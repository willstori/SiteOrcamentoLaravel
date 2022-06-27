<?php

namespace App\Services\Site;

use App\Categoria;
use App\Produto;

class ProdutoService implements IProdutoService
{
    public function listar($request, $ViewData)
    {
        $ViewData['categorias'] = Categoria::with('subcategorias')
        ->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->get();

        $ViewData['produtos'] = Produto::all();

        return $ViewData;
    }

    public function categoria($ViewData, $id)
    {
        $ViewData['categorias'] = Categoria::with('subcategorias')
        ->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->get();

        $ViewData['id_categoria'] = $id;

        $ViewData['produtos'] = Produto::whereHas('subcategoria', function($query) use ($id){
            $query->where('subcategorias.id_categoria', '=', $id);
        })
        ->get();

        return $ViewData;
    }

    public function subcategoria($ViewData, $subcategoria)
    {
        $ViewData['categorias'] = Categoria::with('subcategorias')
        ->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->get();

        $ViewData['id_categoria'] = $subcategoria->id_categoria;

        $ViewData['id_subcategoria'] = $subcategoria->id;

        $ViewData['produtos'] = Produto::where('id_subcategoria', '=', $subcategoria->id)
        ->get();

        return $ViewData;
    }

    public function buscar($request, $ViewData)
    {
        $ViewData['categorias'] = Categoria::with('subcategorias')
        ->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->get();

        $ViewData['produtos'] = Produto::where('codigo', 'LIKE', '%'.$request->busca.'%')
        ->orWhere('nome', 'LIKE', '%'.$request->busca.'%')
        ->get();

        return $ViewData;
    }

    public function detalhes($ViewData, $produto)
    {
        $ViewData['categorias'] = Categoria::with('subcategorias')
        ->orderBy('ordem', 'ASC')
        ->orderBy('id', 'DESC')
        ->get();

        $ViewData['produto'] = $produto;

        $ViewData['id_categoria'] = $produto->subcategoria->id_categoria;

        $ViewData['id_subcategoria'] = $produto->id_subcategoria;

        return $ViewData;
    }
}
