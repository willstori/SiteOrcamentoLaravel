<?php

namespace App\Http\Controllers\Admin;

use App\Banner;
use Illuminate\Http\Request;
use App\Services\Admin\IBannerService;
use App\Http\Controllers\Controller;


class BannerController extends Controller
{
    private const POR_PAGINA = 10;

    private $_bannerService;

    function __construct(IBannerService $bannerService)
    {
        $this->_bannerService = $bannerService;
    }

    /* Views */

    public function index(Banner $banner)
    {
        $ViewData['banners'] = $banner->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->paginate(BannerController::POR_PAGINA);

        return view('admin.banners.list', $ViewData);
    }

    public function search(Request $request)
    {
        $ViewData['banners'] = Banner::where('titulo', 'LIKE', '%'.$request->busca.'%')
        ->orWhere('link', 'LIKE', '%'.$request->busca.'%')
        ->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->paginate(BannerController::POR_PAGINA);

        $ViewData['busca'] = $request->busca;

        return view('admin.banners.list', $ViewData);
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function edit(Banner $banner)
    {
        $ViewData['banner'] = $banner;

        return view('admin.banners.edit', $ViewData);
    }

    public function fotos(Banner $banner)
    {
        $ViewData['banner'] = $banner;

        return view('admin.banners.fotos', $ViewData);
    }

    /* Data */

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:150',
            'link' => 'nullable|url|max:150',
            'foto' => 'required|mimes:jpeg,png,gif'
        ]);

        $this->_bannerService->store($request);

        return redirect()
            ->route('admin.banners');
    }

    public function update(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'titulo' => 'required|max:150',
            'link' => 'nullable|url|max:150'
        ]);

        $this->_bannerService->update($request, $banner);

        return redirect()
            ->route('admin.banners.edit', $banner->id)
            ->with('success', "As informaçõe de Banner foram alteradas.");
    }

    public function updateFotos(Request $request, Banner $banner)
    {
        $this->validate($request, [
            'foto' => 'required|mimes:jpeg,png,gif'
        ]);

        $this->_bannerService->updateFotoPrincipal($request, $banner);

        return redirect()
            ->route('admin.banners.fotos', $banner->id)
            ->with('success', "As fotos do Banner foram alteradas.");
    }

    public function order(Request $request)
    {
        $this->_bannerService->order($request);

        return response()
            ->json([
                'tipo' => "success"
            ], 200);
    }

    public function destroy($id)
    {
        $this->_bannerService->destroy($id);

        return response()
            ->json([
                'titulo' => "Sucesso!",
                'mensagem' => "Item removido.",
                'tipo' => "success"
            ], 200);
    }
}
