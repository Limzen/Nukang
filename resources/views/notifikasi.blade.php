@extends('app')

@section('content')
<div class="container">
	<div class="row" style="padding:20px;">
		<h2 class="tengah">NOTIFIKASI</h2>
		<?php if(Session::has('message_success')): ?>
	    <div class="alert alert-success">
	       	<?php echo Session::get('message_success')?>
	    </div>
	    <?php endif;?>
	    <?php if(Session::has('message_failed')): ?>
	    <div class="alert alert-danger" style="margin-bottom:10px;">
	        <?php echo Session::get('message_failed')?>
	    </div>
	    <?php endif;?>
		<h3>Notifikasi Belum Dibaca</h3>
		<div class="row" style="border-top:1px solid #f0eeee">
			@if(count($notifunread)!=0)
			<ul class="list-unstyled">
				<?php $i=1;?>
				@foreach($notifunread as $key => $value)
				<li><h5 style="line-height:30px;text-align:justify"><h5><b><?php echo $i?>. User dengan kode {{$value->kodeuser}} {{$value->isinotifikasi}}</b></h5></li>
				&nbsp&nbsp&nbsp&nbspTanggal Notifikasi : <small class="text-muted">{{$value->tanggalnotifikasi}}</small>
				<br><br>&nbsp&nbsp&nbsp&nbsp<a href="{{url($value->jenisnotifikasi)}}">Lihat Selengkapnya</a> | <a href="{{url('notifikasi')}}/{{$value->id_notifikasi}}/markasread">Tandai Sudah Dibaca</a>
				<?php $i++?>
				@endforeach
			</ul>
			<center>
			<?php echo $notifunread->render();?>
			</center>
			@else
			<h4 style="padding-bottom:20px;padding-left:18px"><small>Belum Ada Notifikasi</small></h4>
			@endif
		</div>
		<h3>Notifikasi Sudah Dibaca</h3>
		<div class="row" style="border-top:1px solid #f0eeee">
			@if(count($notifread)!=0)
			<ul class="list-unstyled">
				<?php $i=1;?>
				@foreach($notifread as $key => $value)
				<li><h5 style="line-height:30px;text-align:justify"><b><?php echo $i?>. User dengan kode {{$value->kodeuser}} {{$value->isinotifikasi}}</b></h5></li>
				&nbsp&nbsp&nbsp&nbspTanggal Notifikasi : <small class="text-muted">{{$value->tanggalnotifikasi}}</small>
				<br><br>&nbsp&nbsp&nbsp&nbsp<a href="{{url($value->jenisnotifikasi)}}">Lihat Selengkapnya</a>
				<?php $i++?>
				@endforeach
			</ul>
			<center>
			<?php echo $notifread->render();?>
			</center>
			@else
			<h4 style="padding-bottom:20px;padding-left:18px"><small>Belum Ada Notifikasi</small></h4>
			@endif
		</div>
	</div>
</div>
@endsection