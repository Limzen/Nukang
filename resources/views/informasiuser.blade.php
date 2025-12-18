@extends('app')

@section('content')
<div class="container" style="margin-top:20px">
	<h2 class="tengah">Informasi User</h2>
	<div class="row" style="margin:0px">
		<table id="exampleRiwayatTransaksi" class="table table-bordered" style="margin-top:10px;width:100%">
	        <thead class="primarycolor">
	            <tr>
	              	<th style="width:30px">No</th>
	              	<th>Email</th>
	              	<th>Kode User</th>
	              	<th>Nomor Handphone</th>
	              	<th>Alamat</th>
	              	<th>Foto Profil</th>
	              	<th>Jenis User</th>
	              	<th>Status</th>
	              	<th></th>
	            </tr>
	        </thead>
	        <tbody>
	          	<?php $i=1?>
	          	@foreach($user as $key => $value)
	          	<tr>
	           	 	<td>{{$i}}</td>
	            	<td>{{$value->email}}</td>
	            	<td>{{$value->kodeuser}}</td>
	            	<td>{{$value->nomorhandphone}}</td>
	            	<td>{{$value->alamat}}</td>
	            	<td><a href="{{asset('images/fotoprofil')}}/{{$value->fotoprofil}}" target="_blank">Foto Profil</a></td>
	            	<td>
	            		@if($value->statuspengguna == "1")
	            		Pelanggan
	            		@elseif($value->statuspengguna == "2")
	            		Tukang
	            		@endif
	            	</td>
	            	<td>
	            		@if($value->statusverifikasi == "1")
	            		Aktif
	            		@elseif($value->statusverifikasi == "2")
	            		Blokir
	            		@endif
	            	</td>
	            	<td>
	            		@if($value->statusverifikasi == '1')
			        	<form method="POST" action="{{url('informasiuser')}}/blokir" accept-charset="UTF-8">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="iduser" value="{{$value->id}}">
							<button type="submit" class="btn btn-primary">Blokir</button>
						</form>
						@elseif($value->statusverifikasi == '2')
						<form method="POST" action="{{url('informasiuser')}}/buka" accept-charset="UTF-8">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="iduser" value="{{$value->id}}">
							<button type="submit" class="btn btn-primary">Buka</button>
						</form>
						@endif
	            	</td>
	          	</tr>
	          	<?php $i++?>
	          	@endforeach
	        </tbody>
	    </table>	
	</div>
</div>
@endsection
@section('datatable')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
@endsection