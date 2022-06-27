<?php

namespace App\Services\Admin;

use App\Produto;
use App\ProdutoFoto;
use App\Services\IUploadService;
use App\Services\IImageService;

class ProdutoService implements IProdutoService
{
    private const PATH_FOTOS = "FotosProdutos";
    private const PATH_FOTOS_THUMBS = "FotosProdutos/Thumbs";

    private const LARGURA_FOTO_THUMB = 400;
    private const ALTURA_FOTO_THUMB = 300;

    private const LARGURA_GALERIA_THUMB = 400;
    private const ALTURA_GALERIA_THUMB = 300;

    protected $_uploadService;
    protected $_imageService;

    function __construct(IUploadService $uploadService, IImageService $imageService)
    {
        $this->_uploadService = $uploadService;
        $this->_imageService = $imageService;
    }

    /* Produto */

    public function store($request)
    {
        $input = $request->all();

        $input['foto'] = $this->_uploadService->loadFromRequest($request, 'foto', ProdutoService::PATH_FOTOS);
        $input['foto_thumb'] = $this->_uploadService->loadFromRequest($request, 'foto', ProdutoService::PATH_FOTOS_THUMBS);

        $this->_imageService->resize($input['foto']);
        $this->_imageService->resizeFit($input['foto_thumb'], ProdutoService::LARGURA_FOTO_THUMB, ProdutoService::ALTURA_FOTO_THUMB);

        return Produto::create($input);
    }

    public function update($request, $produto)
    {
        $produto->update($request->all());
    }

    public function updateFotoPrincipal($request, $produto)
    {
        $foto = $this->_uploadService->loadFromRequest($request, 'foto', ProdutoService::PATH_FOTOS);
        $thumb = $this->_uploadService->loadFromRequest($request, 'foto', ProdutoService::PATH_FOTOS_THUMBS);

        if ($foto == null) {
            return;
        }

        if (file_exists($produto->foto)) {
            unlink(public_path($produto->foto));
            unlink(public_path($produto->foto_thumb));
        }

        $this->_imageService->resize($foto);
        $this->_imageService->resizeFit($thumb, ProdutoService::LARGURA_FOTO_THUMB, ProdutoService::ALTURA_FOTO_THUMB);

        $produto->foto = $foto;
        $produto->foto_thumb = $thumb;

        $produto->update();
    }

    public function order($request)
    {
        foreach($request->ordem as $posicao => $id){

            Produto::find($id)->update(['ordem' => $posicao]);

        }
    }

    public function destroy($id)
    {
        $produto = Produto::find($id);

        foreach ($produto->fotos as $produtoFoto) {

            if (file_exists($produtoFoto->foto)) {
                unlink(public_path($produtoFoto->foto));
                unlink(public_path($produtoFoto->foto_thumb));
            }

        }

        $produto->fotos()->delete();

        if (file_exists($produto->foto)) {
            unlink(public_path($produto->foto));
            unlink(public_path($produto->foto_thumb));
        }

        $produto->delete();
    }

    /* Fotos */

    public function storeProdutoFoto($request, $produto)
    {
        $fotos = $this->_uploadService->loadFromRequestMultiple($request, 'fotos', ProdutoService::PATH_FOTOS);
        $thumbs = $this->_uploadService->loadFromRequestMultiple($request, 'fotos', ProdutoService::PATH_FOTOS_THUMBS);

        if(empty($fotos)){
            return null;
        }

        for($i = 0; $i < count($fotos); $i++){

            $this->_imageService->resize($fotos[$i]);
            $this->_imageService->resizeFit($thumbs[$i], ProdutoService::LARGURA_GALERIA_THUMB, ProdutoService::ALTURA_GALERIA_THUMB);

            $produtoFoto = new ProdutoFoto();

            $produtoFoto->id_produto = $produto->id;
            $produtoFoto->foto = $fotos[$i];
            $produtoFoto->foto_thumb = $thumbs[$i];
            $produtoFoto->ordem = 0;

            $produtoFoto->save();
        }

    }

    public function orderProdutoFoto($request)
    {
        foreach($request->ordem as $posicao => $id){

            ProdutoFoto::find($id)->update(['ordem' => $posicao]);

        }
    }

    public function destroyProdutoFoto($produtoFoto)
    {
        if (file_exists($produtoFoto->foto)) {
            unlink(public_path($produtoFoto->foto));
            unlink(public_path($produtoFoto->foto_thumb));
        }

        $produtoFoto->delete();
    }

}
