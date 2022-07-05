@extends("frontend.main")
@section('content')
    <div class="slider-area mt-20">
        <div class="container">
            <div class="slider-active owl-dot-style owl-carousel">
                @if($slider->isNotEmpty())
                    @foreach($slider as $sliderD)
                        <div class="single-slider pt-200 pb-200 bg-img" style="background-image:url('{{$sliderD->resim}}');"> </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <div class="content-wrapper pt-30 pb-5">
        <div class="container">
            <div class="row">

                <div class="col-lg-12 col-md-12">


                    <div class="product-area">
                        <div class="row">
                            <div class="col-lg-12 col-xl-12 col-md-12">
                                <div class="section-title mb-25">
                                    <h3>VİTRİN ÜRÜNLERİ</h3>
                                </div>
                                <div class="row">
                                    @if(!empty($urunListesi))
                                        @foreach($urunListesi as $urunListesiD)
                                            <div class="col-lg-3 col-md-6 col-sm-6 mb-12">
                                                <div class="product-wrapper">
                                                    <div class="product-img">
                                                        <a href="{{route('urunDetayi',$urunListesiD->slug)}}">
                                                            <img class="primary-image" alt="" src="{{$urunListesiD->resim}}">
                                                        </a>

                                                    </div>
                                                    <div class="product-content text-center">
                                                        <h4>
                                                            <a href="{{route('urunDetayi',$urunListesiD->slug)}}">{{$urunListesiD->adi}}</a>
                                                        </h4>

                                                        <div class="product-price-wrapper">
                                                            <span>{{fonksiyon::paraBirimi($urunListesiD->fiyat)}} TL</span>
                                                        </div>
                                                        <div class="product-action text-center">
                                                            <a class="action-cart" style="cursor: pointer" onclick="urunEkle('{{$urunListesiD->id}}')"> <i class="fa fa-shopping-cart x5"></i> SEPETE EKLE</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif


                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
