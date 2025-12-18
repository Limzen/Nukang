@extends('app')
@section('content')
<div class="container">
	<div class="row" style="margin:0px;padding:20px">
		<center>
			<h3><b>Nomor Pemesanan: {{$value->nomorpemesanan}}</b></h3>
		</center>
		<div class="row">
			<div class="col-md-6">
				<div class="col-md-4">
					<img src="{{ asset('images/fotoprofil') }}/{{$value->fotoprofil}}" class="img-responsive" style="border:1px solid black"> 
				</div>
				<div class="col-md-8">
					<h3><b>{{$value->kodeuser}}</b></h3>
					<h4>{{$value->namapelanggan}}</h4>
					<h4>Alamat: {{$value->alamat}}</h4>
				</div>
			</div>
			<div class="col-md-6">
				<div class="col-md-8" style="text-align:right">
					<h3><b>{{$tukang->kodeuser}}</b></h3>
					<h4>{{$tukang->namatukang}}</h4>
					<h5><b>Rating:</b>
				        @include('include/bintang')
				    </h5>
				    <h4>Kategori: {{$tukang->kategoritukang}}</h4>
				</div>
				<div class="col-md-4">
					<img src="{{ asset('images/fotoprofil') }}/{{$tukang->fotoprofil}}" class="img-responsive" style="border:1px solid black"> 
				</div>
			</div>
		</div>
		<h4>Status Pemesanan: @include('include/statuspemesanan')</h4>
	   	<h4>Tanggal Kedatangan Tukang: {{$value->tanggalbekerja}}</h4>
		<h4>Alamat Pengerjaan: {{$value->alamatpemesanan}} <a href="{{url('riwayatpemesanan')}}/{{$value->id_pemesanan}}/lihatpeta" target="_blank">Lihat di Peta</a></h4>
		<h4>Jenis Pemesanan: @include('include/harianorborongan')</h4>
		<h4>Jasa Yang Dipilih: {{$value->jenispemesanan}} (Rp. {{number_format($value->biayajasa,2)}})</h4>
		<h4>Biaya Pengantaran Bahan Material ({{$jarak}} Km x Rp. {{number_format($hargajarak->hargajarak,2)}}): Rp. {{number_format($jarak * $hargajarak->hargajarak,2)}}</h4>
		<h4>Catatan: {{$value->catatan}}</h4>
		<h4>Alasan Penolakan: {{$value->alasanpenolakanpemesanan}}</h4>
		<div class="row borderkotak" style="margin:0px">
			<h4><b>Keranjang Bahan Material</b></h4>
			<hr>
			@if(count($pemesananbahan)==0)
			<h4><small>Belum Ada Bahan Material Yang Dimasukkan Ke Keranjang</small></h4>
			@else
			<?php $i=1?>
			@foreach($pemesananbahan as $key => $value)
			<h4>{{$i}}. {{$value->kodebahanmaterial}} ({{$value->bahanmaterial}} - Rp.{{number_format($value->hargapemesananbahanmaterial,2)}}) <b>X{{$value->qtypembelian}}</b></h4>
			<?php $i++?>
			@endforeach
			@endif
		</div>
	</div>
</div>
@endsection