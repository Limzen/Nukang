@extends('app')

@section('content')
<div class="container-fluid">			
	<div class="row" style="padding-top:20px">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="tengah" style="padding-bottom:20px">Ubah Harga Jarak</h2>
				<div class="panel-body">
					<?php if(Session::has('message_success')): ?>
				    <div class="message-success">
				       	<?php echo Session::get('message_success')?>
				    </div>
				    <?php endif;?>
				    <?php if(Session::has('message_failed')): ?>
				    <div class="message-failed" style="margin-bottom:10px;">
				        <?php echo Session::get('message_failed')?>
				    </div>
				    <?php endif;?>
					<form class="form-horizontal" role="form" method="POST" action="" style="margin-top:10px;" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="form-group">
								    <label for="hargajarak">Harga Jarak <font style="color:red">*</font></label>
									<input type="number" class="form-control" name="hargajarak" value="{{$hargajarak->hargajarak}}" required="required">
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8" style="padding:0px">
								<button type="submit" name="store_btn" class="btn btn-primary" style="width:100%">SUBMIT</button>
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