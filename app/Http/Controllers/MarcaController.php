<?php

namespace App\Http\Controllers;

use App\Marca;

class MarcaController extends SiteController
{
    public function index()
    {
        $this->ViewData['marcas'] = Marca::orderBy('ordem', 'ASC')->orderBy('id', 'DESC')->get();

        return view('site.marcas', $this->ViewData);
    }
}
