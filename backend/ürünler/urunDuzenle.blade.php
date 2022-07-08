@extends("backend.main")
@section('icerik')
    <div id="main-content">
        <div class="container-fluid mt-4">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <h2>ÜRÜN DÜZENLE</h2>
                        </div>
                        <div class="body">
                            <form id="urunGuncelleForm" action="{{route('urunDuzenlePostKP')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="row clearfix">
                                    <input type="hidden" name="icerikID" value="{{$urunBilgi->id}}">
                                    <div class="col-lg-12 col-md-6 col-sm-12 text-center">
                                        <div class="form-group">
                                            <img style="width: 200px; border-radius: 50%" src="/{{$urunBilgi->resim}}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-6 col-sm-12 mb-3">
                                        <label for="il" class="control-label">ÜRÜN GÖRSELİ</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="resim" name="resim">
                                                <label class="custom-file-label" for="resim">GÖRÜNTÜ SEÇ</label>
                                            </div>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-secondary" type="submit">YÜKLE</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="katID" class="control-label">ÜRÜN KATEGORİSİ</label>
                                            <select name="katID" id="katID" class="form-control" >
                                                <option value="0">Lütfen Kategori Seçin</option>
                                                @if($kategoriler->isNotEmpty())
                                                    @foreach($kategoriler as $kategorilerD)
                                                        <option @if($kategorilerD->id==$urunBilgi->kat_id) selected @endif value="{{$kategorilerD->id}}">{{$kategorilerD->adi}}</option>
                                                    @endforeach
                                                @endif

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="adi" class="control-label">ÜRÜN ADI</label>
                                            <input type="text" id="adi" name="adi" value="{{$urunBilgi->adi}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="kodu" class="control-label">ÜRÜN KODU</label>
                                            <input type="text" id="kodu" name="kodu" value="{{$urunBilgi->kodu}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="fiyat" class="control-label">ÜRÜN FİYATI</label>
                                            <input type="number" step="0.1" id="fiyat" name="fiyat" value="{{$urunBilgi->fiyat}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="kdv" class="control-label">KDV ORANI</label>
                                            <input type="text" id="kdv" name="kdv" value="{{$urunBilgi->kdv}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="anasayfa" class="control-label">VİTRİN ÜRÜNÜ</label>
                                            <select name="anasayfa" id="anasayfa" class="form-control" >
                                                <option @if($urunBilgi->anasayfa==0) selected @endif value="0">HAYIR</option>
                                                <option @if($urunBilgi->anasayfa==1) selected @endif value="1">EVET</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-12 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label for="aciklama" class="control-label">İÇERİK BAŞLIK</label>
                                            <textarea id="ckeditor" name="aciklama">
                                                {{$urunBilgi->aciklama}}
                                            </textarea>
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
    <script src="https://www.wrraptheme.com/templates/hexabit/html/assets/vendor/ckeditor/ckeditor.js"></script><!-- Ckeditor -->

    <script src="/backend/assets/js/pages/forms/editors.js"></script>
    <script>
        $("#urunGuncelleForm").submit(function (e) {

            for (instance in CKEDITOR.instances) {
                CKEDITOR.instances[instance].updateElement();
            }

            e.preventDefault();
            var form = $(this);

            var url = form.attr('action');
            $.ajax({
                type: "POST",
                url: url,
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $("#bekleyinModali").modal('show');
                },
                success: function (data) {
                    var donenDeger = jQuery.parseJSON(data);

                    if(donenDeger.hata==0){
                        toastr.success(donenDeger.aciklama, "");
                        setTimeout(function () {
                            location.reload();
                        }, 1200);

                    }else{
                        setTimeout(function () {
                            toastr.error(donenDeger.aciklama, "");
                        }, 600);
                    }
                }
            }).done(function() {
                setTimeout(function () {
                    $("#bekleyinModali").modal('hide');
                }, 600);
            });
        });

    </script>
@endsection
