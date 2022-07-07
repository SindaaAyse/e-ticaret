@extends("frontend.hesabim.anaEkran")
@section('contentHesabim')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class="product-sidebar-wrap mb-30">
            <div class="shop-widget">
                <h4 class="shop-sidebar-title"> ÜYELİK BİLGİLERİM </h4>
                <form id="uyelikBilgiForm" action="{{route('uyelikBilgilerimPost')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="contact-form-style mb-20">
                                <label for="adSoyad" id="formLabelYeni"> Ad Soyad <span id="yaziKirmizi"> * </span></label>
                                <input name="adSoyad" id="adSoyad" value="{{fonksiyon::buyukHarfeCevir(Session::get('musteriBilgi')->ad_soyad)}}" type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-form-style mb-20">
                                <label for="gsm" id="formLabelYeni"> Gsm <span id="yaziKirmizi"> * </span></label>
                                <input name="gsm" id="gsm" type="text" value="{{Session::get('musteriBilgi')->gsm}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="billing-select mb-20">
                                <label for="il" id="formLabelYeni"> İl <span id="yaziKirmizi"> * </span></label>
                                <select name="il" id="il"  style="padding: 10px; height: 50px;">
                                    @foreach($ilListesi as $ilListesiD)
                                        <option @if($ilListesiD->id==Session::get('musteriBilgi')->il) selected @endif value="{{$ilListesiD->id}}">{{$ilListesiD->sehir_adi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="billing-select mb-20">
                                <label for="ilce" id="formLabelYeni"> İlçe <span id="yaziKirmizi"> * </span></label>
                                <select name="ilce" id="ilce"  style="padding: 10px; height: 50px;">
                                    <option value="0"> Lütfen Önce İl Seçin</option>
                                    @foreach($ilceListesi as $ilceListesiD)
                                        <option @if($ilceListesiD->id==Session::get('musteriBilgi')->ilce) selected @endif  value="{{$ilceListesiD->id}}">{{$ilceListesiD->ilce_adi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contact-form-style mb-20">
                                <label for="adres" id="formLabelYeni"> Adres <span id="yaziKirmizi"> * </span></label>
                                <input name="adres" id="adres" type="text" value="{{Session::get('musteriBilgi')->adres}}">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contact-form-style mb-20">
                                <label for="email" id="formLabelYeni"> E-mail <span id="yaziKirmizi"> * </span></label>
                                <input name="email" id="email" type="email" value="{{Session::get('musteriBilgi')->email}}">
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

        $("#uyelikBilgiForm").submit(function (e) {
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
