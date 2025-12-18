@extends('app')

@section('content')
<div class="container">
	<div class="row" style="padding-top:20px">
		<div class="col-md-3">
		</div>
		<div class="col-md-6 borderkotak tengah">
			<h4>Saldo Elektronik Anda Rp. {{number_format(Auth::user()->saldo,2)}}</h4>
		</div>
		<div class="col-md-3">
		</div>
	</div>
	<h2 class="tengah">Penarikan Saldo</h2>
	<h5 class="tengah"><b>Catatan: Setiap Penarikan Saldo Akan Dikenakan Biaya Admin Sebesar 5% dan Minimal Penarikan Saldo Adalah Rp. 20,000.00</b></h5>
	<div class="row" style="margin-top:40px;margin-bottom:40px;padding:20px">
		<?php if(Session::has('message_success')): ?>
        <div class="alert alert-success" style="margin-bottom:20px;">
            <?php echo Session::get('message_success')?>
        </div>
        <?php endif;?>
        <?php if(Session::has('message_failed')): ?>
            <div class="alert alert-danger" style="margin-bottom:20px;">
                <?php echo Session::get('message_failed')?>
            </div>
        <?php endif;?>
		<form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="jumlahsaldo">Jumlah Saldo <font style="color:red">*</font></label>
						<input type="number" min="20000" class="form-control" name="jumlahsaldouser" required="required">
					</div>
				</div>
				<div class="col-md-3">
				</div>
			<div class="row">
			</div>
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="rekeninganda">Rekening Anda <font style="color:red">*</font></label>
						<input type="number" class="form-control" name="rekeninganda" required="required" value="{{Auth::user()->nomorrekening}}">
					</div>
				</div>
				<div class="col-md-3">
				</div>
			</div>
			<div class="row margintop20px">
				<div class="col-md-3">
				</div>
				<div class="col-md-6" style="padding:0px">
					<button type="submit" class="btn btn-primary" style="width:100%">SUBMIT</button>
				</div>
				<div class="col-md-3">
				</div>
			</div>
		</form>
	</div>
</div>
@endsection
