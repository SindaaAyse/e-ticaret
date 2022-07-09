<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\frontend\homeController;
use App\Http\Controllers\frontend\urunlerController;
use App\Http\Controllers\frontend\icerikController;
use App\Http\Controllers\frontend\iletisimController;
use App\Http\Controllers\frontend\musterilerController;
use App\Http\Controllers\frontend\alisverisController;
use App\Http\Controllers\frontend\hesabim\hesabimController;
use App\Http\Controllers\frontend\hesabim\adreslerimController;
use App\Http\Controllers\ajaxController;
use App\Http\Controllers\frontend\siparislerController;

//BACKEND
use App\Http\Controllers\backend\kullaniciController;
use App\Http\Controllers\backend\backendController;
use App\Http\Controllers\backend\sliderController;
use App\Http\Controllers\backend\musterilerController as musterilerControllerKP;
use App\Http\Controllers\backend\iletisimController as iletisimControllerKP;
use App\Http\Controllers\backend\icerikController as icerikControllerKP;
use App\Http\Controllers\backend\urunlerController as urunlerControllerKP;
use App\Http\Controllers\backend\siparislerController as siparislerControllerKP;


Route::get('/', [homeController::class, 'index'])->name('anasayfa');

//YARDIMCI AJAXLAR
Route::get('/ilceleri-getir', [ajaxController::class, 'ilceGetirGet'])->name('ilceGetirGet');


// ÜRÜNLER İLE İLGİLİ BÖLÜM
Route::get('/urunler/{kategoriSlug}', [urunlerController::class, 'urunListesi'])->name('urunListesi');
Route::get('/urun-detay/{urunSlug}', [urunlerController::class, 'urunDetay'])->name('urunDetayi');
Route::get('/urun-ara', [urunlerController::class, 'urunArama'])->name('urunArama');

// İÇERİK VE SÖZLEŞMELER SAYFASI
Route::get('/icerik/{icerikSlug}', [icerikController::class, 'icerikDetayi'])->name('icerikDetayi');

//İLETİŞİM SAYFASI
Route::get('/iletisim', [iletisimController::class, 'iletisimGet'])->name('iletisimGet');
Route::post('/iletisim', [iletisimController::class, 'iletisimPost'])->name('iletisimPost'); // İLETİŞİM SAYFASINDA FORM POST EDİLİNCE (AJAX)


//MÜŞTERİLER İLE İLGİLİ BÖLÜM
Route::get('/yeni-kayit', [musterilerController::class, 'yeniKayitGet'])->name('yeniKayitGet');
Route::post('/yeni-kayit', [musterilerController::class, 'yeniKayitPost'])->name('yeniKayitPost');
Route::get('/giris', [musterilerController::class, 'girisGet'])->name('girisGet');
Route::post('/giris', [musterilerController::class, 'girisPost'])->name('girisPost');
Route::get('/cikis', [musterilerController::class, 'cikisGet'])->name('cikisGet');

//ALIŞVERİŞ (SEPET) İŞLEMLERİ
Route::get('/alisveris-sepeti', [alisverisController::class, 'alisveriSepeti'])->name('alisveriSepeti');
Route::get('/alisveris-sepeti/odeme/{id?}', [alisverisController::class, 'alisveriSepetiOdeme'])->name('alisverisSepetiOdeme');
Route::post('/alisveris-sepeti/odeme/{id?}', [alisverisController::class, 'alisveriSepetiOdemePost'])->name('alisveriSepetiOdemePost');
Route::get('/alisveris-sepeti/basarili/{id?}', [alisverisController::class, 'basariliAlisveris'])->name('basariliAlisveris');
Route::post('/sepete-urun-ekle', [alisverisController::class, 'sepeteUrunEkle'])->name('sepeteUrunEkle');
Route::post('/alisveris-sepeti-temizle', [alisverisController::class, 'sepetiTemizle'])->name('sepetiTemizle');
Route::post('/alisveris-sepeti-urun-sil', [alisverisController::class, 'sepetUrunSil'])->name('sepetUrunSil');
Route::post('/alisveris-sepeti-guncelle', [alisverisController::class, 'sepetGuncelle'])->name('sepetGuncelle');
Route::get('/alisveris-sepeti/teslimat', [alisverisController::class, 'teslimatGet'])->name('teslimatGet')->middleware('musteri'); // Müşteri Giriş Yapmamış Bu Sayfayı Görmesini İstemiyoruz.
Route::post('/alisveris-sepeti/teslimat', [alisverisController::class, 'teslimatPost'])->name('teslimatPost')->middleware('musteri'); // Müşteri Giriş Yapmamış Bu Sayfayı Görmesini İstemiyoruz.
Route::post('/alisveris-sepeti/adres-sec', [alisverisController::class, 'sepetAdresiSec'])->name('sepetAdresiSec')->middleware('musteri'); // Müşteri Giriş Yapmamış Bu Sayfayı Görmesini İstemiyoruz.

//MÜŞTERİ LOGİN OLMUŞSA GÖRÜNECEK BÖLÜMLER

Route::group(['prefix' => 'hesabim', 'middleware' => ['musteri']], function () {

    Route::get('/', [hesabimController::class, 'anaEkran'])->name('hesabim');

    Route::post('/uyelik-bilgilerim', [hesabimController::class, 'uyelikBilgilerimPost'])->name('uyelikBilgilerimPost'); // ÜYELİK BİLGİLERİNİ GÜNCELLE
    Route::get('/sifre-degis', [hesabimController::class, 'sifreDegisGet'])->name('sifreDegisGet'); // ŞİFRE DEĞİŞTİRME BLADE
    Route::post('/sifre-degis', [hesabimController::class, 'sifreDegisPost'])->name('sifreDegisPost'); // ŞİFRE DEĞİŞTİRME POST

    //HESABIM > ADRESLERİM BÖLÜMÜ
    Route::get('/adreslerim', [adreslerimController::class, 'adresListesi'])->name('adresListesi');
    Route::get('/adreslerim/yeni-ekle', [adreslerimController::class, 'yeniAdresGet'])->name('yeniAdresGet');
    Route::post('/adreslerim/yeni-ekle', [adreslerimController::class, 'yeniAdresPost'])->name('yeniAdresPost');
    Route::post('/adreslerim/adres-sil', [adreslerimController::class, 'adresSil'])->name('adresSilPost');
    Route::get('/adreslerim/duzenle/{id?}', [adreslerimController::class, 'adresDuzenle'])->name('adresDuzenleGet');
    Route::post('/adreslerim/duzenlee/{id?}', [adreslerimController::class, 'adresDuzenlePost'])->name('adresDuzenlePost');

    //HESANIM > SİPARİŞLERİM BÖLÜMÜ
    Route::get('/siparislerim', [siparislerController::class, 'siparisListesi'])->name('siparisListesi');
    Route::get('/siparis-detay/{id?}', [siparislerController::class, 'siparisDetayi'])->name('siparisDetayi');

});

// KONTROL PANELİ LOGİN EKRANI
Route::get('/panel/login', [kullaniciController::class, 'loginGet'])->name('loginGetKP');
Route::post('/panel/login', [kullaniciController::class, 'loginPost'])->name('loginPostKP');

//YÖNETİCİ LOGİN OLMUŞSA GÖRÜNECEK BÖLÜMLER
Route::group(['prefix' => 'panel', 'middleware' => ['yonetici']], function () {

    Route::get('/', [backendController::class, 'anaEkran'])->name('anaEkranKP');
    Route::get('/cikis', [kullaniciController::class, 'cikisGet'])->name('cikisGetKP');

    //YÖNETİCİ ŞİFRE İŞLEMLERİ
    Route::get('/sifre-guncelle', [kullaniciController::class, 'sifreGuncelleGet'])->name('sifreGuncelleGetKP');
    Route::post('/sifre-guncelle', [kullaniciController::class, 'sifreGuncellePost'])->name('sifreGuncellePostKP');

    //MÜŞTERİLER MODULU
    Route::get('/musteri/musteri-listesi', [musterilerControllerKP::class, 'musteriListesi'])->name('musteriListesiKP');
    Route::post('/musteri/musteri-sil', [musterilerControllerKP::class, 'musteriSil'])->name('musteriSilKP');
    Route::get('/musteri/musteri-duzenle/{id}', [musterilerControllerKP::class, 'musteriDuzenleGet'])->name('musteriDuzenleGetKP');
    Route::post('/musteri/musteri-duzenle', [musterilerControllerKP::class, 'musteriDuzenlePost'])->name('musteriDuzenlePostKP');
    Route::post('/musteri/musteri-duzenle-gb', [musterilerControllerKP::class, 'musteriDuzenlePostGB'])->name('musteriDuzenlePostGBKP');
    Route::post('/musteri/musteri-giris', [musterilerControllerKP::class, 'musteriGiris'])->name('musteriGirisKP');

    //SLİDER MODULU
    Route::get('/slider', [sliderController::class, 'sliderListesi'])->name('sliderListesiKP');
    Route::post('/slider-sil', [sliderController::class, 'sliderSil'])->name('sliderSilKP');
    Route::post('/slider-ekle', [sliderController::class, 'sliderEklePost'])->name('sliderEklePostKP');

    //İLETİŞİM MODULU
    Route::get('/iletisim', [iletisimControllerKP::class, 'gelenKutusu'])->name('gelenKutusuKP');
    Route::post('/iletisim-sil', [iletisimControllerKP::class, 'gelenKutusuSil'])->name('gelenKutusuSilKP');
    Route::post('/iletisim-detay', [iletisimControllerKP::class, 'gelenKutusuDetay'])->name('gelenKutusuDetayKP');


    //İÇERİK SAYFALARI
    Route::get('/icerik/icerik-listesi', [icerikControllerKP::class, 'icerikListesi'])->name('icerikListesiKP');
    Route::post('/icerik/icerik-sil', [icerikControllerKP::class, 'icerikSil'])->name('icerikSilKP');
    Route::get('/icerik/icerik-duzenle/{id}', [icerikControllerKP::class, 'icerikDuzenleGet'])->name('icerikDuzenleGetKP');
    Route::post('/icerik/icerik-duzenle', [icerikControllerKP::class, 'icerikDuzenlePost'])->name('icerikDuzenlePostKP');
    Route::get('/icerik/icerik-ekle', [icerikControllerKP::class, 'icerikEkleGet'])->name('icerikEkleGetKP');
    Route::post('/icerik/icerik-ekle', [icerikControllerKP::class, 'icerikEklePost'])->name('icerikEklePostKP');


    //ÜRÜN KATEGORİLERİ
    Route::get('/urunler/urun-kategorileri', [urunlerControllerKP::class, 'urunKategorileri'])->name('urunKategorileriKP');
    Route::post('/urunler/urun-kategori-ekle', [urunlerControllerKP::class, 'urunKategoriEkle'])->name('urunKategoriEkleKP');
    Route::post('/urunler/urun-kategori-sil', [urunlerControllerKP::class, 'urunKategoriSil'])->name('urunKategoriSilKP');
    Route::get('/urunler/urun-kategori/{id}', [urunlerControllerKP::class, 'urunKategoriDuzenleGet'])->name('urunKategoriDuzenleGetKP');
    Route::post('/urunler/urun-kategori-duzenle', [urunlerControllerKP::class, 'urunKategoriDuzenlePost'])->name('urunKategoriDuzenlePostKP');

    //ÜRÜN LİSTESİ
    Route::get('/urunler/urun-listesi', [urunlerControllerKP::class, 'urunListesi'])->name('urunListesiKP');
    Route::post('/urunler/urun-sil', [urunlerControllerKP::class, 'urunSil'])->name('urunSilKP');
    Route::get('/urunler/urun-duzenle/{id}', [urunlerControllerKP::class, 'urunDuzenleGet'])->name('urunDuzenleGetKP');
    Route::post('/urunler/urun-duzenle', [urunlerControllerKP::class, 'urunDuzenlePost'])->name('urunDuzenlePostKP');
    Route::get('/urunler/urun-ekle', [urunlerControllerKP::class, 'urunEkleGet'])->name('urunEkleGetKP');
    Route::post('/urunler/urun-ekle', [urunlerControllerKP::class, 'urunEklePost'])->name('urunEklePostKP');


    //SİPARİŞLER
    Route::get('/siparis/siparis-listesi/{kategori?}', [siparislerControllerKP::class, 'siparisListesi'])->name('siparisListesiKP');
    Route::get('/siparis/siparis-detay/{id}', [siparislerControllerKP::class, 'siparisDetayi'])->name('siparisDetayiKP');
    Route::post('/siparis/siparis-guncelle', [siparislerControllerKP::class, 'siparisGuncellePost'])->name('siparisGuncellePostKp');


});
