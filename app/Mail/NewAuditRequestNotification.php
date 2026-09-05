<?php

namespace App\Mail;

use App\Models\AuditRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class NewAuditRequestNotification extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public AuditRequest $auditRequest) {}

    public function envelope(): Envelope
    {
        return new Envelope(subject: 'New Local Works Digital Friction Audit Request');
    }

    public function content(): Content
    {
        return new Content(view: 'mail.audit-request');
    }
}
