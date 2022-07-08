@extends("frontend.main")
@section('content')
    <div class="breadcrumb-area pt-20">
        <div class="container">
            <div class="breadcrumb-content border-bottom-1 pb-22">
                <ul>
                    <li><a href="/">Ana Sayfa</a> <i class="fa fa-angle-right"></i></li>
                    <li class="active">İLETİŞİM</li>
                </ul>
            </div>
        </div>
    </div>
    <div class="contact-area pt-80 pb-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="fa fa-map-marker"></i>
                        </div>
                        <div class="contact-info-content">
                            <h4>Adresimiz</h4>
                            <p>Fırat Ünv., 23119 Elâzığ Merkez/Elazığ</p>
                            <p><a href="#">info@sindaakyil.com.tr</a></p>
                            <p><a href="#">info@ayseekinci.com.tr</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="fa fa-mobile"></i>
                        </div>
                        <div class="contact-info-content">
                            <h4>Çağrı Merkezi</h4>
                            <p><b>Gsm:</b> 0212 222 22 22</p>
                            <p><b>Fax:</b> 0212 222 22 23</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-12">
                    <div class="contact-info-wrapper text-center mb-30">
                        <div class="contact-info-icon">
                            <i class="fa fa-envelope-o"></i>
                        </div>
                        <div class="contact-info-content">
                            <h4>Bize Ulaşın</h4>
                            <p><a href="#">info@sindaakyil.com.tr </a></p>
                            <p><a href="#">info@ayseekinci.com.tr </a></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="contact-message-wrapper">
                        <h4 class="contact-title">İLETİŞİM FORMU</h4>
                        <div class="contact-message">
                            <form id="iletisimFormu" action="{{route('iletisimPost')}}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="contact-form-style mb-20">
                                            <input name="ad" placeholder="Adınız" type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="contact-form-style mb-20">
                                            <input name="email" placeholder="E-mail Adresiniz" type="email">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-form-style mb-20">
                                            <input name="konu" placeholder="Konu" type="text">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="contact-form-style">
                                            <textarea name="mesaj" placeholder="Mesajınız"></textarea>
                                            <button class="submit btn-style" type="submit">GÖNDER</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <p class="form-messege"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12458.974984154846!2d39.2019556!3d38.6777569!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x97da54a9bdfebc9a!2zRsSxcmF0IMOcbml2ZXJzaXRlc2k!5e0!3m2!1str!2str!4v1655288647752!5m2!1str!2str" height="650" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>

@endsection
@section('js')
    <script>
        $("#iletisimFormu").submit(function (e) {
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
                        toastr.success(donenDeger.aciklama, "");
                        $('#iletisimFormu').trigger("reset");
                    }else{
                        toastr.error(donenDeger.aciklama, "");
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
