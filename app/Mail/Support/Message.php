<?php

namespace App\Mail\Support;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class Message extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $support;
    /**
     * Create a new message instance.
     */
    public function __construct($user, $support)
    {
        $this->user = $user;
        $this->support = $support;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('contact@augur.re', 'AÜGUR'),
            replyTo: [
                new Address('contact@augur.re', 'AÜGUR'),
            ],
            subject: 'AÜGUR - Message de support provenant du site',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.support.message',
            with: ['user' => $this->user, 'support' => $this->support]
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
