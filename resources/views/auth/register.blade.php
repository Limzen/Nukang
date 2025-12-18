@extends('app')

@section('content')
<div class="container-fluid">	
	<div class="row" style="padding-top:20px;margin-top:20px">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="tengah" style="padding-bottom:20px;">Daftar Sebagai Pelanggan</h2>
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
				<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/register') }}">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="statuspengguna" value="1">
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
							<h5>Apakah anda ingin mendaftar menjadi penyedia jasa renovasi? Ayo <a href="{{url('auth/registertukang')}}">Daftar Sebagai Penyedia Jasa Renovasi</a></h5>
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
