@extends("frontend.hesabim.anaEkran")
@section('contentHesabim')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class="product-sidebar-wrap mb-30">
            <div class="shop-widget">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                        <h4 class="shop-sidebar-title"> SİPARİŞLERİM </h4>
                    </div>
                </div>
                <div class="row">
                    @if($siparisListesi->isNotEmpty())
                        <table class="table" style="margin-top: 10px">
                            <thead>
                                <tr>
                                    <th scope="col">TARİH</th>
                                    <th scope="col">SİPARİŞ ID</th>
                                    <th scope="col">TUTAR</th>
                                    <th scope="col">ÖDEME </th>
                                    <th scope="col">DURUM</th>
                                    <th scope="col">ÖDEME TİPİ</th>
                                    <th scope="col">..</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($siparisListesi as $siparisListesiD)
                                <tr style="vertical-align: middle;">
                                    <td>{{fonksiyon::tarihBicimi($siparisListesiD->alisveris_tarihi,1)}}</td>
                                    <td><span style="font-weight: bold">#SPRS0{{$siparisListesiD->id}}</span></td>
                                    <td>{{fonksiyon::paraBirimi($siparisListesiD->toplam_tutar)}} TL</td>
                                    <td>
                                        @if($siparisListesiD->odeme_durumu==0)
                                            <span> BEKLEMEDE </span>
                                        @else
                                            <span> ÖDENDİ </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($siparisListesiD->durum==1)
                                            HAZIRLANIYOR
                                        @elseif($siparisListesiD->durum==2)
                                            KARGODA
                                        @elseif($siparisListesiD->durum==3)
                                            TAMAMLANDI
                                        @elseif($siparisListesiD->durum==4)
                                            İPTAL
                                        @endif
                                    </td>
                                    <td>
                                        @if($siparisListesiD->odeme_tipi==1)
                                            EFT-HAVALE
                                        @elseif($siparisListesiD->odeme_tipi==2)
                                            KREDİ KARTI
                                        @elseif($siparisListesiD->odeme_tipi==3)
                                            KAPIDA NAKİT
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('siparisDetayi',"SPRS0".$siparisListesiD->id)}}">
                                            <i id="detayIcon" class="fa fa-search"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    @else
                        <div id="kirmiziUyari" style="margin-top: 20px">
                            HENÜZ SİPARİŞ OLUŞTURMADINIZ
                        </div>
                    @endif

                </div>

            </div>
        </div>
    </div>
@endsection
@section('js')


@endsection

