@extends('app')

@section('content')
<div class="container" style="padding-top:20px">
	@include('include/detailtukangtab')
	<div class="row" style="margin:0px;padding:0 10px 10px 10px;border:1px solid #5485e4">
		<h4>{{$tukang->deskripsikeahlian}}</h4>
	</div>
	<div class="row" style="padding-top:20px;padding-bottom: 30px">
		<center>
			<button type="button" class="btn btn-primary" href="#vendorboard" id="" data-toggle="modal">Pesan</button>
		</center>
	</div>
	@include('include/pesantukangharian')
</div>
@endsection