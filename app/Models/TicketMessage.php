<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TicketMessage extends Model
{
    use HasFactory;

    protected $fillable = [
        'ticket_id',
        'user_id',
        'message',
        'attachments',
        'is_internal',
        'type',
        'metadata',
        'is_read',
        'read_at',
    ];

    protected function casts(): array
    {
        return [
            'attachments' => 'array',
            'metadata' => 'array',
            'is_internal' => 'boolean',
            'is_read' => 'boolean',
            'read_at' => 'datetime',
        ];
    }

    // Relationships
    public function ticket(): BelongsTo
    {
        return $this->belongsTo(SupportTicket::class, 'ticket_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Helper Methods
    public function isFromCustomer(): bool
    {
        return !$this->user->isAdmin();
    }

    public function isFromAdmin(): bool
    {
        return $this->user->isAdmin();
    }

    public function hasAttachments(): bool
    {
        return !empty($this->attachments);
    }

    public function getTypeLabel(): string
    {
        return match($this->type) {
            'message' => 'Message',
            'status_change' => 'Status Change',
            'assignment' => 'Assignment',
            'resolution' => 'Resolution',
            default => ucfirst($this->type),
        };
    }

    public function markAsRead(): void
    {
        if (!$this->is_read) {
            $this->update([
                'is_read' => true,
                'read_at' => now(),
            ]);
        }
    }
}