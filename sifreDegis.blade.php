@extends("frontend.hesabim.anaEkran")
@section('contentHesabim')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class="product-sidebar-wrap mb-30">
            <div class="shop-widget">
                <h4 class="shop-sidebar-title"> ÜYELİK BİLGİLERİM </h4>
            <form id="sifreDegisForm" action="{{route('sifreDegisPost')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-4">
                        <div class="contact-form-style mb-20">
                            <label for="eskiSifre" id="formLabelYeni"> Eski Şifre <span id="yaziKirmizi"> * </span></label>
                            <input name="eskiSifre" id="eskiSifre"  type="password">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-form-style mb-20">
                            <label for="yeniSifre" id="formLabelYeni"> Yeni Şifre <span id="yaziKirmizi"> * </span></label>
                            <input name="yeniSifre" id="yeniSifre"  type="password">
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="contact-form-style mb-20">
                            <label for="yeniSifre2" id="formLabelYeni"> Yeni Şifre (Tekrar)<span id="yaziKirmizi"> * </span></label>
                            <input name="yeniSifre2" id="yeniSifre2"  type="password">
                        </div>
                    </div>
                </div>

                <div class="row">
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

        $("#sifreDegisForm").submit(function (e) {
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
