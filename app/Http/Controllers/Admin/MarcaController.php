<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Admin\IMarcaService;
use App\Marca;

class MarcaController extends Controller
{
    private $_marcaService;

    function __construct(IMarcaService $marcaService)
    {
        $this->_marcaService = $marcaService;
    }

    /* Views */

    public function index(Marca $marca)
    {
        $ViewData['marcas'] = $marca->orderBy('ordem', 'ASC')->orderBy('id', 'DESC')->get();

        return view('admin.marcas.list', $ViewData);
    }

    public function create()
    {
        return view('admin.marcas.create');
    }

    public function edit(Marca $marca)
    {
        $ViewData['marca'] = $marca;

        return view('admin.marcas.edit', $ViewData);
    }

    public function fotos(Marca $marca)
    {
        $ViewData['marca'] = $marca;

        return view('admin.marcas.fotos', $ViewData);
    }

    /* Data */

    public function store(Request $request)
    {
        $this->validate($request, [
            'nome' => 'required|max:150',
            'link' => 'nullable|url|max:150',
            'foto' => 'required|mimes:jpeg,png,gif'
        ]);

        $this->_marcaService->store($request);

        return redirect()
            ->route('admin.marcas');
    }

    public function update(Request $request, Marca $marca)
    {
        $this->validate($request, [
            'nome' => 'required|max:150',
            'link' => 'nullable|url|max:150'
        ]);

        $this->_marcaService->update($request, $marca);

        return redirect()
            ->route('admin.marcas.edit', $marca->id)
            ->with('success', "As informaçõe de Marca foram alteradas.");
    }

    public function updateFotos(Request $request, Marca $marca)
    {
        $this->validate($request, [
            'foto' => 'required|mimes:jpeg,png,gif'
        ]);

        $this->_marcaService->updateFotoPrincipal($request, $marca);

        return redirect()
            ->route('admin.marcas.fotos', $marca->id)
            ->with('success', "As fotos da Marca foram alteradas.");
    }

    public function order(Request $request)
    {
        $this->_marcaService->order($request);

        return response()
            ->json([
                'tipo' => "success"
            ], 200);
    }

    public function destroy($id)
    {
        $this->_marcaService->destroy($id);

        return response()
            ->json([
                'titulo' => "Sucesso!",
                'mensagem' => "Item removido.",
                'tipo' => "success"
            ], 200);
    }
}
