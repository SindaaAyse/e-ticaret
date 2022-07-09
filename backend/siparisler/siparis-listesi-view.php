@extends("backend.main")
@section('icerik')
    <div id="main-content">


        <div class="container-fluid mt-5">

            <div class="row clearfix">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="header">
                            <h2>SİPARİŞLER</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive check-all-parent">
                                <table class="table table-hover m-b-0 c_list">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>SİPARİŞ ID</th>
                                        <th>TARİH</th>
                                        <th>MÜŞTERİ</th>
                                        <th>TUTAR</th>
                                        <th>ÖD. TİPİ</th>
                                        <th>ÖD. DURUMU</th>
                                        <th>SİPARİŞ DURUMU</th>
                                        <th> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(!empty($alisverisler))
                                        @php
                                        $i=1;
                                        @endphp
                                        @foreach($alisverisler as $alisverislerD)
                                            @php
                                                $musteriAdi = '';
                                                if(isset($musteriBilgi[$alisverislerD->uye_id])){
                                                    $musteriAdi = $musteriBilgi[$alisverislerD->uye_id]->ad_soyad;
                                                }

                                                if($alisverislerD->odeme_tipi==1){
                                                    $odemeTipi = 'EFT-HAVALE';
                                                }elseif($alisverislerD->odeme_tipi==2){
                                                    $odemeTipi = 'KREDİ KARTI';
                                                }elseif($alisverislerD->odeme_tipi==3){
                                                    $odemeTipi = 'KAPIDA NAKİT';
                                                }

                                                if($alisverislerD->odeme_durumu==0){
                                                    $odemeDurumu = '<span style="padding:10px; font-weight:bold;" class="badge badge-primary">BEKLEMEDE</span>';
                                                }else{
                                                    $odemeDurumu = '<span style="padding:10px; font-weight:bold;" class="badge badge-success">ÖDENDİ</span>';
                                                }

                                                if($alisverislerD->durum==1){
                                                    $durum = '<span style="padding:10px; font-weight:bold;" class="badge badge-primary">HAZIRLANIYOR</span>';
                                                }elseif($alisverislerD->durum==2){
                                                    $durum = '<span style="padding:10px; font-weight:bold;" class="badge badge-warning">KARGODA</span>';
                                                }elseif($alisverislerD->durum==3){
                                                    $durum = '<span style="padding:10px; font-weight:bold;" class="badge badge-success">TAMAMLANDI</span>';
                                                }elseif($alisverislerD->durum==4){
                                                    $durum = '<span style="padding:10px; font-weight:bold;" class="badge badge-danger">İPTAL</span>';
                                                }
                                            @endphp
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>#SPRS0{{$alisverislerD->id}}</td>
                                                <td>{{fonksiyon::tarihBicimi($alisverislerD->alisveris_tarihi,1)}}</td>
                                                <td><b>{{$musteriAdi}}</b></td>
                                                <td>{{fonksiyon::paraBirimi($alisverislerD->toplam_tutar)}} TL</td>
                                                <td>{{$odemeTipi}}</td>
                                                <td>{!! $odemeDurumu !!}</td>
                                                <td>{!! $durum !!}</td>
                                                <td>
                                                    <a href="{{route('siparisDetayiKP',$alisverislerD->id)}}" style="color:white;" type="button" class="btn btn-info" ><i class="fa fa-search"></i> Detay</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="9">
                                                <div class="alert alert-danger alert-dismissible text-center" role="alert">
                                                    <i class="fa fa-info"></i> SİPARİŞ YOK
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
