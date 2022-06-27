<?php

namespace App\Http\Controllers;

use App\Categoria;
use App\Produto;
use App\Services\Site\IProdutoService;
use App\Subcategoria;
use Illuminate\Http\Request;

class ProdutoController extends SiteController
{
    protected $_produtoService;

    function __construct(IProdutoService $produtoService)
    {
        parent::__construct();
        $this->_produtoService = $produtoService;
    }

    public function index(Request $request)
    {
        $this->ViewData = $this->_produtoService->listar($request, $this->ViewData);

        return view('site.produtos', $this->ViewData);
    }

    public function categoria($id)
    {
        $this->ViewData = $this->_produtoService->categoria($this->ViewData, $id);

        return view('site.produtos', $this->ViewData);
    }

    public function subcategoria(Subcategoria $subcategoria)
    {
        $this->ViewData = $this->_produtoService->subcategoria($this->ViewData, $subcategoria);

        return view('site.produtos', $this->ViewData);
    }

    public function buscar(Request $request)
    {
        $this->ViewData = $this->_produtoService->buscar($request, $this->ViewData);

        return view('site.produtos', $this->ViewData);
    }

    public function detalhes(Produto $produto)
    {
        $this->ViewData = $this->_produtoService->detalhes($this->ViewData, $produto);

        return view('site.produto', $this->ViewData);
    }
}
