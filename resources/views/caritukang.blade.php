@extends('app')

@section('title', 'Cari Tukang - Nukang')

@section('content')
<div class="search-page">
    {{-- Page Header --}}
    <div class="search-header">
        <div class="container">
            <div class="search-header-content animate-fadeIn">
                <div class="search-header-text">
                    <h1>Cari Tukang <span class="text-gradient">Terdekat</span></h1>
                    <p>Temukan tukang profesional di sekitar lokasi Anda</p>
                </div>
                <div class="search-header-stats">
                    <div class="header-stat">
                        <i class="fas fa-users"></i>
                        <span>{{ count($tukang) }} Tukang Ditemukan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="search-layout">
            {{-- Filter Panel --}}
            <aside class="filter-panel animate-fadeIn">
                <div class="filter-card">
                    <div class="filter-header">
                        <h3><i class="fas fa-filter"></i> Filter Pencarian</h3>
                    </div>
                    
                    <form action="" method="GET" class="filter-form">
                        {{-- Kategori --}}
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-tags"></i> Kategori
                            </label>
                            <select class="form-control" name="kategori">
                                <option value="all" {{ isset($_GET['kategori']) && $_GET['kategori'] == 'all' ? 'selected' : '' }}>
                                    Semua Kategori
                                </option>
                                @foreach($kategoritukang as $value)
                                    <option value="{{ $value->id_kategoritukang }}"
                                        {{ isset($_GET['kategori']) && $_GET['kategori'] == $value->id_kategoritukang ? 'selected' : '' }}>
                                        {{ $value->kategoritukang }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Radius --}}
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-map-marker-alt"></i> Radius Pencarian
                            </label>
                            <select class="form-control" name="jarak">
                                @for ($i = 10; $i <= 400; $i+=10)
                                    <option value="{{$i}}" {{ isset($_GET['jarak']) && $_GET['jarak'] == $i ? 'selected' : '' }}>
                                        {{$i}} Km
                                    </option>
                                @endfor
                            </select>
                        </div>

                        {{-- Nama --}}
                        <div class="filter-group">
                            <label class="filter-label">
                                <i class="fas fa-search"></i> Nama Tukang
                            </label>
                            <input type="text" 
                                   class="form-control" 
                                   name="nama" 
                                   placeholder="Cari berdasarkan nama..."
                                   value="{{ isset($_GET['nama']) ? $_GET['nama'] : '' }}">
                        </div>

                        <button type="submit" class="btn btn-primary btn-block">
                            <i class="fas fa-search"></i> Cari Sekarang
                        </button>
                    </form>
                </div>
                
                {{-- Distance Info --}}
                <div class="distance-card">
                    <div class="distance-icon">
                        <i class="fas fa-route"></i>
                    </div>
                    <div class="distance-info">
                        <span class="distance-label">Jarak Terdekat</span>
                        <span class="distance-value" id="jarak">0 Km</span>
                    </div>
                </div>
            </aside>

            {{-- Map Container --}}
            <main class="map-container animate-fadeIn">
                <div class="map-card">
                    <div class="map-header">
                        <div class="map-title">
                            <i class="fas fa-map-marked-alt"></i>
                            <span>Peta Lokasi Tukang</span>
                        </div>
                        <div class="map-legend">
                            <div class="legend-item">
                                <span class="legend-dot legend-user"></span>
                                <span>Lokasi Anda</span>
                            </div>
                            <div class="legend-item">
                                <span class="legend-dot legend-tukang"></span>
                                <span>Tukang</span>
                            </div>
                        </div>
                    </div>
                    <div id="map" class="map-view"></div>
                </div>
            </main>
        </div>
    </div>
</div>

<style>
/* Search Page Styles */
.search-page {
    min-height: calc(100vh - 80px);
    padding-bottom: var(--space-12);
}

.search-header {
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border-primary);
    padding: var(--space-8) 0;
    margin-bottom: var(--space-8);
}

.search-header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: var(--space-4);
}

.search-header-text h1 {
    font-size: 1.75rem;
    margin-bottom: var(--space-1);
}

.search-header-text p {
    color: var(--text-secondary);
    font-size: 0.95rem;
}

.header-stat {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-5);
    background: var(--gradient-primary);
    border-radius: var(--radius-full);
    color: white;
    font-size: 0.9rem;
    font-weight: 500;
}

.search-layout {
    display: grid;
    grid-template-columns: 320px 1fr;
    gap: var(--space-6);
}

/* Filter Panel */
.filter-panel {
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.filter-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.filter-header {
    padding: var(--space-5);
    border-bottom: 1px solid var(--border-primary);
    background: var(--bg-tertiary);
}

.filter-header h3 {
    font-size: 1rem;
    display: flex;
    align-items: center;
    gap: var(--space-2);
    margin: 0;
}

.filter-header i {
    color: var(--success);
}

.filter-form {
    padding: var(--space-5);
}

.filter-group {
    margin-bottom: var(--space-5);
}

.filter-label {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.85rem;
    font-weight: 500;
    color: var(--text-secondary);
    margin-bottom: var(--space-2);
}

.filter-label i {
    color: var(--text-tertiary);
    font-size: 0.8rem;
}

/* Distance Card */
.distance-card {
    background: var(--gradient-primary);
    border-radius: var(--radius-xl);
    padding: var(--space-5);
    display: flex;
    align-items: center;
    gap: var(--space-4);
    color: white;
}

.distance-icon {
    width: 50px;
    height: 50px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
}

.distance-info {
    display: flex;
    flex-direction: column;
}

.distance-label {
    font-size: 0.8rem;
    opacity: 0.9;
}

.distance-value {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 700;
}

/* Map Container */
.map-container {
    min-height: 600px;
}

.map-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
    height: 100%;
}

.map-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-4) var(--space-5);
    border-bottom: 1px solid var(--border-primary);
    background: var(--bg-tertiary);
}

.map-title {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-weight: 600;
}

.map-title i {
    color: var(--success);
}

.map-legend {
    display: flex;
    gap: var(--space-4);
}

.legend-item {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.8rem;
    color: var(--text-secondary);
}

.legend-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
}

.legend-user {
    background: #3b82f6;
    box-shadow: 0 0 8px rgba(59, 130, 246, 0.5);
}

.legend-tukang {
    background: var(--success);
    box-shadow: 0 0 8px rgba(16, 185, 129, 0.5);
}

.map-view {
    height: 550px;
    width: 100%;
}

/* Responsive */
@media (max-width: 992px) {
    .search-layout {
        grid-template-columns: 1fr;
    }
    
    .filter-panel {
        order: 2;
    }
    
    .map-container {
        order: 1;
        min-height: 400px;
    }
    
    .map-view {
        height: 400px;
    }
}

@media (max-width: 576px) {
    .search-header-content {
        flex-direction: column;
        text-align: center;
    }
    
    .map-header {
        flex-direction: column;
        gap: var(--space-3);
    }
}

/* Google Maps InfoWindow Premium Styling */
.gm-style .gm-style-iw-c {
    padding: 0 !important;
    border-radius: 16px !important;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15) !important;
    max-width: 320px !important;
    overflow: visible !important;
}

.gm-style .gm-style-iw-d {
    overflow: visible !important;
    max-height: none !important;
}

.gm-style .gm-style-iw-tc {
    display: none;
}

.gm-style .gm-style-iw-t::after {
    background: linear-gradient(135deg, #f8fafc, #f1f5f9) !important;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15) !important;
}

.gm-ui-hover-effect {
    top: 8px !important;
    right: 8px !important;
    width: 28px !important;
    height: 28px !important;
    background: #f1f5f9 !important;
    border-radius: 6px !important;
    opacity: 1 !important;
    border: 1px solid #e2e8f0 !important;
}

.gm-ui-hover-effect:hover {
    background: #e2e8f0 !important;
}

.gm-ui-hover-effect span {
    width: 16px !important;
    height: 16px !important;
    margin: 6px !important;
    background-color: #64748b !important;
}

.tukang-infowindow {
    padding: 16px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: linear-gradient(135deg, #f8fafc, #f1f5f9);
    border-radius: 16px;
    min-width: 260px;
}

.iw-header {
    display: flex;
    align-items: center;
    gap: 14px;
    margin-bottom: 14px;
    padding-bottom: 14px;
    border-bottom: 1px solid #e2e8f0;
}

.iw-avatar {
    flex-shrink: 0;
}

.iw-avatar img {
    width: 56px;
    height: 56px;
    border-radius: 12px;
    object-fit: cover;
    border: 3px solid #10b981;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.25);
}

.iw-info {
    flex: 1;
    min-width: 0;
}

.iw-name {
    font-size: 15px;
    font-weight: 700;
    color: #1e293b;
    margin-bottom: 4px;
    line-height: 1.3;
}

.iw-rating {
    display: flex;
    align-items: center;
    gap: 2px;
}

.iw-rating i {
    font-size: 12px;
}

.iw-rating-value {
    color: #64748b;
    font-size: 12px;
    margin-left: 4px;
    font-weight: 500;
}

.iw-details {
    margin-bottom: 14px;
}

.iw-detail-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 8px 12px;
    background: white;
    border-radius: 8px;
    margin-bottom: 6px;
    font-size: 13px;
    color: #475569;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}

.iw-detail-item:last-child {
    margin-bottom: 0;
}

.iw-detail-item i {
    font-size: 14px;
    color: #10b981;
    width: 18px;
    text-align: center;
}

.iw-button {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 12px 20px;
    background: linear-gradient(135deg, #10b981, #14b8a6);
    color: white !important;
    text-decoration: none !important;
    border-radius: 10px;
    font-size: 14px;
    font-weight: 600;
    transition: all 0.2s ease;
    box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
}

.iw-button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(16, 185, 129, 0.4);
    color: white !important;
    text-decoration: none !important;
}

.iw-button i {
    font-size: 14px;
}
</style>

<script>
function initMap() {
    let map;
    let userMarker;
    let directionsService = new google.maps.DirectionsService();
    let directionsRenderer = new google.maps.DirectionsRenderer({ suppressMarkers: true });

    // Data user dari database
    let latDB = "{{ Auth::user() && Auth::user()->latitude ? Auth::user()->latitude : '' }}";
    let lngDB = "{{ Auth::user() && Auth::user()->longtitude ? Auth::user()->longtitude : '' }}";

    // Map styling untuk dark/light mode
    const darkStyle = [
        { elementType: "geometry", stylers: [{ color: "#1a1a25" }] },
        { elementType: "labels.text.stroke", stylers: [{ color: "#1a1a25" }] },
        { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
        { featureType: "water", elementType: "geometry", stylers: [{ color: "#0a0a0f" }] },
        { featureType: "road", elementType: "geometry", stylers: [{ color: "#2a2a35" }] },
        { featureType: "road", elementType: "geometry.stroke", stylers: [{ color: "#12121a" }] },
        { featureType: "poi", elementType: "geometry", stylers: [{ color: "#1a1a25" }] },
    ];

    // Init map
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 3.597031, lng: 98.678513 },
        zoom: 14,
        styles: document.documentElement.getAttribute('data-theme') === 'dark' ? darkStyle : [],
        mapTypeControl: false,
        streetViewControl: false,
        fullscreenControl: true,
    });

    directionsRenderer.setMap(map);

    // Pilih sumber lokasi
    let pilihan = confirm(
        "Gunakan lokasi GPS perangkat?\n\nOK = GPS\nCancel = Lokasi dari Pengaturan Akun"
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

    function gunakanDB(lat, lng) {
        setUserPosition({ lat: lat, lng: lng });
    }

    function setUserPosition(userPos) {
        map.setCenter(userPos);
        map.setZoom(15);

        // Custom marker untuk user
        userMarker = new google.maps.Marker({
            position: userPos,
            map: map,
            icon: {
                path: google.maps.SymbolPath.CIRCLE,
                scale: 12,
                fillColor: "#3b82f6",
                fillOpacity: 1,
                strokeColor: "#1d4ed8",
                strokeWeight: 3,
            },
            title: "Lokasi Anda"
        });

        // Data tukang
        let tukangList = [
            @foreach($tukang as $t)
            {
                id: {{ $t->id_tukang }},
                nama: "{{ $t->namatukang }}",
                kode: "{{ $t->kodeuser }}",
                kategori: "{{ $t->namakategori ?? 'Tukang' }}",
                rating: {{ $t->rating ?? 0 }},
                pengalaman: "{{ $t->lamapengalamanbekerja ?? '1' }}",
                foto: "{{ $t->fotoprofil ?? 'default.png' }}",
                lat: {{ $t->latitude }},
                lng: {{ $t->longtitude }}
            },
            @endforeach
        ];

        let terdekat = null;
        let jarakMin = Infinity;

        tukangList.forEach(function (t) {
            let tukangPos = { lat: t.lat, lng: t.lng };
            let jarak = haversine(userPos.lat, userPos.lng, t.lat, t.lng);

            if (jarak < jarakMin) {
                jarakMin = jarak;
                terdekat = t;
            }

            // Custom marker untuk tukang
            let marker = new google.maps.Marker({
                position: tukangPos,
                map: map,
                icon: {
                    path: google.maps.SymbolPath.CIRCLE,
                    scale: 10,
                    fillColor: "#10b981",
                    fillOpacity: 1,
                    strokeColor: "#059669",
                    strokeWeight: 2,
                },
                title: t.nama
            });

            // Generate rating stars
            let stars = '';
            for (let i = 1; i <= 5; i++) {
                if (i <= Math.floor(t.rating)) {
                    stars += '<i class="fas fa-star" style="color: #fbbf24; font-size: 11px;"></i>';
                } else if (i - 0.5 <= t.rating) {
                    stars += '<i class="fas fa-star-half-alt" style="color: #fbbf24; font-size: 11px;"></i>';
                } else {
                    stars += '<i class="far fa-star" style="color: #fbbf24; font-size: 11px;"></i>';
                }
            }

            // Enhanced info window with premium styling
            let infoWindow = new google.maps.InfoWindow({
                content: `
                    <div class="tukang-infowindow">
                        <div class="iw-header">
                            <div class="iw-avatar">
                                <img src="{{ asset('images/fotoprofil') }}/${t.foto}" 
                                     onerror="this.src='{{ asset('images/fotoprofil/default.png') }}'">
                            </div>
                            <div class="iw-info">
                                <div class="iw-name">${t.nama}</div>
                                <div class="iw-rating">
                                    ${stars}
                                    <span class="iw-rating-value">(${t.rating.toFixed(1)})</span>
                                </div>
                            </div>
                        </div>
                        <div class="iw-details">
                            <div class="iw-detail-item">
                                <i class="fas fa-tools"></i>
                                <span>${t.kategori}</span>
                            </div>
                            <div class="iw-detail-item">
                                <i class="fas fa-briefcase"></i>
                                <span>${t.pengalaman} tahun pengalaman</span>
                            </div>
                        </div>
                        <a href="cari-tukang/${t.id}/rincian-biaya" class="iw-button">
                            <i class="fas fa-eye"></i> Lihat Detail
                        </a>
                    </div>
                `,
                maxWidth: 320
            });

            marker.addListener('click', function () {
                infoWindow.open(map, marker);
            });
        });

        // Route terpendek
        if (terdekat) {
            directionsService.route({
                origin: userPos,
                destination: { lat: terdekat.lat, lng: terdekat.lng },
                travelMode: 'DRIVING'
            }, function (result, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(result);
                    document.getElementById('jarak').innerHTML = jarakMin.toFixed(2) + ' Km';
                }
            });
        }
    }
}

// Haversine formula
function haversine(lat1, lon1, lat2, lon2) {
    let R = 6371;
    let dLat = toRad(lat2 - lat1);
    let dLon = toRad(lon2 - lon1);
    let a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
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
@endsection
