<?php

namespace App\Http\Controllers;

use App\Sobre;

class SobreController extends SiteController
{
    public function index()
    {
        $this->ViewData['sobre'] = Sobre::find(1);

        return view('site.sobre', $this->ViewData);
    }
}
