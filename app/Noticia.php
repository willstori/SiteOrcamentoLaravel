<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    protected $table = "noticias";

    protected $fillable = ["titulo", "resumo", "texto", "data", "foto", "foto_thumb"];

    public function fotos()
    {
        return $this->hasMany("App\NoticiaFoto", "id_noticia")->orderBy('ordem', 'ASC')->orderBy('id', 'ASC');
    }
}
