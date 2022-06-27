<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailContato extends Mailable
{
    use Queueable, SerializesModels;

    private $Subject;
    private $Form;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Subject, $Form)
    {
        $this->Subject = $Subject;
        $this->Form = $Form;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->Subject)
                ->view('site.emails.contato')
                ->with([
                    'Assunto' => $this->Subject,
                    'Formulario' => $this->Form
                ]);
    }
}
