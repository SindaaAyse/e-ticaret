<?php

namespace App\Http\Controllers\backend;

use App\Models\icerikSayfasi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Session;
use Str;

class icerikController extends Controller
{

    public static function icerikSil(Request $request)
    {
        $id = $request->id;
        icerikSayfasi::where('id', $id)->delete();

        $sonuc = [
            'hata' => 0,
            'aciklama' => 'İçerik Silindi',
        ];

        return json_encode($sonuc, TRUE);
    }


    public static function icerikEklePost(Request $request)
    {


        $menuBaslik = $request->menuBaslik;
        $icerikBaslik = $request->icerikBaslik;
        $icerik = $request->icerik;

        if(empty($menuBaslik) OR empty($icerikBaslik) OR empty($icerik)){
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Lütfen Tüm Alanları Eksiksiz Doldurun',
            ];

            return json_encode($sonuc, TRUE);
        }

        // aynı içerikte başlık var mı kontrol ediyoruz.
        $menuSlug = Str::Slug($menuBaslik);
        $icerikKontrol = icerikSayfasi::where('slug', $menuSlug)->first();
        if (!empty($icerikKontrol->id)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => $icerikBaslik . ' adında başka bir menü mevcut',
            ];

            return json_encode($sonuc, TRUE);
        }

        $veri = [
            'menu_baslik' => $menuBaslik,
            'slug' => $menuSlug,
            'icerik_baslik' => $icerikBaslik,
            'icerik' => $icerik,
        ];

        icerikSayfasi::create($veri);

        $sonuc = [
            'hata' => 0,
            'aciklama' => 'İçerik Eklendi',
        ];

        return json_encode($sonuc, TRUE);

    }
    public static function icerikDuzenlePost(Request $request)
    {
        $icerikID = $request->icerikID;
        $menuBaslik = $request->menuBaslik;
        $icerikBaslik = $request->icerikBaslik;
        $icerik = $request->icerik;

        if(empty($menuBaslik) OR empty($icerikBaslik) OR empty($icerik)){
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Lütfen Tüm Alanları Eksiksiz Doldurun',
            ];

            return json_encode($sonuc, TRUE);
        }

        // aynı içerikte başlık var mı kontrol ediyoruz.
        $menuSlug = Str::Slug($menuBaslik);
        $icerikKontrol = icerikSayfasi::where('id', '!=', $icerikID)->where('slug', $menuSlug)->first();
        if (!empty($icerikKontrol->id)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => $icerikBaslik . ' adında başka bir menü mevcut',
            ];

            return json_encode($sonuc, TRUE);
        }

        $veri = [
            'menu_baslik' => $menuBaslik,
            'slug' => $menuSlug,
            'icerik_baslik' => $icerikBaslik,
            'icerik' => $icerik,
        ];

        icerikSayfasi::where('id',$icerikID)->update($veri);

        $sonuc = [
            'hata' => 0,
            'aciklama' => 'icerik Güncellendi',
        ];

        return json_encode($sonuc, TRUE);

    }

    public static function icerikEkleGet()
    {
        return view('backend/icerik/icerikEkle');
    }

    public static function icerikDuzenleGet($id)
    {
        $icerikDetayi = icerikSayfasi::where('id', $id)->first();

        return view('backend/icerik/icerikDuzenle')
            ->with('icerikDetayi', $icerikDetayi);
    }

    public static function icerikListesi()
    {

        $icerikListesi = icerikSayfasi::get();

        return view('backend/icerik/icerikListesi')
            ->with('icerikListesi', $icerikListesi);
    }

}
