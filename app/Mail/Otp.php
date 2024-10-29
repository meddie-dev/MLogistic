<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address; // Import Address class
use Illuminate\Queue\SerializesModels;

class Otp extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;  // Property to hold the OTP
    public $user; // Property to hold the user

    /**
     * Create a new message instance.
     */
    public function __construct(string $otp, $user) // Updated constructor
    {
        $this->otp = $otp;
        $this->user = $user;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Account Deletion OTP',
            from: new Address('admin@example.com', 'Admin') // Correct usage of Address
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mails.otp', // Ensure this view exists
            with: [
                'otp' => $this->otp, // Pass OTP to the view
                'user' => $this->user, // Pass user to the view
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
