@extends('app')
@section('content')
<div class="container">
	<?php if(Session::has('message_success')): ?>
    <div class="alert alert-success" style="margin-top:10px">
        <?php echo Session::get('message_success')?>
    </div>
    <?php endif;?>
     <?php if(Session::has('message_failed')): ?>
    <div class="alert alert-danger" style="margin-top:10px">
        <?php echo Session::get('message_failed')?>
    </div>
    <?php endif;?>
	<div class="row" style="margin:0px;padding:20px">
		@if(Auth::user()->statuspengguna==2)
		<center>
			<h3><b>Nomor Pemesanan: {{$value->nomorpemesanan}}</b></h3>
			<img src="{{ asset('images/fotoprofil') }}/{{$value->fotoprofil}}" class="img-responsive" style="border:1px solid black" width="160" height="160"> 
			<h3><b>{{$value->kodeuser}}</b></h3>
			<h4>{{$value->namapelanggan}}</h4>
			<h4>Alamat: {{$value->alamat}}</h4>
		    <h4>Status Pemesanan: @include('include/statuspemesanan')</h4>

		    <a href="#" class="btn btn-primary"
			   data-toggle="modal"
			   data-target="#trackingProgressModal">
			    Tracking Progres Pekerjaan
			</a>
		</center>


			<!-- Modal -->
			<div class="modal fade" id="trackingProgressModal" tabindex="-1" role="dialog">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">

			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">
			          &times;
			        </button>
			        <h4 class="modal-title">Tracking Progres Pekerjaan</h4>
			      </div>
			      {{-- Notifikasi sukses --}}
					@if(session('success'))
					    <div class="alert alert-success">
					        {{ session('success') }}
					    </div>
					@endif

			      <div class="modal-body">
					<button class="btn btn-success" data-toggle="modal" data-target="#modalTambahProgress">
					    <i class="glyphicon glyphicon-plus"></i> Tambah Data Progress Pekerjaan
					</button>
					
					<div class="qa-message-list" id="wallmessages">

						@forelse($laporanprogress as $progress)
						  <div class="message-item">
						    <div class="message-inner">

						      {{-- HEADER --}}
						      <div class="message-head clearfix">


						        <div class="user-detail">
						          <h5 class="handle">{{ $progress->nama_tukang }}</h5>

						          <div class="post-meta">
						            <div class="asker-meta">
						              <span class="qa-message-when">
						                <span class="qa-message-when-data">
						                  {{ \Carbon\Carbon::parse($progress->tanggal_progress)->format('d M Y H:i') }}
						                </span>
						              </span>
						            </div>
						          </div>

						        </div>
						      </div>

						      {{-- CONTENT --}}
						      <div class="qa-message-content">
						        <p>{{ $progress->informasi_pekerjaan }}</p>

						        <div class="row">
						          @for($i = 1; $i <= 5; $i++)
						            @if(!empty($progress->{'fotoprogress'.$i}))
						              <div class="col-sm-3">
						                <img src="{{ asset('storage/'.$progress->{'fotoprogress'.$i}) }}"
						                     class="img-thumbnail"
						                     style="margin-bottom:10px;">
						              </div>
						            @endif
						          @endfor
						          <div class="pull-right">
							         <button type="button"
									        class="btn btn-xs btn-warning btn-open-edit"
									        data-id="{{ $progress->id_progress }}">
									    <i class="glyphicon glyphicon-edit"></i> Ubah
									</button>

							          <form action="{{ url('progress/'.$progress->id_progress.'/delete') }}"
							                method="POST"
							                style="display:inline;"
							                onsubmit="return confirm('Yakin hapus progress ini?')">
							            <input type="hidden" name="_token" value="{{ csrf_token() }}">
							            <button type="submit" class="btn btn-xs btn-danger">
							              <i class="glyphicon glyphicon-trash"></i> Hapus
							            </button>
							          </form>
							        </div>
						        </div>


						      </div>
						     
						    </div>
						  </div>

						@empty
						  <div class="alert alert-info text-center">
						    <strong>Belum Ada Progress Pekerjaan Yang Ditambahkan</strong>
						  </div>
						@endforelse

						</div>




			      </div>

			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">
			          Tutup
			        </button>
			      </div>

			    </div>
			  </div>
			</div>
			@foreach($laporanprogress as $progress)
			<div class="modal fade" id="modalEditProgress{{ $progress->id_progress }}" tabindex="-1">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">

			      <form action="{{ url('riwayatpemesanan/'.$value->id_pemesanan.'/update') }}"
			            method="POST"
			            enctype="multipart/form-data">

			        {{-- Laravel 5 pakai hidden --}}
			        <input type="hidden" name="_token" value="{{ csrf_token() }}">
			        <input type="hidden" name="id_progress" value="{{ $progress->id_progress }}">

			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Ubah Progres Pekerjaan</h4>
			        </div>

			        <div class="modal-body">

			          <div class="form-group">
			            <label>Tanggal</label>
			            <input type="datetime-local"
			                   name="tanggal_progress"
			                   class="form-control"
			                   value="{{ \Carbon\Carbon::parse($progress->tanggal_progress)->format('Y-m-d\TH:i') }}"
			                   required>
			          </div>

			          <div class="form-group">
			            <label>Isi Kegiatan</label>
			            <textarea name="informasi_pekerjaan"
			                      class="form-control"
			                      rows="5"
			                      required>{{ $progress->informasi_pekerjaan }}</textarea>
			          </div>

			          <div class="form-group">
					    <label>Foto Progress Pekerjaan</label>

					    <div class="row">
					        @for($i = 1; $i <= 5; $i++)
					        <div class="col-sm-3 text-center">

					            {{-- FLAG HAPUS --}}
					            <input type="hidden"
					                   name="hapus_foto{{ $i }}"
					                   id="hapus_foto_{{ $progress->id_progress }}_{{ $i }}"
					                   value="0">

					            {{-- PREVIEW BOX --}}
					            <div id="imagePreview_{{ $progress->id_progress }}_{{ $i }}" 
								     class="preview-box preview-box-{{ $progress->id_progress }}-{{ $i }}"
								     style="background-image: url('{{ 
								         !empty($progress->{'fotoprogress'.$i})
								            ? asset('storage/'.$progress->{'fotoprogress'.$i})
								            : asset('images/frontslider/addpicture.png')
								     }}')">
								      {{-- TOMBOL X --}}
					            @if($i != 1 && !empty($progress->{'fotoprogress'.$i}))
							    <span id="close_{{ $progress->id_progress }}_{{ $i }}" class="btn-remove"
							          onclick="hapusFotoEdit('{{ $progress->id_progress }}','{{ $i }}')">
							      &times;
							    </span>
							@endif
								</div>

								<input type="file"
								       id="uploadFile_{{ $progress->id_progress }}_{{ $i }}"
								       name="fotoprogress{{ $i }}"
								       class="file-input file-input-{{ $progress->id_progress }}-{{ $i }}"
								       accept="image/*"
								       onchange="previewImage(this, {{ $progress->id_progress }}, {{ $i }})">


					             


					        </div>
					        @endfor
					    </div>
					</div>


			        </div>

			        <div class="modal-footer">
			          <button type="submit" class="btn btn-warning">Submit</button>
			          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			        </div>

			      </form>

			    </div>
			  </div>
			</div>
			@endforeach
			<div class="modal fade" id="modalTambahProgress" tabindex="-1">
			  <div class="modal-dialog modal-lg">
			    <div class="modal-content">

			      <form action="{{ url('riwayatpemesanan') }}/{{$value->id_pemesanan}}/store" method="POST" enctype="multipart/form-data">
			        <input type="hidden" name="_token" value="{{ csrf_token() }}">

			        <div class="modal-header">
			          <button type="button" class="close" data-dismiss="modal">&times;</button>
			          <h4 class="modal-title">Tambah Progres Pekerjaan</h4>
			        </div>

			        <div class="modal-body">

			          <input type="hidden" name="id_pemesanan" value="{{ $idpemesanan }}">

			          <div class="form-group">
			            <label>Tanggal <font style="color:red">*</font></label>
			            <input type="datetime-local" name="tanggal_progress" class="form-control" required>
			          </div>

			          <div class="form-group">
			            <label>Isi Kegiatan Pekerjaan <font style="color:red">*</font></label>
			            <textarea name="informasi_pekerjaan" class="form-control" rows="5" required></textarea>
			          </div>

			        <div class="form-group">
					    <label>Upload Foto Progress Pekerjaan <font style="color:red">*</font></label>

					    <div class="row">
					        @for($i=1; $i<=5; $i++)
							<div class="col-sm-3 text-center">
							    <div id="imagePreview_0_{{ $i }}" 
							         class="preview-box preview-box-0-{{ $i }}"
							         style="background-image: url('{{ asset('images/frontslider/addpicture.png') }}')">
							    </div>

							    <input type="file"
							           id="uploadFile_0_{{ $i }}"
							           name="fotoprogress{{ $i }}"
							           class="file-input file-input-0-{{ $i }}"
							           accept="image/*"
							           onchange="previewImage(this, 0, {{ $i }})"
							           @if($i == 1) required @endif>
							</div>
							@endfor
					    </div>
					</div>


			        </div>

			        <div class="modal-footer">
			          <button type="submit" class="btn btn-primary">Submit</button>
			          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
			        </div>

			      </form>

			    </div>
			  </div>
			</div>
		<h4>Tanggal Kedatangan Penyedia Jasa Renovasi: {{$value->tanggalbekerja}}</h4>
		@if($value->kategoripemesanan == '1')
		<h4>Tanggal Selesai: {{$value->tanggalselesai}}</h4>
		@endif
		<h4>Alamat Pengerjaan: {{$value->alamatpemesanan}} <a href="{{url('riwayatpemesanan')}}/{{$value->id_pemesanan}}/lihatpeta" target="_blank">Lihat di Peta</a></h4>
		<h4>Jenis Pemesanan: @include('include/harianorborongan')</h4>
		<h4>Jasa Yang Dipilih: {{$value->jenispemesanan}} (Rp. {{number_format($value->biayajasa,2)}})</h4>
		@if($value->statuspemesanan != '0' && $value->statuspemesanan != '2')
		    <h4>
		        Biaya Pengantaran Bahan Material ({{$jarak}} Km x Rp. {{ number_format($hargajarak->hargajarak, 2) }}): 
		        Rp. {{ number_format($jarak * $hargajarak->hargajarak, 2) }}
		    </h4>
		@endif
		<h4>Catatan: {{$value->catatan}}</h4>
		@if($statuspemesanan=='2')
		<h4>Alasan Penolakan: {{$value->alasanpenolakanpemesanan}}<h4>
		@endif
		@if(Auth::user()->statuspengguna=="2" && $value->statuspemesanan == '3' && $value->statusubahharga == '0')
		<div class="row borderkotak" style="margin:0px;margin-bottom:20px">
		<form action="{{url('riwayatpemesanan')}}/{{$value->id_pemesanan}}/izinkan" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="col-md-4">
					<p>Izinkan Ubah Biaya Jasa</p>
					<button type="submit"class="btn btn-primary">Proses</button>
				</div>
			</form>
		</div>
		@endif
		<div class="row borderkotak" style="margin:0px">
			<h4><b>Keranjang Bahan Material</b></h4>
			<hr>
			@if(count($pemesananbahan)==0)
			<h4><small>Belum Ada Bahan Material Yang Dimasukkan Ke Keranjang</small></h4>
			@else
			<?php $i=1?>
			@foreach($pemesananbahan as $key => $value)
			<h4>{{$i}}. {{$value->kodebahanmaterial}} ({{$value->bahanmaterial}} - Rp.{{number_format($value->hargapemesananbahanmaterial,2)}}) <b>X{{$value->qtypembelian}}</b></h4>
			<?php $i++?>
			@endforeach
			@endif
		</div>
		@elseif(Auth::user()->statuspengguna=='1')
		<center>
			<h3><b>Nomor Pemesanan: {{$value->nomorpemesanan}}</b></h3>
			<img src="{{ asset('images/fotoprofil') }}/{{$value->fotoprofil}}" class="img-responsive" style="border:1px solid black" width="160" height="160"> 			
			@if($statuspemesanan=='3' && $value->tanggalbekerja >= date('Y-m-d'))
			<div class="row" style="margin:0px;margin-top:20px">
				<center>
					<form action="{{url('riwayatpemesanan')}}/{{$idpemesanan}}/selesaidikerjakan" method="POST">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="biayajasa" value="{{$value->biayajasa}}">
						<button type="submit" class="btn btn-primary">Selesai Dikerjakan</button>
					</form>
				</center>
			</div>
			@endif
			@if($statuspemesanan >= 3)
			<br>
			<a href="{{url('riwayatpemesanan')}}/{{$idpemesanan}}/invoice">Unduh Invoice</a>
			@endif
			@if($statuspemesanan == "4")
			<br>
			<center>Anda Belum Memberikan Rating, Silahkan Klik <a href="{{url('caritukang')}}/{{$value->id_tukang}}/komentarpelanggan" target="_blank">Berikan Rating</a></center>
			@endif
			<h3><b><a href="{{url('caritukang')}}/{{$value->id_tukang}}/rincianbiaya">{{$value->kodeuser}}</a></b></h3>
			<h4>{{$value->namatukang}}</h4>
			<h5><b>Rating:</b>
		       @include('include/bintang2')
		    </h5>
		    <h4>Kategori: {{$value->kategoritukang}}</h4>
		    <h4>Status Pemesanan: @include('include/statuspemesanan')</h4>
				</center>
				<center>
				 <a href="#" class="btn btn-primary"
					   data-toggle="modal"
					   data-target="#trackingProgressModal">
					    Tracking Progres Pekerjaan
					</a>
				</center>


			<!-- Modal -->
			<div class="modal fade" id="trackingProgressModal" tabindex="-1" role="dialog">
			  <div class="modal-dialog modal-lg" role="document">
			    <div class="modal-content">

			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal">
			          &times;
			        </button>
			        <h4 class="modal-title">Tracking Progres Pekerjaan</h4>
			      </div>
			      {{-- Notifikasi sukses --}}
					@if(session('success'))
					    <div class="alert alert-success">
					        {{ session('success') }}
					    </div>
					@endif

			      <div class="modal-body">
					
					
					<div class="qa-message-list" id="wallmessages">

						@forelse($laporanprogress as $progress)
						  <div class="message-item">
						    <div class="message-inner">

						      {{-- HEADER --}}
						      <div class="message-head clearfix">


						        <div class="user-detail">
						          <h5 class="handle">{{ $progress->nama_tukang }}</h5>

						          <div class="post-meta">
						            <div class="asker-meta">
						              <span class="qa-message-when">
						                <span class="qa-message-when-data">
						                  {{ \Carbon\Carbon::parse($progress->tanggal_progress)->format('d M Y H:i') }}
						                </span>
						              </span>
						            </div>
						          </div>

						        </div>
						      </div>

						      {{-- CONTENT --}}
						      <div class="qa-message-content">
						        <p>{{ $progress->informasi_pekerjaan }}</p>

						        <div class="row">
						          @for($i = 1; $i <= 5; $i++)
						            @if(!empty($progress->{'fotoprogress'.$i}))
						              <div class="col-sm-3">
						                <img src="{{ asset('storage/'.$progress->{'fotoprogress'.$i}) }}"
						                     class="img-thumbnail"
						                     style="margin-bottom:10px;">
						              </div>
						            @endif
						          @endfor
						        </div>


						      </div>
						     
						    </div>
						  </div>

						@empty
						  <div class="alert alert-info text-center">
						    <strong>Belum Ada Progress Pekerjaan Yang Ditambahkan</strong>
						  </div>
						@endforelse

						</div>




			      </div>

			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">
			          Tutup
			        </button>
			      </div>

			    </div>
			  </div>
			</div>
		<h4>Tanggal Kedatangan Penyedia Jasa Renovasi: {{$value->tanggalbekerja}}</h4>
		@if($value->kategoripemesanan == '1')
		<h4>Tanggal Selesai: {{$value->tanggalselesai}}</h4>
		@endif
		<h4>Alamat Pengerjaan: {{$value->alamatpemesanan}} <a href="{{url('riwayatpemesanan')}}/{{$value->id_pemesanan}}/lihatpeta" target="_blank">Lihat di Peta</a></h4>
		<h4>Jenis Pemesanan: @include('include/harianorborongan')</h4>
		<h4>Jasa Yang Dipilih: {{$value->jenispemesanan}} (Rp. {{number_format($value->biayajasa,2)}})</h4>
		@if($value->statuspemesanan != '0' && $value->statuspemesanan != '2')
		    <h4>
		        Biaya Pengantaran Bahan Material ({{$jarak}} Km x Rp. {{ number_format($hargajarak->hargajarak, 2) }}): 
		        Rp. {{ number_format($jarak * $hargajarak->hargajarak, 2) }}
		    </h4>
		@endif
		<h4>Catatan: {{$value->catatan}}</h4>
		@if($statuspemesanan=='1')
		<h5>(Silahkan Lakukan Pembelian Bahan Material, Jika Tidak Memerlukan Bahan Material, Silahkan Kosongkan Keranjang dan Tekan Proses)<h5>
		@elseif($statuspemesanan=='2')
		<h4>Alasan Penolakan: {{$value->alasanpenolakanpemesanan}}<h4>
		@endif
		@if(Auth::user()->statuspengguna=="1" && $value->statuspemesanan == '3' && $value->statusubahharga == '1')
		<div class="row borderkotak" style="margin:0px;margin-bottom:20px">
			<form action="{{url('riwayatpemesanan')}}/{{$value->id_pemesanan}}/ubahbiaya" method="POST">
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
				<div class="col-md-4">
					<p>Ubah Biaya Jasa</p>
					<input type="number" min="{{$value->biayajasa}}" class="form-control" name="biayajasaubah" value="{{$value->biayajasa}}">
				</div>
				<div class="col-md-2" style="padding-top:30px">
					<button type="submit"class="btn btn-primary">Proses</button>
				</div>
			</form>
		</div>
		@endif
		<div class="row borderkotak" style="margin:0px">
			<h4><b>Keranjang Bahan Material</b></h4>
			<hr>
			@if(count($pemesananbahan)==0)
			<h4><small>Belum Ada Bahan Material Yang Dimasukkan Ke Keranjang</small></h4>
			@else
			<?php $i=1?>
			@foreach($pemesananbahan as $key => $value)
			<h4>{{$i}}. {{$value->kodebahanmaterial}} ({{$value->bahanmaterial}} - Rp.{{number_format($value->hargapemesananbahanmaterial,2)}}) <b>X{{$value->qtypembelian}}</b>
				@if($value->statuspembelian != "1")
				<a href="{{url('riwayatpemesanan')}}/{{$idpemesanan}}/{{$value->id_pemesananbahanmaterial}}/hapus">Hapus</a>
				@endif
			</h4>
			<?php $i++?>
			@endforeach
			@endif
			@if($statuspemesanan=='1'  || $statuspemesanan=='3')
			<h4><b>Pilih Bahan Material Yang Diperlukan</b></h4>
			<hr>
			<div class="row" style="margin-bottom:10px">
				<form action="" method="GET">
				<div class="col-md-4">
					<p>Kategori</p>
					<select class="form-control" name="kategori" >
						<option value="all"
	                        {{ isset($_GET['kategori']) && $_GET['kategori'] == 'all' ? 'selected' : '' }}>
	                        Seluruh Kategori
	                    </option>
						@foreach($kategoritukang as $key => $value)
                		<option value="{{ $value->id_kategoritukang }}" <?php if($_GET['kategori'] == $value->id_kategoritukang) echo"selected"; ?>>{{ $value->kategoritukang }}</option>
               			@endforeach
					</select>
				</div>
				<div class="col-md-4">
					<p>Kata Kunci</p>
					<input type="text" class="form-control" name="katakunci">
				</div>
				<div class="col-md-2" style="padding-top:30px">
					<button type="submit"class="btn btn-primary">Cari</button>
				</div>
				</form>
			</div>
			<div class="row" style="margin-bottom:10px">
				@if(count($hasilpencarian)==0)
				<h4 style="margin-left:15px">Hasil Pencarian Bahan Material Tidak Ditemukan</h4>
				@else
				@foreach($hasilpencarian as $key => $value)
				<div class="col-md-3">
					@include('include/kotakbahanmaterial')
				</div>
				@endforeach
				@endif
			</div>
			@endif
		</div>
		@if($statuspemesanan=='1' || $statuspemesanan=='3')
		<div class="row" style="margin:0px;margin-top:20px">
			<center>
				<form action="{{url('riwayatpemesanan')}}/{{$idpemesanan}}/prosespembelian" method="POST">
					<input type="hidden" name="_token" value="{{ csrf_token() }}">
					<input type="hidden" name="totalkeranjang" value="{{$totalkeranjang}}">
					<input type="hidden" name="biayajarak" value="{{$jarak * $hargajarak->hargajarak}}">
					<button type="submit" class="btn btn-primary">Proses</button>
				</form>
			</center>
		</div>
		@endif
		@endif
	</div>
</div>

@endsection
