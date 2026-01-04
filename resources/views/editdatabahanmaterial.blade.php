@extends('app')

@section('content')
<div class="container-fluid">			
	<div class="row" style="padding-top:20px">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="tengah" style="padding-bottom:20px">Edit Data Bahan Material</h2>
				<div class="panel-body">
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
					<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="{{url('databahanmaterial')}}/{{$bahanmaterial->id_bahanmaterial}}">
						<input name="_method" type="hidden" value="PUT">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<label for="kategori">Kategori</label>
									<select class="form-control" name="kategoritukang">
										@foreach($kategoritukang as $key => $value)
	                            		<option value="{{ $value->id_kategoritukang }}" <?php if ($bahanmaterial->id_kategoritukang == $value->id_kategoritukang) echo "selected"?>>{{ $value->kategoritukang }}</option>
	                           			@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="form-group">
								    <label for="namabahan">Nama Bahan <font style="color:red">*</font></label>
									<input type="text" class="form-control" name="namabahan" required="required" value="{{$bahanmaterial->bahanmaterial}}">
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="form-group">
								    <label for="hargabahan">Harga Bahan <font style="color:red">*</font></label>
									<input type="number" class="form-control" name="hargabahanmaterial" required="required" value="{{$bahanmaterial->hargabahanmaterial}}">
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="form-group">
								    <label for="informasibahan">Informasi Bahan <font style="color:red">*</font></label>
									<textarea class="form-control" name="informasibahanmaterial" required="required">{{$bahanmaterial->informasibahanmaterial}}</textarea>
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="form-group">
								    <label for="upload">Upload Foto Bahan Material</label><br>
									<img src="{{asset('images/fotobahanmaterial')}}/{{$bahanmaterial->fotobahanmaterial}}" stye="width:150px">
									<input type="hidden" name="oldfile" value="{{$bahanmaterial->fotobahanmaterial}}">
									<input type="file" class="form-control" name="fotobahanmaterial">
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8" style="padding:0px">
								<button type="submit" class="btn btn-primary" style="width:100%">SUBMIT</button>
							</div>
							<div class="col-md-2">
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection