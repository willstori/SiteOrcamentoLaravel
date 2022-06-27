<?php

namespace App\Http\Controllers\Admin;

use App\Categoria;
use App\Subcategoria;
use Illuminate\Http\Request;
use App\Services\Admin\ISubcategoriaService;
use App\Http\Controllers\Controller;

class SubcategoriaController extends Controller
{
    private const POR_PAGINA = 10;

    private $_subcategoriaService;

    function __construct(ISubcategoriaService $subcategoriaService)
    {
        $this->_subcategoriaService = $subcategoriaService;
    }

    /* Views */

    public function index()
    {
        $ViewData['subcategorias'] = Subcategoria::with(['categoria'])
                                        ->orderBy('ordem', 'ASC')
                                        ->orderBy('id', 'DESC')
                                        ->paginate(SubcategoriaController::POR_PAGINA);

        return view('admin.subcategorias.list', $ViewData);
    }

    public function search(Request $request)
    {
        $busca = $request->busca;

        $ViewData['subcategorias'] = Subcategoria::with(['categoria'])
        ->orWhereHas('categoria', function($query) use ($busca){
            $query->where('categorias.nome', 'LIKE', '%'.$busca.'%');
        })
        ->orWhere('subcategorias.nome', 'LIKE', '%'.$busca.'%')
        ->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->paginate(SubcategoriaController::POR_PAGINA);

        $ViewData['busca'] = $request->busca;

        return view('admin.subcategorias.list', $ViewData);
    }

    public function getSubcategoriasAjax($id_categoria)
    {
        $subcategorias = Subcategoria::where('id_categoria', '=', $id_categoria)->get();

        if(!empty($subcategorias)){
            return response()->json($subcategorias, 200);
        }

        return response()->json(['mensagem' => "Nenhuma Subcategoria encontrada."], 404);

    }

    public function create()
    {
        $ViewData['categorias'] = Categoria::orderBy('nome', 'ASC')->get();

        return view('admin.subcategorias.create', $ViewData);
    }

    public function edit(Subcategoria $subcategoria)
    {
        $ViewData['categorias'] = Categoria::orderBy('nome', 'ASC')->get();

        $ViewData['subcategoria'] = $subcategoria;

        return view('admin.subcategorias.edit', $ViewData);
    }

    /* Data */

    public function store(Request $request)
    {
        $this->validate($request, [
            'id_categoria' => 'required|integer',
            'nome' => 'required|max:150'
        ]);

        $this->_subcategoriaService->store($request);

        return redirect()
            ->route('admin.subcategorias');
    }

    public function update(Request $request, Subcategoria $subcategoria)
    {
        $this->validate($request, [
            'id_categoria' => 'required|integer',
            'nome' => 'required|max:150'
        ]);

        $this->_subcategoriaService->update($request, $subcategoria);

        return redirect()
            ->route('admin.subcategorias.edit', $subcategoria->id)
            ->with('success', "As informaçõe de Subcategoria foram alteradas.");
    }

    public function order(Request $request)
    {
        $this->_subcategoriaService->order($request);

        return response()
            ->json([
                'tipo' => "success"
            ], 200);
    }

    public function destroy($id)
    {
        $response = $this->_subcategoriaService->destroy($id);

        if($response['tipo'] == "error"){

            return response()->json($response, 422);
        }

        return response()->json($response, 200);
    }
}
