@extends("backend.main")
@section('icerik')
    <div id="main-content">
        <div class="container-fluid mt-5">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>GELEN KUTUSU</h2>

                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table center-aligned-table">
                                    <thead>
                                    <tr>
                                        <th>ÜYELİK TARİHİ</th>
                                        <th>ADI SOYADI</th>
                                        <th>E-MAIL</th>
                                        <th>KONU</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($gelenKutusu->isNotEmpty())
                                        @foreach($gelenKutusu as $gelenKutusuD)
                                            <tr id="satirID_{{$gelenKutusuD->id}}">
                                                <td>{{fonksiyon::tarihBicimi($gelenKutusuD->tarih,1)}}</td>
                                                <td>{{fonksiyon::buyukHarfeCevir($gelenKutusuD->ad)}}</td>
                                                <td>{{$gelenKutusuD->email}}</td>
                                                <td>{{$gelenKutusuD->konu}}</td>

                                                <td class="text-right">
                                                    <a onclick="mesajGoruntule('{{$gelenKutusuD->id}}')" style="color:white" class="btn btn-info btn-sm"><i class="icon-envelope"></i> GÖRÜNTÜLE</a>
                                                    <button onclick="mesajSil('{{$gelenKutusuD->id}}')" class="btn btn-danger btn-sm"><i class="icon-trash"></i> Sil</button>
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
@section('modal')
    <div class="modal fade bd-example-modal-lg" id="mesajGoruntule" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title h4" id="myLargeModalLabel">MESAJ DETAYI</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" id="mesajDetayi">
                    <p>Woohoo, you're reading this text in a modal!</p>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('js')
    <script>
        function mesajGoruntule(id){

            $.ajax({
                type: "POST",
                url: "{{route('gelenKutusuDetayKP')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id,
                },

                success: function (data) {
                    $("#mesajGoruntule").modal('show');
                    $('#mesajDetayi').html('');
                    $('#mesajDetayi').html(data);

                }
            });
        }

        function mesajSil(id){
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
                        url: "{{route('gelenKutusuSilKP')}}",
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
