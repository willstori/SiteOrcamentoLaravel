<?php

namespace App\Http\Controllers\Admin;

use App\Categoria;
use App\Produto;
use App\ProdutoFoto;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\IProdutoService;
use App\Subcategoria;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    private const POR_PAGINA = 10;

    private $_produtoService;

    function __construct(IProdutoService $produtoService)
    {
        $this->_produtoService = $produtoService;
    }

    /* Views */
    public function index()
    {
        $ViewData['produtos'] = Produto::with(['subcategoria' => function($query){
            $query->with(['categoria']);
        }])
        ->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->paginate(ProdutoController::POR_PAGINA);

        return view('admin.produtos.list', $ViewData);
    }


    public function search(Request $request)
    {
        $busca = $request->busca;

        $ViewData['produtos'] = Produto::with(['subcategoria' => function($query){

            $query->with(['categoria']);

        }])->orWhereHas('subcategoria', function($query) use ($busca){

            $query->where('subcategorias.nome', 'LIKE', '%'.$busca.'%')

            ->orWhereHas('categoria', function($query) use ($busca){

                $query->where('categorias.nome', 'LIKE', '%'.$busca.'%');

            });

        })
        ->orWhere('produtos.codigo', '=', $busca)
        ->orWhere('produtos.nome', 'LIKE', '%'.$busca.'%')
        ->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->paginate(ProdutoController::POR_PAGINA);

        $ViewData['busca'] = $request->busca;

        return view('admin.produtos.list', $ViewData);
    }

    public function create()
    {
        $ViewData['categorias'] = Categoria::orderBy('nome','ASC')->get();

        return view('admin.produtos.create', $ViewData);
    }

    public function edit(Produto $produto)
    {
        $ViewData['categorias'] = Categoria::orderBy('nome','ASC')->get();

        $ViewData['produto'] = $produto;

        $ViewData['subcategorias'] = Subcategoria::where('id_categoria', $produto->subcategoria->id_categoria)->get();

        return view('admin.produtos.edit', $ViewData);
    }

    public function fotos(Produto $produto)
    {
        $ViewData['produto'] = $produto;

        return view('admin.produtos.fotos', $ViewData);
    }

    /* Data */

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_subcategoria' => 'required|integer',
            'nome' => 'required|max:150',
            'codigo' => 'max:150',
            'valor' => 'numeric',
            'texto' => 'required',
            'foto' => 'required|mimes:jpeg,png,gif',
            'fotos.*' => 'mimes:jpeg,png,gif'
        ]);

        $produto = $this->_produtoService->store($request);

        $this->_produtoService->storeProdutoFoto($request, $produto);

        return redirect()
                ->route('admin.produtos');
    }

    public function update(Request $request, Produto $produto)
    {

        $this->validate($request, [
            'id_subcategoria' => 'required|integer',
            'nome' => 'required|max:150',
            'codigo' => 'max:150',
            'valor' => 'numeric',
            'texto' => 'required'
        ]);

        $this->_produtoService->update($request, $produto);

        return redirect()
                ->route('admin.produtos.edit', $produto->id)
                ->with('success', "As informaçõe de Notícia foram alteradas.");

    }

    public function updateFotos(Request $request, Produto $produto)
    {
        $this->validate($request, [
            'foto' => 'mimes:jpeg,png,gif',
            'fotos.*' =>'mimes:jpeg,png,gif'
        ]);

        $this->_produtoService->updateFotoPrincipal($request, $produto);
        $this->_produtoService->storeProdutoFoto($request, $produto);

        return redirect()
                ->route('admin.produtos.fotos', $produto->id)
                ->with('success', "As fotos de Notícia foram alteradas.");
    }

    public function orderProdutoFoto(Request $request)
    {
        $this->_produtoService->orderProdutoFoto($request);

        return response()->json([
            'tipo' => "success"
        ], 200);
    }

    public function destroyProdutoFoto(ProdutoFoto $produtoFoto)
    {
        $this->_produtoService->destroyProdutoFoto($produtoFoto);

        return response()
                ->json([
                    'titulo' => "Sucesso!",
                    'mensagem' => "Item removido.",
                    'tipo' => "success"
                ], 200);

    }

    public function order(Request $request)
    {
        $this->_produtoService->order($request);

        return response()
            ->json([
                'tipo' => "success"
            ], 200);
    }

    public function destroy($id)
    {
        $this->_produtoService->destroy($id);

        return response()
                ->json([
                    'titulo' => "Sucesso!",
                    'mensagem' => "Item removido.",
                    'tipo' => "success"
                ], 200);

    }
}
