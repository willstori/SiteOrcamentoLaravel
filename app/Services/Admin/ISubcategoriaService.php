<?php

namespace App\Services\Admin;

interface ISubcategoriaService
{
    public function getSubcategorias($id_categoria);
    public function store($request);
    public function update($request, $subcategoria);
    public function order($request);
    public function destroy($id);
}
