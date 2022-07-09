<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alisverisSepetDetayi extends Model
{

    public $timestamps = false;

    protected $table = "alisveris_sepeti_detayi";

    protected $fillable = [
        "id",
        "sepet_id",
        "urun_id",
        "adet",
        "net_tutar",
        "tutar",
        "kdv",
        "tarih",
    ];


}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alisverisSepetDetayi extends Model
{

    public $timestamps = false;

    protected $table = "alisveris_sepeti_detayi";

    protected $fillable = [
        "id",
        "sepet_id",
        "urun_id",
        "adet",
        "net_tutar",
        "tutar",
        "kdv",
        "tarih",
    ];


}
