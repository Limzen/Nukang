@extends('app')
@section('title', 'Lokasi Pemesanan - Nukang')
@section('content')

    <style>
        .map-page {
            padding: var(--space-6) 0;
            min-height: 80vh;
        }

        .map-header {
            background: var(--bg-secondary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            padding: var(--space-5);
            margin-bottom: var(--space-5);
        }

        .map-header-title {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: var(--space-4);
        }

        .map-header-title i {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--gradient-primary);
            border-radius: var(--radius-md);
            color: white;
        }

        .address-info {
            display: flex;
            align-items: flex-start;
            gap: var(--space-3);
            padding: var(--space-4);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
        }

        .address-info i {
            color: var(--success);
            font-size: 1.25rem;
            margin-top: 2px;
        }

        .address-text {
            color: var(--text-primary);
            line-height: 1.6;
        }

        .map-container {
            background: var(--bg-secondary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            overflow: hidden;
            height: 500px;
        }

        #map {
            width: 100%;
            height: 100%;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-2) var(--space-4);
            background: var(--bg-secondary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-lg);
            color: var(--text-primary);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            margin-bottom: var(--space-4);
        }

        .back-btn:hover {
            background: var(--bg-tertiary);
            border-color: var(--success);
            color: var(--success);
            transform: translateX(-2px);
            text-decoration: none;
        }

        .back-btn i {
            font-size: 0.875rem;
        }

        /* Leaflet custom styles */
        .leaflet-popup-content-wrapper {
            background: var(--bg-secondary) !important;
            border: 1px solid var(--border-primary) !important;
            border-radius: var(--radius-lg) !important;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3) !important;
        }

        .leaflet-popup-content {
            color: var(--text-primary) !important;
            font-size: 0.9rem !important;
            margin: 12px 16px !important;
        }

        .leaflet-popup-tip {
            background: var(--bg-secondary) !important;
            border: 1px solid var(--border-primary) !important;
        }

        .leaflet-control-zoom a {
            background: var(--bg-secondary) !important;
            color: var(--text-primary) !important;
            border-color: var(--border-primary) !important;
        }

        .leaflet-control-zoom a:hover {
            background: var(--bg-tertiary) !important;
        }
    </style>

    <div class="container map-page">
        <a href="javascript:history.back()" class="back-btn">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>

        <div class="map-header">
            <div class="map-header-title">
                <i class="fas fa-map-marked-alt"></i>
                <span>Lokasi Pengerjaan</span>
            </div>

            <div class="address-info">
                <i class="fas fa-map-marker-alt"></i>
                <div class="address-text">{{ $alamat ?? 'Alamat tidak tersedia' }}</div>
            </div>
        </div>

        <div class="map-container">
            <div id="map"></div>
        </div>

    </div>

    <!-- Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

@endsection

@section('scripts')
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var lat = {{ $latitude ?? 3.5952 }};
            var lng = {{ $longitude ?? 98.6722 }};
            var alamat = "{{ $alamat ?? 'Lokasi Pengerjaan' }}";

            // Initialize map
            var map = L.map('map').setView([lat, lng], 15);

            // Add OpenStreetMap tiles with dark theme
            L.tileLayer('https://{s}.basemaps.cartocdn.com/dark_all/{z}/{x}/{y}{r}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors &copy; <a href="https://carto.com/attributions">CARTO</a>',
                maxZoom: 19
            }).addTo(map);

            // Custom marker icon
            var customIcon = L.divIcon({
                className: 'custom-marker',
                html: '<div style="background: linear-gradient(135deg, #10b981, #06b6d4); width: 40px; height: 40px; border-radius: 50% 50% 50% 0; transform: rotate(-45deg); display: flex; align-items: center; justify-content: center; box-shadow: 0 4px 15px rgba(16, 185, 129, 0.5);"><i class="fas fa-home" style="color: white; font-size: 16px; transform: rotate(45deg);"></i></div>',
                iconSize: [40, 40],
                iconAnchor: [20, 40],
                popupAnchor: [0, -40]
            });

            // Add marker
            var marker = L.marker([lat, lng], { icon: customIcon }).addTo(map);

            // Add popup
            marker.bindPopup('<strong style="color: var(--success);">📍 Lokasi Pengerjaan</strong><br>' + alamat).openPopup();
        });
    </script>
@endsection