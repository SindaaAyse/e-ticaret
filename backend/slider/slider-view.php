@extends("backend.main")
@section('icerik')
    <div id="main-content">

        <div class="container-fluid mt-4">
            <div class="row clearfix">

                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="col-md-12 col-sm-12 mt-4" style="padding-left: 20px">
                            <h5>YENİ SLİDER EKLE</h5>
                        </div>
                        <div class="body">

                            <form id="sliderEkleForm" action="{{route('sliderEklePostKP')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="resim" name="resim">
                                        <label class="custom-file-label" for="resim">GÖRÜNTÜ SEÇ</label>
                                    </div>
                                    <div class="input-group-append">
                                        <button class="btn btn-outline-secondary" type="submit">YÜKLE</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="container-fluid mt-4">
            <div class="row clearfix">
                @if($sliderListesi->isNotEmpty())
                    @foreach($sliderListesi as $sliderListesiD)
                        <div class="col-lg-4 col-md-6 col-sm-12" id="sliderSatir_{{$sliderListesiD->id}}">
                            <div class="card">
                                <div class="body">
                                    <div>
                                        <img style="width: 100%" src="/{{$sliderListesiD->resim}}" alt="">
                                    </div>
                                    <div style="display: block; margin-top: 10px">
                                        <a style="cursor:pointer; color:white;" onclick="sliderSil('{{$sliderListesiD->id}}')" class="btn btn-danger"><i class="fa fa-trash-o"></i> SİL</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else

                @endif


            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        function sliderSil(id){
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
                        url: "{{route('sliderSilKP')}}",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": id,
                        },
                        success: function (data) {
                            $('#sliderSatir_' + id).hide(500);
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

        $("#sliderEkleForm").submit(function (e) {

            e.preventDefault();

            var form = $(this);
            var url = form.attr('action');

            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $("#bekleyinModali").modal('show');
                },
                complete: function () {
                    $('#bekleyinModali').modal('close');
                },
                success: function (data) {
                    var donenDeger = jQuery.parseJSON(data);

                    if (donenDeger.hata == 0) {
                        toastr.success(donenDeger.aciklama, "");

                        setTimeout(function () {
                            $("#bekleyinModali").modal('hide');
                            var url = '{{route("sliderListesiKP")}}';
                            window.location.href = url;
                        }, 1000);
                    } else {
                        setTimeout(function () {
                            toastr.error(donenDeger.aciklama, "");
                            $("#bekleyinModali").modal('hide');
                        }, 600);
                    }
                }
            }).done(function() {

            });
        });
    </script>
@endsection
