<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alisverisSepeti extends Model
{

    public $timestamps = true;

    protected $table = "alisveris_sepeti";

    protected $fillable = [
        "id",
        "uye_id",
        "toplam_tutar",
        "net_tutar",
        "tasima_bedeli",
        "odeme_durumu",
        "odeme_tipi",
        "siparis_notu",
        "durum",
        "durum",
        "alisveris_tarihi",
        "created_at",
        "updated_at",
    ];


}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class alisverisSepeti extends Model
{

    public $timestamps = true;

    protected $table = "alisveris_sepeti";

    protected $fillable = [
        "id",
        "uye_id",
        "toplam_tutar",
        "net_tutar",
        "tasima_bedeli",
        "odeme_durumu",
        "odeme_tipi",
        "siparis_notu",
        "durum",
        "durum",
        "alisveris_tarihi",
        "created_at",
        "updated_at",
    ];


}
