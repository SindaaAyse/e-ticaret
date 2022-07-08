<?php

namespace App\Http\Controllers\backend;

use App\Models\slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Image;
use Hash;
use Session;

class sliderController extends Controller
{

    public static function sliderEklePost(Request $request)
    {

        if (!$request->file('resim')) {
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Lütfen Geçerli Bir Resim Yükleyin',
            ];
            $sonuc = json_encode($sonuc, TRUE);

            return $sonuc;
        }

        if($request->file('resim')->getSize()==false){
            $sonuc = [
                'hata' => 1,
                'aciklama' => 'Görüntü Boyutu Yüksek',
            ];
            $sonuc = json_encode($sonuc, TRUE);

            return $sonuc;
        }
        $time = time();

        //Büyük Resmi Kaydediyoruz.
        if ($request->file('resim')) {
            $resimUzanti = $request->file('resim')->getClientOriginalExtension();
            $buyukResimAdi = $time . '.' . $resimUzanti;

            $buyukResim = public_path('upload/slider/' . $buyukResimAdi);
            $img = Image::make($request->file('resim'))->resize(1170, null, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $img->save($buyukResim);
            $resimDB = 'upload/slider/' . $buyukResimAdi;

        }

        $veriler = [
            'resim' => $resimDB,
        ];

        slider::create($veriler);

        $sonuc = [
            'hata' => 0,
            'aciklama' => 'Slider Başarıyla Eklendi',
        ];
        $sonuc = json_encode($sonuc, TRUE);

        return $sonuc;
    }

    public static function sliderSil(Request $request)
    {
        $id = $request->id;
        slider::where('id',$id)->delete();

        $sonuc=[
            'hata'=>0,
            'aciklama'=>'Slider Silindi',
        ];

        return json_encode($sonuc, TRUE);

    }

    public static function sliderListesi()
    {
        $sliderListesi = slider::orderBy('id','DESC')->get();

        return view('backend/slider/sliderListesi')
            ->with('sliderListesi',$sliderListesi);
    }

}
