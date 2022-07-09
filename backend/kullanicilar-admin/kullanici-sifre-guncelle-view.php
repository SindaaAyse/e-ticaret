@extends("backend.main")
@section('icerik')
    <div id="main-content">
        <div class="container-fluid mt-4">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>ŞİFRE GÜNCELLE</h2>
                        </div>
                        <div class="body">
                            <form id="sifreGuncelleForm" action="{{route('sifreGuncellePostKP')}}" method="post">
                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="guncelSifre" class="control-label">Güncel Şifre</label>
                                            <input type="password" id="guncelSifre" name="guncelSifre" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="yeniSifre" class="control-label">Yeni Şifre</label>
                                            <input type="password" id="yeniSifre" name="yeniSifre" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="yeniSifre2" class="control-label">Yeni Şifre (Tekrar)</label>
                                            <input type="password" id="yeniSifre2" name="yeniSifre2" class="form-control">
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
    <script>
        $("#sifreGuncelleForm").submit(function (e) {
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
