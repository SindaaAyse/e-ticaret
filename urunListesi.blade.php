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
    <div class="shop-area pt-80 pb-30">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-sidebar-wrap mb-30">
                        <div class="shop-widget">
                            <h4 class="shop-sidebar-title">
                                Ürün Ara
                            </h4>
                            <div class="shop-search mt-25">
                                <form class="shop-search-form" action="{{route('urunArama')}}" method="get">
                                    <input type="text" placeholder="Ürün Adı" name="u">
                                    <button type="submit">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="product-sidebar-wrap mb-30">
                        <div class="shop-widget">
                            <h4 class="shop-sidebar-title"> ÜRÜN KATEGORİLERİ </h4>
                            <div class="shop-list-style mt-20">
                                <ul>

                                    {!! icerik::urunKategorileri() !!}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                @if(!$urunler->isNotEmpty())
                    <div class="col-lg-9">
                        <div id="kirmiziUyari"> KATEGORİYE AİT ÜRÜN BULUNAMADI!</div>
                    </div>
                @else
                    <div class="col-lg-9">
                        <div class="shop-topbar-wrapper">

                            <div class="grid-list-options">
                                <ul class="view-mode">
                                    <li class="active"><a href="#product-grid" data-view="product-grid"><i class="fa fa-th"></i></a></li>
                                    <li><a href="#product-list" data-view="product-list"><i class="fa fa-list"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="grid-list-product-wrapper">
                            <div class="product-view product-grid">
                                <div class="row">
                                    @foreach($urunler as $urunlerD)
                                        <div class="product-width col-lg-4 col-xl-4 col-md-4">
                                            <div class="product-wrapper mb-30">
                                                <div class="product-img">
                                                    <a href="{{route('urunDetayi',$urunlerD->slug)}}">
                                                        <img class="primary-image" alt="" src="/{{$urunlerD->resim}}">
                                                    </a>
                                                </div>
                                                <div class="product-content text-center">
                                                    <h4>
                                                        <a href="{{route('urunDetayi',$urunlerD->slug)}}">{{$urunlerD->adi}}</a>
                                                    </h4>
                                                    <div class="product-price-wrapper">
                                                        <span>{{fonksiyon::paraBirimi($urunlerD->fiyat)}} TL</span>
                                                    </div>
                                                    <div class="product-action text-center">
                                                        <a class="action-cart" style="cursor: pointer" onclick="urunEkle('{{$urunlerD->id}}')">
                                                            <i class="fa fa-shopping-cart"></i>
                                                            SEPETE EKLE
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="product-list-content">
                                                    <h4>
                                                        <a href="{{route('urunDetayi',$urunlerD->slug)}}">{{$urunlerD->adi}}</a>
                                                    </h4>
                                                    <div class="product-price-wrapper">
                                                        <span>{{fonksiyon::paraBirimi($urunlerD->fiyat)}} TL</span>
                                                    </div>
                                                    {!! $urunlerD->aciklama !!}
                                                    <div class="product-action-list">
                                                        <a class="action-cart" style="cursor: pointer" onclick="urunEkle('{{$urunlerD->id}}')">
                                                            <i class="fa fa-shopping-cart"></i>
                                                            SEPETE EKLE
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach


                                </div>

                                <div class="f-right mt-15">
                                    {{$urunler->links("pagination::bootstrap-4")}}
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection
