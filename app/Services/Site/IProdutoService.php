<?php

namespace App\Services\Site;

interface IProdutoService
{
    public function listar($request, $ViewData);
    public function categoria($ViewData, $id);
    public function subcategoria($ViewData, $subcategoria);
    public function buscar($request, $ViewData);
    public function detalhes($ViewData, $produto);
}
