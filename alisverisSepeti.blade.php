@extends("frontend.main")
@section('content')
    <div class="breadcrumb-area pt-20">
        <div class="container">
            <div class="breadcrumb-content border-bottom-1 pb-22">
                <ul>
                    <li><a href="/">Ana Sayfa</a> <i class="fa fa-angle-right"></i></li>
                    <li><a href="/">Ürünler</a> <i class="fa fa-angle-right"></i></li>
                    <li class="active">{{$title}}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="cart-main-area pt-20 pb-20">
        <div class="container">
            <div class="row">

                @if(!empty($sepetBilgi))
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                        <form id="sepetiGuncelleForm" action="{{route('sepetGuncelle')}}" method="post">
                            <input class="cart-plus-minus-box" type="hidden" name="sepetID" value="{{$sepetBilgi['sepet']['id']}}">
                            @csrf
                            <div class="table-content table-responsive">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>..</th>
                                        <th>Ürün Adı</th>
                                        <th>Adet</th>
                                        <th>NET TUTAR</th>
                                        <th>TOPLAM TUTAR</th>
                                        <th>..</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($sepetBilgi['urunler'] as $urunDetay)
                                        <tr id="satirID_{{$urunDetay['urunID']}}">
                                            <td class="product-thumbnail">
                                                <a href="#"><img src="{{$urunDetay['urunResmi']}}" alt=""></a>
                                            </td>
                                            <td class="product-name" style="text-align: left; padding-left: 20px;">
                                                <a href="#">
                                                    <span style="font-size: 20px">{{$urunDetay['urunAdi']}}</span>
                                                    <br> Kdv Oranı: %{{$urunDetay['kdv']}}
                                                    <br> Ürün Kodu: {{$urunDetay['urunKodu']}}
                                                </a></td>
                                            <td class="product-quantity">
                                                <input type="hidden" name="urunID[]" value="{{$urunDetay['urunID']}}">
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" type="text" name="adet[]" value="{{$urunDetay['adet']}}">
                                                </div>
                                            </td>

                                            <td class="product-price-cart"><span class="amount">{{fonksiyon::paraBirimi($urunDetay['netTutar'])}}</span> TL</td>
                                            <td class="product-price-cart"><span class="amount">{{fonksiyon::paraBirimi($urunDetay['tutar'])}}</span> TL</td>
                                            <td class="product-remove">
                                                <a style="cursor:pointer;" onclick="urunSil('{{$sepetBilgi['sepet']['id']}}','{{$urunDetay['urunID']}}')">
                                                    <i class="fa fa-trash"></i>
                                                    <span style="font-size:15px">SİL</span>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr id="satirID_0">
                                        <td class="product-thumbnail">

                                        </td>
                                        <td class="product-name" style="text-align: left; padding-left: 20px;">

                                        <td class="product-quantity">

                                        </td>

                                        <td class="product-price-cart"><span style="font-weight: bold"><span id="toplamlarNet">{{fonksiyon::paraBirimi($sepetBilgi['sepet']['netTutar'])}}</span> TL</span></td>
                                        <td class="product-price-cart"><span style="font-weight: bold"><span id="toplamlarToplam">{{fonksiyon::paraBirimi($sepetBilgi['sepet']['toplamTutar'])}}</span> TL</span></td>
                                        <td class="product-remove">
                                        </td>
                                    </tr>


                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="cart-shiping-update-wrapper">
                                        <div class="cart-shiping-update">
                                            <a href="{{route('teslimatGet')}}">ALIŞVERİŞ DEVAM ET</a>
                                            <button type="submit">SEPETİ GÜNCELLE</button>
                                        </div>
                                        <div class="cart-clear">
                                            <a style="cursor:pointer; color:white;" onclick="sepetiBosalt('{{$sepetBilgi['sepet']['id']}}')">SEPETİ TEMİZLE</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="col-lg-12">
                        <div id="kirmiziUyari">
                            SEPETTE ÜRÜN BULUNMAMAKTADIR.
                        </div>
                    </div>
                @endif


            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>

        $("#sepetiGuncelleForm").submit(function (e) {
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
                            var url = '{{route('alisveriSepeti')}}';
                            location.href = url;
                        }, 1000);

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

        function urunSil(sepetID,urunID){
            Swal.fire({
                icon: "info",
                title: "ÖNEMLİ",
                text: "Ürünü Silmek İstediğinize Emin Misiniz?",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#DD6B55',
                confirmButtonText: 'Sil',
                cancelButtonText: "Vazgeç!",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('sepetUrunSil')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "sepetID": sepetID,
                            "urunID": urunID,
                        },
                        success: function (data) {
                            $('#satirID_' + urunID).hide(500);
                            var donenDeger = jQuery.parseJSON(data);
                            $('#sepetTutar').text(donenDeger.sepetTutari);
                            $('#toplamlarNet').text(donenDeger.sepetTutariNet);
                            $('#toplamlarToplam').text(donenDeger.sepetTutari);
                            Swal.fire({
                                icon: "success",
                                title: "",
                                text: donenDeger.aciklama,
                                type: "success",
                                confirmButtonText: "TAMAM",
                                confirmButtonColor: '#DD6B55',
                            }).then(

                            );
                        }
                    });
                }
            })
        }


        function sepetiBosalt(sepetID){
            $.ajax({
                type: "POST",
                url: '{{route('sepetiTemizle')}}',
                data: {
                    "_token" : '{{csrf_token()}}',
                    "sepetID" : sepetID,
                },
                beforeSend: function() {
                    $("#bekleyinModali").modal('show');

                },
                success: function (data) {
                    var donenDeger = jQuery.parseJSON(data);
                    toastr.success(donenDeger.aciklama, "");
                    setTimeout(function () {
                        var url = '{{route('alisveriSepeti')}}';
                        location.href = url;
                    }, 800);


                }
            }).done(function() {
                setTimeout(function () {
                    $("#bekleyinModali").modal('hide');
                }, 500);
            });
        }
    </script>
@endsection
