<?php

namespace App\Services;

use App\Models\Discount;
use App\Models\DiscountLog;
use Carbon\Carbon;

class DiscountService
{
    /**
     * Calculate the best applicable discount for a booking/purchase
     */
    public function calculateDiscount($type, $baseAmount, $startDate = null, $endDate = null, $vehicleId = null): array
    {
        $duration = null;
        $checkDate = $startDate ? Carbon::parse($startDate) : now();

        // Calculate duration for rentals
        if ($type === 'rental' && $startDate && $endDate) {
            $start = Carbon::parse($startDate);
            $end = Carbon::parse($endDate);
            $duration = $start->diffInDays($end);
        }

        // Get the best applicable discount
        $discount = Discount::getBestDiscount($type, $baseAmount, $checkDate, $duration);

        if (!$discount) {
            return [
                'has_discount' => false,
                'discount' => null,
                'original_amount' => $baseAmount,
                'discount_amount' => 0,
                'final_amount' => $baseAmount,
                'discount_reason' => null
            ];
        }

        $discountAmount = $discount->calculateDiscountAmount($baseAmount);
        $finalAmount = $baseAmount - $discountAmount;

        // Generate discount reason
        $reason = $this->generateDiscountReason($discount, $duration);

        return [
            'has_discount' => true,
            'discount' => $discount,
            'original_amount' => $baseAmount,
            'discount_amount' => $discountAmount,
            'final_amount' => $finalAmount,
            'discount_reason' => $reason
        ];
    }

    /**
     * Apply discount to a booking
     */
    public function applyDiscountToBooking($booking, $discountData): void
    {
        if ($discountData['has_discount']) {
            $discount = $discountData['discount'];
            
            $booking->update([
                'discount_id' => $discount->id,
                'discount_type' => $discount->type,
                'discount_percentage' => $discount->percentage,
                'discount_amount' => $discountData['discount_amount'],
                'original_total' => $discountData['original_amount'],
                'discount_reason' => $discountData['discount_reason'],
                'total_cost' => $discountData['final_amount']
            ]);

            // Log the discount application
            DiscountLog::logAction(
                $discount->id,
                'applied',
                null,
                [
                    'booking_id' => $booking->id,
                    'amount' => $discountData['discount_amount'],
                    'original_total' => $discountData['original_amount'],
                    'final_total' => $discountData['final_amount']
                ],
                "Discount applied to booking #{$booking->id}"
            );
        }
    }

    /**
     * Apply discount to a purchase
     */
    public function applyDiscountToPurchase($purchase, $discountData): void
    {
        if ($discountData['has_discount']) {
            $discount = $discountData['discount'];
            
            $purchase->update([
                'discount_id' => $discount->id,
                'discount_type' => $discount->type,
                'discount_percentage' => $discount->percentage,
                'discount_amount' => $discountData['discount_amount'],
                'original_total' => $discountData['original_amount'],
                'discount_reason' => $discountData['discount_reason'],
                'total_amount' => $discountData['final_amount']
            ]);

            // Log the discount application
            DiscountLog::logAction(
                $discount->id,
                'applied',
                null,
                [
                    'purchase_id' => $purchase->id,
                    'amount' => $discountData['discount_amount'],
                    'original_total' => $discountData['original_amount'],
                    'final_total' => $discountData['final_amount']
                ],
                "Discount applied to purchase #{$purchase->id}"
            );
        }
    }

    /**
     * Preview discount without applying it
     */
    public function previewDiscount($type, $baseAmount, $startDate = null, $endDate = null): array
    {
        return $this->calculateDiscount($type, $baseAmount, $startDate, $endDate);
    }

    /**
     * Get active discounts for display
     */
    public function getActiveDiscounts($type = null): \Illuminate\Database\Eloquent\Collection
    {
        $query = Discount::active()->currentlyValid();

        if ($type) {
            if ($type === 'rental') {
                $query->forRental();
            } elseif ($type === 'selling') {
                $query->forSelling();
            }
        }

        return $query->orderBy('type')->orderByDesc('percentage')->get();
    }

    /**
     * Get discount statistics for admin dashboard
     */
    public function getDiscountStatistics($startDate = null, $endDate = null): array
    {
        $startDate = $startDate ? Carbon::parse($startDate) : now()->startOfMonth();
        $endDate = $endDate ? Carbon::parse($endDate) : now()->endOfMonth();

        // Get bookings with discounts
        $bookingsQuery = \App\Models\Booking::whereNotNull('discount_id')
            ->whereBetween('created_at', [$startDate, $endDate]);

        // Get purchases with discounts
        $purchasesQuery = \App\Models\Purchase::whereNotNull('discount_id')
            ->whereBetween('created_at', [$startDate, $endDate]);

        $totalDiscountedBookings = $bookingsQuery->count();
        $totalDiscountedPurchases = $purchasesQuery->count();
        
        $totalDiscountAmount = $bookingsQuery->sum('discount_amount') + 
                              $purchasesQuery->sum('discount_amount');
        
        $totalOriginalAmount = $bookingsQuery->sum('original_total') + 
                              $purchasesQuery->sum('original_total');

        $averageDiscountPercentage = $totalOriginalAmount > 0 
            ? ($totalDiscountAmount / $totalOriginalAmount) * 100 
            : 0;

        return [
            'total_discounted_transactions' => $totalDiscountedBookings + $totalDiscountedPurchases,
            'total_discounted_bookings' => $totalDiscountedBookings,
            'total_discounted_purchases' => $totalDiscountedPurchases,
            'total_discount_amount' => $totalDiscountAmount,
            'total_original_amount' => $totalOriginalAmount,
            'total_final_amount' => $totalOriginalAmount - $totalDiscountAmount,
            'average_discount_percentage' => round($averageDiscountPercentage, 2),
            'period_start' => $startDate,
            'period_end' => $endDate
        ];
    }

    /**
     * Generate human-readable discount reason
     */
    private function generateDiscountReason($discount, $duration = null): string
    {
        if ($discount->type === 'holiday') {
            return "Holiday discount: {$discount->name} ({$discount->percentage}% off)";
        }

        if ($discount->type === 'duration' && $duration) {
            if ($duration >= 14) {
                return "Long-term rental discount: {$discount->percentage}% off for {$duration}+ days";
            } elseif ($duration >= 7) {
                return "Weekly rental discount: {$discount->percentage}% off for {$duration} days";
            }
        }

        return "Discount applied: {$discount->name} ({$discount->percentage}% off)";
    }

    /**
     * Validate discount rules and conflicts
     */
    public function validateDiscount($discountData): array
    {
        $errors = [];

        // Check for date conflicts with existing holiday discounts
        if ($discountData['type'] === 'holiday') {
            $conflictingDiscounts = Discount::holiday()
                ->active()
                ->where('id', '!=', $discountData['id'] ?? null)
                ->where(function ($query) use ($discountData) {
                    $query->whereBetween('start_date', [$discountData['start_date'], $discountData['end_date']])
                          ->orWhereBetween('end_date', [$discountData['start_date'], $discountData['end_date']])
                          ->orWhere(function ($q) use ($discountData) {
                              $q->where('start_date', '<=', $discountData['start_date'])
                                ->where('end_date', '>=', $discountData['end_date']);
                          });
                })
                ->exists();

            if ($conflictingDiscounts) {
                $errors[] = 'Date range conflicts with existing holiday discount';
            }
        }

        // Validate percentage limits
        if ($discountData['percentage'] > 50) {
            $errors[] = 'Discount percentage cannot exceed 50%';
        }

        if ($discountData['percentage'] <= 0) {
            $errors[] = 'Discount percentage must be greater than 0%';
        }

        return $errors;
    }
}