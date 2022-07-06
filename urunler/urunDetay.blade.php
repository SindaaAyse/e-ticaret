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
    <div class="product-details-area pb-80">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-sm-5 col-xs-12">
                    <div class="product-details-img">
                        <img id="zoompro" src="/{{$urunBilgi['resim']}}" data-zoom-image="assets/img/product-details/product-detalis-bl1.jpg" alt="zoom"/>
                    </div>
                </div>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <div class="modal-pro-content">
                        <h3>{{$urunBilgi['adi']}}</h3>
                        <div class="product-price-wrapper">
                            <span>{{fonksiyon::paraBirimi($urunBilgi['fiyat'])}} TL</span>
                        </div>
                        <div class="prodetails-categories-wrap">
                            <label>ÜRÜN KATEGORİSİ : <span>{{$urunBilgi['kategori']}}</span></label>
                        </div>
                       {!! $urunBilgi['aciklama'] !!}

                        <div class="product-quantity pt-20">
                            <div class="cart-plus-minus">
                                <input class="cart-plus-minus-box" type="text" id="urunAdet" value="1">
                            </div>
                            <button onclick="urunEkleDetay('{{$urunBilgi['id']}}')">SEPETE EKLE</button>
                        </div>
                        <div class="productdetails-share-wrap">
                            <label>PAYLAŞ :</label>
                            <div class="prodetails-share">
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-dribbble"></i></a></li>
                                </ul>
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
        function urunEkleDetay(urunID){

            var urunAdet = $('#urunAdet').val();

            $.ajax({
                type: "POST",
                url: '{{route('sepeteUrunEkle')}}',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'urunID' : urunID,
                    'adet':urunAdet,
                },
                beforeSend: function() {
                    $("#bekleyinModali").modal('show');

                },
                success: function (data) {
                    var donenDeger = jQuery.parseJSON(data);

                    if(donenDeger.hata==0){

                        $('#sepetTutar').text(donenDeger.sepetTutari);
                        setTimeout(function () {
                            toastr.success(donenDeger.aciklama, "");
                        }, 600);

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
        }
    </script>
@endsection
