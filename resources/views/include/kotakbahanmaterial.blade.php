<form action="{{url('riwayatpemesanan')}}/{{$idpemesanan}}/{{$value->id_bahanmaterial}}/masukkeranjang" method="POST">
	<input type="hidden" name="_token" value="{{ csrf_token() }}">
	<input type="hidden" name="hargapemesanan" value="{{$value->hargabahanmaterial}}">
	<div class="box">
	    <img src="{{ asset('images/fotobahanmaterial') }}/{{$value->fotobahanmaterial}}" class="img-responsive"/>
	</div>
	<div class="info">
	    <h4 class="center"><b>{{$value->bahanmaterial}}</b></h4>
	    <h4 class="center" style="border-bottom:1px solid gray"><b>Rp. {{number_format($value->hargabahanmaterial,2)}}</h4>
	    <h4>Informasi:</h4>
	    <h5>{{$value->informasibahanmaterial}}</h5>
	    <h4>Kuantiti:</h4>
	    <input type="number" value="1" class="form-control" max="99" name="qty">
	</div>
	<button type="submit" class="btn btn-primary" style="width:100%">Pesan</button>
</form>