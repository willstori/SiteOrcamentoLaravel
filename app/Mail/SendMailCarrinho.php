<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailCarrinho extends Mailable
{
    use Queueable, SerializesModels;

    private $Subject;
    private $Form;
    private $Carrinho;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($Subject, $Form, $Carrinho)
    {
        $this->Subject = $Subject;
        $this->Form = $Form;
        $this->Carrinho = $Carrinho;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->Subject)
                ->view('site.emails.orcamento')
                ->with([
                    'Assunto' => $this->Subject,
                    'Formulario'=> $this->Form,
                    'Carrinho' => $this->Carrinho
                ]);
    }
}
