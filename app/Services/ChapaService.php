<?php

namespace App\Services;

use App\Models\ChapaTransaction;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Exception;

class ChapaService
{
    private string $baseUrl;
    private string $secretKey;
    private string $publicKey;

    public function __construct()
    {
        $this->baseUrl = config('services.chapa.base_url', 'https://api.chapa.co/v1');
        $this->secretKey = config('services.chapa.secret_key');
        $this->publicKey = config('services.chapa.public_key');
    }

    /**
     * Initialize a payment with Chapa
     */
    public function initializePayment(array $data): array
    {
        try {
            $payload = [
                'amount' => $data['amount'],
                'currency' => $data['currency'] ?? 'ETB',
                'email' => $data['email'],
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'phone_number' => $data['phone_number'],
                'tx_ref' => $data['tx_ref'],
                'callback_url' => route('chapa.callback'),
                'return_url' => $data['return_url'],
                'description' => $data['description'] ?? 'Payment for vehicle service',
                'meta' => [
                    'user_id' => $data['user_id'],
                    'payable_type' => $data['payable_type'],
                    'payable_id' => $data['payable_id'],
                ],
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
                'Content-Type' => 'application/json',
            ])->post($this->baseUrl . '/transaction/initialize', $payload);

            if ($response->successful()) {
                $responseData = $response->json();
                
                if ($responseData['status'] === 'success') {
                    return [
                        'success' => true,
                        'data' => $responseData['data'],
                        'checkout_url' => $responseData['data']['checkout_url'],
                    ];
                }
            }

            Log::error('Chapa initialization failed', [
                'response' => $response->json(),
                'status' => $response->status(),
            ]);

            $responseData = $response->json();
            $errorMessage = 'Payment initialization failed. Please try again.';
            
            if (isset($responseData['message'])) {
                if (is_array($responseData['message'])) {
                    // Handle validation errors more user-friendly
                    $validationErrors = [];
                    foreach ($responseData['message'] as $field => $errors) {
                        if (is_array($errors)) {
                            $validationErrors[] = ucfirst($field) . ': ' . implode(', ', $errors);
                        } else {
                            $validationErrors[] = ucfirst($field) . ': ' . $errors;
                        }
                    }
                    $errorMessage = 'Please check your information: ' . implode('. ', $validationErrors);
                } else {
                    // Handle rate limiting and other API errors
                    if (strpos($responseData['message'], 'try again in') !== false) {
                        $errorMessage = 'Too many payment requests. Please wait a moment and try again.';
                    } elseif (strpos($responseData['message'], 'Invalid API Key') !== false) {
                        $errorMessage = 'Payment service is temporarily unavailable. Please contact support.';
                    } else {
                        $errorMessage = $responseData['message'];
                    }
                }
            }

            return [
                'success' => false,
                'message' => $errorMessage,
                'error' => $errorMessage,
            ];

        } catch (Exception $e) {
            Log::error('Chapa initialization exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);

            return [
                'success' => false,
                'message' => 'Payment service is currently unavailable. Please try again later.',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Verify a payment with Chapa
     */
    public function verifyPayment(string $txRef): array
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->secretKey,
            ])->get($this->baseUrl . '/transaction/verify/' . $txRef);

            if ($response->successful()) {
                $responseData = $response->json();
                
                return [
                    'success' => true,
                    'data' => $responseData['data'],
                    'status' => $responseData['data']['status'],
                ];
            }

            Log::error('Chapa verification failed', [
                'tx_ref' => $txRef,
                'response' => $response->json(),
                'status' => $response->status(),
            ]);

            $responseData = $response->json();
            $errorMessage = 'Failed to verify payment.';
            
            if (isset($responseData['message'])) {
                if (is_array($responseData['message'])) {
                    $errorMessage = 'Verification failed: ' . json_encode($responseData['message']);
                } else {
                    $errorMessage = $responseData['message'];
                }
            }

            return [
                'success' => false,
                'message' => $errorMessage,
                'error' => $errorMessage,
            ];

        } catch (Exception $e) {
            Log::error('Chapa verification exception', [
                'tx_ref' => $txRef,
                'message' => $e->getMessage(),
            ]);

            return [
                'success' => false,
                'message' => 'Payment verification failed.',
                'error' => $e->getMessage(),
            ];
        }
    }

    /**
     * Handle Chapa webhook callback
     */
    public function handleCallback(array $data): bool
    {
        try {
            $txRef = $data['tx_ref'] ?? null;
            
            if (!$txRef) {
                Log::error('Chapa callback missing tx_ref', $data);
                return false;
            }

            // Find the transaction
            $transaction = ChapaTransaction::where('chapa_tx_ref', $txRef)->first();
            
            if (!$transaction) {
                Log::error('Chapa callback: transaction not found', ['tx_ref' => $txRef]);
                return false;
            }

            // Update transaction with callback data
            $transaction->update([
                'callback_data' => $data,
                'callback_received_at' => now(),
                'chapa_status' => $data['status'] ?? 'unknown',
            ]);

            // Verify the payment status
            $verification = $this->verifyPayment($txRef);
            
            if ($verification['success']) {
                $this->updateTransactionStatus($transaction, $verification['data']);
                return true;
            }

            return false;

        } catch (Exception $e) {
            Log::error('Chapa callback exception', [
                'data' => $data,
                'message' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Update transaction status based on Chapa response
     */
    private function updateTransactionStatus(ChapaTransaction $transaction, array $chapaData): void
    {
        $status = strtolower($chapaData['status']);
        
        // Map Chapa status to our status
        $ourStatus = match($status) {
            'success' => 'success',
            'failed' => 'failed',
            'pending' => 'pending',
            'cancelled' => 'cancelled',
            default => 'pending',
        };

        $updateData = [
            'status' => $ourStatus,
            'chapa_status' => $status,
            'chapa_response' => $chapaData,
            'chapa_reference' => $chapaData['reference'] ?? null,
        ];

        if ($ourStatus === 'success') {
            $updateData['paid_at'] = now();
        }

        $transaction->update($updateData);

        // Update related booking/purchase status
        if ($ourStatus === 'success') {
            $this->updatePayableStatus($transaction);
        }

        // Log the status change
        AuditLog::log('chapa_payment_' . $ourStatus, $transaction);
    }

    /**
     * Update the status of the related booking or purchase
     */
    private function updatePayableStatus(ChapaTransaction $transaction): void
    {
        $payable = $transaction->payable;
        
        if (!$payable) {
            return;
        }

        if ($transaction->payable_type === 'App\Models\Booking') {
            $payable->update(['status' => 'confirmed']);
            AuditLog::log('booking_payment_confirmed', $payable);
        } elseif ($transaction->payable_type === 'App\Models\Purchase') {
            $payable->update(['status' => 'completed']);
            // Mark vehicle as sold
            $payable->vehicle->update(['is_sold' => true, 'status' => 'sold']);
            AuditLog::log('purchase_payment_confirmed', $payable);
        }
    }

    /**
     * Get payment status for display
     */
    public function getPaymentStatus(ChapaTransaction $transaction): array
    {
        if ($transaction->isSuccessful()) {
            return [
                'status' => 'success',
                'message' => 'Payment completed successfully!',
                'class' => 'text-green-600',
            ];
        }

        if ($transaction->isFailed()) {
            return [
                'status' => 'failed',
                'message' => 'Payment failed. Please try again.',
                'class' => 'text-red-600',
            ];
        }

        if ($transaction->isPending()) {
            return [
                'status' => 'pending',
                'message' => 'Payment is being processed...',
                'class' => 'text-yellow-600',
            ];
        }

        return [
            'status' => 'unknown',
            'message' => 'Payment status unknown.',
            'class' => 'text-gray-600',
        ];
    }
}