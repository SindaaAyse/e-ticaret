@extends("frontend.main")
@section('content')
    <div class="breadcrumb-area pt-20">
        <div class="container">
            <div class="breadcrumb-content border-bottom-1 pb-22">
                <ul>
                    <li><a href="/">Ana Sayfa</a> <i class="fa fa-angle-right"></i></li>
                    <li class="active">{{$title}}</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="contact-message-wrapper">
                    <h4 class="contact-title">YENİ KAYIT</h4>
                    <div class="contact-message">
                        <form id="yeniKayitFormu" action="{{route('yeniKayitPost')}}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="contact-form-style mb-20">
                                        <label for="adSoyad" id="formLabelYeni"> Ad Soyad <span id="yaziKirmizi"> * </span></label>
                                        <input name="adSoyad" id="adSoyad" type="text">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact-form-style mb-20">
                                        <label for="gsm" id="formLabelYeni"> Gsm <span id="yaziKirmizi"> * </span></label>
                                        <input name="gsm" id="gsm" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="billing-select mb-20">
                                        <label for="il" id="formLabelYeni"> İl <span id="yaziKirmizi"> * </span></label>
                                        <select name="il" id="il"  style="padding: 10px; height: 50px;">
                                            @foreach($ilListesi as $ilListesiD)
                                                <option value="{{$ilListesiD->id}}">{{$ilListesiD->sehir_adi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="billing-select mb-20">
                                        <label for="ilce" id="formLabelYeni"> İlçe <span id="yaziKirmizi"> * </span></label>
                                        <select name="ilce" id="ilce"  style="padding: 10px; height: 50px;">
                                            <option value="0"> Lütfen Önce İl Seçin</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="contact-form-style mb-20">
                                        <label for="adres" id="formLabelYeni"> Adres <span id="yaziKirmizi"> * </span></label>
                                        <input name="adres" id="adres" type="text">
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-lg-6">
                                    <div class="contact-form-style mb-20">
                                        <label for="email" id="formLabelYeni"> E-mail <span id="yaziKirmizi"> * </span></label>
                                        <input name="email" id="email" type="email">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="contact-form-style mb-20">
                                        <label for="sifre" id="formLabelYeni"> Şifre <span id="yaziKirmizi"> * </span></label>
                                        <input name="sifre" id="sifre" type="password">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="contact-form-style">
                                        <button class="submit btn-style btn-block" type="submit">GÖNDER</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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

        $("#yeniKayitFormu").submit(function (e) {
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
                            Swal.fire({
                                    title: "Tebrikler",
                                    text: donenDeger.aciklama,
                                    type: "succes",
                                    confirmButtonText: "Tamam",
                                }
                            ).then((result) => {
                                var url = '{{ route("hesabim") }}';
                                window.location.href = url;
                            });
                        }, 600);

                    }else{
                        setTimeout(function () {
                            Swal.fire({
                                    title: "Hata!",
                                    text: donenDeger.aciklama,
                                    type: "error",
                                    confirmButtonText: "Tamam",
                                }
                            );
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

