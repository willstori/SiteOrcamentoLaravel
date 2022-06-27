<?php

namespace App\Services\Admin;

use App\Categoria;

class CategoriaService implements ICategoriaService
{
    public function store($request)
    {
        Categoria::create($request->all());
    }

    public function update($request, $categoria)
    {
        $categoria->update($request->all());
    }

    public function order($request)
    {
        foreach($request->ordem as $posicao => $id){

            Categoria::find($id)->update(['ordem' => $posicao]);

        }
    }

    public function destroy($id)
    {
        $categoria = Categoria::find($id);

        if(!$categoria->subcategorias->isEmpty()){

            return [
                'titulo' => "Falha!",
                'mensagem' => "Existem Subcategorias ligadas a esta categoria.",
                'tipo' => "error"
            ];

        }

        $categoria->delete();

        return [
            'tipo' => "success"
        ];
    }
}
