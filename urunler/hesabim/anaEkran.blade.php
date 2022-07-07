@extends("frontend.main")
@section('content')

    <div class="product-details-area pt-30 pb-80">
        <div class="container">
            <div class="row">

                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="product-sidebar-wrap mb-30">
                        <div class="shop-widget">
                            <h4 class="shop-sidebar-title"> HESABIM </h4>
                            <div class="shop-list-style mt-20">
                                <ul id="hesabimMenuUl">
                                    <li>
                                        <a class="active" href="{{route('hesabim')}}" style="display: flex">
                                            <span style="float: left"><i class="fa fa-user"></i></span>
                                            <span style="float: left; padding-left: 10px;">ÜYELİK BİLGİLERİM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('siparisListesi')}}" style="display: flex">
                                            <span style="float: left"><i class="fa fa-shopping-cart"></i></span>
                                            <span style="float: left; padding-left: 10px;">SİPARİŞLERİM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('adresListesi')}}" style="display: flex">
                                            <span style="float: left"><i class="fa fa-map-marker"></i></span>
                                            <span style="float: left; padding-left: 10px;">ADRESLERİM</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{route('sifreDegisGet')}}" style="display: flex">
                                            <span style="float: left"><i class="fa fa-lock"></i></span>
                                            <span style="float: left; padding-left: 10px;">ŞİFRE DEĞİŞTİR</span>
                                        </a>
                                    </li>
                                    <li style="border: none">
                                        <a href="{{route('cikisGet')}}" style="display: flex">
                                            <span style="float: left"><i class="fa fa-sign-out"></i></span>
                                            <span style="float: left; padding-left: 10px;">ÇIKIŞ YAP</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                @yield('contentHesabim')

            </div>
        </div>
    </div>
@endsection
