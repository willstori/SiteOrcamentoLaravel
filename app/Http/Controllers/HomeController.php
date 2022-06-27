<?php

namespace App\Http\Controllers;

use App\Banner;
use App\Produto;

class HomeController extends SiteController
{
    public function index()
    {
        $this->ViewData['banners'] = Banner::orderBy('ordem', 'ASC')->orderBy('id', 'DESC')->get();

        $this->ViewData['produtos'] = Produto::orderBy('ordem', 'ASC')->orderBy('id', 'DESC')->get();

        return view('site.home', $this->ViewData);
    }
}
