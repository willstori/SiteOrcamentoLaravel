<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $table = "marcas";

    protected $fillable = ["nome", "link", "foto", "ordem"];

    protected $attributes = ['ordem' => 0];
}
