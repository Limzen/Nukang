@extends('app')

@section('content')
<div class="container-fluid">			
	<div class="row" style="padding-top:20px">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="tengah" style="padding-bottom:20px">Pengaturan Jasa & Keahlian</h2>
				<div class="panel-body">
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
				    <?php
					$hasilpotongan3 = explode("~", Auth::user()->pengalamanbekerja);
					?>
					<form class="form-horizontal" role="form" method="POST" action="">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<label for="jenispemesanan">Jenis Pemesanan Yang Diterima</label>
									<div class="row">
										<div class="col-md-3">
											<select class="form-control" name="kategoripemesanan" id="kategoripemesanan">
												<option value="0">Harian</option>
												<option value="1">Borongan</option>
											</select>
										</div>
										<div class="col-md-4">
											<select class="form-control" name="jenispemesanan" id="kurikulumjp">
												@foreach($jenispemesanan as $key => $value)
			                            		<option value="{{ $value->id_jenispemesanan }}">{{ $value->jenispemesanan }}</option>
			                           			@endforeach
											</select>
										</div>
										<div class="col-md-3">
											<input type="number" class="form-control" id="kurikulumbox" placeholder="Biaya Jasa">
										</div>
										<div class="col-md-2">
											<button type="button" class="btn btn-primary" id="tambahkurikulum">Tambah</a>
										</div>
									</div>
									<h5><b>List Pemesanan Yang Diterima</b></h5>
									<h5 style="border-bottom:1px solid black">Harian</h5>
									<div id="kurikulumdiv">
										<?php $i=0;?>
										@foreach($jasatersediaharian as $key => $value)
										<h5 id="kurikulumrow{{$i+1}}">- {{$value->jenispemesanan}} (Rp. {{number_format($value->biayajasatersedia,2)}}) <a style="cursor:pointer" class="hapuskurikulum" id="{{$i+1}}">Hapus</a></h5>
										<input id="kurikulumhidden{{$i+1}}" type="hidden" value="{{$value->biayajasatersedia}}" name="kurikulum[]">
										<input id="kurikulumhiddenjp{{$i+1}}" type="hidden" value="{{$value->id_jenispemesanan}}" name="kurikulumjp[]">
										<?php $i++;?>
										@endforeach
									</div>
									<h5 style="border-bottom:1px solid black">Borongan</h5>
									<div id="kurikulumdiv2">
										<?php $i=0;?>
										@foreach($jasatersediaborongan as $key => $value)
										<h5 id="kurikulumrow2{{$i+1}}">- {{$value->jenispemesanan}} (Rp. {{number_format($value->biayajasatersedia,2)}}) <a style="cursor:pointer" class="hapuskurikulum2" id="{{$i+1}}">Hapus</a></h5>
										<input id="kurikulumhidden2{{$i+1}}" type="hidden" value="{{$value->biayajasatersedia}}" name="kurikulum2[]">
										<input id="kurikulumhiddenjp2{{$i+1}}" type="hidden" value="{{$value->id_jenispemesanan}}" name="kurikulumjp2[]">
										<?php $i++;?>
										@endforeach
									</div>
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
									<label for="pengalaman">Pengalaman Bekerja</label>
									<div class="row">
										<div class="col-md-10">
											<input type="text" class="form-control" id="kurikulumbox3" >
										</div>
										<div class="col-md-2">
											<button type="button" class="btn btn-primary" id="tambahkurikulum3">Tambah</a>
										</div>
									</div>
									<h5><b>List Pengalaman Bekerja</b></h5>
									<div id="kurikulumdiv3">
										@if(Auth::user()->pengalamanbekerja != "")
											@for ($i = 0; $i < count($hasilpotongan3); $i++)
											<h5 id="kurikulumrow3{{$i+1}}">- {{$hasilpotongan3[$i]}} <a style="cursor:pointer" class="hapuskurikulum3" id="{{$i+1}}">Hapus</a></h5>
											<input id="kurikulumhidden3{{$i+1}}" type="hidden" value="{{$hasilpotongan3[$i]}}" name="kurikulum3[]">
											@endfor
										@endif
									</div>
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
									<label for="lamapengalaman">Lama Pengalaman Bekerja <font style="color:red">*</font></label>
									<select class="form-control" name="pengalaman">
									@for ($i = 1; $i <= 50; $i++)
							    	<option <?php if (Auth::user()->pengalamanbekerja == $i) echo "selected"?> value="{{$i}}">{{$i}} Tahun</option>
							    	@endfor
								</select>
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
									<label for="keahlian">Deskripsi Keahlian <font style="color:red">*</font></label>
									<textarea class="form-control" name="deskripsi">{{Auth::user()->deskripsikeahlian}}</textarea>
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<div class="row" style="padding-top:20px">
							<div class="col-md-2">
							</div>
							<div class="col-md-8" style="padding:0px">
								<button type="submit" class="btn btn-primary" style="width:100%">SUBMIT</button>
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