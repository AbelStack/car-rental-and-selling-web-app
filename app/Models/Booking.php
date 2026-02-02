<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Support\Str;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_reference',
        'user_id',
        'vehicle_id',
        'pickup_date',
        'return_date',
        'total_days',
        'driving_option',
        'pickup_location',
        'pickup_latitude',
        'pickup_longitude',
        'return_location',
        'return_latitude',
        'return_longitude',
        'daily_rate',
        'driver_cost',
        'subtotal',
        'tax_amount',
        'total_amount',
        'status',
        'cancellation_reason',
        'cancelled_at',
        'special_requests',
        // Discount fields
        'discount_id',
        'discount_type',
        'discount_percentage',
        'discount_amount',
        'original_total',
        'discount_reason',
    ];

    protected function casts(): array
    {
        return [
            'pickup_date' => 'date',
            'return_date' => 'date',
            'daily_rate' => 'decimal:2',
            'driver_cost' => 'decimal:2',
            'subtotal' => 'decimal:2',
            'tax_amount' => 'decimal:2',
            'total_amount' => 'decimal:2',
            'pickup_latitude' => 'decimal:8',
            'pickup_longitude' => 'decimal:8',
            'return_latitude' => 'decimal:8',
            'return_longitude' => 'decimal:8',
            'cancelled_at' => 'datetime',
            // Discount field casts
            'discount_percentage' => 'decimal:2',
            'discount_amount' => 'decimal:2',
            'original_total' => 'decimal:2',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($booking) {
            if (!$booking->booking_reference) {
                $booking->booking_reference = 'BK-' . strtoupper(Str::random(8));
            }
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle(): BelongsTo
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function discount(): BelongsTo
    {
        return $this->belongsTo(\App\Models\Discount::class);
    }

    public function payment(): MorphOne
    {
        return $this->morphOne(Payment::class, 'payable');
    }

    public function chapaTransactions(): MorphMany
    {
        return $this->morphMany(ChapaTransaction::class, 'payable');
    }

    public function latestChapaTransaction(): MorphOne
    {
        return $this->morphOne(ChapaTransaction::class, 'payable')->latest();
    }

    // Helper methods
    public function calculateTotalDays(): int
    {
        return $this->pickup_date->diffInDays($this->return_date) + 1;
    }

    public function calculateSubtotal(): float
    {
        $rentalCost = $this->daily_rate * $this->total_days;
        $driverCost = $this->driving_option === 'with_driver' ? ($this->driver_cost * $this->total_days) : 0;
        return $rentalCost + $driverCost;
    }

    public function canBeCancelled(): bool
    {
        return in_array($this->status, ['pending_payment', 'paid', 'confirmed']) && 
               $this->pickup_date->isFuture();
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isPaid(): bool
    {
        return in_array($this->status, ['paid', 'confirmed', 'active', 'completed']);
    }
}