@extends('app')

@section('content')
<div class="container-fluid" style="padding:25px;margin-top:50px">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="tengah">MASUK</h2>
			@if (count($errors) > 0)
				<div class="alert alert-danger">
					<strong>Terjadi Kesalahan!</strong><br><br>
					<ul>
						@foreach ($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>
				</div>
			@else
				<?php if(Session::has('success')): ?>
				<div class="message-success" style="margin-bottom:10px;">
					 <?php echo Session::get('success')?>
				</div>
				<?php endif;?>
			@endif
			<form class="form-horizontal" style="margin-top:50px" role="form" method="POST" action="{{ url('/auth/login') }}">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="row">
					<div class="col-md-2">
					</div>
					<div class="col-md-8">
						<div class="form-group">
						    <label for="email">Alamat Email</label>
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
						    <label for="password">Kata Sandi</label>
						    <input type="password" class="form-control" name="password" required="required">
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
						<h5>Belum mempunyai akun? Ayo daftar sebagai <a href="{{url('auth/registertukang')}}">Penyedia Jasa Renovasi</a> atau <a href="{{url('auth/register')}}">Pelanggan</a></h5>
					</div>
					<div class="col-md-2">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
