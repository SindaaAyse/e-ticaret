<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kullanicilar extends Model
{

    public $timestamps = false;

    protected $table = "kullanicilar";

    protected $fillable = [
        "id",
        "kullanici_adi",
        "sifre",
        "isim",
    ];


}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class kullanicilar extends Model
{

    public $timestamps = false;

    protected $table = "kullanicilar";

    protected $fillable = [
        "id",
        "kullanici_adi",
        "sifre",
        "isim",
    ];


}
