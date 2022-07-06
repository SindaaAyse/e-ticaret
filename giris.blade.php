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
                    <h4 class="contact-title">MÜŞTERİ GİRİŞİ</h4>
                    <div class="contact-message">
                        <form id="girisFormu" action="{{route('girisPost')}}" method="post">
                            @csrf
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
                                        <button class="submit btn-style btn-block" type="submit">GİRİŞ YAP</button>
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
        $("#girisFormu").submit(function (e) {
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
                            var url = '{{route('anasayfa')}}';
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
                }, 500);
            });
        });
    </script>
@endsection
