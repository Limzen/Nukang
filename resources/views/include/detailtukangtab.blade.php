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
<center>
	<img src="{{ asset('images/fotoprofil') }}/{{$tukang->fotoprofil}}" class="img-responsive" style="border:1px solid black" width="160" height="160"> 
	<h3><b>{{$tukang->kodeuser}}</b></h3>
	<h4>{{$tukang->namatukang}}</h4>
	<h4>{{$tukang->alamat}}</h4>
	<h4><b>Rating:</b>
	 @include('include/bintang')
    </h4>
    <h4>Kategori: {{$tukang->kategoritukang}}</h4>
</center>
<div class="row" style="margin:0px;padding-top:20px">
	<ul class="nav nav-pills" style="background-color:##5485e4">
		<li class="{{ Request::is('caritukang/*/rincianbiaya') ? 'active' : '' }}"><a href="{{url('caritukang')}}/{{$idtukang}}/rincianbiaya">Rincian Biaya</a></li>
		<li class="{{ Request::is('caritukang/*/pengalamanbekerja') ? 'active' : '' }}"><a href="{{url('caritukang')}}/{{$idtukang}}/pengalamanbekerja">Pengalaman Bekerja</a></li>
		<li class="{{ Request::is('caritukang/*/deskripsikeahlian') ? 'active' : '' }}"><a href="{{url('caritukang')}}/{{$idtukang}}/deskripsikeahlian">Deskripsi Keahlian</a></li>
		<li class="{{ Request::is('caritukang/*/komentarpelanggan') ? 'active' : '' }}"><a href="{{url('caritukang')}}/{{$idtukang}}/komentarpelanggan">Komentar Pelanggan</a></li>
		<li class="{{ Request::is('caritukang/*/lokasi') ? 'active' : '' }}"><a href="{{url('caritukang')}}/{{$idtukang}}/lokasi">Lokasi</a></li>
	</ul>	
	<hr style="margin:0px;margin-top:5px">
</div>
