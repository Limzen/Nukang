@extends('app')

@section('content')
<div class="container">
	<form action="" method="GET"/>
		<div class="row" style="margin-top:20px">
			<div class="col-md-3">
                <div class="form-group">
                    <label for="kategori">Kategori</label>
                    <select class="form-control" name="kategori">
                        {{-- OPSI SEMUA --}}
                        <option value="all"
                            {{ isset($_GET['kategori']) && $_GET['kategori'] == 'all' ? 'selected' : '' }}>
                            Seluruh Kategori
                        </option>

                        @foreach($kategoritukang as $value)
                            <option value="{{ $value->id_kategoritukang }}"
                                {{ isset($_GET['kategori']) && $_GET['kategori'] == $value->id_kategoritukang ? 'selected' : '' }}>
                                {{ $value->kategoritukang }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

			<div class="col-md-3">
				<div class="form-group">
					<label for="jarak">Radius</label>
					<select class="form-control" name="jarak">
						@for ($i = 10; $i <= 400; $i+=10)
                        <option value="{{$i}}" <?php if($_GET['jarak'] == $i) echo"selected"; ?>>{{$i}} Km</option>
                        @endfor
					</select>
				</div>
			</div>
            <div class="col-md-3">
                <div class="form-group">
                    <label for="nama">Nama Tukang</label>
                    <input type="text"
                       class="form-control"
                       name="nama"
                       value="{{ isset($_GET['nama']) ? $_GET['nama'] : '' }}">

                </div>
            </div>
			<div class="col-md-2" style="padding-top:35px">
				<button type="submit" class="btn btn-primary" style="width:100%;padding:10px">CARI</button>
			</div>
		</div>
	</form>
	<div class="row" style="margin:0px">
		<div id="map" style="height:500px;margin-top:20px"></div>
		<script>
            function initMap() {

                let map;
                let userMarker;
                let directionsService = new google.maps.DirectionsService();
                let directionsRenderer = new google.maps.DirectionsRenderer({ suppressMarkers: true });

                // ===============================
                // DATA USER DARI DATABASE (AMAN PHP 5.6)
                // ===============================
                let latDB = "{{ Auth::user() && Auth::user()->latitude ? Auth::user()->latitude : '' }}";
                let lngDB = "{{ Auth::user() && Auth::user()->longtitude ? Auth::user()->longtitude : '' }}";

                // ===============================
                // INIT MAP DEFAULT (MEDAN)
                // ===============================
                map = new google.maps.Map(document.getElementById('map'), {
                    center: { lat: 3.597031, lng: 98.678513 },
                    zoom: 14
                });

                directionsRenderer.setMap(map);

                // ===============================
                // PILIH SUMBER LOKASI
                // ===============================
                let pilihan = confirm(
                    "Gunakan lokasi GPS perangkat?\n\nOK = GPS\nCancel = Lokasi Berdasarkan Pengaturan Akun & Profil"
                );

                if (pilihan) {
                    gunakanGPS();
                } else {
                    if (latDB !== "" && lngDB !== "") {
                        gunakanDB(parseFloat(latDB), parseFloat(lngDB));
                    } else {
                        alert("Lokasi akun belum tersedia, otomatis pakai GPS");
                        gunakanGPS();
                    }
                }

                // ===============================
                // FUNCTION GPS
                // ===============================
                function gunakanGPS() {
                    if (navigator.geolocation) {
                        navigator.geolocation.getCurrentPosition(function (pos) {
                            setUserPosition({
                                lat: pos.coords.latitude,
                                lng: pos.coords.longitude
                            });
                        }, function () {
                            alert("GPS tidak diizinkan");
                        });
                    }
                }

                // ===============================
                // FUNCTION DB
                // ===============================
                function gunakanDB(lat, lng) {
                    setUserPosition({ lat: lat, lng: lng });
                }

                // ===============================
                // SET USER POSITION
                // ===============================
                function setUserPosition(userPos) {

                    map.setCenter(userPos);
                    map.setZoom(15);

                    userMarker = new google.maps.Marker({
                        position: userPos,
                        map: map,
                        icon: "{{ asset('images/icon/person.png') }}"
                    });

                    // ===============================
                    // DATA TUKANG
                    // ===============================
                    let tukangList = [
                        @foreach($tukang as $t)
                        {
                            id: {{ $t->id_tukang }},
                            nama: "{{ $t->namatukang }}",
                            kode: "{{ $t->kodeuser }}",
                            lat: {{ $t->latitude }},
                            lng: {{ $t->longtitude }}
                        },
                        @endforeach
                    ];

                    let terdekat = null;
                    let jarakMin = Infinity;

                    tukangList.forEach(function (t) {

                        let tukangPos = { lat: t.lat, lng: t.lng };

                        let jarak = haversine(
                            userPos.lat, userPos.lng,
                            t.lat, t.lng
                        );

                        if (jarak < jarakMin) {
                            jarakMin = jarak;
                            terdekat = t;
                        }

                        let marker = new google.maps.Marker({
                            position: tukangPos,
                            map: map,
                            icon: "{{ asset('images/icon/tukang.png') }}",
                            label: t.kode
                        });

                        marker.addListener('click', function () {
                            window.location.href = 'caritukang/' + t.id + '/rincianbiaya';
                        });
                    });

                    // ===============================
                    // ROUTE TERPENDEK
                    // ===============================
                    if (terdekat) {
                        directionsService.route({
                            origin: userPos,
                            destination: { lat: terdekat.lat, lng: terdekat.lng },
                            travelMode: 'DRIVING'
                        }, function (result, status) {
                            if (status === 'OK') {
                                directionsRenderer.setDirections(result);
                                document.getElementById('jarak').innerHTML =
    'Perkiraan Jarak : ' + jarakMin.toFixed(2) + ' Km';

                            }
                        });
                    }
                }
            }

            // ===============================
            // HAVERSINE (KM)
            // ===============================
            function haversine(lat1, lon1, lat2, lon2) {
                let R = 6371;
                let dLat = toRad(lat2 - lat1);
                let dLon = toRad(lon2 - lon1);

                let a =
                    Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                    Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) *
                    Math.sin(dLon / 2) * Math.sin(dLon / 2);

                let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                return R * c;
            }

            function toRad(val) {
                return val * Math.PI / 180;
            }
            </script>


        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVHbAYfrB3OBft96wmCAmmxYJferc_Gz0&libraries=places&callback=initMap"
        async defer></script>
        <h3 id="jarak">Perkiraan Jarak : 0 Km</h3>
	</div>
</div>
@endsection
