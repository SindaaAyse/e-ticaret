<?php

namespace App\Http\Controllers\backend;

use App\Models\iletisim;
use App\Helper\fonksiyonlar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class iletisimController extends Controller
{

    public static function gelenKutusuDetay(Request $request)
    {

        $gelenID = $request->id;

        //Mesaj Detayını Alıyoruz.

        $icerik = '';

        $iletisimSql = iletisim::where('id', $gelenID)->first();
        if (!empty($iletisimSql->id)) {
            $icerik .= '
                <div id="mesajDetayBr"> <span>TARİH :</span>  '.fonksiyonlar::tarihBicimi($iletisimSql->tarih,1).' </div>
                <div id="mesajDetayBr"> <span>AD SOYAD :</span>  '.$iletisimSql->ad.' </div>
                <div id="mesajDetayBr"> <span>E-MAIL :</span> '.$iletisimSql->email.' </div>
                <div id="mesajDetayBr"> <span>KONU :</span> '.$iletisimSql->konu.' </div>
                <div id="mesajDetayBr"> <span>MESAJ DETAYI :</span> '.$iletisimSql->mesaj.' </div>
            ';
        }

        return $icerik;
    }

    public static function gelenKutusuSil(Request $request)
    {
        $id = $request->id;
        iletisim::where('id', $id)->delete();

        $sonuc = [
            'hata' => 0,
            'aciklama' => 'Mesaj Silindi',
        ];

        return json_encode($sonuc, TRUE);
    }

    public static function gelenKutusu()
    {

        $gelenKutusu = iletisim::get();


        return view('backend/gelenKutusu')
            ->with('gelenKutusu', $gelenKutusu);
    }

}
<?php

namespace App\Http\Controllers\backend;

use App\Models\iletisim;
use App\Helper\fonksiyonlar;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class iletisimController extends Controller
{

    public static function gelenKutusuDetay(Request $request)
    {

        $gelenID = $request->id;

        //Mesaj Detayını Alıyoruz.

        $icerik = '';

        $iletisimSql = iletisim::where('id', $gelenID)->first();
        if (!empty($iletisimSql->id)) {
            $icerik .= '
                <div id="mesajDetayBr"> <span>TARİH :</span>  '.fonksiyonlar::tarihBicimi($iletisimSql->tarih,1).' </div>
                <div id="mesajDetayBr"> <span>AD SOYAD :</span>  '.$iletisimSql->ad.' </div>
                <div id="mesajDetayBr"> <span>E-MAIL :</span> '.$iletisimSql->email.' </div>
                <div id="mesajDetayBr"> <span>KONU :</span> '.$iletisimSql->konu.' </div>
                <div id="mesajDetayBr"> <span>MESAJ DETAYI :</span> '.$iletisimSql->mesaj.' </div>
            ';
        }

        return $icerik;
    }

    public static function gelenKutusuSil(Request $request)
    {
        $id = $request->id;
        iletisim::where('id', $id)->delete();

        $sonuc = [
            'hata' => 0,
            'aciklama' => 'Mesaj Silindi',
        ];

        return json_encode($sonuc, TRUE);
    }

    public static function gelenKutusu()
    {

        $gelenKutusu = iletisim::get();


        return view('backend/gelenKutusu')
            ->with('gelenKutusu', $gelenKutusu);
    }

}
