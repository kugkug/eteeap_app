<?php

declare(strict_types=1);
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class EteeapMailer extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $view;
    public $data;
    public $type;
    
    public function __construct(array $array_info) {
        $this->type = $array_info['type'];
        $this->data = $array_info['data'];
    }

    public function envelope(): Envelope {
        return new Envelope(
            subject: messageHelper()->getEmailSubject($this->type),
        );
    }
    
    public function content(): Content {
        return new Content(
            view: "mailer.".messageHelper()->getEmailView($this->type),
        );
    }

    public function attachments(): array
    {
        return [];
    }
}