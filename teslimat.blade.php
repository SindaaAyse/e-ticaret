@extends("frontend.main")
@section('content')
    <div class="breadcrumb-area pt-20">
        <div class="container">
            <div class="breadcrumb-content border-bottom-1 pb-22">
                <ul>
                    <li><a href="/">Ana Sayfa</a> <i class="fa fa-angle-right"></i></li>
                    <li><a href="/">Alışveriş Sepeti</a> <i class="fa fa-angle-right"></i></li>
                    <li class="active">{{$title}}</li>
                </ul>
            </div>
        </div>
    </div>
    @if(!empty($sepetBilgileri->id))

        <div class="product-details-area pt-30 pb-80">
            <div class="container">
                <div class="row">

                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <form id="teslimatForm" action="{{route('teslimatPost')}}" method="post">
                            <input type="hidden" name="secilenAdres" id="secilenAdres" value="">
                            @csrf
                            <div class="product-sidebar-wrap mb-30">
                                <div class="shop-widget">
                                    <h4 class="shop-sidebar-title"> TESLİMAT ADRESİ </h4>
                                    <div class="shop-list-style mt-20">
                                        @if(!empty($adresListesi))
                                            <div class="row mt-3">
                                                @foreach($adresListesi as $adresListesiD)
                                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                                        <div class="adresCerceveDiv"
                                                             id="adresSatir_{{$adresListesiD['id']}}">
                                                            <div id="adresBaslikDiv">
                                                                {{$adresListesiD['adresBaslik']}}
                                                            </div>
                                                            <div id="adresAdDiv">
                                                                {{$adresListesiD['adSoyad']}} ({{$adresListesiD['gsm']}}
                                                                )
                                                            </div>
                                                            <div id="adresAciklamaDiv">
                                                                {{$adresListesiD['adres']}}
                                                                <br> {{$adresListesiD['ilceAdi']}}
                                                                / {{$adresListesiD['ilAdi']}}
                                                            </div>
                                                            <div id="adresButtonlarDiv">
                                                                <a onclick="adresSec('{{$adresListesiD['id']}}','{{$sepetBilgileri->id}}')">
                                                                    <i class="fa fa-check" id="adresSecIconu_{{$adresListesiD['id']}}"></i> <span id="adresSecYazisi_{{$adresListesiD['id']}}">ADRESİ SEÇ</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="product-sidebar-wrap mb-30">
                                <div class="shop-widget">
                                    <h4 class="shop-sidebar-title"> ÖDEME TİPİ </h4>
                                    <div class="shop-list-style mt-20">
                                        <div class="row">
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="odemeTipi" value="1">EFT-HAVALE
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-check">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="odemeTipi" value="2">ONLİNE KREDİ KARTI
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-12 col-xs-12">
                                                <div class="form-check disabled">
                                                    <label class="form-check-label">
                                                        <input type="radio" class="form-check-input" name="odemeTipi" value="3">KAPIDA NAKİT
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product-sidebar-wrap mb-30">
                                <div class="shop-widget">
                                    <h4 class="shop-sidebar-title"> SİPARİŞ NOTU </h4>
                                    <div class="shop-list-style mt-20">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="contact-form-style">
                                                    <textarea style="height: 70px" name="siparis_notu" placeholder=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update">
                                        <button style="margin: 0; display: block; width: 100%;" type="submit">ALIŞVERİŞİ TAMAMLA</button>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="product-sidebar-wrap mb-30">
                            <div class="shop-widget">
                                <h4 class="shop-sidebar-title"> SEPET ÖZETİ </h4>
                                <div class="shop-list-style mt-20">
                                    <ul id="hesabimMenuUl">
                                        <li>
                                            <span style="font-weight: bold">NET TUTAR: </span>{{fonksiyon::paraBirimi($sepetBilgileri->net_tutar)}} TL
                                        </li>
                                        <li>
                                            <span style="font-weight: bold">TOPLAM TUTAR: </span>{{fonksiyon::paraBirimi($sepetBilgileri->toplam_tutar)}} TL
                                        </li>
                                        <li>
                                            <span style="font-weight: bold">KARGO ÜCRETİ: </span>{{fonksiyon::paraBirimi($sepetBilgileri->tasima_bedeli)}} TL
                                        </li>
                                        <li>
                                            <span style="font-weight: bold">ÖDENECEK TUTAR: </span>{{fonksiyon::paraBirimi($sepetBilgileri->toplam_tutar + $sepetBilgileri->tasima_bedeli)}} TL
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="product-details-area pt-30 pb-80">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="product-sidebar-wrap mb-30">
                            <div id="kirmiziUyari">
                                ALIŞVERİŞ SEPETİNİZ BOŞ
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    @endif

@endsection

@section('js')
    <script>

        $("#teslimatForm").submit(function (e) {
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

                        if(donenDeger.krediKarti==1){
                            setTimeout(function () {
                                var url = '{{route('alisverisSepetiOdeme',"SPRS0".$sepetBilgileri->id)}}';
                                location.href = url;
                            }, 1000);
                        }else{
                            setTimeout(function () {
                                var url = '{{route('basariliAlisveris',"SPRS0".$sepetBilgileri->id)}}';
                                location.href = url;
                            }, 1000);
                        }


                    }else{
                        setTimeout(function () {
                            toastr.error(donenDeger.aciklama, "");
                        }, 600);
                    }
                }
            }).done(function() {
                setTimeout(function () {
                    $("#bekleyinModali").modal('hide');
                }, 500);
            });
        });


        function adresSec(adresID) {
            $("#bekleyinModali").modal('show');
            var secilenAdres = $('#secilenAdres').val();
            if(secilenAdres!==null){
                $("#adresSatir_"+secilenAdres).attr('class', 'adresCerceveDiv');
                $("#adresSecYazisi_"+secilenAdres).text('ADRESİ SEÇ');
                $("#adresSecYazisi_"+secilenAdres).css("color", "");
                $("#adresSecIconu_"+secilenAdres).css("color", "");
            }
            $("#adresSatir_"+adresID).attr('class', 'adresCerceveDivSecili');
            $("#adresSecYazisi_"+adresID).css("color", "#fe5413");
            $("#adresSecIconu_"+adresID).css("color", "#fe5413");
            $("#adresSecYazisi_"+adresID).text('SEÇİLDİ');
            $('#secilenAdres').val(adresID);
            var secilenAdres2 = $('#secilenAdres').val();
            toastr.success("Adres Seçildi", "");
            setTimeout(function () {
                $("#bekleyinModali").modal('hide');
            }, 500);
        }
    </script>
@endsection
