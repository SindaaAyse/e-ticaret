@extends("frontend.hesabim.anaEkran")
@section('contentHesabim')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class="product-sidebar-wrap mb-30">
            <div class="shop-widget">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <h4 class="shop-sidebar-title"> <span style="font-weight: bold">#SPRS0{{$sepetBilgi['sepetBilgi']['id']}}</span> - SİPARİŞ DETAYI </h4>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="siparisDetayDiv">
                            <span style="font-weight: bold">Sipariş Tarihi: </span>{{fonksiyon::tarihBicimi($sepetBilgi['sepetBilgi']['alisverisTarihi'],1)}}
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="siparisDetayDiv">
                            <span style="font-weight: bold">Ödeme Durumu :</span>
                            @if($sepetBilgi['sepetBilgi']['odemeDurumu']==0)
                                Ödeme Bekliyor
                            @else
                                Ödendi
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="siparisDetayDiv">
                            <span style="font-weight: bold">Ödeme Tipi :</span>
                            @if($sepetBilgi['sepetBilgi']['odemeTipi']==1)
                                Eft-Havale
                            @elseif($sepetBilgi['sepetBilgi']['odemeTipi']==2)
                                Kredi Kartı
                            @else
                                Kapıda Nakit
                            @endif
                        </div>

                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="siparisDetayDiv">
                            <span style="font-weight: bold">Sipariş Durumu :</span>
                            @if($sepetBilgi['sepetBilgi']['durum']==1)
                                Hazırlanıyor
                            @elseif($sepetBilgi['sepetBilgi']['odemeTipi']==2)
                                Kargoda
                            @elseif($sepetBilgi['sepetBilgi']['odemeTipi']==3)
                                Tamamlandı
                            @else
                                İptal Edildi
                            @endif
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center mt-4">
                        <h4 class="shop-sidebar-title"> TESLİMAT BİLGİLERİ </h4>
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center mt-2 mb-20">
                        <div style="display: block">
                            {{$sepetBilgi['teslimatBilgi']['adSoyad']}} - {{$sepetBilgi['teslimatBilgi']['gsm']}}
                        </div>
                        <div style="display: block; margin-top: 10px">
                            {{$sepetBilgi['teslimatBilgi']['adres']}} / {{$sepetBilgi['teslimatBilgi']['ilceAdi']}} / {{$sepetBilgi['teslimatBilgi']['ilAdi']}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center mt-4">
                        <h4 class="shop-sidebar-title"> SEPETTEKİ ÜRÜNLER </h4>
                    </div>
                </div>
                <div class="row">
                    <table class="table" style="margin-top: 10px">
                        <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">ÜRÜN KODU</th>
                            <th scope="col">ÜRÜN ADI</th>
                            <th scope="col">ADET</th>
                            <th scope="col" style="text-align: right">NET TUTAR </th>
                            <th scope="col" style="text-align: right">TOPLAM TUTAR</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sepetBilgi['urunler'] as $sepetUrunleri)
                            <tr style="vertical-align: middle">
                                <td style="text-align: center">
                                    <img style="width: 50px; border-radius: 50%" src="/{{$sepetUrunleri['urunResmi']}}" alt="">
                                </td>
                                <td>{{$sepetUrunleri['urunKodu']}}</td>
                                <td>{{$sepetUrunleri['urunAdi']}}</td>
                                <td>{{$sepetUrunleri['adet']}}</td>
                                <td style="text-align: right">{{fonksiyon::paraBirimi($sepetUrunleri['netTutar'])}} TL</td>
                                <td style="text-align: right">{{fonksiyon::paraBirimi($sepetUrunleri['tutar'])}} TL</td>
                            </tr>
                        @endforeach
                        <tr style="vertical-align: middle; height: 50px;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right"><b>TOPLAM NET :</b></td>
                            <td style="text-align: right">{{fonksiyon::paraBirimi($sepetBilgi['sepetBilgi']['netTutar'])}} TL</td>
                        </tr>
                        <tr style="vertical-align: middle; height: 50px;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right"><b>TOPLAM KDV :</b></td>
                            <td style="text-align: right">{{fonksiyon::paraBirimi($sepetBilgi['sepetBilgi']['toplamTutar'] - $sepetBilgi['sepetBilgi']['netTutar'])}} TL</td>
                        </tr>
                        <tr style="vertical-align: middle; height: 50px;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right"><b>GENEL TOPLAM :</b></td>
                            <td style="text-align: right">{{fonksiyon::paraBirimi($sepetBilgi['sepetBilgi']['toplamTutar'])}} TL</td>
                        </tr>
                        <tr style="vertical-align: middle; height: 50px;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right"><b>KARGO ÜCRETİ :</b></td>
                            <td style="text-align: right">{{fonksiyon::paraBirimi($sepetBilgi['sepetBilgi']['tasimaBedeli'])}} TL</td>
                        </tr>
                        <tr style="vertical-align: middle; height: 50px;">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style="text-align: right"><b>ÖDENECEK TUTAR :</b></td>
                            <td style="text-align: right">{{fonksiyon::paraBirimi($sepetBilgi['sepetBilgi']['tasimaBedeli'] + $sepetBilgi['sepetBilgi']['toplamTutar'])}} TL</td>
                        </tr>
                        @if(!empty($sepetBilgi['sepetBilgi']['siparisNotu']))
                        <tr style="vertical-align: middle; height: 50px;">
                            <td colspan="6"> <span style="font-weight: bold"> SİPARİŞ NOTU :</span> {{$sepetBilgi['sepetBilgi']['siparisNotu']}}</td>
                        </tr>
                        @endif
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')


@endsection
