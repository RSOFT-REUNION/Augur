<?php

namespace App\Mail\Evenement;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DeleteEvenement extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $evenement;

    /**
     * Create a new message instance.
     */
    public function __construct($user, $evenement)
    {
        $this->user = $user;
        $this->evenement = $evenement;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address('no-reply@augur.re', 'AÜGUR'),
            replyTo: [
                new Address('no-reply@augur.re', 'AÜGUR'),
            ],
            subject: 'AÜGUR - Annulation d\'un évènement',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            markdown: 'emails.evenements.deleteEvenement',
            with: ['user' => $this->user, 'evenement' => $this->evenement]
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
