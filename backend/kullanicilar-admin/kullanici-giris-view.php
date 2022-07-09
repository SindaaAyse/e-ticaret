<!doctype html>
<html lang="tr">
<head>
    <title>KONTROL PANELİ</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <meta name="description" content=" S">
    <meta name="author" content=" ">

    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="/backend/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="/frontend/assets/css/font-awesome.min.css">

    <!-- MAIN CSS -->
    <link rel="stylesheet" href="/backend/assets/css/main.css">
    <link rel="stylesheet" href="/backend/assets/css/color_skins.css">

    {{--    TOASTR İÇİN --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />
</head>
<style>
    .theme-orange .auth-main:before {
        background: #feb800;
    }
</style>
<body class="theme-orange">
<!-- WRAPPER -->
<div id="wrapper" class="auth-main">
    <div class="container" style="margin-top: 50px">
        <div class="row clearfix">

            <div class="col-lg-12" style="text-align: center">
                <div class="card" style="width: 500px">
                    <div class="header">
                        <p class="lead"><B>YÖNETİCİ GİRİŞİ</B></p>
                    </div>
                    <div class="body">
                        <form id="yoneticiGirisFormu" class="form-auth-small" action="{{route('loginPostKP')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="signin-email" class="control-label sr-only">KULLANICI ADI</label>
                                <input type="text" class="form-control" name="kullaniciAdi" placeholder="Kullanıcı Adı" value="" placeholder="">
                            </div>
                            <div class="form-group">
                                <label for="signin-password" class="control-label sr-only">ŞİFRE</label>
                                <input type="password" class="form-control" name="sifre" value="" placeholder="Password">
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block">GİRİŞ YAP</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="bekleyinModali" tabindex="-1" role="dialog" style="margin-top: 15%;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body"  style="text-align: center">
                <div class="lds-ripple"><div></div><div></div></div>
                <br>
                <span>LÜTFEN BEKLEYİN</span>
            </div>

        </div>
    </div>
</div>
<!-- END WRAPPER -->

<script src="/backend/assets/bundles/libscripts.bundle.js"></script>
<script src="/backend/assets/bundles/vendorscripts.bundle.js"></script>

<script src="/backend/assets/bundles/mainscripts.bundle.js"></script>
{{--    TOASTR İÇİN --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>

<script>
    $("#yoneticiGirisFormu").submit(function (e) {
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
                    var url = '{{route('anaEkranKP')}}';
                    location.href = url;
                    $('#yoneticiGirisFormu').trigger("reset");
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
</body>
</html>
