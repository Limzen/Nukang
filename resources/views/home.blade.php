@extends('app')

@section('content')
@if(Auth::guest() || Auth::user()->statuspengguna == '1')
<div class="container">
    <?php if(Session::has('message_success')): ?>
    <div class="alert alert-success">
        <?php echo Session::get('message_success')?>
    </div>
    <?php endif;?>
    <?php if(Session::has('message_failed')): ?>
    <div class="alert alert-danger" style="margin-bottom:10px;">
        <?php echo Session::get('message_failed')?>
    </div>
    <?php endif;?>
</div>
<div class="container mt-2">
  <h1 style="font-size:40px;font-family: 'Open Sans', sans-serif;margin-top:50px"><center>Layanan Kami</center></h1>
  <div class="row">
    <div class="col-md-3 col-sm-6 item d-flex">
      <div class="card item-card d-flex flex-column w-100">

        <h4 class="item-card-title text-right">
          <i class="fa fa-map-marker" style="color:#11b360"></i> Pencarian Online
        </h4>

        <img src="{{ asset('images/icon/icon1.png') }}" class="card-img-top icon-img" alt="Online Searching">

        <div class="card-body d-flex flex-column">
          <h5 class="card-title mt-3 mb-3"><b>Pencarian Jasa Renovasi</b></h5>
          <p class="card-text flex-grow-1">
            Fitur pencarian jasa renovasi berbasis peta digital Google Maps sehingga memudahkan pelanggan mengetahui penyedia jasa renovasi terdekat dari lokasi rumahnya.
          </p>
        </div>

      </div>
    </div>

    <div class="col-md-3 col-sm-6 item d-flex">
      <div class="card item-card d-flex flex-column w-100">

        <h4 class="item-card-title text-right">
          <i class="fa fa-laptop" style="color:#11b360"></i> Pemesanan Online
        </h4>

        <img src="{{ asset('images/icon/icon2.png') }}" class="card-img-top icon-img" alt="Online Order">

        <div class="card-body d-flex flex-column">
          <h5 class="card-title mt-3 mb-3"><b>Pemesanan Jasa Renovasi</b></h5>
          <p class="card-text flex-grow-1">
            Melakukan pemesanan jasa renovasi secara cepat dan mudah melalui sistem hanya dalam beberapa klik.
          </p>
        </div>

      </div>
    </div>

    <div class="col-md-3 col-sm-6 item d-flex">
      <div class="card item-card d-flex flex-column w-100">

        <h4 class="item-card-title text-right">
          <i class="fa fa-money" style="color:#11b360"></i> Pembayaran Online
        </h4>

        <img src="{{ asset('images/icon/icon3.png') }}" class="card-img-top icon-img" alt="Online Payment">

        <div class="card-body d-flex flex-column">
          <h5 class="card-title mt-3 mb-3"><b>Pembayaran Jasa Renovasi</b></h5>
          <p class="card-text flex-grow-1">
            Sistem bertindak sebagai perantara pembayaran sehingga transaksi lebih aman dan terpercaya.
          </p>
        </div>

      </div>
    </div>

    <div class="col-md-3 col-sm-6 item d-flex">
      <div class="card item-card d-flex flex-column w-100">

        <h4 class="item-card-title text-right">
          <i class="fa fa-road" style="color:#11b360"></i> Pembelian Bahan Material
        </h4>

        <img src="{{ asset('images/icon/icon4.png') }}" class="card-img-top icon-img" alt="Buy Material">

        <div class="card-body d-flex flex-column">
          <h5 class="card-title mt-3 mb-3"><b>Beli Material Renovasi</b></h5>
          <p class="card-text flex-grow-1">
            Fitur pembelian material renovasi langsung dari aplikasi tanpa harus mencari vendor terpisah.
          </p>
        </div>

      </div>
    </div>

  </div>
  
</div>
<div class="row" style="background-color: #11b360;margin-top:50px;margin-bottom:50px">
  <div class="container" style="padding: 30px;text-align: center">
    <h1 style="color:white;font-size:40px;margin-bottom:40px"><b>Tentang Kami</b></h1>
    <h4 style="color:white;line-height:40px;margin-bottom: 40px">Kami adalah platform renovasi rumah berbasis web yang menghubungkan pelanggan dengan penyedia jasa renovasi terpercaya secara transparan, efisien, dan terintegrasi melalui pencarian lokasi terdekat, pemesanan mudah, serta pemantauan proses renovasi.</h4>
  </div>
</div>
 <div class="container">
   <h1 style="font-size:40px;font-family: 'Open Sans', sans-serif;margin-top:10px;margin-bottom:15px"><center>Menyediakan Jasa Renovasi Berbagai Keahlian</center></h1>
   <div class="row">

  <div class="col-md-6 col-sm-12">
    <div class="box-part text-center">

      <center>
        <img src="{{ asset('images/icon/indoor.png') }}" class="img-responsive" style="width:90px">
      </center>

      <div class="title">
        <h4>Renovasi Indoor</h4>
      </div>

      <div class="text">
        <span>
          Layanan renovasi bagian dalam bangunan seperti listrik, AC, elektronik, dan interior rumah.
        </span>
      </div>

    </div>
  </div>

  <div class="col-md-6 col-sm-12">
    <div class="box-part text-center">

      <center>
        <img src="{{ asset('images/icon/outdoor.png') }}" class="img-responsive" style="width:90px">
      </center>

      <div class="title">
        <h4>Renovasi Outdoor Bangunan</h4>
      </div>

      <div class="text">
        <span>
          Layanan renovasi bagian luar bangunan seperti dinding, atap, pagar, dan struktur bangunan.
        </span>
      </div>

    </div>
  </div>

</div>
</div>

<!-- <div class="row" style="background-image: linear-gradient(rgba(17, 179, 96, 0.2), white);;margin-top:30px;padding:10px;margin-right:0px">
    <div class="container" style="margin-bottom:20px;">
        <h2 style="text-align:center;"><b>Tukang Dengan Rating Terbaik Dari Berbagai Kategori</b></h2>
        <div class="row">
            @foreach($tukang as $key => $value)
            <div class="col-md-4" style="margin-top: 20px">
                @include('include/depankotaktukang')
            </div>
            @endforeach
        </div>
    </div>
</div> -->
@elseif(Auth::user()->statuspengguna == '2')
<div class="container" style="margin-bottom:20px;padding-top: 50px">
    <div class="row">
        <center>
            <div class="profile-picture">
                <img src="{{ asset('images/fotoprofil') }}/{{Auth::user()->fotoprofil}}">
            </div>
            <h3>{{Auth::user()->namatukang}}</h3>
            <h4>Nomor ID Penyedia Jasa Renovasi: {{Auth::user()->kodeuser}}</h4>
            <h4>Pemesanan Selesai: {{$ps}} Pesanan</h4>
            <h4>Pemesanan Belum Selesai: {{$pbs}} Pesanan</h4>
        </center>
    </div>
</div>
@elseif(Auth::user()->statuspengguna == '0')
<div class="container">
    <div class="row">
        <h2 class="tengah">Verifikasi Penyedia Jasa Renovasi</h2>
        <?php if(Session::has('message_success')): ?>
        <div class="alert alert-success" style="margin-bottom:20px;">
            <?php echo Session::get('message_success')?>
        </div>
        <?php endif;?>
        <?php if(Session::has('message_failed')): ?>
            <div class="alert alert-danger" style="margin-bottom:20px;">
                <?php echo Session::get('message_failed')?>
            </div>
        <?php endif;?>
        <div class="row" style="padding:20px">
        <table id="exampleRiwayatTransaksi" class="table table-bordered" style="margin-top:10px;width:100%">
            <thead class="primarycolor">
                <tr>
                    <th style="width:30px">No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Deskripsi Keahlian</th>
                    <th>Pengalaman Bekerja</th>
                    <th>Foto SIM</th>
                    <th>Foto KTP</th>
                    <th>Foto Profil</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1?>
                @foreach($verifikasitukang as $key => $value)
                <tr style="background-color:white">
                    <td>{{$i}}</td>
                    <td>{{$value->namatukang}}</td>
                    <td>{{$value->email}}</td>
                    <td>{{$value->deskripsikeahlian}}</td>
                    <td>{{$value->lamapengalamanbekerja}} tahun</td>
                    <td><a href="{{asset('images/fotosim')}}/{{$value->fotosim}}" target="_blank">Foto SIM</a></td>
                    <td><a href="{{asset('images/fotoktp')}}/{{$value->fotoktp}}" target="_blank">Foto KTP</a></td>
                    <td><a href="{{asset('images/fotoprofil')}}/{{$value->fotoprofil}}" target="_blank">Foto Profil</a></td>
                    <td>
                        <form action="{{url('home/terima')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="iduser" value="{{$value->id}}">
                            <button type="submit"><span class="glyphicon glyphicon-ok"></span></button>
                        </form>
                    </td>
                    <td>
                        <form action="{{url('home/tolak')}}" method="POST">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input type="hidden" name="iduser" value="{{$value->id}}">
                            <button type="submit"><span class="glyphicon glyphicon-remove"></span></button>
                        </form>
                    </td>
                </tr>
                <?php $i++;?>
                @endforeach
            </tbody>
        </table>    
    </div>
    </div>
</div>
@endif
@endsection
@section('datatable')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
@endsection
