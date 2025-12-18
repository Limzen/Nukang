@extends('app')

@section('content')
<div class="container" style="padding-top:20px">
	@include('include/detailtukangtab')
	<div class="row" style="margin:0px;padding:0 10px 10px 10px;border:1px solid #5485e4">
		<input type="hidden" name="latitudesivendor" id="latitudesivendor" value="{{Auth::user()->latitude}}"/>
    <input type="hidden" name="longtitudesivendor" id="longtitudesivendor" value="{{Auth::user()->longtitude}}"/>
    <input type="hidden" name="latitudesiclient" id="latitudesiclient" value="{{$tukang->latitude}}"/>
    <input type="hidden" name="longtitudesiclient" id="longtitudesiclient" value="{{$tukang->longtitude}}"/>
    <div id="map" style="height:300px;margin-top:20px"></div>
		<div class="row" style="padding:10px;align-items:center">
      <div class="col-md-8">
          <h4 id="jarak" style="margin:0">
              Perkiraan Jarak : 0 Km
          </h4>
      </div>
      <div class="col-md-4 text-right">
          <button type="button" class="btn btn-primary" id="get">
              Tampilkan Jarak
          </button>
      </div>
  </div>
    <script>
      var map, directionDisplay, directionService;
      var uluru, uluruclient;

      setTimeout(function () {
          pilihLokasi();
      }, 1000);


      function pilihLokasi() {
          var pakaiGps = confirm(
                    "Gunakan lokasi GPS perangkat?\n\nOK = GPS\nCancel = Lokasi Berdasarkan Pengaturan Akun & Profil"
                );

          if (pakaiGps) {
              getLokasiGPS();
          } else {
              initMapDatabase();
          }
      }

      // ===============================
      // PAKAI LOKASI DATABASE
      // ===============================
      function initMapDatabase() {
          uluru = {
              lat: parseFloat(document.getElementById('latitudesivendor').value),
              lng: parseFloat(document.getElementById('longtitudesivendor').value)
          };

          uluruclient = {
              lat: parseFloat(document.getElementById('latitudesiclient').value),
              lng: parseFloat(document.getElementById('longtitudesiclient').value)
          };

          initMap();
      }

      // ===============================
      // PAKAI GPS
      // ===============================
      function getLokasiGPS() {
          if (navigator.geolocation) {
              navigator.geolocation.getCurrentPosition(function (position) {

                  uluru = {
                      lat: position.coords.latitude,
                      lng: position.coords.longitude
                  };

                  uluruclient = {
                      lat: parseFloat(document.getElementById('latitudesiclient').value),
                      lng: parseFloat(document.getElementById('longtitudesiclient').value)
                  };

                  initMap();

              }, function () {
                  alert('GPS gagal diakses, menggunakan lokasi database');
                  initMapDatabase();
              });
          } else {
              alert('Browser tidak mendukung GPS');
              initMapDatabase();
          }
      }

      // ===============================
      // INIT MAP
      // ===============================
      function initMap() {

          directionDisplay = new google.maps.DirectionsRenderer({ suppressMarkers: true });
          directionService = new google.maps.DirectionsService();

          map = new google.maps.Map(document.getElementById('map'), {
              center: uluru,
              zoom: 13
          });

          // MARKER USER
          new google.maps.Marker({
              position: uluru,
              map: map,
              icon: "{{ asset('images/icon/person.png') }}"
          });

          // MARKER TUKANG
          new google.maps.Marker({
              position: uluruclient,
              map: map,
              icon: "{{ asset('images/icon/tukang.png') }}"
          });

          directionDisplay.setMap(map);

          // BUTTON TOGGLE ROUTE
          document.getElementById("get").onclick = function () {
              if (this.innerText === "Tampilkan Jarak") {
                  calculateRoute();
                  this.innerText = "Tampilkan Biasa";
              } else {
                  initMap();
                  this.innerText = "Tampilkan Jarak";
              }
          };
      }

      // ===============================
      // ROUTE
      // ===============================
     function calculateRoute() {

        // ===============================
        // HITUNG JARAK DENGAN HAVERSINE
        // ===============================
        var jarakKm = haversine(
            uluru.lat, uluru.lng,
            uluruclient.lat, uluruclient.lng
        );

        document.getElementById('jarak').innerHTML =
            'Perkiraan Jarak : ' + jarakKm.toFixed(2) + ' Km';

        // ===============================
        // TAMPILKAN ROUTE GOOGLE MAPS
        // ===============================
        var request = {
            origin: uluru,
            destination: uluruclient,
            travelMode: 'DRIVING'
        };

        directionService.route(request, function (result, status) {
            if (status === "OK") {
                directionDisplay.setDirections(result);
            }
        });
    }

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

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVHbAYfrB3OBft96wmCAmmxYJferc_Gz0"
  async defer></script>

	</div>
	<div class="row" style="padding-top:20px;padding-bottom: 30px">
    <center>
      <button type="button" class="btn btn-primary" href="#vendorboard" id="" data-toggle="modal">Pesan</button>
    </center>
  </div>
  @include('include/pesantukangharian')
</div>
@endsection