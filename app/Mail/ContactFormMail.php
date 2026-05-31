<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->from($this->data['email'], $this->data['name'])
                    ->subject('Nouveau message de contact - ' . $this->data['subject'])
                    ->view('emails.contact')
                    ->with('data', $this->data);
    }
}