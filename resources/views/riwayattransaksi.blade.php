@extends('app')

@section('content')
<div class="container" style="margin-top:20px">
	<h2 class="tengah">Riwayat Transaksi</h2>
	<div class="row" style="margin:0px">
		<table id="exampleRiwayatTransaksi" class="table table-bordered" style="margin-top:10px;width:100%">
	        <thead class="primarycolor">
	            <tr>
	              	<th style="width:30px">No</th>
	              	<th>Kode Transaksi</th>
	              	<th>Tanggal Transaksi</th>
	              	<th>Nomor Rekening</th>
	              	<th>Nama Pemilik</th>
	              	<th>Jumlah Saldo</th>
	              	<th>Rekening Tujuan</th>
	              	<th>Jenis Transaksi</th>
	              	<th>Bukti Transaksi</th>
	              	<th>Status</th>
	            </tr>
	        </thead>
	        <tbody>
	        	<?php $i = 1?>
		        @foreach($riwayattransaksi as $key => $value)
	          	<tr>
	           	 	<td><?php echo $i;?></td>
	            	<td>{{$value->kode}}</td>
	            	<td>{{$value->created_at}}</td>
	            	<td>{{$value->rekening}}</td>
	            	<td>{{$value->namarekening}}</td>
	            	<td>Rp. {{number_format($value->jumlahsaldo,2)}}</td>
	            	<td>{{$value->rekeningtujuan}}</td>
	            	<td>{{$value->jenistransaksi}}</td>
	            	<td>
	            		@if($value->buktitransaksi != "")
	            		<a href="{{asset('images/buktitransfer')}}/{{$value->buktitransaksi}}" target="_blank">Bukti Transfer</a>
	            		@endif
	            	</td>
	            	<td>
	            		@include('include/statustransaksi')
	            	</td>
	          	</tr>
	        	<?php $i++;?>
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