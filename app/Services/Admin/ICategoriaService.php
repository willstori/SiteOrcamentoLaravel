<?php

namespace App\Services\Admin;

interface ICategoriaService
{
    public function store($request);
    public function update($request, $categoria);
    public function order($request);
    public function destroy($id);
}
