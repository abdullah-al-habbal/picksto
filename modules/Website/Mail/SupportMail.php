<?php

declare(strict_types=1);

namespace Modules\Website\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

final class SupportMail extends Mailable
{
    public function __construct(
        public readonly string $senderName,
        public readonly string $senderEmail,
        public readonly string $subjectText,
        public readonly string $messageBody,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "Support: {$this->subjectText}",
        );
    }

    public function content(): Content
    {
        return new Content(
            text: 'website::mail.support',
        );
    }
}
