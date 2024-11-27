<?php

namespace App\Mail;

use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecieptEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $booking;
    public $additionalInfo;

    /**
     * Create a new message instance.
     *
     * @param  Booking  $booking
     * @param  string|null  $additionalInfo
     * @return void
     */
    public function __construct($booking, $additionalInfo = null)
    {
        $this->booking = $booking;
        $this->additionalInfo = $additionalInfo;
    }

    /**
     * Get the message envelope.
     *
     * @return Envelope
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Booking Confirmation',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return Content
     */
    public function content(): Content
    {
        return new Content(
            view: 'bookings.email_content',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
