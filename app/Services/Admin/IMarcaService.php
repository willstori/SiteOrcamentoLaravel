<?php

namespace App\Services\Admin;

interface IMarcaService
{
    public function store($request);
    public function update($request, $marca);
    public function updateFotoPrincipal($request, $marca);
    public function order($request);
    public function destroy($id);
}
