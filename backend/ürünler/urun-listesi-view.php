@extends("backend.main")
@section('icerik')
    <div id="main-content">

        <div class="container-fluid mt-5">
            <div class="row clearfix">
                <div class="col-md-12 text-right mb-2">
                    <a href="{{{route('urunEkleGetKP')}}}" class="btn btn-success btn-sm"><i class="icon-plus"></i> YENİ EKLE</a>
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>ÜRÜN LİSTESİ</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table center-aligned-table">
                                    <thead>
                                    <tr>
                                        <th>KATEGORİ ADI</th>
                                        <th class="text-center">GÖRSEL</th>
                                        <th>ÜRÜN KODU</th>
                                        <th>ÜRÜN ADI</th>
                                        <th>FİYAT</th>
                                        <th>KDV ORANI</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($urunListesi->isNotEmpty())
                                        @foreach($urunListesi as $urunListesiD)
                                            @php
                                                $kategoriAdi='';
                                                if(isset($kategoriBilgi[$urunListesiD->kat_id])){
                                                    $kategoriAdi = $kategoriBilgi[$urunListesiD->kat_id];
                                                }
                                            @endphp
                                            <tr id="satirID_{{$urunListesiD->id}}">
                                                <td>{{fonksiyon::buyukHarfeCevir($kategoriAdi)}}</td>
                                                <td class="text-center"><img style="width: 80px; height: 80px; border-radius: 50%" src="/{{$urunListesiD->resim}}" alt=""></td>
                                                <td>{{$urunListesiD->kodu}}</td>
                                                <td>{{$urunListesiD->adi}}</td>
                                                <td>{{fonksiyon::paraBirimi($urunListesiD->fiyat)}} TL</td>
                                                <td>%{{$urunListesiD->kdv}}</td>
                                                <td class="text-right">

                                                    <a href="{{route('urunDuzenleGetKP',$urunListesiD->id)}}"
                                                       class="btn btn-info btn-sm"><i class="icon-pencil"></i>
                                                        Düzenle</a>
                                                    <button onclick="urunSil('{{$urunListesiD->id}}')"
                                                            class="btn btn-danger btn-sm"><i class="icon-trash"></i> Sil
                                                    </button>
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

        function urunSil(id) {
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
                        url: "{{route('urunSilKP')}}",
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
