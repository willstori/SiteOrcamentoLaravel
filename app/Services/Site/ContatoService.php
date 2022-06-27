<?php

namespace App\Services\Site;

use App\Mail\SendMailContato;
use App\Site;
use Illuminate\Support\Facades\Mail;

class ContatoService implements IContatoService
{
    public function email($request)
    {
        if(!empty($request->check1) || !empty($request->check2)){

            return [
                'titulo' => "Falha!",
                'mensagem' => "Navegação incomum detectada",
                'tipo' => "error",
                'status' => 403
            ];

        }

        $site = Site::find(1);

        $Formulario = $request->except(['check1', 'check2']);

        if(env('APP_ENV') == "production"){
            Mail::to($site->email)->send(new SendMailContato("Contato pelo site Herval Embalagens", $Formulario));
        }

        return [
            'titulo' => "Sucesso!",
            'mensagem' => "Sua mensagem foi enviada. Em breve entraremos em contato.",
            'tipo' => "success",
            'status' => 200
        ];
    }
}
