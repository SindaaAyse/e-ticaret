@extends("backend.main")
@section('icerik')
    <div id="main-content">
        <div class="container-fluid mt-4">
            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="col-md-12 col-sm-12 mt-4">
                            <h5>YENİ KATEGORİ EKLE</h5>
                        </div>
                        <div class="body">
                            <form id="kategoriEkle" action="{{route('urunKategoriEkleKP')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-9 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="menuBaslik" class="control-label">KATEGORİ ADI</label>
                                            <input type="text" id="kategoriAdi" name="kategoriAdi" value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <label for="menuBaslik" class="control-label"> </label>
                                        <button class="btn btn-dark btn-block" style="margin-top: 7px;"> EKLE</button>
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid ">
            <div class="row clearfix">
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
                                        <th>KATEGORİ ADI</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($urunKategorileri->isNotEmpty())
                                        @foreach($urunKategorileri as $urunKategorileriD)
                                            <tr id="satirID_{{$urunKategorileriD->id}}">
                                                <td>{{fonksiyon::buyukHarfeCevir($urunKategorileriD->adi)}}</td>
                                                <td class="text-right">
                                                    <a href="{{route('urunKategoriDuzenleGetKP',$urunKategorileriD->id)}}" class="btn btn-info btn-sm"><i class="icon-pencil"></i> Düzenle</a>
                                                    <button onclick="kategoriSil('{{$urunKategorileriD->id}}')" class="btn btn-danger btn-sm"><i class="icon-trash"></i> Sil</button>
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

        function kategoriSil(id){
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
                        url: "{{route('urunKategoriSilKP')}}",
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

        $("#kategoriEkle").submit(function (e) {
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
                        setTimeout(function () {
                            toastr.success(donenDeger.aciklama, "");
                            var url = '{{route('urunKategorileriKP')}}';
                            location.href = url;
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
                }, 1000);
            });
        });
    </script>
@endsection
