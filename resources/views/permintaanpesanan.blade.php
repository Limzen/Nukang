@extends('app')

@section('content')
<div class="container" style="margin-top:20px">
	<h2 class="tengah">Permintaan Pesanan</h2>
	<?php if(Session::has('message_success')): ?>
    <div class="alert alert-success" style="margin-bottom:20px;margin-top:20px">
        <?php echo Session::get('message_success')?>
    </div>
    <?php endif;?>
     <?php if(Session::has('message_failed')): ?>
    <div class="alert alert-danger" style="margin-bottom:10px;">
        <?php echo Session::get('message_failed')?>
    </div>
    <?php endif;?>
	<div class="row">
		<table id="exampleRiwayatTransaksi" class="table table-bordered" style="margin-top:10px;width:100%">
	        <thead class="primarycolor">
	            <tr>
	              	<th style="width:30px">No</th>
	              	<th>Nomor Pemesanan</th>
	              	<th>Tanggal Kedatangan Penyedia Jasa Renovasi</th>
	            </tr>
	        </thead>
	        <tbody>
		        <?php $i = 1?>
		        @foreach($pesanan as $key => $value)
		          	<tr>
		           	 	<td><?php echo $i;?></td>
		            	<td><a href="{{url('riwayatpemesanan')}}/{{$value->id_pemesanan}}">{{$value->nomorpemesanan}}</a></td>
		            	<td>{{$value->tanggalbekerja}}</td>
		          	</tr>
		        <?php $i++;?>
		        @endforeach
	        </tbody>
	    </table>	
	</div>
	<div class="row" style="border-top:1px solid black;margin-top:10px">
		<h4>Catatan: Sebelum menerima pemesanan, sebaiknya survei terlebih dahulu ke tempat pelanggan</h4>
	</div>
	@if(count($permintaan)!=0)
	@foreach($permintaan as $key => $value)
	<div class="row" style="border:1px solid black;padding:15px">
		<div class="col-md-2">
            <div class="boxpictureriwayatpesanan">
                <img src="{{ asset('images/fotoprofil') }}/{{$value->fotoprofil}}" class="img-responsive" style="border:1px solid black">
            </div>  
        </div>
        <div class="col-md-10" style="margin-top:-20px">
            <h3><b>Nomor Pemesanan: </b>{{$value->nomorpemesanan}}</h3>
            <h4 style="text-align:justify"><b>Nomor ID Pelanggan: {{$value->kodeuser}}</h4>
            <h4 style="text-align:justify"><b>Nama: </b>{{$value->namapelanggan}}</h4>
            <h4 style="text-align:justify"><b>Nomor HP: </b>{{$value->nomorhandphone}}</h4>
            <h4 style="text-align:justify"><b>Kategori: </b>{{$value->kategoritukang}}</h4>
            <h4 style="text-align:justify"><b>Jenis Pemesanan: </b>@include('include/harianorborongan')</h4>
            <h4 style="text-align:justify"><b>Tanggal Kedatangan Penyedia Jasa Renovasi: </b>{{$value->tanggalbekerja}}</h4>
            @if($value->kategoripemesanan != '0')
             <h4 style="text-align:justify"><b>Tanggal Selesai: </b>{{$value->tanggalselesai}}</h4>
            @endif
            <h4 style="text-align:justify"><b>Alamat: </b>{{$value->alamatpemesanan}}</h4>
            <h4 style="text-align:justify"><b>Jasa Yang Diperlukan: </b>{{$value->jenispemesanan}} (Rp. {{number_format($value->biayajasa,2)}})</h4>
            <h4 style="text-align:justify"><b>Catatan: </b>{{$value->catatan}}</h4>
            @if($value->fotopemesanan1 != "" && $value->fotopemesanan2 != "")
            <h4 style="text-align:justify"><b>Foto: 
            @endif
            	@if($value->fotopemesanan1 != "")
            	<a href="{{asset('images/fotoproduk')}}/{{$value->fotopemesanan1}}" target="_blank"><img style="margin-top:-10px;width:150px" src="{{asset('images/fotoproduk')}}/{{$value->fotopemesanan1}}"></a> 
            	@endif
            	@if($value->fotopemesanan2 != "")
            	<a href="{{asset('images/fotoproduk')}}/{{$value->fotopemesanan2}}" target="_blank"><img style="margin-top:-10px;width:150px" src="{{asset('images/fotoproduk')}}/{{$value->fotopemesanan2}}"></a></b></h4>
           		@endif
            <form action="{{url('permintaanpesanan')}}/{{$value->id_pemesanan}}/tolak" method="POST">
        	<input type="hidden" name="_token" value="{{ csrf_token() }}">
        	<h4 style="text-align:justify"><b>Alasan Penolakan: </b><textarea class="form-control" name="alasanpenolakan" required></textarea></h4>
            <div class="row" style="padding-right:24px">
            	<div class="col-md-10">
            	</div>
            	<div class="col-md-1">
			            <button type="submit" class="btn" style="background-color:red">Tolak</button>
			        </form>
            	</div>
            	<div class="col-md-1">
			        <form action="{{url('permintaanpesanan')}}/{{$value->id_pemesanan}}/terima" method="POST">
		                <input type="hidden" name="_token" value="{{ csrf_token() }}">
			            <button type="submit" class="btn btn-primary">Terima</button>
			        </form>
            	</div>
        	</div>
        </div>
	</div>
	@endforeach
	@else
	<h5 style="margin-left:-15px">Belum Ada Permintaan Pesanan</h5>
	@endif
</div>
@endsection
@section('datatable')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
@endsection