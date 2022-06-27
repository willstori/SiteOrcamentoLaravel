<?php

namespace App\Services\Admin;

interface IProdutoService
{
    public function store($request);

    public function update($request, $produto);

    public function updateFotoPrincipal($request, $produto);

    public function order($request);

    public function destroy($id);

    public function storeProdutoFoto($request, $produto);

    public function orderProdutoFoto($request);

    public function destroyProdutoFoto($produtoFoto);
}
