<?php

namespace App\Mail;

use App\Models\Purchase;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PurchaseConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Purchase $purchase;

    /**
     * Create a new message instance.
     */
    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        $subject = app()->getLocale() === 'am' 
            ? 'የተሽከርካሪ ግዢ ማረጋገጫ - ' . $this->purchase->purchase_reference
            : 'Vehicle Purchase Confirmation - ' . $this->purchase->purchase_reference;

        return new Envelope(
            subject: $subject,
            from: config('mail.from.address', 'fitsumgashaw22@gmail.com'),
            replyTo: 'fitsumgashaw22@gmail.com'
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.purchase-confirmation',
            with: [
                'purchase' => $this->purchase,
                'user' => $this->purchase->user,
                'vehicle' => $this->purchase->vehicle,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}