@extends('app')

@section('content')
<div class="container">			
	<div class="row" style="padding-top:20px">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="tengah" style="padding-bottom:20px">Pengaturan Akun & Profil User</h2>
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
					<form class="form-horizontal" role="form" enctype="multipart/form-data" method="POST" action="">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8" style="padding:0px">
								<h4><b>Informasi Akun</b></h4>
								<hr>
								<div class="form-group" style="padding-left:15px;padding-right:15px">
									<label for="email">Email <font style="color:red">*</font></label>
									<input type="text" class="form-control" name="email" value="{{Auth::user()->email}}" required="required">
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
									<label for="password">Kata Sandi <font style="color:red">*</font></label>
									<input type="password" class="form-control" name="password">
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>

						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8" style="padding:0px">
								<h4><b>Informasi Pribadi</b></h4>
								<hr>
								<div class="form-group" style="padding-left:15px;padding-right:15px">
									<label for="name">Nama Lengkap <font style="color:red">*</font></label>
									@if(Auth::user()->statuspengguna=='2')
									<input type="text" class="form-control" name="name" value="{{Auth::user()->namatukang}}" required="required">
									@else
									<input type="text" class="form-control" name="name" value="{{Auth::user()->namapelanggan}}" required="required">
									@endif
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
									<label for="alamat">Alamat Tempat Tinggal <font style="color:red">*</font></label>
									<textarea class="form-control" name="alamat">{{Auth::user()->alamat}}</textarea>
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<div class="row">
						    <div class="col-md-2"></div>

						    <div class="col-md-8">
						        <div class="form-group">
						            <label for="map">
						                Cari Lokasi 
						                <small>(Klik peta atau gunakan GPS perangkat)</small>
						            </label>

						            <input type="text" id="pac-input" class="form-control" placeholder="Cari lokasi"/>

						           <input type="hidden" name="latitude" id="latitude"
								       value="{{ Auth::user() ? Auth::user()->latitude : '' }}">

									<input type="hidden" name="longtitude" id="longtitude"
								       value="{{ Auth::user() ? Auth::user()->longtitude : '' }}">

						            <div id="map" style="height:400px;margin-top:10px;"></div>
						        </div>
						    </div>

						    <div class="col-md-2"></div>
						</div>

						<script>
							function initAutocomplete() {

							    let map;
							    let markers = [];

							    let latInput = document.getElementById('latitude').value;
							    let lngInput = document.getElementById('longtitude').value;

							    // ===============================
							    // PRIORITAS POSISI
							    // ===============================
							    let startPos;

							    // 1. Dari database user
							    if (latInput !== '' && lngInput !== '') {
							        startPos = {
							            lat: parseFloat(latInput),
							            lng: parseFloat(lngInput)
							        };
							    }
							    // 2. Default sementara
							    else {
							        startPos = { lat: 3.597031, lng: 98.678513 }; // Medan
							    }

							    // ===============================
							    // INIT MAP
							    // ===============================
							    map = new google.maps.Map(document.getElementById('map'), {
							        center: startPos,
							        zoom: 16
							    });

							    placeMarker(startPos);

							    // ===============================
							    // GPS (HANYA JIKA DB KOSONG)
							    // ===============================
							    if (latInput === '' && lngInput === '' && navigator.geolocation) {
							        navigator.geolocation.getCurrentPosition(
							            function (position) {
							                let gpsPos = {
							                    lat: position.coords.latitude,
							                    lng: position.coords.longitude
							                };

							                clearMarkers();
							                placeMarker(gpsPos);

							                map.setCenter(gpsPos);
							                map.setZoom(16);
							            },
							            function () {
							                console.log('GPS tidak diizinkan');
							            }
							        );
							    }

							    // ===============================
							    // SEARCH BOX
							    // ===============================
							    let input = document.getElementById('pac-input');
							    let searchBox = new google.maps.places.SearchBox(input);

							    map.addListener('bounds_changed', function () {
							        searchBox.setBounds(map.getBounds());
							    });

							    searchBox.addListener('places_changed', function () {
							        let places = searchBox.getPlaces();
							        if (places.length === 0) return;

							        let place = places[0];
							        if (!place.geometry) return;

							        clearMarkers();
							        placeMarker(place.geometry.location);

							        map.setCenter(place.geometry.location);
							        map.setZoom(16);
							    });

							    // ===============================
							    // CLICK MAP
							    // ===============================
							    map.addListener('click', function (event) {
							        clearMarkers();
							        placeMarker(event.latLng);
							    });

							    // ===============================
							    // FUNCTIONS
							    // ===============================
							    function placeMarker(location) {

							        let lat, lng;

							        if (typeof location.lat === "function") {
							            lat = location.lat();
							            lng = location.lng();
							        } else {
							            lat = location.lat;
							            lng = location.lng;
							        }

							        let marker = new google.maps.Marker({
							            position: { lat: lat, lng: lng },
							            map: map
							        });

							        markers.push(marker);

							        // ISI KE INPUT HIDDEN
							        document.getElementById('latitude').value = lat;
							        document.getElementById('longtitude').value = lng;
							    }

							    function clearMarkers() {
							        markers.forEach(m => m.setMap(null));
							        markers = [];
							    }
							}

						</script>
						<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVHbAYfrB3OBft96wmCAmmxYJferc_Gz0&libraries=places&callback=initAutocomplete" async defer></script>

						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="form-group">
									<label for="nomorrekening">Nomor Rekening <font style="color:red">*</font></label>
									<input type="number" class="form-control" name="nomorrekening" value="{{Auth::user()->nomorrekening}}"/>
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
									<label for="namarekening">Nama Rekening <font style="color:red">*</font></label>
									<input type="text" class="form-control" name="namarekening" value="{{Auth::user()->namarekening}}"/>
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
									<label for="nomorhandphone">Nomor Handphone <font style="color:red">*</font></label>
									<input type="number" class="form-control" name="nomorhandphone" value="{{Auth::user()->nomorhandphone}}"/>
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
									<label for="fotoprofil">Upload Foto Profil</label>
		        	   				@if(Auth::user()->statuspengguna=='1')
		        	   				<img style="width:150px;border:1px solid black" src="{{ asset('images/fotoprofil') }}/{{Auth::user()->fotoprofil}}" class="img-responsive"/>
		        	   				@else
		        	   				<img style="width:150px;border:1px solid black" src="{{ asset('images/fotoprofil') }}/{{Auth::user()->fotoprofil}}" class="img-responsive"/>
		        	   				@endif
		        	   				<input style="color:transparent" type="file" name="fotoprofil"/>
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