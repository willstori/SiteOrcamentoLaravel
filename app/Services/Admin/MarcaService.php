<?php

namespace App\Services\Admin;

use App\Marca;
use App\Services\IUploadService;
use App\Services\IImageService;

class MarcaService implements IMarcaService
{
    private const PATH_FOTOS = "FotosMarcas";

    private const LARGURA_FOTO = 300;
    private const ALTURA_FOTO = 200;

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

        $input['foto'] = $this->_uploadService->loadFromRequest($request, 'foto', MarcaService::PATH_FOTOS);

        $this->_imageService->resize($input['foto'], MarcaService::LARGURA_FOTO, MarcaService::ALTURA_FOTO);

        Marca::create($input);
    }

    public function update($request, $marca)
    {
        $marca->update($request->all());
    }

    public function updateFotoPrincipal($request, $marca)
    {
        $foto = $this->_uploadService->loadFromRequest($request, 'foto', MarcaService::PATH_FOTOS);

        if ($foto == null) {
            return;
        }

        if (file_exists($marca->foto)) {
            unlink(public_path($marca->foto));
        }

        $this->_imageService->resize($foto, MarcaService::LARGURA_FOTO, MarcaService::ALTURA_FOTO);

        $marca->foto = $foto;

        $marca->update();
    }

    public function order($request)
    {
        foreach($request->ordem as $posicao => $id){

            Marca::find($id)->update(['ordem' => $posicao]);

        }
    }

    public function destroy($id)
    {
        $marca = Marca::find($id);

        if (file_exists($marca->foto)) {
            unlink(public_path($marca->foto));
        }

        $marca->delete();
    }
}
