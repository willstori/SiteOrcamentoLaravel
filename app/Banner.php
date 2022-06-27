<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $table = "banners";

    protected $fillable = ["titulo", "link", "foto", "ordem"];

    protected $attributes = ['ordem' => 0];
}
