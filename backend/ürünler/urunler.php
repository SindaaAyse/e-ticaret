<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class urunler extends Model
{

    public $timestamps = false;

    protected $table = "urunler";

    protected $fillable = [
        "id",
        "kat_id",
        "kodu",
        "adi",
        "slug",
        "resim",
        "fiyat",
        "kdv",
        "aciklama",
        "anasayfa",
        "silindi",
    ];


}
