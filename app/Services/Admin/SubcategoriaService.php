<?php

namespace App\Services\Admin;

use App\Subcategoria;

class SubcategoriaService implements ISubcategoriaService
{
    public function getSubcategorias($id_categoria)
    {
        $subcategorias = Subcategoria::where('id_categoria', $id_categoria)->orderBy('nome', 'ASC')->get();

        if(!$subcategorias->isEmpty()){
            return $subcategorias;
        }

        return null;
    }

    public function store($request)
    {
        Subcategoria::create($request->all());
    }

    public function update($request, $subcategoria)
    {
        $subcategoria->update($request->all());
    }

    public function order($request)
    {
        foreach($request->ordem as $posicao => $id){

            Subcategoria::find($id)->update(['ordem' => $posicao]);

        }
    }

    public function destroy($id)
    {
        $subcategoria = Subcategoria::find($id);

        if(!$subcategoria->produtos->isEmpty()){

            return [
                'titulo' => "Falha!",
                'mensagem' => "Existem Produtos ligados a esta subcategoria.",
                'tipo' => "error"
            ];

        }

        $subcategoria->delete();

        return [
            'tipo' => "success"
        ];
    }
}
