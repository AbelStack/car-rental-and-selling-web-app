<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'role_id',
        'status',
        'preferred_language',
        'last_login_at',
        'last_login_ip',
        'kyc_status',
        'kyc_verified_at',
        'kyc_rejection_reason',
        'kyc_attempts',
        'verification_level',
        'phone_verified_at',
        'can_book',
        'can_purchase',
        'restrictions_updated_at',
        // Additional user information fields
        'national_id',
        'city',
        'address',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'last_login_at' => 'datetime',
            'locked_until' => 'datetime',
            'kyc_verified_at' => 'datetime',
            'phone_verified_at' => 'datetime',
            'restrictions_updated_at' => 'datetime',
            'can_book' => 'boolean',
            'can_purchase' => 'boolean',
        ];
    }

    // Relationships
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    public function auditLogs(): HasMany
    {
        return $this->hasMany(AuditLog::class);
    }

    public function kycVerifications(): HasMany
    {
        return $this->hasMany(KycVerification::class);
    }

    public function currentKyc(): HasOne
    {
        return $this->hasOne(KycVerification::class)->latest();
    }

    public function chapaTransactions(): HasMany
    {
        return $this->hasMany(ChapaTransaction::class);
    }

    public function supportTickets(): HasMany
    {
        return $this->hasMany(SupportTicket::class);
    }

    public function ticketMessages(): HasMany
    {
        return $this->hasMany(TicketMessage::class);
    }

    // Helper methods
    public function isAdmin(): bool
    {
        return $this->role && in_array($this->role->name, ['admin', 'super_admin']);
    }

    public function isSuperAdmin(): bool
    {
        return $this->role && $this->role->name === 'super_admin';
    }

    public function isActive(): bool
    {
        return $this->status === 'active';
    }

    public function isLocked(): bool
    {
        return $this->locked_until && $this->locked_until->isFuture();
    }

    public function canLogin(): bool
    {
        return $this->isActive() && !$this->isLocked();
    }

    // KYC Methods
    public function isKycVerified(): bool
    {
        return $this->kyc_status === 'verified' && $this->kyc_verified_at;
    }

    public function isKycPending(): bool
    {
        return in_array($this->kyc_status, ['pending', 'under_review']);
    }

    public function isKycRejected(): bool
    {
        return $this->kyc_status === 'rejected';
    }

    public function canSubmitKyc(): bool
    {
        return in_array($this->kyc_status, ['unverified', 'rejected']) && $this->kyc_attempts < 3;
    }

    public function canBookVehicles(): bool
    {
        return $this->isKycVerified() && $this->can_book;
    }

    public function canPurchaseVehicles(): bool
    {
        return $this->isKycVerified() && $this->can_purchase;
    }

    public function getVerificationLevelLabel(): string
    {
        return match($this->verification_level) {
            1 => 'Email Verified',
            2 => 'Phone Verified',
            3 => 'KYC Verified',
            default => 'Unverified',
        };
    }

    public function getKycStatusBadgeClass(): string
    {
        return match($this->kyc_status) {
            'unverified' => 'bg-gray-100 text-gray-800',
            'pending' => 'bg-yellow-100 text-yellow-800',
            'under_review' => 'bg-blue-100 text-blue-800',
            'verified' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            'expired' => 'bg-orange-100 text-orange-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
