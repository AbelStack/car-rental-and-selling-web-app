<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SupportTicket extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_number',
        'user_id',
        'subject',
        'description',
        'category',
        'priority',
        'status',
        'assigned_to',
        'assigned_at',
        'resolution',
        'resolved_at',
        'resolved_by',
        'first_response_at',
        'due_at',
        'sla_breached',
        'rating',
        'feedback',
    ];

    protected function casts(): array
    {
        return [
            'assigned_at' => 'datetime',
            'resolved_at' => 'datetime',
            'first_response_at' => 'datetime',
            'due_at' => 'datetime',
            'sla_breached' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($ticket) {
            if (!$ticket->ticket_number) {
                $ticket->ticket_number = 'TKT-' . date('Ymd') . '-' . str_pad(
                    static::whereDate('created_at', today())->count() + 1, 
                    4, 
                    '0', 
                    STR_PAD_LEFT
                );
            }
            
            // Set SLA due date based on priority
            if (!$ticket->due_at) {
                $hours = match($ticket->priority) {
                    'urgent' => 2,
                    'high' => 8,
                    'medium' => 24,
                    'low' => 72,
                    default => 24,
                };
                $ticket->due_at = Carbon::now()->addHours($hours);
            }
        });
    }

    // Relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function resolvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'resolved_by');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(TicketMessage::class, 'ticket_id');
    }

    // Helper Methods
    public function isOpen(): bool
    {
        return in_array($this->status, ['open', 'in_progress', 'waiting_customer']);
    }

    public function isClosed(): bool
    {
        return in_array($this->status, ['resolved', 'closed']);
    }

    public function isOverdue(): bool
    {
        return $this->due_at && $this->due_at->isPast() && $this->isOpen();
    }

    public function getStatusBadgeClass(): string
    {
        return match($this->status) {
            'open' => 'bg-blue-100 text-blue-800',
            'in_progress' => 'bg-yellow-100 text-yellow-800',
            'waiting_customer' => 'bg-purple-100 text-purple-800',
            'resolved' => 'bg-green-100 text-green-800',
            'closed' => 'bg-gray-100 text-gray-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getPriorityBadgeClass(): string
    {
        return match($this->priority) {
            'urgent' => 'bg-red-100 text-red-800',
            'high' => 'bg-orange-100 text-orange-800',
            'medium' => 'bg-yellow-100 text-yellow-800',
            'low' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getCategoryLabel(): string
    {
        return match($this->category) {
            'general' => 'General Inquiry',
            'booking' => 'Booking Issue',
            'payment' => 'Payment Issue',
            'kyc' => 'KYC Verification',
            'technical' => 'Technical Support',
            'complaint' => 'Complaint',
            default => ucfirst($this->category),
        };
    }

    public function getResponseTime(): ?string
    {
        if (!$this->first_response_at) {
            return null;
        }
        
        return $this->created_at->diffForHumans($this->first_response_at, true);
    }
}