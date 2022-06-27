<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sobre extends Model
{
    protected $table = "sobre";

    protected $fillable = ["texto", "missao", "visao", "valores", "foto"];
}
