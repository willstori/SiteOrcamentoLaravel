<?php

namespace App\Http\Controllers\Admin;

use App\Categoria;
use Illuminate\Http\Request;
use App\Services\Admin\ICategoriaService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    private const POR_PAGINA = 10;

    private $_categoriaService;

    function __construct(ICategoriaService $categoriaService)
    {
        $this->_categoriaService = $categoriaService;
    }

    /* Views */

    public function index(Categoria $categoria)
    {
        $ViewData['categorias'] = $categoria->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->paginate(CategoriaController::POR_PAGINA);

        return view('admin.categorias.list', $ViewData);
    }

    public function search(Request $request)
    {
        $ViewData['categorias'] = Categoria::where('nome', 'LIKE', '%'.$request->busca.'%')
        ->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->paginate(CategoriaController::POR_PAGINA);

        $ViewData['busca'] = $request->busca;

        return view('admin.categorias.list', $ViewData);
    }

    public function create()
    {
        return view('admin.categorias.create');
    }

    public function edit(Categoria $categoria)
    {
        $ViewData['categoria'] = $categoria;

        return view('admin.categorias.edit', $ViewData);
    }

    /* Data */

    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:150|unique:categorias'
        ]);

        $this->_categoriaService->store($request);

        return redirect()
            ->route('admin.categorias');
    }

    public function update(Request $request, Categoria $categoria)
    {
        $this->validate($request, [
            'nome' => 'required|max:150|unique:categorias,nome,'.$categoria->id.',id'
        ]);

        $this->_categoriaService->update($request, $categoria);

        return redirect()
            ->route('admin.categorias.edit', $categoria->id)
            ->with('success', "As informaçõe de Categoria foram alteradas.");
    }

    public function order(Request $request)
    {
        $this->_categoriaService->order($request);

        return response()
            ->json([
                'tipo' => "success"
            ], 200);
    }

    public function destroy($id)
    {
        $response = $this->_categoriaService->destroy($id);

        if($response['tipo'] == "error"){

            return response()->json($response, 422);
        }

        return response()->json($response, 200);
    }
}
