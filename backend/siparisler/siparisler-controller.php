<?php

namespace App\Http\Controllers\backend;


use App\Helper\fonksiyonlar;
use App\Models\alisverisSepetDetayi;
use App\Models\alisverisSepeti;
use App\Models\alisverisSepetiTeslimat;
use App\Models\ilceler;
use App\Models\iller;
use App\Models\musteriler;
use App\Models\urunler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Hash;
use Session;

class siparislerController extends Controller
{

    public static function siparisGuncellePost(Request $request)
    {

        $durum = $request->siparisDurumu;
        $odemeTipi = $request->odemeTipi;
        $odemeDurumu = $request->odemeDurumu;
        $siparisID = $request->id;

        $siparisVeri = [
            'durum' => $durum,
            'odeme_tipi' => $odemeTipi,
            'odeme_durumu' => $odemeDurumu,
        ];

        alisverisSepeti::where('id', $siparisID)->update($siparisVeri);

        $sonuc=[
            'hata'=>0,
            'aciklama'=>'Sipariş Bilgileri Güncellendi',
        ];

        return json_encode($sonuc, TRUE);
    }

    public static function siparisDetayi($id)
    {

        $urunler = urunler::get();
        if ($urunler->isNotEmpty()) {
            foreach ($urunler as $urunlerD) {
                $urunBilgi[$urunlerD->id] = $urunlerD;
            }
        }

        //Teslimat Bilgileri

        $alisverisTeslimat = alisverisSepetiTeslimat::where('sepet_id', $id)->first();
        if (!empty($alisverisTeslimat->id)) {

            //il Bilgi
            $ilSql = iller::where('id', $alisverisTeslimat->il)->first();
            $ilAdi = $ilSql->sehir_adi;

            //ilce Bilgi
            $ilceSql = ilceler::where('id', $alisverisTeslimat->ilce)->first();
            $ilceAdi = $ilceSql->ilce_adi;

            $teslimatBilgi = [
                'adSoyad' => fonksiyonlar::buyukHarfeCevir($alisverisTeslimat->ad_soyad),
                'gsm' => $alisverisTeslimat->gsm,
                'il' => fonksiyonlar::buyukHarfeCevir($ilAdi),
                'ilce' => fonksiyonlar::buyukHarfeCevir($ilceAdi),
                'adres' => fonksiyonlar::buyukHarfeCevir($alisverisTeslimat->adres),
            ];
        }

        $siparisBilgi = alisverisSepeti::where('id', $id)->first();
        $siparistekiUrunler = alisverisSepetDetayi::where('sepet_id', $id)->get();
        return view('backend/siparisler/siparisDetayi')
            ->with('teslimatBilgi', $teslimatBilgi)
            ->with('siparisBilgi', $siparisBilgi)
            ->with('siparistekiUrunler', $siparistekiUrunler)
            ->with('urunBilgi', $urunBilgi);
    }


    public static function siparisListesi($kategori = null)
    {

        //MüşteriListesi
        $musteriListesi = musteriler::get();
        if ($musteriListesi->isNotEmpty()) {
            foreach ($musteriListesi as $musteriListesiD) {
                $musteriBilgi[$musteriListesiD->id] = $musteriListesiD;
            }
        }

        if (!isset($musteriBilgi)) {
            $musteriBilgi = 0;
        }

        if ($kategori == 'bekleyen') {
            $alisverisler = alisverisSepeti::where('durum', 1)->orderBy('id', 'DESC')->get();
        } else {
            $alisverisler = alisverisSepeti::where('durum', '>=', 1)->orderBy('id', 'DESC')->get();
        }



        return view('backend/siparisler/siparisListesi')
            ->with('alisverisler', $alisverisler)
            ->with('musteriBilgi', $musteriBilgi);
    }

}
