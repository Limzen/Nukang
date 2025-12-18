@extends('app')

@section('content')
<div class="container" style="margin-top:20px">
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
	<h2 class="tengah">Data Kategori Tukang</h2>
	<div class="row">
		<div class="col-md-10">
		</div>
		<div class="col-md-2" style="text-align:right">
			<a href="{{url('datakategoritukang')}}/create" class="btn btn-primary">Tambah Data</a>
		</div>
	</div>
	<div class="row" style="margin:0px">
		<table id="exampleRiwayatTransaksi" class="table table-bordered" style="margin-top:10px;width:100%">
	        <thead class="primarycolor">
	            <tr>
	              	<th style="width:30px">No</th>
	              	<th>Kategori Tukang</th>
	              	<th></th>
	              	<th></th>
	            </tr>
	        </thead>
	        <tbody>
	          	<?php $i = 1?>
		        @foreach($kategoritukang as $key => $value)
	          	<tr>
	           	 	<td>{{$i}}</td>
	            	<td>{{$value->kategoritukang}}</td>
	            	<td style="text-align:right;color:blue">
			          	<a href="{{url('datakategoritukang')}}/{{$value->id_kategoritukang}}/edit"><i class="fa fa-edit"></i></a>
			        </td>
			        <td>
			        	<form method="POST" action="{{url('datakategoritukang')}}/{{$value->id_kategoritukang}}" accept-charset="UTF-8">
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