<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Discount extends Model
{
    protected $fillable = [
        'name',
        'type',
        'percentage',
        'applies_to',
        'start_date',
        'end_date',
        'description',
        'is_active',
        'conditions'
    ];

    protected function casts(): array
    {
        return [
            'percentage' => 'decimal:2',
            'start_date' => 'date',
            'end_date' => 'date',
            'is_active' => 'boolean',
            'conditions' => 'array',
        ];
    }

    // Relationships
    public function logs(): HasMany
    {
        return $this->hasMany(DiscountLog::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeHoliday($query)
    {
        return $query->where('type', 'holiday');
    }

    public function scopeDuration($query)
    {
        return $query->where('type', 'duration');
    }

    public function scopeForRental($query)
    {
        return $query->whereIn('applies_to', ['rental', 'both']);
    }

    public function scopeForSelling($query)
    {
        return $query->whereIn('applies_to', ['selling', 'both']);
    }

    public function scopeCurrentlyValid($query, $date = null)
    {
        $date = $date ?: now()->toDateString();
        
        return $query->where(function ($q) use ($date) {
            $q->where('type', 'duration') // Duration discounts are always valid when active
              ->orWhere(function ($subQ) use ($date) {
                  $subQ->where('type', 'holiday')
                       ->where('start_date', '<=', $date)
                       ->where('end_date', '>=', $date);
              });
        });
    }

    // Business Logic Methods
    public function isValidForDate($date = null): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($this->type === 'duration') {
            return true; // Duration discounts are always valid when active
        }

        $checkDate = $date ? Carbon::parse($date) : now();
        
        return $checkDate->between(
            Carbon::parse($this->start_date),
            Carbon::parse($this->end_date)
        );
    }

    public function isValidForDuration($days): bool
    {
        if ($this->type !== 'duration') {
            return false;
        }

        $conditions = $this->conditions ?? [];
        
        // Default duration rules if not specified
        if (empty($conditions)) {
            return $days >= 7; // Minimum 7 days for duration discount
        }

        foreach ($conditions as $condition) {
            $minDays = $condition['min_days'] ?? 0;
            $maxDays = $condition['max_days'] ?? PHP_INT_MAX;
            
            if ($days >= $minDays && $days <= $maxDays) {
                return true;
            }
        }

        return false;
    }

    public function calculateDiscountAmount($baseAmount): float
    {
        return round($baseAmount * ($this->percentage / 100), 2);
    }

    // Static Methods for Business Logic
    public static function getApplicableDiscounts($type, $date = null, $duration = null): \Illuminate\Database\Eloquent\Collection
    {
        $query = static::active()->currentlyValid($date);

        if ($type === 'rental') {
            $query->forRental();
        } elseif ($type === 'selling') {
            $query->forSelling();
        }

        $discounts = $query->get();

        // Filter duration discounts by actual duration
        if ($duration !== null) {
            $discounts = $discounts->filter(function ($discount) use ($duration) {
                if ($discount->type === 'duration') {
                    return $discount->isValidForDuration($duration);
                }
                return true;
            });
        }

        return $discounts;
    }

    public static function getBestDiscount($type, $baseAmount, $date = null, $duration = null): ?self
    {
        $applicableDiscounts = static::getApplicableDiscounts($type, $date, $duration);

        if ($applicableDiscounts->isEmpty()) {
            return null;
        }

        // Priority: Holiday > Duration (as per specification)
        $holidayDiscounts = $applicableDiscounts->where('type', 'holiday');
        $durationDiscounts = $applicableDiscounts->where('type', 'duration');

        // If holiday discounts exist, choose the best one
        if ($holidayDiscounts->isNotEmpty()) {
            return $holidayDiscounts->sortByDesc('percentage')->first();
        }

        // Otherwise, choose the best duration discount
        if ($durationDiscounts->isNotEmpty()) {
            return $durationDiscounts->sortByDesc('percentage')->first();
        }

        return null;
    }

    // System Duration Discounts (Default Rules)
    public static function getSystemDurationDiscounts(): array
    {
        return [
            [
                'name' => '7-13 Days Discount',
                'min_days' => 7,
                'max_days' => 13,
                'percentage' => 3.00
            ],
            [
                'name' => '14+ Days Discount',
                'min_days' => 14,
                'max_days' => null,
                'percentage' => 6.00
            ]
        ];
    }
}
