@extends("frontend.main")
@section('content')
    <div class="breadcrumb-area pt-20">
        <div class="container">
            <div class="breadcrumb-content border-bottom-1 pb-22">
                <ul>
                    <li><a href="/">Ana Sayfa</a> <i class="fa fa-angle-right"></i></li>

                </ul>
            </div>
        </div>
    </div>
    <div class="product-details-area pb-80">
        <div class="container">
            <div class="row">

                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <div id="basariliYazi"> <span style="font-weight: bold">#{{$sepetID}}</span> nolu SİPARİŞİNİZ ALINDI</div>
                    <div style="display: block">
                        <i id="basariliIcon" class="fa fa-check"></i>
                    </div>
                    <br>
                    <div style="padding-top: 20px">
                        <a href="{{route('siparisListesi')}}" style="padding: 10px 38px; background: #fd5413; color: white; border-radius: 11px;">SİPARİŞLERİM</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

