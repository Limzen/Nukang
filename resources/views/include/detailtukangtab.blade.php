<?php if(Session::has('message_success') && false): ?>{{-- Shown in app.blade.php --}}
<div class="alert alert-success">
   	<?php echo Session::get('message_success')?>
</div>
<?php endif;?>
<?php if(Session::has('message_failed') && false): ?>{{-- Shown in app.blade.php --}}
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
		<li class="{{ Request::is('cari-tukang/*/rincian-biaya') ? 'active' : '' }}"><a href="{{url('cari-tukang')}}/{{$idtukang}}/rincian-biaya">Rincian Biaya</a></li>
		<li class="{{ Request::is('cari-tukang/*/pengalaman-bekerja') ? 'active' : '' }}"><a href="{{url('cari-tukang')}}/{{$idtukang}}/pengalaman-bekerja">Pengalaman Bekerja</a></li>
		<li class="{{ Request::is('cari-tukang/*/deskripsi-keahlian') ? 'active' : '' }}"><a href="{{url('cari-tukang')}}/{{$idtukang}}/deskripsi-keahlian">Deskripsi Keahlian</a></li>
		<li class="{{ Request::is('cari-tukang/*/komentar-pelanggan') ? 'active' : '' }}"><a href="{{url('cari-tukang')}}/{{$idtukang}}/komentar-pelanggan">Komentar Pelanggan</a></li>
		<li class="{{ Request::is('cari-tukang/*/lokasi') ? 'active' : '' }}"><a href="{{url('cari-tukang')}}/{{$idtukang}}/lokasi">Lokasi</a></li>
	</ul>	
	<hr style="margin:0px;margin-top:5px">
</div>
