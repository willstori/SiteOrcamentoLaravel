<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Subcategoria extends Model
{
    protected $table = "subcategorias";

    protected $fillable = ["id_categoria", "nome", "ordem"];

    protected $attributes = ['ordem' => 0];

    public function categoria()
    {
        return $this->belongsTo("App\Categoria", "id_categoria", "id");
    }

    public function produtos()
    {
        return $this->hasMany("App\Produto", "id_subcategoria")->orderBy('ordem', 'ASC')->orderBy('id', 'DESC');
    }

    public function setNomeAttribute($value)
    {
        $this->attributes['nome'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }
}
