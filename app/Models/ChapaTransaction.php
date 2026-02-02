<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Str;

class ChapaTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'chapa_tx_ref',
        'our_tx_ref',
        'payable_type',
        'payable_id',
        'user_id',
        'amount',
        'currency',
        'email',
        'phone_number',
        'first_name',
        'last_name',
        'status',
        'chapa_status',
        'chapa_response',
        'checkout_url',
        'paid_at',
        'chapa_reference',
        'callback_data',
        'callback_received_at',
        'ip_address',
        'user_agent',
    ];

    protected function casts(): array
    {
        return [
            'amount' => 'decimal:2',
            'chapa_response' => 'array',
            'callback_data' => 'array',
            'user_agent' => 'array',
            'paid_at' => 'datetime',
            'callback_received_at' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($transaction) {
            if (!$transaction->our_tx_ref) {
                $transaction->our_tx_ref = 'TXN-' . strtoupper(Str::random(12));
            }
            
            if (!$transaction->chapa_tx_ref) {
                $transaction->chapa_tx_ref = 'chapa-' . time() . '-' . Str::random(8);
            }
        });
    }

    // Relationships
    public function payable(): MorphTo
    {
        return $this->morphTo();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Helper Methods
    public function isSuccessful(): bool
    {
        return $this->status === 'success';
    }

    public function isPending(): bool
    {
        return in_array($this->status, ['initiated', 'pending']);
    }

    public function isFailed(): bool
    {
        return in_array($this->status, ['failed', 'cancelled']);
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'initiated' => 'bg-blue-100 text-blue-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'success' => 'bg-green-100 text-green-800',
            'failed' => 'bg-red-100 text-red-800',
            'cancelled' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getFormattedAmount(): string
    {
        return number_format($this->amount, 2) . ' ' . $this->currency;
    }

    public function canRetry(): bool
    {
        return $this->isFailed() && $this->created_at->diffInHours() < 24;
    }
}