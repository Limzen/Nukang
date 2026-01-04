@extends('app')

@section('title', 'Lokasi - ' . $tukang->namatukang . ' - Nukang')

@section('content')
    <div class="detail-tukang-page">
        <div class="container">
            @include('include.detailtukangheader')

            {{-- Content Section --}}
            <div class="content-section">
                {{-- Map Card --}}
                <div class="content-card animate-fadeIn">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-map-marked-alt"></i></div>
                        <div class="card-title">
                            <h3>Lokasi Tukang</h3>
                            <p>Lihat jarak dan rute menuju lokasi</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="latitudesivendor" value="{{ Auth::user()->latitude }}">
                        <input type="hidden" id="longtitudesivendor" value="{{ Auth::user()->longtitude }}">
                        <input type="hidden" id="latitudesiclient" value="{{ $tukang->latitude }}">
                        <input type="hidden" id="longtitudesiclient" value="{{ $tukang->longtitude }}">

                        <div id="map" class="location-map"></div>

                        <div class="map-controls">
                            <div class="distance-info">
                                <i class="fas fa-route"></i>
                                <span id="jarak">Perkiraan Jarak: -- Km</span>
                            </div>
                            <button type="button" class="btn btn-secondary" id="get">
                                <i class="fas fa-directions"></i> Tampilkan Rute
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Location Info --}}
                <div class="location-cards animate-fadeIn stagger-1">
                    <div class="location-card">
                        <div class="loc-icon"><i class="fas fa-user"></i></div>
                        <div class="loc-info">
                            <span class="loc-label">Lokasi Anda</span>
                            <span class="loc-value">{{ Auth::user()->alamat ?? 'Tidak tersedia' }}</span>
                        </div>
                    </div>
                    <div class="location-card">
                        <div class="loc-icon loc-icon-green"><i class="fas fa-hard-hat"></i></div>
                        <div class="loc-info">
                            <span class="loc-label">Lokasi Tukang</span>
                            <span class="loc-value">{{ $tukang->alamat ?? 'Tidak tersedia' }}</span>
                        </div>
                    </div>
                </div>

                {{-- CTA --}}
                <div class="cta-section animate-fadeIn stagger-2">
                    <div class="cta-content">
                        <h3>Lokasi terjangkau?</h3>
                        <p>Pesan sekarang dan tukang akan datang ke lokasi Anda</p>
                    </div>
                    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#orderModal">
                        <i class="fas fa-shopping-cart"></i> Pesan Sekarang
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('include.ordermodal')

    <style>
        .detail-tukang-page {
            padding: var(--space-6) 0 var(--space-16);
        }

        .content-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            overflow: hidden;
            margin-bottom: var(--space-6);
        }

        .content-card .card-header {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-5);
            background: var(--bg-tertiary);
            border-bottom: 1px solid var(--border-primary);
        }

        .content-card .card-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .content-card .card-title {
            flex: 1;
        }

        .content-card .card-title h3 {
            font-size: 1.1rem;
            margin-bottom: var(--space-1);
        }

        .content-card .card-title p {
            font-size: 0.85rem;
            color: var(--text-tertiary);
            margin: 0;
        }

        .content-card .card-body {
            padding: var(--space-6);
        }

        .location-map {
            height: 400px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--border-primary);
            margin-bottom: var(--space-4);
        }

        .map-controls {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-4);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
        }

        .distance-info {
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        .distance-info i {
            color: var(--success);
            font-size: 1.25rem;
        }

        .distance-info span {
            font-weight: 600;
            color: var(--text-primary);
        }

        .location-cards {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-4);
            margin-bottom: var(--space-6);
        }

        .location-card {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-5);
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
        }

        .loc-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-accent);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .loc-icon-green {
            background: var(--gradient-primary);
        }

        .loc-info {
            flex: 1;
        }

        .loc-label {
            display: block;
            font-size: 0.8rem;
            color: var(--text-tertiary);
            margin-bottom: var(--space-1);
        }

        .loc-value {
            font-weight: 500;
            color: var(--text-primary);
        }

        .cta-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-6);
            background: var(--gradient-primary);
            border-radius: var(--radius-xl);
            color: white;
        }

        .cta-content h3 {
            font-size: 1.25rem;
            margin-bottom: var(--space-2);
            color: white;
        }

        .cta-content p {
            opacity: 0.9;
            margin: 0;
        }

        .cta-section .btn {
            background: white;
            color: var(--success);
        }

        .stagger-1 {
            animation-delay: 0.1s;
        }

        .stagger-2 {
            animation-delay: 0.2s;
        }

        @media (max-width: 768px) {
            .location-cards {
                grid-template-columns: 1fr;
            }

            .map-controls {
                flex-direction: column;
                gap: var(--space-3);
            }

            .cta-section {
                flex-direction: column;
                text-align: center;
                gap: var(--space-4);
            }
        }
    </style>

    <script>
        var map, directionDisplay, directionService;
        var uluru, uluruclient;

        // pilihLokasi will be called by Google Maps callback
        function pilihLokasi() {
            var pakaiGps = confirm("Gunakan lokasi GPS perangkat?\n\nOK = GPS\nCancel = Lokasi dari Pengaturan Akun");
            if (pakaiGps) { getLokasiGPS(); } else { initMapDatabase(); }
        }

        function initMapDatabase() {
            var latVendor = document.getElementById('latitudesivendor').value;
            var lngVendor = document.getElementById('longtitudesivendor').value;
            var latClient = document.getElementById('latitudesiclient').value;
            var lngClient = document.getElementById('longtitudesiclient').value;

            // Validate coordinates
            if (!latVendor || !lngVendor || latVendor === '' || lngVendor === '') {
                alert('Lokasi Anda belum diatur. Silahkan perbarui lokasi di Pengaturan Akun.');
                return;
            }

            uluru = { lat: parseFloat(latVendor), lng: parseFloat(lngVendor) };
            uluruclient = { lat: parseFloat(latClient), lng: parseFloat(lngClient) };
            initMap();
        }

        function getLokasiGPS() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    uluru = { lat: position.coords.latitude, lng: position.coords.longitude };
                    uluruclient = { lat: parseFloat(document.getElementById('latitudesiclient').value), lng: parseFloat(document.getElementById('longtitudesiclient').value) };
                    initMap();
                }, function () { alert('GPS gagal, menggunakan lokasi database'); initMapDatabase(); });
            } else { alert('Browser tidak mendukung GPS'); initMapDatabase(); }
        }

        function initMap() {
            directionDisplay = new google.maps.DirectionsRenderer({ suppressMarkers: true });
            directionService = new google.maps.DirectionsService();

            var darkStyle = [
                { elementType: "geometry", stylers: [{ color: "#1a1a25" }] },
                { elementType: "labels.text.stroke", stylers: [{ color: "#1a1a25" }] },
                { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
                { featureType: "water", elementType: "geometry", stylers: [{ color: "#0a0a0f" }] },
                { featureType: "road", elementType: "geometry", stylers: [{ color: "#2a2a35" }] },
            ];

            map = new google.maps.Map(document.getElementById('map'), {
                center: uluru,
                zoom: 13,
                styles: document.documentElement.getAttribute('data-theme') === 'dark' ? darkStyle : []
            });

            new google.maps.Marker({ position: uluru, map: map, icon: "{{ asset('images/icon/person.png') }}" });
            new google.maps.Marker({ position: uluruclient, map: map, icon: "{{ asset('images/icon/tukang.png') }}" });

            directionDisplay.setMap(map);

            // Auto-calculate and show distance on load
            var jarakKm = haversine(uluru.lat, uluru.lng, uluruclient.lat, uluruclient.lng);
            document.getElementById('jarak').innerHTML = 'Perkiraan Jarak: ' + jarakKm.toFixed(2) + ' Km';

            // Fit bounds to show both markers
            var bounds = new google.maps.LatLngBounds();
            bounds.extend(uluru);
            bounds.extend(uluruclient);
            map.fitBounds(bounds);

            document.getElementById("get").onclick = function () {
                if (this.innerText.toLowerCase().includes("tampilkan rute")) {
                    calculateRoute();
                    this.innerHTML = '<i class="fas fa-map"></i> Tampilkan Biasa';
                } else {
                    // Reset to show markers only (no route)
                    directionDisplay.setDirections({ routes: [] });
                    map.fitBounds(bounds);
                    this.innerHTML = '<i class="fas fa-directions"></i> Tampilkan Rute';
                }
            };
        }

        function calculateRoute() {
            console.log('calculateRoute called');
            console.log('Origin (uluru):', uluru);
            console.log('Destination (uluruclient):', uluruclient);

            var request = {
                origin: new google.maps.LatLng(uluru.lat, uluru.lng),
                destination: new google.maps.LatLng(uluruclient.lat, uluruclient.lng),
                travelMode: google.maps.TravelMode.DRIVING
            };

            console.log('Request:', request);

            directionService.route(request, function (result, status) {
                console.log('Direction Service Response - Status:', status);
                console.log('Direction Service Response - Result:', result);

                if (status === google.maps.DirectionsStatus.OK) {
                    console.log('Route found! Displaying...');
                    directionDisplay.setDirections(result);
                    // Update distance with actual driving distance if available
                    if (result.routes[0] && result.routes[0].legs[0]) {
                        var drivingDist = result.routes[0].legs[0].distance.text;
                        document.getElementById('jarak').innerHTML = 'Perkiraan Jarak: ' + drivingDist;
                        console.log('Driving distance:', drivingDist);
                    }
                } else {
                    console.error('Directions request failed: ' + status);
                    alert('Gagal menampilkan rute: ' + status + '\n\nKemungkinan penyebab:\n- API Key tidak memiliki akses Directions API\n- Tidak ada rute yang tersedia');
                }
            });
        }

        function haversine(lat1, lon1, lat2, lon2) {
            let R = 6371; let dLat = toRad(lat2 - lat1); let dLon = toRad(lon2 - lon1);
            let a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(toRad(lat1)) * Math.cos(toRad(lat2)) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
            let c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
            return R * c;
        }
        function toRad(val) { return val * Math.PI / 180; }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVHbAYfrB3OBft96wmCAmmxYJferc_Gz0&callback=pilihLokasi"
        async defer></script>
@endsection