<?php

namespace App\Http\Controllers;

use App\Services\Site\ICarrinhoService;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;


class CarrinhoController extends Controller
{
    private $_carrinhoService;

    function __construct(ICarrinhoService $carrinhoService)
    {
        $this->_carrinhoService = $carrinhoService;
    }

    public function index(Request $request)
    {
        $ViewData = $this->_carrinhoService->listar($request);

        return view('site.carrinho', $ViewData);
    }

    public function finalizar()
    {

        $ViewData['site'] = \App\Site::find(1);

        return view('site.finalizarCarrinho', $ViewData);
    }

    public function Adicionar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => "required|integer|min:1",
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }

        $response = $this->_carrinhoService->adicionar($request);

        return response()->json($response, 200);
    }

    public function alterar(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => "required|integer|min:1",
            'quantidade' => "required|integer|min:1"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }

        $response = $this->_carrinhoService->alterar($request);

        return response()->json($response, 200);
    }

    public function remover(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => "required|integer|min:1"
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()->first()], 422);
        }

        $response = $this->_carrinhoService->remover($request);

        return response()->json($response, 200);
    }

    public function email(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => "required",
            'email' => "required|email",
            'telefone' => "required",
            'cidade' => "required",
            'estado' => "required"
        ]);

        if ($validator->fails()) {

            return response()->json([
                'titulo' => "Falha!",
                'mensagem' => $validator->errors()->first(),
                'tipo' => "errors"
            ], 422);
        }

        $response = $this->_carrinhoService->email($request);

        return response()->json($response, 200);
    }
}
