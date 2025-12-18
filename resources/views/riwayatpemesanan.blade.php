@extends('app')

@section('content')
<div class="container" style="padding:20px">
    <h2 class="tengah">Riwayat Pemesanan</h2>
    <?php if(Session::has('message_success')): ?>
    <div class="message-success" style="margin-bottom:20px;margin-top:20px">
        <?php echo Session::get('message_success')?>
    </div>
    <?php endif;?>
    <?php if(Session::has('message_failed')): ?>
    <div class="message-failed" style="margin-bottom:10px;">
    <?php echo Session::get('message_failed')?>
    </div>
    <?php endif;?>
    @if(Auth::user()->statuspengguna == '2')
    @if(count($riwayatpemesanan)!=0)
    @foreach($riwayatpemesanan as $key => $value)
    <div class="row" style="margin:0px;margin-top:20px;background-color:#e0e0d7;padding:20px;border:1px solid black">
        <div class="col-md-2">
            <div class="boxpictureriwayatpesanan">
                <img src="{{ asset('images/fotoprofil') }}/{{$value->fotoprofil}}" class="img-responsive" style="border:1px solid black">
            </div>  
        </div>
        <div class="col-md-10" style="margin-top:-20px">
            <h3><b>Nomor Pemesanan: </b><a href="{{url('riwayatpemesanan')}}/{{$value->id_pemesanan}}">{{$value->nomorpemesanan}}</a></h3>
            <h4 style="text-align:justify"><b>Nomor ID Pelanggan: </b>{{$value->kodeuser}}</h4>
            <h4 style="text-align:justify"><b>Nama: </b>{{$value->namapelanggan}}</h4>
            <h4 style="text-align:justify"><b>Kategori: </b>{{$value->kategoritukang}}</h4>
            <h4 style="text-align:justify"><b>Jenis Pemesanan: </b>@include('include/harianorborongan')</h4>
            <h4 style="text-align:justify"><b>Tanggal Kedatangan Penyedia Jasa Renovasi : </b>{{$value->tanggalbekerja}}</h4>
            <h4 style="text-align:justify"><b>Status Pemesanan: </b>@include('include/statuspemesanan')</b></h4>
            <h4 style="text-align:right"><a href="{{url('riwayatpemesanan')}}/{{$value->id_pemesanan}}">Lihat Selengkapnya</a></h4>
        </div>
    </div>
    @endforeach
    @else
    <h4>Belum Ada Data Pemesanan</h4>
    @endif
    @else
    @if(count($riwayatpemesanan)!=0)
    @foreach($riwayatpemesanan as $key => $value) 
    <div class="row" style="margin:0px;margin-top:20px;background-color:#e0e0d7;padding:20px;border:1px solid black"> 
        <div class="col-md-2">
            <div class="boxpictureriwayatpesanan">
                <img src="{{ asset('images/fotoprofil') }}/{{$value->fotoprofil}}" class="img-responsive" style="border:1px solid black">
            </div>  
        </div>
        <div class="col-md-10" style="margin-top:-20px">
            <h3><b>Nomor Pemesanan: </b><a href="{{url('riwayatpemesanan')}}/{{$value->id_pemesanan}}">{{$value->nomorpemesanan}}</a></h3>
            <h4 style="text-align:justify"><b>Nomor ID Penyedia Jasa Renovasi: </b><a href="{{url('caritukang')}}/{{$value->id_tukang}}/rincianbiaya">{{$value->kodeuser}}</a></h4>
            <h4 style="text-align:justify"><b>Nama: </b>{{$value->namatukang}}</h4>
            <h4 style="text-align:justify"><b>Kategori: </b>{{$value->kategoritukang}}</h4>
            <h4 style="text-align:justify"><b>Jenis Pemesanan: </b>@include('include/harianorborongan')</h4>
            <h4 style="text-align:justify"><b>Tanggal Kedatangan Penyedia Jasa Renovasi : </b>{{$value->tanggalbekerja}}</h4>
            <h4 style="text-align:justify"><b>Status Pemesanan: </b>@include('include/statuspemesanan')</b></h4>
            <h4 style="text-align:right"><a href="{{url('riwayatpemesanan')}}/{{$value->id_pemesanan}}?kategori=all&katakunci=">Lihat Selengkapnya</a></h4>
        </div>
    </div>
    @endforeach
    @else
    <h4>Belum Ada Data Pemesanan</h4>
    @endif
    @endif
    </div>
</div>
@endsection
