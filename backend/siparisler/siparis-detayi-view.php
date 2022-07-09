@extends("backend.main")
@section('icerik')
    <div id="main-content">

        <div class="container-fluid mt-5">

            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="body">
                           <div>
                               <h4><b>SİPARİŞ GÜNCELLE</b></h4>
                               <hr>
                           </div>
                           <form id="siparisGuncelleForm" action="{{route('siparisGuncellePostKp')}}" method="post">
                               @csrf
                               <input type="hidden" name="id" value="{{$siparisBilgi->id}}">
                               <div class="row clearfix">
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                       <div class="form-group">
                                           <label for="siparisDurumu" class="control-label">SİPARİŞ DURUMU</label>
                                           <select name="siparisDurumu" id="siparisDurumu" class="form-control" >
                                               <option @if($siparisBilgi->durum==1) selected @endif value="1"> HAZIRLANIYOR </option>
                                               <option @if($siparisBilgi->durum==2) selected @endif value="2"> KARGODA </option>
                                               <option @if($siparisBilgi->durum==3) selected @endif value="3"> TAMAMLANDI </option>
                                               <option @if($siparisBilgi->durum==4) selected @endif value="4"> İPTAL </option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                       <div class="form-group">
                                           <label for="odemeDurumu" class="control-label">ÖDEME DURUMU</label>
                                           <select name="odemeDurumu" id="odemeDurumu" class="form-control" >
                                               <option @if($siparisBilgi->odeme_durumu==0) selected @endif value="0"> ÖDEME BEKLİYOR </option>
                                               <option @if($siparisBilgi->odeme_durumu==1) selected @endif value="1"> ÖDENDİ </option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-lg-4 col-md-6 col-sm-12">
                                       <div class="form-group">
                                           <label for="odemeTipi" class="control-label">ÖDEME TİPİ</label>
                                           <select name="odemeTipi" id="odemeTipi" class="form-control" >
                                               <option @if($siparisBilgi->odeme_tipi==1) selected @endif value="1"> EFT-HAVALE </option>
                                               <option @if($siparisBilgi->odeme_tipi==2) selected @endif value="2"> KREDİ KARTI </option>
                                               <option @if($siparisBilgi->odeme_tipi==3) selected @endif value="3"> KAPIDA NAKİT </option>
                                           </select>
                                       </div>
                                   </div>
                                   <div class="col-lg-12 col-md-12 col-sm-12">
                                       <button class="btn btn-dark btn-block"> GÜNCELLE</button>
                                   </div>
                               </div>
                           </form>

                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="header">
                            <h4><b>SİPARİŞ DETAYI - #SPRS0{{$siparisBilgi->id}}</b></h4>
                        </div>
                        <div class="body">

                            <div class="col-xl-12">
                                <div class="row clearfix">
                                    <div class="col-md-6 col-sm-6">
                                        <address>
                                            <strong style="font-size: 20px">TESLİMAT BİLGİLERİ</strong>
                                            <div style="display: block; margin-top: 10px">
                                                {{$teslimatBilgi['adSoyad']}} - {{$teslimatBilgi['gsm']}}
                                                <br> {{$teslimatBilgi['adres']}}
                                                / {{$teslimatBilgi['ilce']}} / {{$teslimatBilgi['il']}}
                                            </div>

                                        </address>
                                    </div>
                                    <div class="col-md-6 col-sm-6 text-right">
                                        <div style="display: block">
                                            <p class="m-b-0"><strong>SİPARİŞ
                                                    TARİHİ: </strong> {{fonksiyon::tarihBicimi($siparisBilgi->alisveris_tarihi,1)}}
                                            </p>
                                        </div>

                                        <div style="display: block; margin-top: 10px;">
                                            <p class="m-b-0"><strong>SİPARİŞ DURUMU: </strong>
                                                @if($siparisBilgi->durum==1)
                                                    <span style="padding: 10px;" class="badge badge-info m-b-0">Hazırlanıyor</span>
                                                @elseif($siparisBilgi->durum==2)
                                                    <span style="padding: 10px;" class="badge badge-warning m-b-0">Kargoda</span>
                                                @elseif($siparisBilgi->durum==3)
                                                    <span style="padding: 10px;" class="badge badge-success m-b-0">Tamamlandı</span>
                                                @elseif($siparisBilgi->durum==4)
                                                    <span style="padding: 10px;" class="badge badge-danger m-b-0">Tamamlandı</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div style="display: block; margin-top: 10px; margin-bottom: 10px">
                                            <p class="m-b-0"><strong>ÖDEME TİPİ: </strong>
                                                @if($siparisBilgi->odeme_tipi==1)
                                                    <span style="padding: 10px;" class="badge badge-success m-b-0">Eft-Havale</span>
                                                @elseif($siparisBilgi->odeme_tipi==2)
                                                    <span style="padding: 10px;" class="badge badge-success m-b-0">Kredi Kartı</span>
                                                @else
                                                    <span style="padding: 10px;" class="badge badge-danger m-b-0">Kapıda Nakit</span>
                                                @endif
                                            </p>
                                        </div>
                                        <div style="display: block; margin-top: 10px; margin-bottom: 10px">
                                            <p class="m-b-0"><strong>ÖDEME DURUMU: </strong>
                                                @if($siparisBilgi->odeme_durumu==1)
                                                    <span style="padding: 10px;" class="badge badge-success m-b-0">Ödendi</span>
                                                @else
                                                    <span style="padding: 10px;" class="badge badge-danger m-b-0">Ödeme Bekliyor</span>
                                                @endif
                                            </p>
                                        </div>

                                    </div>
                                </div>
                                <div class="row clearfix">

                                    <div class="col-md-12 mb-2 mt-2">
                                        <div class="alert alert-info alert-dismissible" role="alert">
                                            <i class="fa fa-info-circle"></i> <b>SİPARİŞ
                                                NOTU: </b>{{$siparisBilgi->siparis_notu}}
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <thead class="thead-dark">
                                                <tr>
                                                    <th>#</th>
                                                    <th class="text-center">Görsel</th>
                                                    <th>Ürün Kodu</th>
                                                    <th>Ürün Adı</th>
                                                    <th class="text-center">Adet</th>
                                                    <th class="text-right">Net Tutar</th>
                                                    <th class="text-right">Kdv Tutar</th>
                                                    <th class="text-right">Toplam Tutar</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php
                                                    $i=1;
                                                @endphp
                                                @foreach($siparistekiUrunler as $siparistekiUrunlerD)
                                                    @php
                                                        $urunKodu = $urunBilgi[$siparistekiUrunlerD->urun_id]->kodu;
                                                        $urunAdi = $urunBilgi[$siparistekiUrunlerD->urun_id]->adi;
                                                        $urunGorsel = $urunBilgi[$siparistekiUrunlerD->urun_id]->resim;
                                                    @endphp
                                                    <tr>
                                                        <td>{{$i}}</td>
                                                        <td class="text-center"><img
                                                                style="height: 50px; height: 50px; border-radius: 50%"
                                                                src="/{{$urunGorsel}}" alt=""></td>
                                                        <td>{{$urunKodu}}</td>
                                                        <td>{{$urunAdi}} <br> <b>Kdv Oranı: </b>
                                                            %{{$siparistekiUrunlerD->kdv}} </td>
                                                        <td class="text-center">{{$siparistekiUrunlerD->adet}}</td>
                                                        <td class="text-right">{{fonksiyon::paraBirimi($siparistekiUrunlerD->net_tutar)}}
                                                            TL
                                                        </td>
                                                        <td class="text-right">{{fonksiyon::paraBirimi($siparistekiUrunlerD->tutar-$siparistekiUrunlerD->net_tutar)}}
                                                            TL
                                                        </td>
                                                        <td class="text-right">{{fonksiyon::paraBirimi($siparistekiUrunlerD->tutar)}}
                                                            TL
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $i++;
                                                    @endphp
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><b>TOPLAM NET TUTAR: </b></td>
                                                    <td class="text-right">{{fonksiyon::paraBirimi($siparisBilgi->net_tutar)}}
                                                        TL
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><b>TOPLAM KDV: </b></td>
                                                    <td class="text-right">{{fonksiyon::paraBirimi($siparisBilgi->toplam_tutar-$siparisBilgi->net_tutar)}}
                                                        TL
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><b>TOPLAM TUTAR: </b></td>
                                                    <td class="text-right">{{fonksiyon::paraBirimi($siparisBilgi->toplam_tutar)}}
                                                        TL
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><b>KARGO ÜCRETİ: </b></td>
                                                    <td class="text-right">{{fonksiyon::paraBirimi($siparisBilgi->tasima_bedeli)}}
                                                        TL
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right"><b>ÖDENECE TUTAR: </b></td>
                                                    <td class="text-right">{{fonksiyon::paraBirimi($siparisBilgi->toplam_tutar+$siparisBilgi->tasima_bedeli)}}
                                                        TL
                                                    </td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $("#siparisGuncelleForm").submit(function (e) {
            e.preventDefault();
            var form = $(this);

            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                beforeSend: function() {
                    $("#bekleyinModali").modal('show');
                },
                success: function (data) {
                    var donenDeger = jQuery.parseJSON(data);

                    if(donenDeger.hata==0){
                        toastr.success(donenDeger.aciklama, "");
                        setTimeout(function () {
                            location.reload();
                        }, 1200);


                    }else{
                        setTimeout(function () {
                            toastr.error(donenDeger.aciklama, "");
                        }, 600);
                    }
                }
            }).done(function() {
                setTimeout(function () {
                    $("#bekleyinModali").modal('hide');
                }, 800);
            });
        });
    </script>
@endsection
