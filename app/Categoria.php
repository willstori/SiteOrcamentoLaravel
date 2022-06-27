<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Categoria extends Model
{
    protected $table = "categorias";

    protected $fillable = ["nome", "ordem"];

    protected $attributes = ['ordem' => 0];

    public function subcategorias()
    {
        return $this->hasMany("App\Subcategoria", "id_categoria")->orderBy('ordem', 'ASC')->orderBy('id', 'DESC');
    }

    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
