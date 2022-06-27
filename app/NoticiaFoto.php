<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NoticiaFoto extends Model
{
    protected $table = "noticias_fotos";

    protected $fillable = ["id_noticia", "foto", "foto_thumb", "legenda", "ordem"];

    public function noticia()
    {
        return $this->belongsTo("App\Noticia", "id_noticia");
    }
}
