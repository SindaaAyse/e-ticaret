@extends("backend.main")
@section('icerik')
    <div id="main-content">
        <div class="container-fluid mt-5">
            <div class="row clearfix">
                <div class="col-md-12 text-right mb-2">
                    <a href="{{{route('icerikEkleGetKP')}}}" class="btn btn-success btn-sm"><i class="icon-plus"></i> YENİ EKLE</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>İÇERİK LİSTESİ</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table center-aligned-table">
                                    <thead>
                                    <tr>
                                        <th>MENÜ BAŞLIĞI</th>
                                        <th>İÇERİK BAŞLIĞI</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($icerikListesi->isNotEmpty())
                                        @foreach($icerikListesi as $icerikListesiD)
                                            <tr id="satirID_{{$icerikListesiD->id}}">
                                                <td>{{fonksiyon::buyukHarfeCevir($icerikListesiD->menu_baslik)}}</td>
                                                <td>{{fonksiyon::buyukHarfeCevir($icerikListesiD->icerik_baslik)}}</td>
                                                <td class="text-right">
                                                    <a href="{{route('icerikDuzenleGetKP',$icerikListesiD->id)}}" class="btn btn-info btn-sm"><i class="icon-pencil"></i> Düzenle</a>
                                                    <button onclick="icerikSil('{{$icerikListesiD->id}}')" class="btn btn-danger btn-sm"><i class="icon-trash"></i> Sil</button>
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

        function icerikSil(id){
            Swal.fire({
                icon: "info",
                title: "ÖNEMLİ",
                text: "Silmek İstediğinize Emin Misiniz?",
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
                        url: "{{route('icerikSilKP')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        success: function (data) {
                            $('#satirID_' + id).hide(500);
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
                <div class="col-md-12 text-right mb-2">
                    <a href="{{{route('icerikEkleGetKP')}}}" class="btn btn-success btn-sm"><i class="icon-plus"></i> YENİ EKLE</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>İÇERİK LİSTESİ</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table center-aligned-table">
                                    <thead>
                                    <tr>
                                        <th>MENÜ BAŞLIĞI</th>
                                        <th>İÇERİK BAŞLIĞI</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($icerikListesi->isNotEmpty())
                                        @foreach($icerikListesi as $icerikListesiD)
                                            <tr id="satirID_{{$icerikListesiD->id}}">
                                                <td>{{fonksiyon::buyukHarfeCevir($icerikListesiD->menu_baslik)}}</td>
                                                <td>{{fonksiyon::buyukHarfeCevir($icerikListesiD->icerik_baslik)}}</td>
                                                <td class="text-right">
                                                    <a href="{{route('icerikDuzenleGetKP',$icerikListesiD->id)}}" class="btn btn-info btn-sm"><i class="icon-pencil"></i> Düzenle</a>
                                                    <button onclick="icerikSil('{{$icerikListesiD->id}}')" class="btn btn-danger btn-sm"><i class="icon-trash"></i> Sil</button>
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

        function icerikSil(id){
            Swal.fire({
                icon: "info",
                title: "ÖNEMLİ",
                text: "Silmek İstediğinize Emin Misiniz?",
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
                        url: "{{route('icerikSilKP')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        success: function (data) {
                            $('#satirID_' + id).hide(500);
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
