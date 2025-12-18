@extends('app')

@section('content')
<div class="container" style="margin-top:20px">
	<h2 class="tengah">Data Bahan Material</h2>
	<?php if(Session::has('message_success')): ?>
    <div class="alert alert-success" style="margin-top:10px">
        <?php echo Session::get('message_success')?>
    </div>
    <?php endif;?>
     <?php if(Session::has('message_failed')): ?>
    <div class="alert alert-danger" style="margin-top:10px">
        <?php echo Session::get('message_failed')?>
    </div>
    <?php endif;?>
	<div class="row">
		<div class="col-md-10">
		</div>
		<div class="col-md-2" style="text-align:right">
			<a href="{{url('databahanmaterial')}}/create" class="btn btn-primary">Tambah Data</a>
		</div>
	</div>
	<div class="row" style="margin:0px">
		<table id="exampleRiwayatTransaksi" class="table table-bordered" style="margin-top:10px;width:100%">
	        <thead class="primarycolor">
	            <tr>
	              	<th style="width:30px">No</th>
	              	<th>Kode Bahan</th>
	              	<th>Nama Bahan</th>
	              	<th>Harga Bahan</th>
	              	<th>Informasi Bahan</th>
	              	<th>Foto Bahan</th>
	              	<th>Status Bahan</th>
	              	<th></th>
	              	<th></th>
	              	<th></th>
	            </tr>
	        </thead>
	        <tbody>
	          	<?php $i = 1?>
		        @foreach($bahanmaterial as $key => $value)
	          	<tr>
	          		<td>{{$i}}</td>
	           	 	<td>{{$value->kodebahanmaterial}}</td>
	            	<td>{{$value->bahanmaterial}}</td>
	            	<td>{{number_format($value->hargabahanmaterial,2)}}</td>
	            	<td>{{$value->informasibahanmaterial}}</td>
	            	<td><a href="{{asset('images/fotobahanmaterial')}}/{{$value->fotobahanmaterial}}" target="_blank">Foto Bahan</a></td>
	            	<td>
	            		@if($value->statusbahanmaterial == "1")
	            		Tersedia
	            		@else
	            		Tidak Tersedia
	            		@endif
	            	</td>
	            	<td style="text-align:right;color:blue">
			          	<a href="{{url('databahanmaterial')}}/{{$value->id_bahanmaterial}}/ubahstatus">
			          		@if($value->statusbahanmaterial == "1")
			          		<i class="fa fa-times"></i>
			          		@else
			          		<i class="fa fa-check"></i>
			          		@endif
			          	</a>
			        </td>
	            	<td style="text-align:right;color:blue">
			          	<a href="{{url('databahanmaterial')}}/{{$value->id_bahanmaterial}}/edit"><i class="fa fa-edit"></i></a>
			        </td>
			        <td>
			        	<form method="POST" action="{{url('databahanmaterial')}}/{{$value->id_bahanmaterial}}" accept-charset="UTF-8">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input name="_method" type="hidden" value="DELETE">
							<button style="float:right" type="submit" class="notabutton"><i class="fa fa-trash"></i></button>
						</form>
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