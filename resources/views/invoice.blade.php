<div class="container">
	<div class="row" style="margin:0px;padding:20px">
		<center>			<h2 style="color:orange"><u>Invoice Pemesanan</u></h2>
			<h3><b>Nomor Pemesanan: {{$value->nomorpemesanan}}</b></h3>	
			<h3><b>{{$value->kodeuser}}</b></h3>
			<h4>{{$value->namatukang}}</h4>
		    <h4>Kategori: {{$value->kategoritukang}}</h4>
		</center>
		<h4>Tanggal Kedatangan Tukang: {{$value->tanggalbekerja}}</h4>
		<h4>Alamat Pengerjaan: {{$value->alamatpemesanan}}</h4>
		<h4>Jenis Pemesanan: @include('include/harianorborongan')</h4>
		<h4>Jasa Yang Dipilih: {{$value->jenispemesanan}} (Rp. {{number_format($value->biayajasa,2)}})</h4>
		<h4>Biaya Pengantaran Bahan Material ({{$jarak}} Km x Rp. {{number_format($hargajarak->hargajarak,2)}}): Rp. {{number_format($jarak * $hargajarak->hargajarak,2)}}</h4>
		<h4>Catatan: {{$value->catatan}}</h4>
		<h4>Status Pemesanan: @include('include/statuspemesanan')</h4>
		<div class="row borderkotak" style="margin:0px">
			<h4><b>Bahan Material Yang Dibeli</b></h4>
			<hr>
			@if(count($pemesananbahan)==0)
			<h4><small>Belum Ada Bahan Material Yang Dibeli</small></h4>
			@else
			<?php $i=1?>
			@foreach($pemesananbahan as $key => $value)
			<h4>{{$i}}. {{$value->kodebahanmaterial}} ({{$value->bahanmaterial}}-Rp. {{number_format($value->hargapemesananbahanmaterial,2)}}) Sebanyak {{$value->qtypembelian}} Buah</h4>
			<?php $i++?>
			@endforeach
			@endif
		</div>
		<h4>Total Pemesanan (Biaya Tukang + Biaya Bahan Material + Biaya Pengantaran) = Rp. {{number_format($biayajasa + $totalkeranjang + ($jarak * $hargajarak->hargajarak),2)}}</h4>
	</div>
</div>