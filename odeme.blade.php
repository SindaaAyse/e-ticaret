@extends("frontend.main")
@php
    $SiparisID = $sepetBilgileri->id;
    $SiparisIDBanka = "SPRS0" . $sepetBilgileri->id;

    $DonusLink = "http://127.0.0.1:8000/alisveris-sepeti/odeme/" . $SiparisIDBanka;
    $clientId = "500200000";


    $amount = ($sepetBilgileri->toplam_tutar + $sepetBilgileri->tasima_bedeli);





    $oid = $SiparisIDBanka;
    $okUrl = $DonusLink;
    $failUrl = $DonusLink;
    $rnd = microtime();
    $taksit = "";
    $islemtipi = "Auth";
    $storekey = "123456";
    $hashstr = $clientId . $oid . $amount . $okUrl . $failUrl . $islemtipi . $taksit . $rnd . $storekey;
    $hash = base64_encode(pack('H*', sha1($hashstr)));
@endphp
@section('content')
    <div class="breadcrumb-area pt-20">
        <div class="container">
            <div class="breadcrumb-content border-bottom-1 pb-22">
                <ul>
                    <li><a href="/">Ana Sayfa</a> <i class="fa fa-angle-right"></i></li>
                    <li><a href="/">Alışveriş Sepeti</a> <i class="fa fa-angle-right"></i></li>
                    <li class="active">{{$title}}</li>
                </ul>
            </div>
        </div>
    </div>
    @if(!empty($sepetBilgileri->id))

        <div class="product-details-area pt-30 pb-80">
            <div class="container">
                <div class="row">

                    <div class="col-md-8 col-sm-12 col-xs-12">
                        <form name="KartOdeme" action="https://entegrasyon.asseco-see.com.tr/fim/est3Dgate" method="POST">
                            @csrf
                            <div class="holder mt-3">
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="text-center mb-3">
                                                <h4>
                                                    ÖDEME SAYFASI(#{{$SiparisIDBanka}})
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <div class="row">

                                                <div class="col-md-12 mb-2 mt-1">
                                                    <div class="form-group">
                                                        <label style="font-size: 13px; margin-bottom: 10px;" for="kart_sahibi">Kredi Kartı Sahibi
                                                            <abbr class="required" title="required">*</abbr>
                                                        </label>
                                                        <input type="text" id="kart_sahibi" name="kart_sahibi" class="form-control" value="">
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <div class="form-group">
                                                        <label style="font-size: 13px; margin-bottom: 10px;" for="pan">Kart Numarası
                                                            <abbr class="required" title="required">*</abbr>
                                                        </label>
                                                        <input type="text" id="pan" name="pan" onkeyup="sadecerakam(this)" value=""
                                                               placeholder="xxxx xxxx xxxx xxxx" maxlength="19" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label style="font-size: 13px; margin-bottom: 10px;" for="Ecom_Payment_Card_ExpDate_Month">Son Kul. Tarihi Ay
                                                        <abbr class="required" title="required">*</abbr>
                                                    </label>
                                                    <input type="text" id="Ecom_Payment_Card_ExpDate_Month"
                                                           name="Ecom_Payment_Card_ExpDate_Month" maxlength="2" value=""
                                                           onkeyup="sadecerakam(this)" placeholder="xx" class="form-control" required>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label style="font-size: 13px; margin-bottom: 10px;" for="Ecom_Payment_Card_ExpDate_Year">Son Kul. Yıl
                                                        <abbr class="required" title="required">*</abbr>
                                                    </label>
                                                    <input type="text" id="Ecom_Payment_Card_ExpDate_Year"
                                                           name="Ecom_Payment_Card_ExpDate_Year" maxlength="4" value=""
                                                           onkeyup="sadecerakam(this)" placeholder="xxxx" class="form-control" required>
                                                </div>
                                                <div class="col-md-4 mb-2">
                                                    <label style="font-size: 13px; margin-bottom: 10px;"  for="cv2">Güvenlik Kodu / Cvv 2
                                                        <abbr class="required" title="required">*</abbr>
                                                    </label>
                                                    <input type="text" id="cv2" name="cv2" maxlength="3"
                                                           onkeyup="sadecerakam(this)" class="form-control" placeholder="xxx" value=""
                                                           required>
                                                </div>
                                                <div class="col-md-12 mb-2">
                                                    <label  style="font-size: 13px" for="cardType">Kart Tipi
                                                        <abbr class="required" title="required">*</abbr>
                                                    </label>
                                                    <select name="cardType" id="cardType" class="form-control">
                                                        <option value="1">Visa</option>
                                                        <option value="2">MasterCard</option>
                                                    </select>
                                                    <input type="hidden" name="musteriID" value="{{Session::get('musteriBilgi')->id}}">
                                                    <input type="hidden" name="clientid" value="<?php echo $clientId ?>">
                                                    <input type="hidden" name="amount" value="<?php echo $amount ?>">
                                                    <input type="hidden" name="oid" value="<?php echo $oid ?>">
                                                    <input type="hidden" name="okUrl" value="<?php echo $okUrl ?>">
                                                    <input type="hidden" name="failUrl" value="<?php echo $failUrl ?>">
                                                    <input type="hidden" name="rnd" value="<?php echo $rnd ?>">
                                                    <input type="hidden" name="hash" value="<?php echo $hash ?>">
                                                    <input type="hidden" name="islemtipi" value="<?php echo $islemtipi ?>">
                                                    <input type="hidden" name="taksit" value="<?php echo $taksit ?>">
                                                    <input type="hidden" name="storetype" value="3d_pay">
                                                    <input type="hidden" name="lang" value="tr">
                                                    <input type="hidden" name="currency" value="949">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <button id="odemeButton" onclick="validateForm('{{$SiparisID}}')" type="button"  class="action-cart">
                                                SİPARİŞİ TAMAMLA
                                            </button>
                                        </div>


                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-4 col-sm-12 col-xs-12">
                        <div class="product-sidebar-wrap mb-30">
                            <div class="shop-widget">
                                <h4 class="shop-sidebar-title"> SEPET ÖZETİ </h4>
                                <div class="shop-list-style mt-20">
                                    <ul id="hesabimMenuUl">
                                        <li>
                                            <span style="font-weight: bold">NET TUTAR: </span>{{fonksiyon::paraBirimi($sepetBilgileri->net_tutar)}} TL
                                        </li>
                                        <li>
                                            <span style="font-weight: bold">TOPLAM TUTAR: </span>{{fonksiyon::paraBirimi($sepetBilgileri->toplam_tutar)}} TL
                                        </li>
                                        <li>
                                            <span style="font-weight: bold">KARGO ÜCRETİ: </span>{{fonksiyon::paraBirimi($sepetBilgileri->tasima_bedeli)}} TL
                                        </li>
                                        <li>
                                            <span style="font-weight: bold">ÖDENECEK TUTAR: </span>{{fonksiyon::paraBirimi($sepetBilgileri->toplam_tutar + $sepetBilgileri->tasima_bedeli)}} TL
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="product-details-area pt-30 pb-80">
            <div class="container">
                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="product-sidebar-wrap mb-30">
                            <div id="kirmiziUyari">
                                ALIŞVERİŞ SEPETİNİZ BOŞ
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    @endif

@endsection
@section('js')
    <script>
        $(document).ready(function(e) {
            $("#cv2").bind("click change keyup", function(e){
                var Cv2 = $("#cv2").val();
                sadecerakam(Cv2);
            });
        });

        String.prototype.toCardFormat = function () {
            return this.replace(/[^0-9]/g, "").substr(0, 16).split("").reduce(cardFormat, "");
            function cardFormat(str, l, i) {
                return str + ((!i || (i % 4)) ? "" : " ") + l;
            }
        };

        $(document).ready(function(){
            $("#pan").keyup(function () {
                $(this).val($(this).val().toCardFormat());
            });
        });


        RegExp.prototype.harfRakam=function(str){
            return  (this.test(str)) ? str.replace(this,"") : str ;
        }

        function sadecerakam(bu){
            var re=/[^0-9]+/g;
            bu.value= re.harfRakam(bu.value);
        }

        function sadeceharf(bu){
            var re2=/[^A-z- ]+/g;
            bu.value= re2.harfRakam(bu.value);
        }

        function validateForm(siparisID=null) {
            var KartSahibi = document.getElementById('kart_sahibi').value;
            var KartNumarasi = document.getElementById('pan').value.replace(/ /g,"");
            var SAy = document.getElementById('Ecom_Payment_Card_ExpDate_Month').value.replace(/ /g,"");
            var SYil = document.getElementById('Ecom_Payment_Card_ExpDate_Year').value.replace(/ /g,"");
            var Cv2 = document.getElementById('cv2').value.replace(/ /g,"");

            if (KartSahibi == null || KartSahibi == 0 || KartSahibi == "0") {
                Swal.fire({
                    icon: "error",
                    title: "",
                    text: "Lütfen Kredi Kartı Sahibi Kısmını Boş Bırakmayın",
                    type: "success",
                    confirmButtonText: "TAMAM",
                    confirmButtonColor: '#DD6B55',
                });
            }else if (KartNumarasi == null || isNaN(KartNumarasi) || KartNumarasi.length!=16) {
                Swal.fire({
                    icon: "error",
                    title: "",
                    text: "Lütfen Kart Numarası Kısmını xxxx xxxx xxxx xxxx şeklinde girin",
                    type: "error",
                    confirmButtonText: "TAMAM",
                    confirmButtonColor: '#DD6B55',
                });
            }else if (SAy == null || isNaN(SAy) || SAy.length!=2) {
                Swal.fire({
                    icon: "error",
                    title: "",
                    text: "Lütfen Son Kullanma Tarihinde Ay Kısmını 2 Hane Olacak Şekilde Girin",
                    type: "error",
                    confirmButtonText: "TAMAM",
                    confirmButtonColor: '#DD6B55',
                });

            }else if (SYil == null || isNaN(SYil) || SYil.length!=4) {
                Swal.fire({
                    icon: "error",
                    title: "",
                    text: "Lütfen Son Kullanma Tarihinde Yıl Kısmını 4 Hane Olacak Şekilde Girin",
                    type: "error",
                    confirmButtonText: "TAMAM",
                    confirmButtonColor: '#DD6B55',
                });
            }else if (Cv2 == null || isNaN(Cv2) || Cv2.length!=3) {
                Swal.fire({
                    icon: "error",
                    title: "",
                    text: "Lütfen Kartınızın Arka Yüzündeki 3 Haneli Güvenlik Kodunu Kontrol Edin",
                    type: "error",
                    confirmButtonText: "TAMAM",
                    confirmButtonColor: '#DD6B55',
                });
            }else{
                document.KartOdeme.submit();
            }
        }

        $(document).ready(function(){
            $(".replace").on("keyup", function(){
                str = $(this).val();
                var dizi = { "İ": "I", "Ş": "S", "Ğ": "G", "Ü": "U", "Ö": "O", "Ç": "C",  "ş": "s", "ğ": "g", "ü": "u", "ö": "o", "ç": "c", " ": "" };
                str = str.replace(/(([İŞĞÜÖÇşğüöç ]))+/g, function(harf){ return dizi[harf]; })
                $(this).val(str);
            });
        });

    </script>
@endsection

