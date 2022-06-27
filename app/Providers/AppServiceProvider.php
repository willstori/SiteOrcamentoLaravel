<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('App\Services\IUploadService', 'App\Services\UploadService');
        $this->app->bind('App\Services\IImageService', 'App\Services\ImageService');

        $this->app->bind('App\Services\Admin\IBannerService', 'App\Services\Admin\BannerService');
        $this->app->bind('App\Services\Admin\ICategoriaService', 'App\Services\Admin\CategoriaService');
        $this->app->bind('App\Services\Admin\ISubcategoriaService', 'App\Services\Admin\SubcategoriaService');
        $this->app->bind('App\Services\Admin\IProdutoService', 'App\Services\Admin\ProdutoService');
        $this->app->bind('App\Services\Admin\IMarcaService', 'App\Services\Admin\MarcaService');
        $this->app->bind('App\Services\Admin\ISobreService', 'App\Services\Admin\SobreService');
        $this->app->bind('App\Services\Admin\ISiteService', 'App\Services\Admin\SiteService');
        $this->app->bind('App\Services\Admin\IUserService', 'App\Services\Admin\UserService');

        $this->app->bind('App\Services\Site\IProdutoService', 'App\Services\Site\ProdutoService');
        $this->app->bind('App\Services\Site\ICarrinhoService', 'App\Services\Site\CarrinhoService');
        $this->app->bind('App\Services\Site\IContatoService', 'App\Services\Site\ContatoService');

        DB::enableQueryLog(); // Enable query log
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
