<?php

namespace App\Services\Admin;

use App\Services\IUploadService;
use App\Services\IImageService;

class SobreService implements ISobreService
{
    private const PATH_FOTOS = "FotosSobre";

    protected $_uploadService;
    protected $_imageService;

    function __construct(IUploadService $uploadService, IImageService $imageService)
    {
        $this->_uploadService = $uploadService;
        $this->_imageService = $imageService;
    }


    public function update($request, $sobre)
    {
        $sobre->update($request->all());
    }

    public function updateFotoPrincipal($request, $sobre)
    {
        $foto = $this->_uploadService->loadFromRequest($request, 'foto', SobreService::PATH_FOTOS);

        if ($foto == null) {
            return;
        }

        if (file_exists($sobre->foto)) {
            unlink(public_path($sobre->foto));
        }

        $this->_imageService->resize($foto);

        $sobre->foto = $foto;

        $sobre->update();
    }
}
