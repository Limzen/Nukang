@extends('app')

@section('content')
<div class="container-fluid">			
	<div class="row" style="padding-top:20px">
		<div class="col-md-8 col-md-offset-2">
			<h2 class="tengah" style="padding-bottom:20px">Tambah Alamat Pelanggan</h2>
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
					<div class="row" style="padding-bottom:10px;">
						<div class="col-md-2">
						</div>
						<div class="col-md-8" style="border:1px solid black;padding:10px;">
							<label for="alamat"><b>Informasi Alamat Yang Telah Ditambahkan</b></label>
							<div class="row">
								@if(count($alamatpelanggan) != 0)
								@foreach($alamatpelanggan as $key => $value)
								<div class="row" style="margin:0px">
									<div class="col-md-6">
										<h5>- {{$value->alamatpelanggan}}</h5>
									</div>
									<div class="col-md-2" style="padding-top:8px">
										<form method="POST" action="{{url('tambahalamat')}}/{{$value->id_alamatpelanggan}}" accept-charset="UTF-8">
											<input type="hidden" name="_token" value="{{ csrf_token() }}">
											<button type="submit" class="notabutton">Hapus</button>
										</form>
									</div>
								</div>
								@endforeach
								@else
								<h5 style="padding:15px">Anda belum menambahkan alamat anda</h5>
								@endif
							</div>
						</div>
						<div class="col-md-2">
						</div>
					</div>
					<form class="form-horizontal" role="form" method="POST" action="" style="margin-top:10px;">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<div class="row">
							<div class="col-md-2">
							</div>
							<div class="col-md-8">
								<div class="form-group">
								    <label for="alamat">Alamat Pelanggan <font style="color:red">*</font></label>
									<input type="text" class="form-control" name="alamat" required="required">
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
								   	<label for="map">Cari Lokasi <small>(Lakukan pengisian koordinat lokasi tempat anda dengan mengklik peta)</small></label>
								    <input type="text" id="pac-input" placeholder="Masukkan Posisi Lokasi" class="form-control"/>
							       	@if(Auth::user()->latitude=="")
							       	<input type="hidden" name="latitude" id="latitude" value="3.59703"/>
							        <input type="hidden" name="longtitude" id="longtitude" value="98.678513"/>
							       	@else
							       	<input type="hidden" name="latitude" id="latitude" value="{{Auth::user()->latitude}}"/>
							        <input type="hidden" name="longtitude" id="longtitude" value="{{Auth::user()->longtitude}}"/>
								    @endif
								    <div id="map" style="height:400px"></div>
								    <script>
 setTimeout(function() { 
						              initAutocomplete();
						            },4000);

function initAutocomplete() {

    var map;
    var markers = [];

    // ===============================
    // AMBIL LOKASI GPS
    // ===============================
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {

            var posisiawal = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            // SET INPUT
            document.getElementById('latitude').value = posisiawal.lat;
            document.getElementById('longtitude').value = posisiawal.lng;

            initMap(posisiawal);

        }, function () {
            // GPS GAGAL → FALLBACK INPUT
            fallbackInput();
        });
    } else {
        fallbackInput();
    }

    // ===============================
    // FALLBACK INPUT
    // ===============================
    function fallbackInput() {
        var posisiawal = {
            lat: parseFloat(document.getElementById('latitude').value) || -6.200000,
            lng: parseFloat(document.getElementById('longtitude').value) || 106.816666
        };
        initMap(posisiawal);
    }

    // ===============================
    // INIT MAP
    // ===============================
    function initMap(posisiawal) {

        map = new google.maps.Map(document.getElementById('map'), {
            center: posisiawal,
            zoom: 15
        });

        placeMarker(posisiawal);

        var input = document.getElementById('pac-input');
        var searchBox = new google.maps.places.SearchBox(input);

        map.addListener('bounds_changed', function () {
            searchBox.setBounds(map.getBounds());
        });

        // ===============================
        // KLIK MAP → PINDAH MARKER
        // ===============================
        map.addListener('click', function (event) {
            clearMarkers();
            placeMarker(event.latLng);
        });

        // ===============================
        // SEARCH → LANGSUNG TERMARKER
        // ===============================
        searchBox.addListener('places_changed', function () {

            var places = searchBox.getPlaces();
            if (places.length === 0) return;

            clearMarkers();

            var place = places[0];
            if (!place.geometry) return;

            placeMarker(place.geometry.location);

            map.panTo(place.geometry.location);
            map.setZoom(16);
        });
    }

    // ===============================
    // PLACE MARKER
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


    // ===============================
    // CLEAR MARKER
    // ===============================
    function clearMarkers() {
        markers.forEach(function (marker) {
            marker.setMap(null);
        });
        markers = [];
    }
}
</script>

						            <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVHbAYfrB3OBft96wmCAmmxYJferc_Gz0&libraries=places&callback=initAutocomplete"
						            async defer></script>
								</div>
							</div>
							<div class="col-md-2">
							</div>
						</div>
						<div class="row margintop20px">
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