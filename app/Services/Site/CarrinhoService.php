<?php

namespace App\Services\Site;

use App\Mail\SendMailCarrinho;
use App\Site;
use App\Produto;
use Illuminate\Support\Facades\Mail;

class CarrinhoService implements ICarrinhoService
{
    public function listar($request)
    {
        $ViewData['site'] = Site::find(1);

        $carrinho = $request->session()->get('carrinho', []);

        $ViewData['itens'] = [];

        foreach ($carrinho as $item) {
            array_push($ViewData['itens'], [
                'produto' => Produto::find($item['produto']),
                'quantidade' => $item['quantidade']
            ]);
        }

        return $ViewData;
    }

    public function Adicionar($request)
    {
        $carrinho = $request->session()->get('carrinho', []);

        for ($i = 0; $i < count($carrinho); $i++) {

            if ($carrinho[$i]['produto'] == $request->id) {
                $carrinho[$i]['quantidade']++;

                $request->session()->put('carrinho', $carrinho);

                return ['mensagem' => "Item Adicionado ao Carrinho"];
            }
        }

        array_push($carrinho, [
            'produto' => $request->id,
            'quantidade' => 1
        ]);

        $request->session()->put('carrinho', $carrinho);

        return ['mensagem' => "Item Adicionado ao Carrinho"];
    }

    public function alterar($request)
    {
        $carrinho = $request->session()->get('carrinho', []);

        for ($i = 0; $i < count($carrinho); $i++) {

            if ($carrinho[$i]['produto'] == $request->id) {

                $carrinho[$i]['quantidade'] = $request->quantidade > 0 ? $request->quantidade : 1;

                $request->session()->put('carrinho', $carrinho);

                return ['quantidade' => $carrinho[$i]['quantidade']];
            }
        }

        return ['quantidade' => 1];
    }

    public function remover($request)
    {
        $carrinho = $request->session()->get('carrinho', []);

        for ($i = 0; $i < count($carrinho); $i++) {

            if ($carrinho[$i]['produto'] == $request->id) {

                unset($carrinho[$i]);
                break;
            }
        }

        $carrinho = array_merge($carrinho);

        $request->session()->put('carrinho', $carrinho);

        return ['mensagem' => "Item removido do Carrinho"];
    }

    public function email($request)
    {
        if(!empty($request->check1) || !empty($request->check2)){

            return [
                'titulo' => "Falha!",
                'mensagem' => "Navegação incomum dectectada",
                'tipo' => "error",
                'status' => 403
            ];

        }

        $site = Site::find(1);

        $Formulario = $request->except(['check1', 'check2']);

        $carrinho = $request->session()->get('carrinho', []);

        $Itens = [];

        foreach ($carrinho as $item) {
            array_push($Itens, [
                'produto' => Produto::find($item['produto']),
                'quantidade' => $item['quantidade']
            ]);
        }

        if(env('APP_ENV') == "production"){
            Mail::to($site->email)->send(new SendMailCarrinho("Orçamento pelo site Herval Embalagens", $Formulario, $Itens));
        }

        $request->session()->forget(['carrinho']);

        return [
            'titulo' => "Sucesso!",
            'mensagem' => "Seu orçamento foi enviado. Em breve entraremos em contato.",
            'tipo' => "success"
        ];
    }
}
