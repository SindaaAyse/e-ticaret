<?php

namespace App\Http\Controllers\backend;


use App\Helper\fonksiyonlar;
use App\Models\urunKategoriler;
use App\Models\urunler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Str;
use Session;
use Image;

class urunlerController extends Controller
{

    public static function urunKategoriSil(Request $request)
    {
        $id = $request->id;
        urunKategoriler::where('id', $id)->delete();

        $sonuc = [
            'hata' => 0,
            'aciklama' => 'Kategori Silindi',
        ];

        return json_encode($sonuc, TRUE);
    }

    public static function urunKategoriDuzenlePost(Request $request)
    {
        $kategoriAdi = $request->kategoriAdi;
        $kategoriID = $request->katID;

        if (empty($kategoriAdi)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Lütfen Kategori Adını Boş Geçmeyin',
            ];

            return json_encode($sonuc, TRUE);
        }

        $kategoriSlug = Str::Slug($kategoriAdi);

        //Slug Kontrolu Yapıyoruz.
        $slugKontrol = urunKategoriler::where('id', '!=', $kategoriID)->where('slug', $kategoriSlug)->first();
        if (!empty($slugKontrol->id)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => $kategoriAdi . ' adında kategori zaten mevcut',
            ];

            return json_encode($sonuc, TRUE);
        }

        $veri = [
            'adi' => $kategoriAdi,
            'slug' => $kategoriSlug,
        ];

        urunKategoriler::where('id', $kategoriID)->update($veri);

        $sonuc = [
            'hata' => 0,
            'aciklama' => 'Kategori Güncellendi',
        ];

        return json_encode($sonuc, TRUE);
    }


    public static function urunKategoriEkle(Request $request)
    {
        $kategoriAdi = $request->kategoriAdi;

        if (empty($kategoriAdi)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Lütfen Kategori Adını Boş Geçmeyin',
            ];

            return json_encode($sonuc, TRUE);
        }

        $kategoriSlug = Str::Slug($kategoriAdi);

        //Slug Kontrolu Yapıyoruz.
        $slugKontrol = urunKategoriler::where('slug', $kategoriSlug)->first();
        if (!empty($slugKontrol->id)) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => $kategoriAdi . ' adında kategori zaten mevcut',
            ];

            return json_encode($sonuc, TRUE);
        }

        $veri = [
            'adi' => $kategoriAdi,
            'slug' => $kategoriSlug,
        ];

        urunKategoriler::create($veri);

        $sonuc = [
            'hata' => 0,
            'aciklama' => 'Kategori Eklendi',
        ];

        return json_encode($sonuc, TRUE);


    }

    public static function urunKategoriDuzenleGet($id)
    {
        $urunKategorileri = urunKategoriler::orderBy('id', 'DESC')->get();

        //Kategori Bilgisini Ayrıca Alıyoruz.

        $kategoriBilgi = urunKategoriler::where('id', $id)->first();

        return view('backend/urunler/urunKategoriDuzenle')
            ->with('kategoriBilgi', $kategoriBilgi)
            ->with('urunKategorileri', $urunKategorileri);
    }

    public static function urunKategorileri()
    {
        $urunKategorileri = urunKategoriler::orderBy('id', 'DESC')->get();
        return view('backend/urunler/urunKategorileri')
            ->with('urunKategorileri', $urunKategorileri);
    }

}
