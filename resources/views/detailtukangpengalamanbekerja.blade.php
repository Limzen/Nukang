@extends('app')

@section('content')
<div class="container" style="padding-top:20px">
	@include('include/detailtukangtab')
	<div class="row" style="margin:0px;padding:0 10px 10px 10px;border:1px solid #5485e4">
		<h3><b>Riwayat Pengalaman Bekerja</b></h3>
		<hr style="margin:0px">
		<?php
		$k=1;
		$hasilpotongan3 = explode("~", $tukang->pengalamanbekerja);
		?>
		@if($tukang->pengalamanbekerja != "")
			@for ($i = 0; $i < count($hasilpotongan3); $i++)
			<h4>{{$k}}. {{$hasilpotongan3[$i]}}</h4>
			<?php $k++;?>
			@endfor
		@else
			<h4>Belum Ada Pengalaman</h4>
		@endif
		
		<h3><b>Lama Pengalaman Bekerja</b></h3>
		<hr style="margin:0px">
		<h4>{{$tukang->lamapengalamanbekerja}} Tahun</h4>
		<h3><b>Foto Hasil Kerja (Yang Sudah Selesai Dikerjakan)</b></h3>
		<hr style="margin:0px">

		@if(!empty($tukang->fotohasilkerja))
		    <div style="margin-top:15px">
		        <a href="{{ asset('files/hasil_pekerjaan/'.$tukang->fotohasilkerja) }}"
		           class="btn btn-outline-primary"
		           download>
		            <i class="fa fa-file-archive-o"></i>
		            Unduh Hasil Kerja (ZIP)
		        </a>
		    </div>
		@else
		    <h4>Belum Ada Hasil Kerja</h4>
		@endif

	</div>
	<div class="row" style="padding-top:20px;padding-bottom: 30px">
		<center>
			<button type="button" class="btn btn-primary" href="#vendorboard" id="" data-toggle="modal">Pesan</button>
		</center>
	</div>
	@include('include/pesantukangharian')
</div>
@endsection