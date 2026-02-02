<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;
use Carbon\Carbon;

class KycVerification extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'document_type',
        'document_number',
        'document_front_path',
        'document_back_path',
        'selfie_path',
        'full_name',
        'date_of_birth',
        'gender',
        'nationality',
        'document_expiry_date',
        'place_of_birth',
        'address_line_1',
        'address_line_2',
        'city',
        'region',
        'postal_code',
        'status',
        'rejection_reason',
        'verification_notes',
        'verified_by',
        'verified_at',
        'expires_at',
        'ip_address',
        'user_agent',
        'attempt_number',
    ];

    protected function casts(): array
    {
        return [
            'date_of_birth' => 'date',
            'document_expiry_date' => 'date',
            'verified_at' => 'datetime',
            'expires_at' => 'datetime',
            'verification_notes' => 'array',
            'user_agent' => 'array',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($kyc) {
            // Set expiry date (1 year from verification)
            if (!$kyc->expires_at && $kyc->status === 'approved') {
                $kyc->expires_at = Carbon::now()->addYear();
            }
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    // Helper Methods
    public function isPending(): bool
    {
        return in_array($this->status, ['pending', 'under_review']);
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }

    public function isExpired(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    public function canResubmit(): bool
    {
        return $this->isRejected() && $this->attempt_number < 3;
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'pending' => 'bg-yellow-100 text-yellow-800',
            'under_review' => 'bg-blue-100 text-blue-800',
            'approved' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'expired' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getDocumentTypeLabel(): string
    {
        return match($this->document_type) {
            'national_id' => 'National ID',
            'passport' => 'Passport',
            default => ucfirst($this->document_type),
        };
    }

    public function getAge(): int
    {
        return $this->date_of_birth->age;
    }

    public function isAdult(): bool
    {
        return $this->getAge() >= 18;
    }
}