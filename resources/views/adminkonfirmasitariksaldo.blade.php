@extends('app')

@section('content')
<div class="container" style="padding:20px">
    <h2 class="tengah">Tarik Saldo</h2>
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
    @if(count($tariksaldo)!=0)
    @foreach($tariksaldo as $key => $value)
    <div class="row" style="margin:0px;margin-top:20px;background-color:#e0e0d7;padding:20px;border:1px solid black">
        <div class="col-md-12" style="margin-top:-20px">
            <h3><b>Kode Transaksi: </b>{{$value->kode}}</a></h3>
            <h4><b>Nama Tukang: </b>{{$value->namatukang}}</h4>
            <h4><b>Nomor Rekening: </b>{{$value->nomorrekening}}-{{$value->namarekening}}</h4>
            <h4><b>Jumlah Transaksi: </b>{{number_format($value->jumlahsaldo,2)}}</h4>
            <h4><b>Jenis Transaksi: </b>{{$value->jenistransaksi}}</h4>
            <form action="{{url('konfirmasitariksaldo/terima')}}" method="POST">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idriwayat" value="{{$value->id_riwayattransaksi}}">
                <button type="submit" class="btn btn-primary" style="width:100%">Tarik</button>
            </form>
            <form action="{{url('konfirmasitariksaldo/tolak')}}" method="POST" style="margin-top:10px">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="idriwayat" value="{{$value->id_riwayattransaksi}}">
                <button type="submit" class="btn" style="background-color:red;width:100%">Tolak</button>
            </form>
        </div>
    </div>
    @endforeach
    @else
    <h4>Belum Ada Permintaan Penarikan Saldo Dari Tukang</h4>
    @endif
    </div>
</div>
@endsection
