@extends('app')

@section('content')
<div class="container" style="padding:20px">
    <h2 class="tengah">Update Saldo</h2>
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
    @if(count($updatesaldo)!=0)
    @foreach($updatesaldo as $key => $value)
    <div class="row" style="margin:0px;margin-top:20px;background-color:#e0e0d7;padding:20px;border:1px solid black">
        <div class="col-md-12" style="margin-top:-20px">
            <h3><b>Kode Transaksi: </b>{{$value->kode}}</a></h3>
            <h4><b>Nama Pelanggan: </b>{{$value->namapelanggan}}</h4>
            <h4><b>Nomor Rekening: </b>{{$value->nomorrekening}}-{{$value->namarekening}}</h4>
            <h4><b>Nama Rekening: </b>{{$value->namarekening}}</h4>
            <h4><b>Rekening Tujuan: </b>{{$value->rekeningtujuan}}</h4>
            <h4><b>Jenis Transaksi: </b>{{$value->jenistransaksi}}</h4>
            <h4><b>Jumlah Transaksi: </b>{{number_format($value->jumlahsaldo,2)}}</h4>
            <h4><b>Bukti Transfer: </b><a href="{{asset('images/buktitransfer')}}/{{$value->buktitransaksi}}" target="_blank"><img src="{{asset('images/buktitransfer')}}/{{$value->buktitransaksi}}" style="width:150px"></a></h4>
            <form action="{{url('konfirmasiupdatesaldo/terima')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idriwayat" value="{{$value->id_riwayattransaksi}}">
                <button type="submit" class="btn btn-primary" style="width:100%">Update</button>
            </form>
            <form action="{{url('konfirmasiupdatesaldo/tolak')}}" method="POST" style="margin-top:10px">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idriwayat" value="{{$value->id_riwayattransaksi}}">
                <button type="submit" class="btn" style="background-color:red;width:100%">Tolak</button>
            </form>
        </div>
    </div>
    @endforeach
    @else
    <h4>Belum Ada Permintaan Pengisian Saldo Dari Pelanggan</h4>
    @endif
    </div>
</div>
@endsection
