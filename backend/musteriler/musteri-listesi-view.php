@extends("backend.main")
@section('icerik')
    <div id="main-content">
        <div class="container-fluid mt-5">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>MÜŞTERİ LİSTESİ</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table center-aligned-table">
                                    <thead>
                                        <tr>
                                            <th>ÜYELİK TARİHİ</th>
                                            <th>ADI SOYADI</th>
                                            <th>GSM</th>
                                            <th>E-MAIL</th>
                                            <th>İL</th>
                                            <th>İLÇE</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($musteriListesi->isNotEmpty())
                                        @foreach($musteriListesi as $musteriListesiD)
                                            @php
                                                $ilAdi='';
                                                if(isset($ilBilgi[$musteriListesiD->il])){
                                                    $ilAdi = $ilBilgi[$musteriListesiD->il];
                                                }

                                                $ilceAdi='';
                                                if(isset($ilceBilgi[$musteriListesiD->ilce])){
                                                    $ilceAdi = $ilceBilgi[$musteriListesiD->ilce];
                                                }
                                            @endphp
                                            <tr id="satirID_{{$musteriListesiD->id}}">
                                                <td>{{fonksiyon::tarihBicimi($musteriListesiD->tarih,1)}}</td>
                                                <td>{{fonksiyon::buyukHarfeCevir($musteriListesiD->ad_soyad)}}</td>
                                                <td>{{$musteriListesiD->gsm}}</td>
                                                <td>{{$musteriListesiD->email}}</td>
                                                <td>{{$ilAdi}}</td>
                                                <td>{{$ilceAdi}}</td>

                                                <td class="text-right">
                                                    <a href="{{route('musteriDuzenleGetKP',$musteriListesiD->id)}}" style="color:white" class="btn btn-info btn-sm"><i class="icon-pencil"></i> Düzenle</a>
                                                    <button onclick="musteriSil('{{$musteriListesiD->id}}')" class="btn btn-danger btn-sm"><i class="icon-trash"></i> Sil</button>
                                                    <form target="_blank" method="post" action="{{route('musteriGirisKP')}}" style="float: right; margin-left: 5px;">
                                                        @csrf
                                                        <input type="hidden" name="musteriID" value="{{$musteriListesiD->id}}">
                                                        <button class="btn btn-success btn-sm"><i class="icon-user"></i> Panele Git</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
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
        function musteriSil(musteriID){
            Swal.fire({
                icon: "info",
                title: "ÖNEMLİ",
                text: "Silmek İstediğinize Emin Misiniz? Müşteriye Ait Tüm Bilgiler Silinecektir.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#feb800',
                confirmButtonText: 'Sil',
                cancelButtonText: "Vazgeç!",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('musteriSilKP')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "musteriID": musteriID,
                        },
                        success: function (data) {
                            $('#satirID_' + musteriID).hide(500);
                            var donenDeger = jQuery.parseJSON(data);

                            Swal.fire({
                                icon: "success",
                                title: "",
                                text: donenDeger.aciklama,
                                type: "success",
                                confirmButtonText: "TAMAM",
                                confirmButtonColor: '#DD6B55',
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
@extends("backend.main")
@section('icerik')
    <div id="main-content">
        <div class="container-fluid mt-5">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>MÜŞTERİ LİSTESİ</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table center-aligned-table">
                                    <thead>
                                        <tr>
                                            <th>ÜYELİK TARİHİ</th>
                                            <th>ADI SOYADI</th>
                                            <th>GSM</th>
                                            <th>E-MAIL</th>
                                            <th>İL</th>
                                            <th>İLÇE</th>
                                            <th></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                    @if($musteriListesi->isNotEmpty())
                                        @foreach($musteriListesi as $musteriListesiD)
                                            @php
                                                $ilAdi='';
                                                if(isset($ilBilgi[$musteriListesiD->il])){
                                                    $ilAdi = $ilBilgi[$musteriListesiD->il];
                                                }

                                                $ilceAdi='';
                                                if(isset($ilceBilgi[$musteriListesiD->ilce])){
                                                    $ilceAdi = $ilceBilgi[$musteriListesiD->ilce];
                                                }
                                            @endphp
                                            <tr id="satirID_{{$musteriListesiD->id}}">
                                                <td>{{fonksiyon::tarihBicimi($musteriListesiD->tarih,1)}}</td>
                                                <td>{{fonksiyon::buyukHarfeCevir($musteriListesiD->ad_soyad)}}</td>
                                                <td>{{$musteriListesiD->gsm}}</td>
                                                <td>{{$musteriListesiD->email}}</td>
                                                <td>{{$ilAdi}}</td>
                                                <td>{{$ilceAdi}}</td>

                                                <td class="text-right">
                                                    <a href="{{route('musteriDuzenleGetKP',$musteriListesiD->id)}}" style="color:white" class="btn btn-info btn-sm"><i class="icon-pencil"></i> Düzenle</a>
                                                    <button onclick="musteriSil('{{$musteriListesiD->id}}')" class="btn btn-danger btn-sm"><i class="icon-trash"></i> Sil</button>
                                                    <form target="_blank" method="post" action="{{route('musteriGirisKP')}}" style="float: right; margin-left: 5px;">
                                                        @csrf
                                                        <input type="hidden" name="musteriID" value="{{$musteriListesiD->id}}">
                                                        <button class="btn btn-success btn-sm"><i class="icon-user"></i> Panele Git</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
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
        function musteriSil(musteriID){
            Swal.fire({
                icon: "info",
                title: "ÖNEMLİ",
                text: "Silmek İstediğinize Emin Misiniz? Müşteriye Ait Tüm Bilgiler Silinecektir.",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#feb800',
                confirmButtonText: 'Sil',
                cancelButtonText: "Vazgeç!",
                closeOnConfirm: false,
                closeOnCancel: false
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "POST",
                        url: "{{route('musteriSilKP')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "musteriID": musteriID,
                        },
                        success: function (data) {
                            $('#satirID_' + musteriID).hide(500);
                            var donenDeger = jQuery.parseJSON(data);

                            Swal.fire({
                                icon: "success",
                                title: "",
                                text: donenDeger.aciklama,
                                type: "success",
                                confirmButtonText: "TAMAM",
                                confirmButtonColor: '#DD6B55',
                            });
                        }
                    });
                }
            })
        }
    </script>
@endsection
