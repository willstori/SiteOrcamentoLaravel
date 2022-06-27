<?php

namespace App\Services\Admin;

interface IBannerService
{
    public function store($request);
    public function update($request, $banner);
    public function updateFotoPrincipal($request, $banner);
    public function order($request);
    public function destroy($id);
}
