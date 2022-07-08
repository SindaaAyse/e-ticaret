<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class icerikSayfasi extends Model
{

    public $timestamps = false;

    protected $table = "icerik_sayfalari";

    protected $fillable = [
        "id",
        "menu_baslik",
        "slug",
        "icerik_baslik",
        "icerik",
        "sozlesme",
    ];


}
