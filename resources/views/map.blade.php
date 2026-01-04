@extends('app')
@section('content')
@if(Auth::user()->statuspengguna == "0" || Auth::user()->statuspengguna == "1")
<div class="container" style="padding:55px">
	<div class="row" style="padding-top:10px">
		<div id="map" style="width:100%;height:500px"></div>
		<script>
        setTimeout(function() { 
          initAutocomplete();
        },4000);
        function initAutocomplete() {
           	var uluru = {lat: parseFloat({{$alamat->latitudepemesanan}}), lng: parseFloat({{$alamat->longtitudepemesanan}})};
	        var map = new google.maps.Map(document.getElementById('map'), {	
	          center: uluru,
	          zoom: 13,
	        });
	        var marker = new google.maps.Marker({
                position: uluru,
                icon : "{{ asset('images/icon/tukang.png') }}",
                map: map,
            });
        }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVHbAYfrB3OBft96wmCAmmxYJferc_Gz0&libraries=places&callback=initAutocomplete"
		async defer></script>
	</div>
</div>
@else
<div class="container" style="padding:55px">
    <div class="row" style="padding-top:10px">
        <div id="map" style="width:100%;height:500px"></div>
        <script>
        setTimeout(function() { 
          initAutocomplete();
        },4000);
        function initAutocomplete() {
            var directionDisplay = new google.maps.DirectionsRenderer({suppressMarkers: true});
            var directionService = new google.maps.DirectionsService();
            var uluru = {lat: parseFloat({{$alamat->latitudepemesanan}}), lng: parseFloat({{$alamat->longtitudepemesanan}})};
            var uluru2 = {lat: parseFloat({{Auth::user()->latitude}}), lng: parseFloat({{Auth::user()->longtitude}})};
            var map = new google.maps.Map(document.getElementById('map'), { 
              center: uluru,
              zoom: 13,
                suppressMarkers : true,
            });
            var marker = new google.maps.Marker({
                position: uluru,
                icon : "{{ asset('images/icon/person.png') }}",
                map: map,
            });
            var marker2 = new google.maps.Marker({
              position: uluru2,
              icon : "{{ asset('images/icon/tukang.png') }}",
              map: map,
            });
            directionDisplay.setMap(map);
              function calculateRoute(){
                  var request = {
                      origin: uluru,
                      destination: uluru2,
                      travelMode : 'DRIVING'
                  }
                  directionService.route(request,function(result,status)
                  {
                      if(status=="OK")
                      {
                          directionDisplay.setDirections(result);
                      }
                              
                  });
              }
              calculateRoute();
        }
        </script>
        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVHbAYfrB3OBft96wmCAmmxYJferc_Gz0&libraries=places&callback=initAutocomplete"
        async defer></script>
        <h3>Perkiraan Jarak : {{number_format($jarak,2)}} Km</h3>
    </div>
</div>
@endif
@endsection