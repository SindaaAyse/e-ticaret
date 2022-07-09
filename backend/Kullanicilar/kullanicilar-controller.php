<?php

namespace App\Http\Controllers\backend;

use App\Models\kullanicilar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Hash;
use Session;

class kullaniciController extends Controller
{

    public static function cikisGet(Request $request)
    {
        $request->session()->forget('adminBilgi');

        return redirect()->route('loginGetKP')->send();
    }

    public static function sifreGuncellePost(Request $request)
    {
        $guncelSifre = $request->guncelSifre;
        $yeniSifre = $request->yeniSifre;
        $yeniSifre2 = $request->yeniSifre2;

        if (empty($guncelSifre) or empty($yeniSifre) or empty($yeniSifre2)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Lütfen tüm alanları eksiksiz doldurun',
            ];

            return json_encode($sonuc, TRUE);
        }


        if (!Hash::check($guncelSifre, Session::get('adminBilgi')->sifre)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Lütfen tüm alanları eksiksiz doldurun',
            ];

            return json_encode($sonuc, TRUE);
        }

        if ($yeniSifre != $yeniSifre2) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Yeni Şifre ve Yeni Şifre (Tekrar) Alanları Aynı Değil',
            ];

            return json_encode($sonuc, TRUE);
        }

        $yeniSifreDB  = Hash::make($yeniSifre);

        $kullaniciID = Session::get('adminBilgi')->id;
        $kullaniciVeri = [
            'sifre' => $yeniSifreDB,
        ];

        kullanicilar::where('id', $kullaniciID)->update($kullaniciVeri);

        $sonuc = [
            'hata' => 0,
            'aciklama' => 'Şifreniz Güncellendi',
        ];

        return json_encode($sonuc, TRUE);
    }

    public static function sifreGuncelleGet()
    {

        return view('backend/sifreGuncelle');
    }

    public static function loginPost(Request $request)
    {

        $kullaniciAdi = $request->kullaniciAdi;
        $sifre = $request->sifre;

        if (empty($kullaniciAdi) or empty($sifre)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Lütfen Kullanıcı adı ve şifre alanın boş geçmeyin',
            ];

            return json_encode($sonuc, TRUE);
        }

        //kullanıcı adını kontrol ediyoruz.

        $kulaniciKontrol = kullanicilar::where('kullanici_adi', $kullaniciAdi)->first();


        if (empty($kulaniciKontrol->id)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Kullanıcı adı mevcut değil',
            ];

            return json_encode($sonuc, TRUE);
        }


        $dbSifre = $kulaniciKontrol->sifre;

        if (Hash::check($sifre, $dbSifre)) {
            //ŞİFRE DOĞRU GİRİŞMİŞ İSE

            Session::put('adminBilgi', $kulaniciKontrol);

            $sonuc = [
                'hata' => 0,
                'aciklama' => 'Login Yaptıracağız',
            ];

            return json_encode($sonuc, TRUE);

        } else {
            // ŞİFRE HATALI
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Şifreniz Hatalı',
            ];

            return json_encode($sonuc, TRUE);
        }
    }

    public static function loginGet()
    {
        return view('backend/login');
    }

}
