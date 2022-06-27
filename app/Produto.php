<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produto extends Model
{
    protected $table = "produtos";

    protected $fillable = ["id_subcategoria", "nome", "codigo", "valor", "texto", "foto", "foto_thumb", "ordem"];

    protected $attributes = ['ordem' => 0];

    public function subcategoria()
    {
        return $this->belongsTo("App\Subcategoria", "id_subcategoria");
    }

    public function fotos()
    {
        return $this->hasMany("App\ProdutoFoto", "id_produto")->orderBy('ordem', 'ASC')->orderBy('id', 'ASC');
    }

    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

}
