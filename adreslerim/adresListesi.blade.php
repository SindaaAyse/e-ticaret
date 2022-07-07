@extends("frontend.hesabim.anaEkran")
@section('contentHesabim')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class="product-sidebar-wrap mb-30">
            <div class="shop-widget">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <h4 class="shop-sidebar-title"> ADRESLERİM </h4>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12" style="text-align: right">
                        <a href="{{route('yeniAdresGet')}}" style="background: #fe5413; padding: 10px; color: white;">YENi
                            EKLE</a>
                    </div>
                </div>
                @if(!empty($adresListesi))
                    <div class="row mt-3">
                        @foreach($adresListesi as $adresListesiD)
                            <div class="col-md-6 col-sm-12 col-xs-12" id="adresSatir_{{$adresListesiD['id']}}">
                                <div id="adresCerceveDiv">
                                    <div id="adresBaslikDiv">
                                        {{$adresListesiD['adresBaslik']}}
                                    </div>
                                    <div id="adresAdDiv">
                                        {{$adresListesiD['adSoyad']}} ({{$adresListesiD['gsm']}})
                                    </div>
                                    <div id="adresAciklamaDiv">
                                        {{$adresListesiD['adres']}} <br> {{$adresListesiD['ilceAdi']}}
                                        / {{$adresListesiD['ilAdi']}}
                                    </div>
                                    <div id="adresButtonlarDiv">
                                        <a href="{{route('adresDuzenleGet',$adresListesiD['id'])}}">
                                            <i class="fa fa-edit"></i> DÜZENLE
                                        </a>
                                        <a onclick="adresSil('{{$adresListesiD['id']}}')">
                                            <i class="fa fa-trash-o"></i> SİL
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div style="display: block">
                        <div style="margin-top:20px; display: inline-table;" id="kirmiziUyari">
                            HENÜZ ADRES EKLEMEDİNİZ
                        </div>

                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function adresSil(adresID) {
            Swal.fire({
                icon: "info",
                title: "ÖNEMLİ",
                text: "Silmek İstediğinize Emin Misiniz?",
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
                        url: "{{route('adresSilPost')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "adresID": adresID,
                        },
                        success: function (data) {
                            $('#adresSatir_' + adresID).hide(500);
                            Swal.fire({
                                icon: "success",
                                title: "",
                                text: "Adres Silindi",
                                type: "success",
                                confirmButtonText: "TAMAM",
                                confirmButtonColor: '#DD6B55',
                            })
                        }
                    });
                }
            })
        }

    </script>

@endsection
