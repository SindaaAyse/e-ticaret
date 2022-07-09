<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class iletisim extends Model
{

    public $timestamps = false;

    protected $table = "iletisim_form";

    protected $fillable = [
        "id",
        "ad",
        "email",
        "konu",
        "mesaj",
        "tarih",
    ];


}
