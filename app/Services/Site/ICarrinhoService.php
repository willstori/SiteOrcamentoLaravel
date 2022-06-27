<?php

namespace App\Services\Site;

interface ICarrinhoService
{
    public function listar($request);
    public function adicionar($request);
    public function alterar($request);
    public function remover($request);

    public function email($request);
}
