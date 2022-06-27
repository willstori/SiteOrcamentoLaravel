<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = "site";

    protected $fillable = ["keywords", "description", "facebook",
     "instagram", "whatsapp", "email", "telefone", "endereco", "mapa", "codigos_terceiros"];
}
