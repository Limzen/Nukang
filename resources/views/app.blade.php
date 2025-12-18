<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Marketplacetukang.com</title>

	<link href="{{ asset('/css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/btn-icon.css') }}" rel="stylesheet">
	<link href="{{ asset('/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
	

</head>
<body style="width:100%;background: url({{asset('images/frontslider/background.jpg')}}) no-repeat center center fixed;background-size: cover;">
	@if(Request::is('home') && Auth::user()->statuspengguna == '1' || Request::is('/'))
	<section class="header">
	@else
	<section class="header" style="height:32vh">
	@endif
	    <div class="overlay">
	        <div class="row" style="margin-right:0px">
	           <div class="navbar navbar-default">
	              <div class="container" style="padding:20px">
	                <!-- Brand and toggle get grouped for better mobile display -->
	                <div class="navbar-header">
	                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
	                    <span class="sr-only">Toggle navigation</span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                    <span class="icon-bar"></span>
	                  </button>
	                    <div class="navlogo col-lg-2">
	                        <a class="navbar-brand" href="/"><img style="margin-top:-10px;width:40px" src="{{ asset('images/frontslider/logo.png') }}"></a>
	                    </div>
	                  
	                </div>

	                <!-- Collect the nav links, forms, and other content for toggling -->
	                  
	                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
	                   	<div class="col-lg-10">
	                         <ul class="nav navbar-nav">
								@if(Auth::guest())
								<li><a href="/" style="{{ Request::is('/') ? 'color:white;background-color:#11b360' : 'color:white' }}">Beranda</a></li>
								@elseif(Auth::user()->statuspengguna=="1")
								<li><a href="{{url('/')}}" style="{{ Request::is('/') || Request::is('home') ? 'color:white;background-color:#11b360' : 'color:white' }}">Beranda</a></li>
								<li><a href="{{ url('caritukang?kategori=all&jarak=10') }}" style="{{ Request::is('caritukang') || Request::is('caritukang/*') ? 'color:white;background-color:#11b360' : 'color:white' }}">Pencarian Penyedia Jasa Renovasi</a></li>
								@else
									@if(Auth::user()->statuspengguna=="2")
									<li><a href="/" style="{{ Request::is('/') || Request::is('home') ? 'color:white;background-color:#11b360' : 'color:white' }}">Beranda</a></li>
									<li><a href="{{url('permintaanpesanan')}}" style="{{ Request::is('/') || Request::is('permintaanpesanan') ? 'color:white;background-color:#11b360' : 'color:white' }}">Permintaan Pesanan ({{$totalpermintaan}})</a></li>
									@else
									<li><a href="{{url('home')}}" style="{{ Request::is('home') ? 'color:white;background-color:#11b360' : 'color:white' }}">Verifikasi Tukang</a></li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="{{ Request::is('databahanmaterial') || Request::is('datajenispemesanan') || Request::is('datakategoritukang') || Request::is('databahanmaterial/*') || Request::is('datajenispemesanan/*') || Request::is('datakategoritukang/*') ? 'color:white;background-color:#11b360' : 'color:white' }}">Data Master <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="{{url('databahanmaterial')}}" style="{{ Request::is('databahanmaterial') || Request::is('databahanmaterial/*') ? 'color:white;background-color:#11b360' : 'color:black' }}">Data Bahan Material</a></li>
											<li><a href="{{url('datajenispemesanan')}}" style="{{ Request::is('datajenispemesanan') || Request::is('datajenispemesanan/*') ? 'color:white;background-color:#11b360' : 'color:black' }}">Data Jenis Pemesanan</a></li>
											<li><a href="{{url('datakategoritukang')}}" style="{{ Request::is('datakategoritukang') || Request::is('datakategoritukang/*') ? 'color:white;background-color:#11b360' : 'color:black' }}">Data Kategori Tukang</a></li>
										</ul>
									</li>
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="{{ Request::is('riwayattransaksi') || Request::is('riwayatpenyewaan') || Request::is('riwayatpenyewaan/*') ? 'color:white;background-color:#11b360' : 'color:white' }}">Riwayat <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="{{url('riwayattransaksi')}}" style="{{ Request::is('riwayattransaksi') ? 'color:white;background-color:#11b360' : 'color:black' }}">Riwayat Transaksi</a></li>
											<li><a href="{{url('riwayatpemesanan')}}" style="{{ Request::is('riwayatpemesanan') || Request::is('riwayatpemesanan/*') ? 'color:white;background-color:#11b360' : 'color:black' }}">Riwayat Pemesanan</a></li>
										</ul>
									</li>
									@endif
								@endif
							</ul>

							<ul class="nav navbar-nav navbar-right">
								@if(Auth::guest())
								<li><a href="{{ url('/auth/register') }}" style="{{ Request::is('auth/register') ? 'color:white;background-color:#11b360' : 'color:white' }}">Daftar</a></li>
								<li><a href="{{ url('/auth/login') }}" style="{{ Request::is('auth/login') ? 'color:white;background-color:#11b360' : 'color:white' }}">Masuk</a></li>
								@else
									@if(Auth::user()->statuspengguna=="1")
									<li class="dropdown" style="z-index:10000">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->namapelanggan }} <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu" style="background-color: white;">
											<li><a href="{{url('notifikasi')}}" style="{{ Request::is('notifikasi') ? 'color:white;background-color:#11b360' : 'color:black' }}">Notifikasi ({{$totalnotifikasi}})</a></li>
											<li><a href="{{url('tambahalamat')}}" style="{{ Request::is('tambahalamat') ? 'color:white;background-color:#11b360' : 'color:black' }}">Tambah Alamat User</a></li>
											<li><a href="{{url('isisaldo')}}" style="{{ Request::is('isisaldo') ? 'color:white;background-color:#11b360' : 'color:black' }}">Isi Saldo Elektronik</a></li>
											<li><a href="{{url('riwayatpemesanan')}}" style="{{ Request::is('riwayatpemesanan') || Request::is('riwayatpemesanan/*') ? 'color:white;background-color:#11b360' : 'color:black' }}">Riwayat Pemesanan</a></li>
											<li><a href="{{url('riwayattransaksi')}}" style="{{ Request::is('riwayattransaksi') ? 'color:white;background-color:#11b360' : 'color:black' }}">Riwayat Transaksi</a></li>
											<li><a href="{{url('pengaturanakun')}}" style="{{ Request::is('pengaturanakun') ? 'color:white;background-color:#11b360' : 'color:black' }}">Pengaturan Akun & Profil</a></li>
											<li class="divider"></li>
											<li><a href="{{ url('/auth/logout') }}">Keluar</a></li>
										</ul>
									</li>
									@elseif(Auth::user()->statuspengguna=="2")
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->namatukang }} <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="{{url('notifikasi')}}" style="{{ Request::is('notifikasi') ? 'color:white;background-color:#11b360' : 'color:black' }}">Notifikasi ({{$totalnotifikasi}})</a></li>
											<li><a href="{{url('penarikansaldo')}}" style="{{ Request::is('penarikansaldo') ? 'color:white;background-color:#11b360' : 'color:black' }}">Penarikan Saldo Elektronik</a></li>
											<li><a href="{{url('riwayatpemesanan')}}" style="{{ Request::is('riwayatpemesanan') || Request::is('riwayatpemesanan/*') ? 'color:white;background-color:#11b360' : 'color:black' }}">Riwayat Pemesanan</a></li>
											<li><a href="{{url('riwayattransaksi')}}" style="{{ Request::is('riwayattransaksi') ? 'color:white;background-color:#11b360' : 'color:black' }}">Riwayat Transaksi</a></li>
											<li><a href="{{url('pengaturanjasakeahlian')}}" style="{{ Request::is('pengaturanjasakeahlian') ? 'color:white;background-color:#11b360' : 'color:black' }}">Pengaturan Jasa & Keahlian</a></li>
											<li><a href="{{url('pengaturanakun')}}" style="{{ Request::is('pengaturanakun') ? 'color:white;background-color:#11b360' : 'color:black' }}">Pengaturan Akun</a></li>
											<li class="divider"></li>
											<li><a href="{{ url('/auth/logout') }}">Keluar</a></li>
										</ul>
									</li>
									@else
									<li class="dropdown">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->namaadmin }} <span class="caret"></span></a>
										<ul class="dropdown-menu" role="menu">
											<li><a href="{{url('konfirmasiupdatesaldo')}}" style="{{ Request::is('konfirmasiupdatesaldo') ? 'color:white;background-color:#11b360' : 'color:black' }}">Konfirmasi Update Saldo</a></li>
											<li><a href="{{url('konfirmasitariksaldo')}}" style="{{ Request::is('konfirmasitariksaldo') ? 'color:white;background-color:#11b360' : 'color:black' }}">Konfirmasi Tarik Saldo</a></li>
											<li><a href="{{url('informasiuser')}}" style="{{ Request::is('informasiuser') ? 'color:white;background-color:#11b360' : 'color:black' }}">Informasi User</a></li>
											<li><a href="{{url('ubahhargajarak')}}" style="{{ Request::is('ubahhargajarak') ? 'color:white;background-color:#11b360' : 'color:black' }}">Ubah Harga Jarak</a></li>
											<li><a href="{{ url('/auth/logout') }}">Keluar</a></li>
										</ul>
									</li>
									@endif
								@endif
							</ul>    
	                    </div>
	                    </div>
	              </div>
	         </div>
	    </div>
	    @if(Request::is('home') || Request::is('/'))
	    <div class="carousel-caption">
        	<p style="font-size:14pt;">
			Website Pencarian dan Pemesanan Penyedia Jasa Renovasi. Lakukan Pencarian Penyedia Jasa Renovasi dan Pemesanan Secara Cepat, Mudah, dan Tepat
        	</p>
            <div class="row" style="margin-top:20px">
                <div class="col-md-4">
                </div>
                <div class="col-md-4" style="padding-left:10px;padding-right:10px">
                    @if(Auth::guest())
                    <a href="{{ url('auth/registertukang') }}" class="btn btn-primary" style="padding:15px; color: white;
  background-color: #11b360;
  border-color: #11b360;">Daftar Menjadi Penyedia Jasa Renovasi</a>
                    @endif
                </div>
                <div class="col-md-4">
                </div>
            </div>
        </div>
        @endif
	</div>
	</section>
	@yield('content')
	<footer>
    <div class="container">
        <div class="row text-center">
        	 <div class="col-md-6 col-sm-6 col-xs-12" style="color:white">
                <h5 style="color:white">Copyright &copy <?php echo date('Y');?> - marketplacetukang.com</h5>
            </div>
             <div class="col-md-6 col-sm-6 col-xs-12">
              <ul class="list-inline">
                   <li>
                        <a href="#"><i class="fa fa-facebook fa-2x"></i></a>
                   </li>
                   <li>
                        <a href="#"><i class="fa fa-dropbox fa-2x"></i></a>
                   </li>
                   <li>
                        <a href="#"><i class="fa fa-flickr fa-2x"></i></a> 
                   </li>
                   <li>
                        <a href="#"><i class="fa fa-github fa-2x"></i></a>
                   </li>
                   <li>
                        <a href="#"><i class="fa fa-linkedin fa-2x"></i></a>
                   </li>
                   <li>
                        <a href="#"><i class="fa fa-tumblr fa-2x"></i></a>
                   </li>
                   <li>
                        <a href="#"><i class="fa fa-google-plus fa-2x"></i></a>
                  </li>    
                </ul>
            </div>
       
           
       </div> 
    </div>
</footer>
	<!-- Scripts -->
	<script src="{{ asset('bootstrap-3.3.7-dist/googleapis/jquery.min.js') }}"></script>
    <script src="{{ asset('bootstrap-3.3.7-dist/js/bootstrap.min.js') }}"></script>
    <script>
	$(document).ready(function(){

	    // Tombol edit
	    $('.btn-open-edit').on('click', function(){
	        var id = $(this).data('id');
	        var editModal = '#modalEditProgress' + id;

	        // Tutup modal tracking dulu
	        $('#trackingProgressModal').modal('hide');

	        // Setelah tracking tertutup, buka modal edit
	        $('#trackingProgressModal').one('hidden.bs.modal', function () {
	            $(editModal).modal('show');

	            // Ketika modal edit ditutup, buka lagi modal tracking
	            $(editModal).one('hidden.bs.modal', function() {
	                $('#trackingProgressModal').modal('show');
	            });
	        });
	    });

	});
	</script>
	<script>
		function previewImage(input, progressId, index) {
		    var files = !!input.files ? input.files : [];
		    if (!files.length || !window.FileReader) return; // tidak ada file atau browser tidak support FileReader

		    if (/^image/.test(files[0].type)) { // hanya file image
		        var reader = new FileReader();
		        reader.readAsDataURL(files[0]);

		        reader.onloadend = function() {
		            // Set background preview
		            var previewBox = document.getElementById('imagePreview_' + progressId + '_' + index);
		            if(previewBox) {
		                previewBox.style.backgroundImage = "url('" + this.result + "')";
		            }

		            // Buat tombol X otomatis jika belum ada
		            var closeId = 'close_' + progressId + '_' + index;
		            var closeBtn = document.getElementById(closeId);
		            if(!closeBtn) {
		                closeBtn = document.createElement('span');
		                closeBtn.id = closeId;
		                closeBtn.className = 'btn-remove';
		                closeBtn.innerHTML = '&times;';
		                closeBtn.style.fontSize = '22px';
		                closeBtn.style.color = 'white';
		                closeBtn.style.cursor = 'pointer';
		                closeBtn.style.position = 'absolute';
		                closeBtn.style.top = '5px';
		                closeBtn.style.right = '5px';
		                closeBtn.onclick = function() {
		                    hapusFotoEdit(progressId, index);
		                };

		                // Tambahkan tombol X ke previewBox
		                previewBox.style.position = 'relative'; // pastikan parent relatif
		                previewBox.appendChild(closeBtn);
		            } else {
		                // jika sudah ada, cukup tampilkan
		                closeBtn.style.display = 'block';
		            }
		        }
		    }
		}

		function hapusFotoEdit(progressId, index) {
		    // Set flag hapus jika ada input hidden
		    var hapusInput = document.getElementById('hapus_foto_' + progressId + '_' + index);
		    if(hapusInput) {
		        hapusInput.value = 1;
		    }

		    // Ambil preview box dan file input berdasarkan class unik
		    var previewBoxes = document.getElementsByClassName('preview-box-' + progressId + '-' + index);
		    var fileInputs = document.getElementsByClassName('file-input-' + progressId + '-' + index);

		    // Reset semua preview box yang cocok ke gambar placeholder
		    for(var i = 0; i < previewBoxes.length; i++) {
		        previewBoxes[i].style.backgroundImage = "url('{{ asset('images/frontslider/addpicture.png') }}')";

		        // Sembunyikan tombol X jika ada
		        var closeBtn = previewBoxes[i].querySelector('.btn-remove');
		        if(closeBtn) {
		            closeBtn.style.display = 'none';
		        }
		    }

		    // Reset semua file input yang cocok
		    for(var i = 0; i < fileInputs.length; i++) {
		        fileInputs[i].value = '';
		    }
		}


	</script>


    <script src="{{ asset('js/jquery.flexslider.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
   	@if(session('open_tracking_modal'))
	<script>
	$('#modalTambahProgress').modal('hide');

	setTimeout(function(){
	    $('#trackingProgressModal').modal('show');
	}, 500);
	</script>


	@endif
    @yield('datatable')
    @yield('scriptslider')
</body>
</html>
