@extends("frontend.hesabim.anaEkran")
@section('contentHesabim')
    <div class="col-md-9 col-sm-12 col-xs-12">
        <div class="product-sidebar-wrap mb-30">
            <div class="shop-widget">
                <div >
                    <h4 class="shop-sidebar-title"> ADRES DÜZENLE </h4>
                </div>
                <form id="adresDuzenleForm" action="{{route('adresDuzenlePost',$adresBilgi['id'])}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="contact-form-style mb-20">
                                <label for="adresBaslik" id="formLabelYeni"> Adres Başlığı <span id="yaziKirmizi"> * </span></label>
                                <input name="adresBaslik" id="adresBaslik" value="{{$adresBilgi['adresBaslik']}}" type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-form-style mb-20">
                                <label for="adSoyad" id="formLabelYeni"> Ad Soyad <span id="yaziKirmizi"> * </span></label>
                                <input name="adSoyad" id="adSoyad" value="{{$adresBilgi['adSoyad']}}" type="text">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-form-style mb-20">
                                <label for="gsm" id="formLabelYeni"> Gsm <span id="yaziKirmizi"> * </span></label>
                                <input name="gsm" id="gsm" type="text" value="{{$adresBilgi['gsm']}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="billing-select mb-20">
                                <label for="il" id="formLabelYeni"> İl <span id="yaziKirmizi"> * </span></label>
                                <select name="il" id="il"  style="padding: 10px; height: 50px;">
                                    @foreach($ilListesi as $ilListesiD)
                                        <option @if($adresBilgi['il']==$ilListesiD->id) selected @endif value="{{$ilListesiD->id}}">{{$ilListesiD->sehir_adi}}</option>
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
                                        <option @if($adresBilgi['ilce']==$ilceListesiD->id) selected @endif value="{{$ilceListesiD->id}}">{{$ilceListesiD->ilce_adi}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="contact-form-style mb-20">
                                <label for="adres" id="formLabelYeni"> Adres <span id="yaziKirmizi"> * </span></label>
                                <input name="adres" id="adres" type="text" value="{{$adresBilgi['adres']}}">
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

        $("#adresDuzenleForm").submit(function (e) {
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
                            var url = '{{route('adresListesi')}}';
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
