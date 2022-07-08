@extends("backend.main")
@section('icerik')
    <div id="main-content">
        <div class="container-fluid mt-4">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>İÇERİK DÜZENLE</h2>
                        </div>
                        <div class="body">
                            <form id="icerikGuncelleForm" action="{{route('icerikDuzenlePostKP')}}" method="post">
                                @csrf
                                <div class="row clearfix">
                                    <input type="hidden" name="icerikID" value="{{$icerikDetayi->id}}">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="menuBaslik" class="control-label">MENÜ BAŞLIK</label>
                                            <input type="text" id="menuBaslik" name="menuBaslik" value="{{$icerikDetayi->menu_baslik}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="icerikBaslik" class="control-label">İÇERİK BAŞLIK</label>
                                            <input type="text" id="icerikBaslik" name="icerikBaslik" value="{{$icerikDetayi->icerik_baslik}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="icerik" class="control-label">İÇERİK BAŞLIK</label>
                                            <textarea id="ckeditor" name="icerik">
                                                {{$icerikDetayi->icerik}}
                                            </textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button class="btn btn-dark btn-block"> GÜNCELLE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://www.wrraptheme.com/templates/hexabit/html/assets/vendor/ckeditor/ckeditor.js"></script><!-- Ckeditor -->

    <script src="/backend/assets/js/pages/forms/editors.js"></script>
    <script>
        $("#icerikGuncelleForm").submit(function (e) {

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            e.preventDefault();
            var form = $(this);

            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: $("#icerikGuncelleForm").serialize(),
                beforeSend: function() {
                    $("#bekleyinModali").modal('show');
                },
                success: function (data) {
                    var donenDeger = jQuery.parseJSON(data);

                    if(donenDeger.hata==0){
                        setTimeout(function () {
                            toastr.success(donenDeger.aciklama, "");
                            {{--var url = '{{route('adresListesi')}}';--}}
                            {{--location.href = url;--}}
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
                }, 500);
            });
        });

    </script>
@endsection
@extends("backend.main")
@section('icerik')
    <div id="main-content">
        <div class="container-fluid mt-4">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>İÇERİK DÜZENLE</h2>
                        </div>
                        <div class="body">
                            <form id="icerikGuncelleForm" action="{{route('icerikDuzenlePostKP')}}" method="post">
                                @csrf
                                <div class="row clearfix">
                                    <input type="hidden" name="icerikID" value="{{$icerikDetayi->id}}">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="menuBaslik" class="control-label">MENÜ BAŞLIK</label>
                                            <input type="text" id="menuBaslik" name="menuBaslik" value="{{$icerikDetayi->menu_baslik}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="icerikBaslik" class="control-label">İÇERİK BAŞLIK</label>
                                            <input type="text" id="icerikBaslik" name="icerikBaslik" value="{{$icerikDetayi->icerik_baslik}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="icerik" class="control-label">İÇERİK BAŞLIK</label>
                                            <textarea id="ckeditor" name="icerik">
                                                {{$icerikDetayi->icerik}}
                                            </textarea>
                                        </div>
                                    </div>

                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <button class="btn btn-dark btn-block"> GÜNCELLE</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://www.wrraptheme.com/templates/hexabit/html/assets/vendor/ckeditor/ckeditor.js"></script><!-- Ckeditor -->

    <script src="/backend/assets/js/pages/forms/editors.js"></script>
    <script>
        $("#icerikGuncelleForm").submit(function (e) {

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            e.preventDefault();
            var form = $(this);

            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: $("#icerikGuncelleForm").serialize(),
                beforeSend: function() {
                    $("#bekleyinModali").modal('show');
                },
                success: function (data) {
                    var donenDeger = jQuery.parseJSON(data);

                    if(donenDeger.hata==0){
                        setTimeout(function () {
                            toastr.success(donenDeger.aciklama, "");
                            {{--var url = '{{route('adresListesi')}}';--}}
                            {{--location.href = url;--}}
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
                }, 500);
            });
        });

    </script>
@endsection
