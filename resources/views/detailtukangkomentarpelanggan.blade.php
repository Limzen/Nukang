@extends('app')

@section('content')
<div class="container" style="padding-top:20px">
	@include('include/detailtukangtab')
	<div class="row" style="padding:0 10px 10px 10px;border:1px solid #5485e4;margin:0px">
		@if(count($ulasan)=="0")
		<h4>Belum Ada Ulasan Pelanggan</h4>
		<hr style="margin-top:0px">
		@else
		@foreach($ulasan as $key => $value)
		<div class="row" style="padding:10px">
			<div class="col-md-2">
	            <div class="boxpictureriwayatpesanan">
	            	<img src="{{ asset('images/fotoprofil') }}/{{$value->fotoprofil}}" class="img-responsive" style="border:1px solid black"> 
	            </div>  
	        </div>
	        <div class="col-md-10" style="margin-top:-20px">
	            <h3><b>{{$value->namapelanggan}}</b></h3>
	            <h4 style="text-align:justify">
	            	@include('include/bintang3')
			    </h4>
	            <h4 style="text-align:justify"><b>Tanggal Komentar: {{$value->tanggalulasan}}</b></h4>
	            <h4 style="text-align:justify">{{$value->isiulasan}}</h4>
	        </div>
		</div>
	    <hr style="margin-top:0px">
	    @endforeach
	    @endif
	    @if(count($jumlahkomentar) != "0")
		<div class="row" style="padding:10px">
			<div class="col-md-4">
				<p>Jumlah Kuota Komentar: {{count($jumlahkomentar)}}</p>
				
			</div>
		</div>
		<form action="" method="POST">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
	 		<input type="hidden" name="idpemesanan" value="{{$jumlahkomentar[0]['id_pemesanan']}}">
	 		<div class="row" style="padding:10px">
				<div class="col-md-4">
					<p>Berikan Rating</p>
				  	<select class="form-control" name="nilairating">
	               		@for ($i = 1; $i <= 5; $i++)
	               		<option value="{{$i}}">{{$i}} Bintang</option>
	               		@endfor
	               	</select>
				</div>
			</div>
			<div class="row" style="padding:10px">
				<div class="col-md-12">
					<p>Isi Ulasan</p>
					<textarea class="form-control" style="height:100px" name="isiulasan" required></textarea>
				</div>
			</div>
			<div class="row" style="padding-top:10px;float:right;padding-right:25px">
				<button type="submit" class="btn btn-primary">Submit</button>
			</div>
		</form>
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