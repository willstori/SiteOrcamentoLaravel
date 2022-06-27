<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProdutoFoto extends Model
{
    protected $table = "produtos_fotos";

    protected $fillable = ["id_produto", "foto", "foto_thumb", "ordem"];

    protected $attributes = ['ordem' => 0];

    public function produto()
    {
        return $this->belongsTo("App\Produto", "id_produto");
    }
}
