<?php

namespace App\Http\Controllers;

use App\Services\Site\IContatoService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ContatoController extends SiteController
{
    protected $_contatoService;

    function __construct(IContatoService $contatoService){

        parent::__construct();

        $this->_contatoService = $contatoService;

    }

    public function index()
    {
        return view('site.contato', $this->ViewData);
    }

    public function email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => "required",
            'email' => "required|email",
            'telefone' => "required",
            'assunto' => "required"
        ]);

        if($validator->fails()){

            return response()->json([
                'titulo' => "Falha!",
                'mensagem' => $validator->errors()->first(),
                'tipo' => "errors"
            ], 422);

        }

        $response = $this->_contatoService->email($request);

        return response()->json($response, $response['status']);

    }
}
