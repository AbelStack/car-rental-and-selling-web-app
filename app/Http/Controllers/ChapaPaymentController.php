<?php

namespace App\Http\Controllers;

use App\Models\ChapaTransaction;
use App\Models\Booking;
use App\Models\Purchase;
use App\Models\AuditLog;
use App\Services\ChapaService;
use App\Mail\PurchaseConfirmationMail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ChapaPaymentController extends Controller
{
    private ChapaService $chapaService;

    public function __construct(ChapaService $chapaService)
    {
        $this->chapaService = $chapaService;
    }

    /**
     * Initialize payment for a booking
     */
    public function initializeBookingPayment(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) {
            abort(403);
        }

        if (!auth()->user()->canBookVehicles()) {
            return redirect()->route('kyc.index')
                ->with('error', 'KYC verification is required to make bookings. Please complete your identity verification to continue.');
        }

        if ($booking->status !== 'pending_payment') {
            $statusMessage = match($booking->status) {
                'confirmed' => 'This booking has already been confirmed and paid for.',
                'completed' => 'This booking has already been completed.',
                'cancelled' => 'This booking has been cancelled and cannot be paid.',
                'active' => 'This booking is currently active.',
                default => "This booking is currently {$booking->status} and cannot be paid at this time."
            };
            
            return redirect()->route('bookings.show', $booking)
                ->with('error', $statusMessage);
        }

        return $this->initializePayment($booking, 'booking');
    }

    /**
     * Initialize payment for a purchase
     */
    public function initializePurchasePayment(Request $request, Purchase $purchase)
    {
        if ($purchase->user_id !== auth()->id()) {
            abort(403);
        }

        if (!auth()->user()->canPurchaseVehicles()) {
            return redirect()->route('kyc.index')
                ->with('error', 'KYC verification is required to make purchases. Please complete your identity verification to continue.');
        }

        if ($purchase->status !== 'pending') {
            $statusMessage = match($purchase->status) {
                'completed' => 'This purchase has already been completed and paid for.',
                'payment_submitted' => 'Payment has been submitted and is being processed.',
                'verified' => 'This purchase has been verified and is being processed.',
                'cancelled' => 'This purchase has been cancelled and cannot be paid.',
                'rejected' => 'This purchase has been rejected and cannot be paid.',
                default => "This purchase is currently {$purchase->status} and cannot be paid at this time."
            };
            
            return redirect()->route('purchases.show', $purchase)
                ->with('error', $statusMessage);
        }

        return $this->initializePayment($purchase, 'purchase');
    }

    /**
     * Initialize payment for any payable model
     */
    private function initializePayment($payable, string $type)
    {
        $user = auth()->user();
        
        // Check if there's already a pending transaction
        $existingTransaction = ChapaTransaction::where('payable_type', get_class($payable))
            ->where('payable_id', $payable->id)
            ->where('status', 'initiated')
            ->first();

        if ($existingTransaction) {
            return redirect($existingTransaction->checkout_url);
        }

        // Create new transaction
        $transaction = ChapaTransaction::create([
            'payable_type' => get_class($payable),
            'payable_id' => $payable->id,
            'user_id' => $user->id,
            'amount' => $payable->total_amount,
            'currency' => 'ETB',
            'email' => $user->email,
            'phone_number' => $user->phone,
            'first_name' => explode(' ', $user->name)[0],
            'last_name' => explode(' ', $user->name, 2)[1] ?? '',
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);

        // Initialize payment with Chapa
        $result = $this->chapaService->initializePayment([
            'amount' => $transaction->amount,
            'currency' => $transaction->currency,
            'email' => $transaction->email,
            'first_name' => $transaction->first_name,
            'last_name' => $transaction->last_name,
            'phone_number' => $transaction->phone_number,
            'tx_ref' => $transaction->chapa_tx_ref,
            'return_url' => route('chapa.return', $transaction),
            'description' => "Payment for {$type} #{$payable->id}",
            'user_id' => $user->id,
            'payable_type' => get_class($payable),
            'payable_id' => $payable->id,
        ]);

        if ($result['success']) {
            // Update transaction with Chapa response
            $transaction->update([
                'status' => 'pending',
                'checkout_url' => $result['checkout_url'],
                'chapa_response' => $result['data'],
            ]);

            AuditLog::log('chapa_payment_initiated', $transaction);

            // Redirect to Chapa checkout
            return redirect($result['checkout_url']);
        }

        // Payment initialization failed
        $transaction->update(['status' => 'failed']);
        
        return back()->with('error', $result['message'] ?? 'Failed to initialize payment. Please try again.');
    }

    /**
     * Handle return from Chapa checkout
     */
    public function handleReturn(Request $request, ChapaTransaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        // Verify payment status with Chapa
        $verification = $this->chapaService->verifyPayment($transaction->chapa_tx_ref);
        
        if ($verification['success']) {
            $status = strtolower($verification['data']['status']);
            
            if ($status === 'success') {
                $transaction->update([
                    'status' => 'success',
                    'paid_at' => now(),
                    'chapa_response' => $verification['data'],
                ]);

                // Update payable status
                $this->updatePayableStatus($transaction);

                return redirect()->route('chapa.success', $transaction)
                    ->with('success', 'Payment completed successfully!');
            }
        }

        return redirect()->route('chapa.failed', $transaction)
            ->with('error', 'Payment was not successful. Please try again.');
    }

    /**
     * Show payment success page
     */
    public function success(ChapaTransaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->load('payable');
        
        return view('payments.chapa.success', compact('transaction'));
    }

    /**
     * Show payment failed page
     */
    public function failed(ChapaTransaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $transaction->load('payable');
        
        return view('payments.chapa.failed', compact('transaction'));
    }

    /**
     * Handle Chapa webhook callback
     */
    public function callback(Request $request)
    {
        $signature = $request->header('Chapa-Signature');
        
        // Verify webhook signature (if configured)
        if (config('services.chapa.webhook_secret')) {
            $expectedSignature = hash_hmac('sha256', $request->getContent(), config('services.chapa.webhook_secret'));
            
            if (!hash_equals($expectedSignature, $signature)) {
                return response('Unauthorized', 401);
            }
        }

        $success = $this->chapaService->handleCallback($request->all());
        
        return response($success ? 'OK' : 'Failed', $success ? 200 : 400);
    }

    /**
     * Check payment status via API
     */
    public function checkStatus(ChapaTransaction $transaction)
    {
        if ($transaction->user_id !== auth()->id()) {
            abort(403);
        }

        $verification = $this->chapaService->verifyPayment($transaction->chapa_tx_ref);
        
        if ($verification['success']) {
            // Update local status if needed
            $chapaStatus = strtolower($verification['data']['status']);
            
            if ($chapaStatus !== $transaction->chapa_status) {
                $transaction->update([
                    'chapa_status' => $chapaStatus,
                    'status' => match($chapaStatus) {
                        'success' => 'success',
                        'failed' => 'failed',
                        'pending' => 'pending',
                        default => $transaction->status,
                    },
                ]);

                if ($chapaStatus === 'success' && $transaction->status === 'success') {
                    $this->updatePayableStatus($transaction);
                }
            }
        }

        return response()->json([
            'status' => $transaction->status,
            'chapa_status' => $transaction->chapa_status,
            'message' => $this->chapaService->getPaymentStatus($transaction)['message'],
        ]);
    }

    /**
     * Update the status of the related booking or purchase
     */
    private function updatePayableStatus(ChapaTransaction $transaction): void
    {
        Log::info('updatePayableStatus called', [
            'transaction_id' => $transaction->id,
            'payable_type' => $transaction->payable_type,
            'payable_id' => $transaction->payable_id
        ]);
        
        $payable = $transaction->payable;
        
        if (!$payable) {
            Log::warning('No payable found for transaction', ['transaction_id' => $transaction->id]);
            return;
        }

        if ($transaction->payable_type === 'App\Models\Booking') {
            $payable->update(['status' => 'confirmed']);
            AuditLog::log('booking_payment_confirmed', $payable);
            
            Log::info('Booking payment confirmed', ['booking_id' => $payable->id]);
            
        } elseif ($transaction->payable_type === 'App\Models\Purchase') {
            Log::info('Processing purchase payment confirmation', [
                'purchase_id' => $payable->id,
                'purchase_reference' => $payable->purchase_reference
            ]);
            
            $payable->update(['status' => 'completed']);
            
            // Mark vehicle as sold
            $payable->vehicle->update(['is_sold' => true, 'status' => 'sold']);
            
            // Log the purchase completion
            AuditLog::log('purchase_payment_confirmed', $payable);
            
            // Send purchase confirmation email
            try {
                // Load the purchase with related data
                $purchase = $payable->load(['user', 'vehicle']);
                
                // Add debug logging
                Log::info('Attempting to send purchase confirmation email', [
                    'purchase_id' => $purchase->id,
                    'purchase_reference' => $purchase->purchase_reference,
                    'user_email' => $purchase->user->email,
                    'vehicle' => $purchase->vehicle->full_name
                ]);
                
                // Send email to the customer
                Mail::to($purchase->user->email)->send(new PurchaseConfirmationMail($purchase));
                
                // Log successful email sending
                Log::info('Purchase confirmation email sent successfully', [
                    'purchase_id' => $purchase->id,
                    'purchase_reference' => $purchase->purchase_reference,
                    'user_email' => $purchase->user->email,
                    'vehicle' => $purchase->vehicle->full_name
                ]);
                
            } catch (\Exception $e) {
                // Log email sending failure but don't break the payment process
                Log::error('Failed to send purchase confirmation email', [
                    'purchase_id' => $payable->id,
                    'purchase_reference' => $payable->purchase_reference,
                    'user_email' => $payable->user->email,
                    'error' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
            }
        }
    }
}