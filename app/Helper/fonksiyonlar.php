<?php

namespace App\Helper;

use App\Http\Controllers\Controller;
use App\Models\alisverisSepeti;

use Session;

class fonksiyonlar
{

    public static function tarihBicimi($date, $bicim)
    {
        $tarihduzenle = date("Y-n-d", strtotime($date));
        $tarihi_bol = explode("-", $tarihduzenle);
        if ($bicim == '1') {
            $sadece_tarih = substr($date, 0, 11);
            $saat = str_replace($sadece_tarih, "", $date);
            $saat = substr($saat, 0, 5);
            $turkceay = array("", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık");

            $sonuc = $tarihi_bol[2] . ' ' . $turkceay[$tarihi_bol[1]]. ' ' . $tarihi_bol[0] . ', ' . $saat;
        }

        return $sonuc;
    }

    public static function sepetTutari()
    {
        $toplamTutar = '0,00';
        if(Session::get('musteriBilgi')){
            //Login Olunmuşsa Sepet Tutarını alıyoruz.

            $musID =Session::get('musteriBilgi')->id;
            $sepetTutarSql = alisverisSepeti::where('uye_id',$musID)->where('durum',0)->first();
            if(!empty($sepetTutarSql->id)){
                $toplamTutar = self::paraBirimi($sepetTutarSql->toplam_tutar);
            }
        }

        return $toplamTutar;
    }
    public static function buyukHarfeCevir($text)
    {
        $search = array("ç", "i", "ı", "ğ", "ö", "ş", "ü");
        $replace = array("Ç", "İ", "I", "Ğ", "Ö", "Ş", "Ü");
        $text = str_replace($search, $replace, $text);
        $text = strtoupper($text);
        $text = mb_convert_encoding($text, 'UTF-8', 'UTF-8');
        return $text;
    }

    public static function paraBirimi($Miktar)
    {
        if (!empty($Miktar)) {
            $paraBirimi = number_format($Miktar, 2, ',', '.');
        } else {
            $paraBirimi = "0,00";
        }
        return $paraBirimi;
    }

}
