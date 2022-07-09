<?php

namespace App\Http\Controllers\backend;

use App\Models\alisverisSepetDetayi;
use App\Models\alisverisSepeti;
use App\Models\alisverisSepetiTeslimat;
use App\Models\ilceler;
use App\Models\iller;
use App\Models\musteriAdresleri;
use App\Models\musteriler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Hash;
use Session;

class musterilerController extends Controller
{

    public static function musteriGiris(Request $request)
    {
        $musteriID = $request->musteriID;

        //Müşteri Bilgileri
        $musteriBilgil = musteriler::where('id',$musteriID)->first();

        Session::put('musteriBilgi', $musteriBilgil);

        return redirect()->route('hesabim')->send();

    }
    public static function musteriDuzenlePostGB(Request $request)
    {

        $musteriID = $request->musteriID;
        $sifre = $request->sifre;
        $email = $request->email;

        if (empty($email)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Lütfen Email Alanın Boş Bırakmayın',
            ];

            return json_encode($sonuc, TRUE);
        }

        //aynı email var mı kontrol ediyoruz.
        $emailKontrol = musteriler::where('id', '!=', $musteriID)->where('email',$email)->first();
        if (!empty($emailKontrol)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'E-mail adresi başka müşteri tarafından kullanılıyor. Lütfen Değiştirin',
            ];

            return json_encode($sonuc, TRUE);
        }

        $musteriBilgi = musteriler::where('id', $musteriID)->first();

        $dbSifre = $musteriBilgi->sifre;

        if (!empty($sifre)) {
            $dbSifre = Hash::make($sifre);
        }

        $veri = [
            'email' => $email,
            'sifre' => $dbSifre
        ];

        musteriler::where('id', $musteriID)->update($veri);
        $sonuc = [
            'hata' => 0,
            'aciklama' => 'Giriş Bilgileri Güncellendi',
        ];

        return json_encode($sonuc, TRUE);

    }

    public static function musteriDuzenlePost(Request $request)
    {

        $musteriID = $request->musteriID;
        $musteriAdi = $request->musteriAdi;
        $gsm = $request->gsm;
        $il = $request->il;
        $ilce = $request->ilce;
        $adres = $request->adres;

        $gsm = str_replace(" ", "", $gsm);

        if (empty($musteriAdi) OR empty($gsm) OR empty($il) OR empty($ilce) OR empty($adres)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Lütfen Tüm Alanları Eksiksiz Doldurun',
            ];

            return json_encode($sonuc, TRUE);
        }

        if (!is_numeric($gsm) or strlen($gsm) != 11) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Lütfen gsm numarasını 05xx şeklinde 11 hane olarak girin',
            ];

            return json_encode($sonuc, TRUE);
        }

        $musteriVeri = [
            'ad_soyad' => $musteriAdi,
            'gsm' => $gsm,
            'il' => $il,
            'ilce' => $ilce,
            'adres' => $adres,
        ];

        musteriler::where('id', $musteriID)->update($musteriVeri);

        $sonuc = [
            'hata' => 0,
            'aciklama' => 'Müşteri Bilgileri Güncellendi',
        ];

        return json_encode($sonuc, TRUE);
    }

    public static function musteriDuzenleGet($id)
    {

        //Müşteri Bilgierini Alıyoruz.

        $musteriBilgileri = musteriler::where('id', $id)->first();
        $ilListesi = iller::get();

        $ilceListesi = ilceler::where('sehir_id', $musteriBilgileri->il)->get();

        return view('backend/musteriler/musteriDuzenle')
            ->with('musteriBilgileri', $musteriBilgileri)
            ->with('ilceListesi', $ilceListesi)
            ->with('ilListesi', $ilListesi);


    }

    public static function musteriSil(Request $request)
    {
        $musteriID = $request->musteriID;

        //Varsa Siparişlerin ID bilgisini Topluyoruz.
        $alisverisSql = alisverisSepeti::where('uye_id', $musteriID)->get();
        if ($alisverisSql->isNotEmpty()) {
            foreach ($alisverisSql as $alisverisSqlD) {
                $siparisIDS[] = $alisverisSqlD->id;
            }
        }

        //Müşterinin Siparişleri Var ise
        if (isset($siparisIDS)) {
            //siparişleri, sipariş detaylarını ve sipariş teslimat bilgilerini siliyoruz.
            alisverisSepetiTeslimat::whereIn('sepet_id', $siparisIDS)->delete();
            alisverisSepetDetayi::whereIn('sepet_id', $siparisIDS)->delete();
            alisverisSepeti::whereIn('id', $siparisIDS)->delete();
        }

        musteriAdresleri::where('mus_id', $musteriID)->delete();
        musteriler::where('id', $musteriID)->delete();


        $sonuc = [
            'hata' => 0,
            'aciklama' => 'Müşteri Silindi',
        ];

        return json_encode($sonuc, TRUE);

    }

    public static function musteriListesi()
    {

        $musteriListesi = musteriler::get();
        $il = iller::get();
        foreach ($il as $ilD) {
            $ilBilgi[$ilD->id] = $ilD->sehir_adi;
        }

        $ilce = ilceler::get();
        foreach ($ilce as $ilceD) {
            $ilceBilgi[$ilceD->id] = $ilceD->ilce_adi;
        }

        return view('backend/musteriler/musteriListesi')
            ->with('ilceBilgi', $ilceBilgi)
            ->with('ilBilgi', $ilBilgi)
            ->with('musteriListesi', $musteriListesi);
    }
}
