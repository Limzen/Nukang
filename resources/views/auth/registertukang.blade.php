@extends('app')

@section('content')
<div class="container-fluid">	
	<div class="row" style="padding-top:20px;margin-top:20px">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="tengah">Daftar Sebagai Tukang</h2>
			<div class="panel-body">
				@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Terjadi Kesalahan!</strong> Terdapat Masalah Pada Inputan Anda<br><br>
					<ul>
						@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
				@endif
				<form class="form-horizontal" enctype="multipart/form-data" role="form" method="POST" action="{{ url('/auth/register') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="statuspengguna" value="2">
					<div class="row">
						<div class="col-md-2">
						</div>
						<div class="col-md-8">
							<div class="form-group">
								<label for="name">Nama Lengkap <font style="color:red">*</font></label>
								<input type="text" class="form-control" name="name" value="{{ old('name') }}" required="required">
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
								<label for="email">Email <font style="color:red">*</font></label>
								<input type="email" class="form-control" name="email" value="{{ old('email') }}" required="required">
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
								<label for="password">Kata Sandi <font style="color:red">*</font></label>
								<input type="password" class="form-control" name="password" required="required">
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
								<label for="password_confirmation">Ulang Kata Sandi <font style="color:red">*</font></label>
								<input type="password" class="form-control" name="password_confirmation" required="required">
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
								<label for="kategori">Kategori</label>
								<select class="form-control" name="kategori">
									@foreach($kategoritukang as $key => $value)
                            		<option value="{{ $value->id_kategoritukang }}">{{ $value->kategoritukang }}</option>
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
								<label for="deskripsi">Deskripsi Keahlian <font style="color:red">*</font></label>
								<textarea class="form-control" name="deskripsi"></textarea>
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
								<label for="pengalaman">Pengalaman Bekerja</label>
								<select class="form-control" name="pengalaman">
									@for ($i = 1; $i <= 51; $i++)
							    	<option value="{{$i}}">{{$i}} Tahun</option>
							    	@endfor
								</select>
							</div>
						</div>
						<div class="col-md-2">
						</div>
					</div>
					<div class="row">
					  <div class="col-md-2"></div>
					  <div class="col-md-8">
					    <div class="form-group">
					      <label>Upload Foto SIM Anda</label>
					      <input type="file" name="fotosim" class="form-control" accept=".jpg,.jpeg,.png">
					      <small class="text-muted">Format: JPG, PNG</small>
					    </div>
					  </div>
					  <div class="col-md-2"></div>
					</div>

					<div class="row">
					  <div class="col-md-2"></div>
					  <div class="col-md-8">
					    <div class="form-group">
					      <label>Upload Foto KTP Anda <span style="color:red">*</span></label>
					      <input type="file" name="fotoktp" class="form-control" accept=".jpg,.jpeg,.png" required>
					      <small class="text-muted">Format: JPG, PNG</small>
					    </div>
					  </div>
					  <div class="col-md-2"></div>
					</div>

					<div class="row">
					  <div class="col-md-2"></div>
					  <div class="col-md-8">
					    <div class="form-group">
					      <label>Upload Foto Anda <span style="color:red">*</span></label>
					      <input type="file" name="fotoprofil" class="form-control" accept=".jpg,.jpeg,.png" required>
					      <small class="text-muted">Format: JPG, PNG</small>
					    </div>
					  </div>
					  <div class="col-md-2"></div>
					</div>

					<div class="row">
					  <div class="col-md-2"></div>
					  <div class="col-md-8">
					    <div class="form-group">
					      <label>Upload Foto Hasil Pekerjaan Anda <span style="color:red">*</span></label>
					      <input type="file" name="fotohasilkerja" class="form-control" accept=".zip" required>
					      <small class="text-muted">Format: ZIP (berisi foto hasil pekerjaan)</small>
					    </div>
					  </div>
					  <div class="col-md-2"></div>
					</div>

					<div class="row">
						<div class="col-md-2">
						</div>
						<div class="col-md-8" style="margin-left:-15px">
							<input type="checkbox" name="verifikasi" required> Anda bersedia untuk mengikuti serangkaian verifikasi dan testing tim kami
						</div>
						<div class="col-md-2">
						</div>
					</div>
					<div class="row margintop20px">
						<div class="col-md-2">
						</div>
						<div class="col-md-8" style="padding:0px">
							<button type="submit" class="btn btn-primary" style="width:100%">SUBMIT</button>
						</div>
						<div class="col-md-2">
						</div>
					</div>
					<div class="row">
						<div class="col-md-2">
						</div>
						<div class="col-md-8" style="padding:0px">
							<h5>Apakah anda ingin mendaftar menjadi Pelanggan? Ayo <a href="{{url('auth/register')}}">Daftar Sebagai Pelanggan</a></h5>
						</div>
						<div class="col-md-2">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
