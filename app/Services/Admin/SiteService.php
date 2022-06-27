<?php

namespace App\Services\Admin;

class SiteService implements ISiteService
{
    function __construct()
    {

    }

    public function update($request, $site)
    {
        $site->update($request->all());
    }
}
