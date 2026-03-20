<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CertificateMail extends Mailable
{
    use Queueable, SerializesModels;

    public $recipientName;

    public $pdfPath;

    public function __construct($name, $pdfPath)
    {
        $this->recipientName = $name;
        $this->pdfPath = $pdfPath;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your Certificate',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.certificate',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath(storage_path('app/'.$this->pdfPath))
                ->as('certificate.pdf')
                ->withMime('application/pdf'),
        ];
    }
}
