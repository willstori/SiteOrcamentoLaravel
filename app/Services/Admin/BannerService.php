<?php

namespace App\Services\Admin;

use App\Banner;
use App\Services\IUploadService;
use App\Services\IImageService;

class BannerService implements IBannerService
{
    private const PATH_FOTOS = "FotosBanners";

    private const LARGURA_FOTO = 1425;
    private const ALTURA_FOTO = 520;

    protected $_uploadService;
    protected $_imageService;

    function __construct(IUploadService $uploadService, IImageService $imageService)
    {
        $this->_uploadService = $uploadService;
        $this->_imageService = $imageService;
    }

    public function store($request)
    {
        $input = $request->all();

        $input['foto'] = $this->_uploadService->loadFromRequest($request, 'foto', BannerService::PATH_FOTOS);

        $this->_imageService->resizeFit($input['foto'], BannerService::LARGURA_FOTO, BannerService::ALTURA_FOTO);

        Banner::create($input);
    }

    public function update($request, $banner)
    {
        $banner->update($request->all());
    }

    public function updateFotoPrincipal($request, $banner)
    {
        $foto = $this->_uploadService->loadFromRequest($request, 'foto', BannerService::PATH_FOTOS);

        if ($foto == null) {
            return;
        }

        if (file_exists($banner->foto)) {
            unlink(public_path($banner->foto));
        }

        $this->_imageService->resizeFit($foto, BannerService::LARGURA_FOTO, BannerService::ALTURA_FOTO);

        $banner->foto = $foto;

        $banner->update();
    }

    public function order($request)
    {
        foreach($request->ordem as $posicao => $id){

            Banner::find($id)->update(['ordem' => $posicao]);

        }
    }

    public function destroy($id)
    {
        $banner = Banner::find($id);

        if (file_exists($banner->foto)) {
            unlink(public_path($banner->foto));
        }

        $banner->delete();
    }
}
