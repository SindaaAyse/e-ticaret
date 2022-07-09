<?php

namespace App\Helper;

use App\Http\Controllers\Controller;
use App\Models\urunKategoriler;
use App\Models\icerikSayfasi;
use App\Helper\fonksiyonlar;


class icerik
{

    public static function urunKategorileri()
    {
        $icerik = '';

        $katLisSql = urunKategoriler::get();
        if ($katLisSql->isNotEmpty()) {
            foreach ($katLisSql as $katLisSqlD){
                $icerik .= '<li><a href="'.route('urunListesi',$katLisSqlD->slug).'">'.fonksiyonlar::buyukHarfeCevir($katLisSqlD->adi).'</a></li>';
            }
        }

        return $icerik;
    }

    //Üst Menü için içerik sayfalarını oluşturuyoruz.
    public static function icerikSayfalariMenu()
    {
        $icerik = '';

        $icerikSSql = icerikSayfasi::where('sozlesme',0)->get();
        if ($icerikSSql->isNotEmpty()) {
            foreach ($icerikSSql as $icerikSSqlD){
                $icerik .= '<li><a href="'.route('icerikDetayi',$icerikSSqlD->slug).'">'.fonksiyonlar::buyukHarfeCevir($icerikSSqlD->menu_baslik).'</a></li>';
            }
        }

        return $icerik;
    }

}
