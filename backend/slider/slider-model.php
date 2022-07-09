<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class slider extends Model
{

    public $timestamps = false;

    protected $table = "slider";

    protected $fillable = [
        "id",
        "resim",
    ];


}
