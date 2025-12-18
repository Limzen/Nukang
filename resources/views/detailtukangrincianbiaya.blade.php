@extends('app')

@section('content')
<div class="container" style="padding-top:20px">
	@include('include/detailtukangtab')
	<div class="row" style="margin:0px;padding:0 10px 10px 10px;border:1px solid #5485e4">
		<h3><b>Harian</b></h3>
		<hr style="margin:0px">
		<?php $i=1;?>
		@foreach($jasatersediaharian as $key => $value)
		<h4>{{$i}}. {{$value->jenispemesanan}} (Rp. {{number_format($value->biayajasatersedia,2)}}/Hari)</h4>
		<?php $i++;?>
		@endforeach
		<h3><b>Borongan</b></h3>
		<hr style="margin:0px">
		<?php $i=1;?>
		@foreach($jasatersediaborongan as $key => $value)
		<h4>{{$i}}. {{$value->jenispemesanan}} (Rp. {{number_format($value->biayajasatersedia,2)}})</h4>
		<?php $i++;?>
		@endforeach
	</div>
	<div class="row" style="padding-top:20px;padding-bottom: 30px">
		<center>
			<button type="button" class="btn btn-primary" href="#vendorboard" id="" data-toggle="modal">Pesan</button>
		</center>
	</div>
	@include('include/pesantukangharian')
</div>
@endsection