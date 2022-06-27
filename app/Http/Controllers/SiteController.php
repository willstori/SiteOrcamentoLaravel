<?php

namespace App\Http\Controllers;

use App\Site;

class SiteController extends Controller
{
    protected $ViewData;

    function __construct()
    {
        $this->ViewData['site'] = Site::find(1);
    }
}
