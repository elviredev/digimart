<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class DefaultMail extends Mailable
{
  use Queueable, SerializesModels;

  /**
   * Create a new message instance.
   */
  public function __construct(
    public string $name,
    public string $mailSubject,
    public string $content,
    public string $toMail
  ){}

  /**
   * Get the message envelope.
   */
  public function envelope(): Envelope
  {
    return new Envelope(
      from: 'admin@example.com',
      to: $this->toMail,
      subject: $this->mailSubject
    );
  }

  /**
   * Get the message content definition.
   */
  public function content(): Content
  {
    return new Content(
      view: 'mails.default-mail',
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
