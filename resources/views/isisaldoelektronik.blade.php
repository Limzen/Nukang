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
	<h2 class="tengah">Isi Saldo</h2>
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
						<input type="number" class="form-control" name="jumlahsaldouser" required="required">
					</div>
				</div>
				<div class="col-md-3">
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="nomorrekening">Nomor Rekening Anda <font style="color:red">*</font></label>
						<input type="number" class="form-control" name="nomorrekeninganda" required="required" value="{{Auth::user()->nomorrekening}}">
					</div>
				</div>
				<div class="col-md-3">
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="namapemilik">Nama Pemilik Rekening <font style="color:red">*</font></label>
						<input type="text" class="form-control" name="namapemilik" required="required" value="{{Auth::user()->namapelanggan}}">
					</div>
				</div>
				<div class="col-md-3">
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="rekeningtujuan">Rekening Tujuan <font style="color:red">*</font></label>
						<select class="form-control" name="nomorrekening">
							<option value="BCA - 8305123456">BCA - 8305123456 A/N KEVIN LIANG</option>
							<option value="Mandiri - 123456789011">Mandiri - 123456789011 A/N KEVIN LIANG</option>
							<option value="Panin - 6789101234455">Panin - 6789101234455 A/N KEVIN LIANG</option>
							<option value="BRI - 445566778888000">BRI - 445566778888000 A/N KEVIN LIANG</option>
							<option value="Danamon - 894215215111434">Danamon - 894215215111434 A/N KEVIN LIANG</option>
						</select>
					</div>
				</div>
				<div class="col-md-3">
				</div>
			</div>
			<div class="row">
				<div class="col-md-3">
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="upload">Upload Bukti Transfer <font style="color:red">*</font></label>
						<input type="file" class="form-control" name="buktitransfer" required="required"/>
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
