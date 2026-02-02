<?php

namespace App\Http\Controllers;

use App\Models\Vehicle;
use App\Models\Purchase;
use App\Models\Payment;
use App\Models\AuditLog;
use App\Services\DiscountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PurchaseController extends Controller
{
    protected $discountService;

    public function __construct(DiscountService $discountService)
    {
        $this->discountService = $discountService;
    }

    /**
     * Show the purchase confirmation page with user information form
     */
    public function create(Vehicle $vehicle)
    {
        // Check if user is authenticated
        if (!auth()->check()) {
            return redirect()->route('login')->with('intended_purchase', $vehicle->id);
        }

        // Check KYC verification
        if (!auth()->user()->canPurchaseVehicles()) {
            return redirect()->route('kyc.index')
                ->with('error', 'Please complete KYC verification to purchase vehicles.');
        }

        if (!$vehicle->isAvailableForSale()) {
            return back()->with('error', 'Vehicle is not available for purchase.');
        }

        return view('purchases.confirm', compact('vehicle'));
    }

    /**
     * Store the purchase and redirect to payment
     */
    public function store(Request $request, Vehicle $vehicle)
    {
        // Validate user information
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'national_id' => 'nullable|string|max:50',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'terms' => 'required|accepted',
            'save_info' => 'nullable|boolean',
        ]);

        // Check KYC verification
        if (!auth()->user()->canPurchaseVehicles()) {
            return redirect()->route('kyc.index')
                ->with('error', 'Please complete KYC verification to purchase vehicles.');
        }

        if (!$vehicle->isAvailableForSale()) {
            return back()->with('error', 'Vehicle is not available for purchase.');
        }

        DB::beginTransaction();
        try {
            $salePrice = $vehicle->sale_price;
            
            // Calculate discount
            $discountData = $this->discountService->calculateDiscount(
                'selling',
                $salePrice,
                now() // Purchase date is today
            );
            
            $taxAmount = $discountData['final_amount'] * 0.15; // 15% tax on discounted amount
            $totalAmount = $discountData['final_amount'] + $taxAmount;

            // Create purchase
            $purchase = Purchase::create([
                'user_id' => auth()->id(),
                'vehicle_id' => $vehicle->id,
                'purchase_price' => $salePrice,
                'tax_amount' => $taxAmount,
                'total_amount' => $totalAmount,
                'status' => 'pending',
                // Discount fields
                'discount_id' => $discountData['has_discount'] ? $discountData['discount']->id : null,
                'discount_type' => $discountData['has_discount'] ? $discountData['discount']->type : null,
                'discount_percentage' => $discountData['has_discount'] ? $discountData['discount']->percentage : null,
                'discount_amount' => $discountData['discount_amount'],
                'original_total' => $discountData['original_amount'],
                'discount_reason' => $discountData['discount_reason'],
            ]);

            // Apply discount logging if applicable
            if ($discountData['has_discount']) {
                $this->discountService->applyDiscountToPurchase($purchase, $discountData);
            }

            // Update user information if requested
            if ($request->save_info) {
                auth()->user()->update([
                    'name' => $request->full_name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'national_id' => $request->national_id,
                    'city' => $request->city,
                    'address' => $request->address,
                ]);
            }

            AuditLog::log('purchase_created', $purchase);

            DB::commit();

            // Redirect directly to Chapa payment
            return redirect()->route('purchases.show', $purchase)
                ->with('success', 'Purchase created successfully! Please complete payment.')
                ->with('redirect_to_payment', true);

        } catch (\Exception $e) {
            DB::rollback();
            
            // Log the actual error for debugging
            \Log::error('Purchase creation failed', [
                'user_id' => auth()->id(),
                'vehicle_id' => $vehicle->id,
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()->with('error', 'Failed to create purchase request. Please try again.');
        }
    }

    public function payment(Purchase $purchase)
    {
        if ($purchase->user_id !== auth()->id()) {
            abort(403);
        }

        // Redirect to show method instead - payment is now handled via Chapa
        return redirect()->route('purchases.show', $purchase);
    }

    public function show(Purchase $purchase)
    {
        if ($purchase->user_id !== auth()->id()) {
            abort(403);
        }

        $purchase->load(['vehicle.images', 'payment']);

        return view('purchases.show', compact('purchase'));
    }
}