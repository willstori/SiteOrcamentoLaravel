<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/* Rotas do site*/
Route::get('/', 'HomeController@index')->name('home');

Route::get('sobre', 'SobreController@index')->name('sobre');

Route::get('produtos', 'ProdutoController@index')->name('produtos');

Route::get('produtos-categoria/{id_categoria}/{nome}', 'ProdutoController@categoria')->name('produtos.categoria');
Route::get('produtos-subcategoria/{subcategoria}/{nome}', 'ProdutoController@subcategoria')->name('produtos.subcategoria');
Route::get('produtos-buscar', 'ProdutoController@buscar')->name('produtos.buscar');
Route::get('produto/{produto}/{slug}', 'ProdutoController@detalhes')->name('produtos.detalhes');

Route::get('carrinho', 'CarrinhoController@index')->name('carrinho');
Route::get('finalizar-orcamento', 'CarrinhoController@finalizar')->name('carrinho.finalizar');
Route::post('carrinho/adicionar', 'CarrinhoController@adicionar')->name('carrinho.adicionar');
Route::patch('carrinho/alterar', 'CarrinhoController@alterar')->name('carrinho.alterar');
Route::delete('carrinho/remover', 'CarrinhoController@remover')->name('carrinho.remover');
Route::post('carrinho/enviar/email', 'CarrinhoController@email')->name('carrinho.email');

Route::get('marcas', 'MarcaController@index')->name('marcas');

Route::get('contato', 'ContatoController@index')->name('contato');
Route::post('contato/enviar/email', 'ContatoController@email')->name('contato.email');

/* Grupo de Rotas do Admin */
Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('inicio', function () {
        return view('admin.inicio');
    })->name('inicio')->middleware('auth');




    /* Rotas de Banners */
    Route::get('banners',                'Admin\BannerController@index')->name('banners')->middleware('auth');
    Route::get('banners-buscar',          'Admin\BannerController@search')->name('banners.search')->middleware('auth');
    // Criar
    Route::get('banners/criar',          'Admin\BannerController@create')->name('banners.create')->middleware('auth');
    Route::post('banners',               'Admin\BannerController@store')->name('banners.store')->middleware('auth');
    // Editar
    Route::get('banners/{banner}',       'Admin\BannerController@edit')->name('banners.edit')->middleware('auth');
    Route::put('banners/{banner}',       'Admin\BannerController@update')->name('banners.update')->middleware('auth');
    // Fotos
    Route::get('banners/fotos/{banner}', 'Admin\BannerController@fotos')->name('banners.fotos')->middleware('auth');
    Route::put('banners/fotos/{banner}', 'Admin\BannerController@updateFotos')->name('banners.updateFotos')->middleware('auth');
    // Ordenar
    Route::patch('banners/ordenar', 'Admin\BannerController@order')->name('banners.order')->middleware('auth');
    // Remover
    Route::delete('banners/{id}',    'Admin\BannerController@destroy')->name('banners.destroy')->middleware('auth');





    /* Rotas de Categorias */
    Route::get('categorias',                'Admin\CategoriaController@index')->name('categorias')->middleware('auth');
    Route::get('categorias-buscar',         'Admin\CategoriaController@search')->name('categorias.search')->middleware('auth');
    // Criar
    Route::get('categorias/criar',          'Admin\CategoriaController@create')->name('categorias.create')->middleware('auth');
    Route::post('categorias',               'Admin\CategoriaController@store')->name('categorias.store')->middleware('auth');
    // Editar
    Route::get('categorias/{categoria}',       'Admin\CategoriaController@edit')->name('categorias.edit')->middleware('auth');
    Route::put('categorias/{categoria}',       'Admin\CategoriaController@update')->name('categorias.update')->middleware('auth');
    // Ordenar
    Route::patch('categorias/ordenar', 'Admin\CategoriaController@order')->name('categorias.order')->middleware('auth');
    // Remover
    Route::delete('categorias/{id}',    'Admin\CategoriaController@destroy')->name('categorias.destroy')->middleware('auth');






    /* Rotas de Subcategorias */
    Route::get('subcategorias',                'Admin\SubcategoriaController@index')->name('subcategorias')->middleware('auth');
    Route::get('subcategorias-buscar',                'Admin\SubcategoriaController@search')->name('subcategorias.search')->middleware('auth');
    Route::get('subcategorias/categoria/{id_categoria}', 'Admin\SubcategoriaController@getSubcategoriasAjax')->name('subcategorias.getSubcategorias')->middleware('auth');
    // Criar
    Route::get('subcategorias/criar',          'Admin\SubcategoriaController@create')->name('subcategorias.create')->middleware('auth');
    Route::post('subcategorias',               'Admin\SubcategoriaController@store')->name('subcategorias.store')->middleware('auth');
    // Editar
    Route::get('subcategorias/{subcategoria}',       'Admin\SubcategoriaController@edit')->name('subcategorias.edit')->middleware('auth');
    Route::put('subcategorias/{subcategoria}',       'Admin\SubcategoriaController@update')->name('subcategorias.update')->middleware('auth');
    // Ordenar
    Route::patch('subcategorias/ordenar', 'Admin\SubcategoriaController@order')->name('subcategorias.order')->middleware('auth');
    // Remover
    Route::delete('subcategorias/{id}',    'Admin\SubcategoriaController@destroy')->name('subcategorias.destroy')->middleware('auth');





    /* Rotas de Produtos */
    Route::get('produtos',                'Admin\ProdutoController@index')->name('produtos')->middleware('auth');
    Route::get('produtos-buscar',                'Admin\ProdutoController@search')->name('produtos.search')->middleware('auth');
    // Criar
    Route::get('produtos/criar',          'Admin\ProdutoController@create')->name('produtos.create')->middleware('auth');
    Route::post('produtos',               'Admin\ProdutoController@store')->name('produtos.store')->middleware('auth');
    // Editar
    Route::get('produtos/{produto}',       'Admin\ProdutoController@edit')->name('produtos.edit')->middleware('auth');
    Route::put('produtos/{produto}',       'Admin\ProdutoController@update')->name('produtos.update')->middleware('auth');
    // Fotos
    Route::get('produtos/fotos/{produto}', 'Admin\ProdutoController@fotos')->name('produtos.fotos')->middleware('auth');
    Route::put('produtos/fotos/{produto}', 'Admin\ProdutoController@updateFotos')->name('produtos.updateFotos')->middleware('auth');
    Route::patch('produtos/fotos/{produtoFoto}', 'Admin\ProdutoController@updateLegenda')->name('produtos.updateLegenda')->middleware('auth');
    Route::patch('produtos/ordenar-fotos', 'Admin\ProdutoController@orderProdutoFoto')->name('produtos.orderProdutoFoto')->middleware('auth');
    Route::delete('produtos/fotos/{produtoFoto}', 'Admin\ProdutoController@destroyProdutoFoto')->name('produtos.destroyProdutoFoto')->middleware('auth');
    // Ordenar
    Route::patch('produtos/ordenar', 'Admin\ProdutoController@order')->name('produtos.order')->middleware('auth');
    // Remover
    Route::delete('produtos/{id}',    'Admin\ProdutoController@destroy')->name('produtos.destroy')->middleware('auth');




    /* Rotas de Marcas */
    Route::get('marcas',                'Admin\MarcaController@index')->name('marcas')->middleware('auth');
    // Criar
    Route::get('marcas/criar',          'Admin\MarcaController@create')->name('marcas.create')->middleware('auth');
    Route::post('marcas',               'Admin\MarcaController@store')->name('marcas.store')->middleware('auth');
    // Editar
    Route::get('marcas/{marca}',       'Admin\MarcaController@edit')->name('marcas.edit')->middleware('auth');
    Route::put('marcas/{marca}',       'Admin\MarcaController@update')->name('marcas.update')->middleware('auth');
    // Fotos
    Route::get('marcas/fotos/{marca}', 'Admin\MarcaController@fotos')->name('marcas.fotos')->middleware('auth');
    Route::put('marcas/fotos/{marca}', 'Admin\MarcaController@updateFotos')->name('marcas.updateFotos')->middleware('auth');
    // Ordenar
    Route::patch('marcas/ordenar', 'Admin\MarcaController@order')->name('marcas.order')->middleware('auth');
    // Remover
    Route::delete('marcas/{id}',    'Admin\MarcaController@destroy')->name('marcas.destroy')->middleware('auth');




    /* Rotas de Sobre */

    // Editar
    Route::get('sobre/{sobre}',       'Admin\SobreController@edit')->name('sobre.edit')->middleware('auth');
    Route::put('sobre/{sobre}',       'Admin\SobreController@update')->name('sobre.update')->middleware('auth');
    // Fotos
    Route::get('sobre/fotos/{sobre}', 'Admin\SobreController@fotos')->name('sobre.fotos')->middleware('auth');
    Route::put('sobre/fotos/{sobre}', 'Admin\SobreController@updateFotos')->name('sobre.updateFotos')->middleware('auth');



    /* Rotas de Site */

    // Editar
    Route::get('site/{site}',       'Admin\SiteController@edit')->name('site.edit')->middleware('auth');
    Route::put('site/{site}',       'Admin\SiteController@update')->name('site.update')->middleware('auth');



    /* Rotas para Usuáruios */
    Route::get('usuarios',          'Admin\Auth\UserController@index')->name('users')->middleware('auth');
    // Criar
    Route::get('usuarios/criar',    'Admin\Auth\UserController@create')->name('users.create')->middleware('auth');
    Route::post('usuarios',         'Admin\Auth\UserController@store')->name('users.store')->middleware('auth');
    // Editar
    Route::get('usuarios/{user}',     'Admin\Auth\UserController@edit')->name('users.edit')->middleware('auth');
    Route::put('usuarios/{user}',     'Admin\Auth\UserController@update')->name('users.update')->middleware('auth');
    // Remover
    Route::delete('usuarios/{user}',  'Admin\Auth\UserController@destroy')->name('users.destroy')->middleware('auth');




    /* Rotas para Autenticação */
    Route::get('login',  'Admin\Auth\LoginController@login')->name('login');
    Route::post('login', 'Admin\Auth\LoginController@authenticate')->name('auth');
    Route::patch('forgot', 'Admin\Auth\LoginController@forgotPassword')->name('forgot');

    Route::get('logout', 'Admin\Auth\LoginController@logout')->name('logout')->middleware('auth');

});


