<?php

namespace App\Http\Controllers\Admin;

use App\Site;
use Illuminate\Http\Request;
use App\Services\Admin\ISiteService;
use App\Http\Controllers\Controller;

class SiteController extends Controller
{
    private $_siteService;

    function __construct(ISiteService $siteService)
    {
        $this->_siteService = $siteService;
    }

    /* Views */

    public function edit(Site $site)
    {
        $ViewData['site'] = $site;

        return view('admin.site.edit', $ViewData);
    }

    /* Data */

    public function update(Request $request, Site $site)
    {
        $this->validate($request, [
            'keywords' => 'required',
            'description' => 'required',
            'facebook' => 'required|url',
            'instagram' => 'required|url',
            'whatsapp' => 'required',
            'email' => 'required|email',
            'telefone' => 'required',
            'endereco' => 'required',
            'mapa' => 'required'
        ]);

        $this->_siteService->update($request, $site);

        return redirect()
            ->route('admin.site.edit', $site->id)
            ->with('success', "As informaçõe de Site foram alteradas.");
    }

}
