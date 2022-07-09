@extends("backend.main")
@section('icerik')
    <div id="main-content">
        <div class="container-fluid mt-4">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>MÜŞTERİ DÜZENLE</h2>
                        </div>
                        <div class="body">
                            <form id="musteriGuncellePost" action="{{route('musteriDuzenlePostKP')}}" method="post">
                                @csrf
                                <div class="row clearfix">
                                    <input type="hidden" name="musteriID" value="{{$musteriBilgileri->id}}">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="musteriAdi" class="control-label">ADI SOYADI</label>
                                            <input type="text" id="musteriAdi" name="musteriAdi" value="{{$musteriBilgileri->ad_soyad}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="gsm" class="control-label">GSM</label>
                                            <input type="text" id="gsm" name="gsm" value="{{$musteriBilgileri->gsm}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="il" class="control-label">İL</label>
                                            <select name="il" id="il" class="form-control" >
                                                @foreach($ilListesi as $ilListesiD)
                                                    <option @if($ilListesiD->id==$musteriBilgileri->il) selected @endif value="{{$ilListesiD->id}}">{{$ilListesiD->sehir_adi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="ilce" class="control-label">İLÇE</label>
                                            <select name="ilce" id="ilce" class="form-control" >
                                                @foreach($ilceListesi as $ilceListesiD)
                                                    <option @if($ilceListesiD->id==$musteriBilgileri->ilce) selected @endif value="{{$ilceListesiD->id}}">{{$ilceListesiD->ilce_adi}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div class="form-group">
                                            <label for="adres" class="control-label">ADRES</label>
                                            <textarea name="adres" id="adres" cols="20" rows="2" class="form-control">{{$musteriBilgileri->adres}}</textarea>
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

                    <div class="card">
                        <div class="header">
                            <h2>GİRİŞ BİLGİLERİ</h2>
                        </div>
                        <div class="body">
                            <form id="musteriGuncellePostGB" action="{{route('musteriDuzenlePostGBKP')}}" method="post">
                                @csrf
                                <div class="row clearfix">
                                    <input type="hidden" name="musteriID" value="{{$musteriBilgileri->id}}">
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="email" class="control-label">E-MAIL</label>
                                            <input type="email" id="email" name="email" value="{{$musteriBilgileri->email}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="sifre" class="control-label">YENİ ŞİFRE</label>
                                            <input type="text" id="sifre" name="sifre" value="" class="form-control">
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

        $('#il').on('change', function () {
            var secilenIl = this.value;
            $.ajax({
                type: "GET",
                url: '{{route('ilceGetirGet')}}',
                data: {
                    ilID: secilenIl,
                    ilceID: 0,
                },
                success: function (data) {
                    $('#ilce').html(data);
                }
            });
        });


        $("#musteriGuncellePost").submit(function (e) {
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

        $("#musteriGuncellePostGB").submit(function (e) {
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
                }, 800);
            });
        });
    </script>
@endsection
