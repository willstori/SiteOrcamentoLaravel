<?php

namespace App\Http\Controllers\Admin;

use App\Sobre;
use Illuminate\Http\Request;
use App\Services\Admin\ISobreService;
use App\Http\Controllers\Controller;

class SobreController extends Controller
{
    private $_sobreService;

    function __construct(ISobreService $sobreService)
    {
        $this->_sobreService = $sobreService;
    }

    /* Views */

    public function edit(Sobre $sobre)
    {
        $ViewData['sobre'] = $sobre;

        return view('admin.sobre.edit', $ViewData);
    }

    public function fotos(Sobre $sobre)
    {
        $ViewData['sobre'] = $sobre;

        return view('admin.sobre.fotos', $ViewData);
    }

    /* Data */

    public function update(Request $request, Sobre $sobre)
    {
        $this->validate($request, [
            'texto' => 'required',
            'missao' => 'required',
            'visao' => 'required',
            'valores' => 'required'
        ]);

        $this->_sobreService->update($request, $sobre);

        return redirect()
            ->route('admin.sobre.edit', $sobre->id)
            ->with('success', "As informaçõe de Sobre foram alteradas.");
    }

    public function updateFotos(Request $request, Sobre $sobre)
    {
        $this->validate($request, [
            'foto' => 'required|mimes:jpeg,png,gif'
        ]);

        $this->_sobreService->updateFotoPrincipal($request, $sobre);

        return redirect()
            ->route('admin.sobre.fotos', $sobre->id)
            ->with('success', "As fotos do Sobre foram alteradas.");
    }

}
