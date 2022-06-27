<?php

namespace App\Services\Admin;

interface ISobreService
{
    public function update($request, $sobre);

    public function updateFotoPrincipal($request, $sobre);
}
