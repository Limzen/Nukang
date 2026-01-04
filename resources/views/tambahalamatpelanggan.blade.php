@extends('app')

@section('title', 'Tambah Alamat - Nukang')

@section('content')
    <div class="address-page">
        <div class="container">
            {{-- Page Header --}}
            <div class="page-header animate-fadeIn">
                <div class="header-icon">
                    <i class="fas fa-map-marker-alt"></i>
                </div>
                <div class="header-text">
                    <h1>Tambah Alamat Pelanggan</h1>
                    <p>Kelola daftar alamat pengiriman Anda</p>
                </div>
            </div>

            {{-- Alerts handled by parent app.blade.php --}}

            <div class="address-grid">
                {{-- Saved Addresses --}}
                <div class="address-card animate-fadeIn">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-home"></i></div>
                        <div class="card-title">
                            <h3>Alamat Tersimpan</h3>
                            <p>{{ count($alamatpelanggan) }} alamat</p>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($alamatpelanggan) > 0)
                            <div class="address-list">
                                @foreach($alamatpelanggan as $value)
                                    <div class="address-item">
                                        <div class="address-info">
                                            <i class="fas fa-map-pin"></i>
                                            <span>{{ $value->alamatpelanggan }}</span>
                                        </div>
                                        <form id="delete-form-{{ $value->id_alamatpelanggan }}" method="POST"
                                            action="{{ url('tambah-alamat') }}/{{ $value->id_alamatpelanggan }}">
                                            @csrf
                                            <button type="button" class="btn-delete" title="Hapus"
                                                onclick="showDeleteModal('delete-form-{{ $value->id_alamatpelanggan }}', '{{ $value->alamatpelanggan }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-map-marked-alt"></i>
                                <p>Belum ada alamat tersimpan</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Add New Address --}}
                <div class="address-card animate-fadeIn stagger-1">
                    <div class="card-header">
                        <div class="card-icon card-icon-green"><i class="fas fa-plus"></i></div>
                        <div class="card-title">
                            <h3>Tambah Alamat Baru</h3>
                            <p>Isi detail alamat pengiriman</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="">
                            @csrf
                            @if(request('redirect'))
                                <input type="hidden" name="redirect" value="{{ request('redirect') }}">
                            @endif

                            <div class="form-field">
                                <label><i class="fas fa-home"></i> Alamat Lengkap</label>
                                <input type="text" class="form-input" name="alamat"
                                    placeholder="Contoh: Jl. Merdeka No. 123, Medan" required>
                            </div>

                            <div class="form-field">
                                <label><i class="fas fa-search-location"></i> Cari Lokasi di Peta</label>
                                <input type="text" id="pac-input" class="form-input"
                                    placeholder="Ketik nama tempat atau alamat...">
                            </div>

                            <div class="map-container">
                                @if(Auth::user()->latitude == "")
                                    <input type="hidden" name="latitude" id="latitude" value="3.59703">
                                    <input type="hidden" name="longtitude" id="longtitude" value="98.678513">
                                @else
                                    <input type="hidden" name="latitude" id="latitude" value="{{ Auth::user()->latitude }}">
                                    <input type="hidden" name="longtitude" id="longtitude"
                                        value="{{ Auth::user()->longtitude }}">
                                @endif
                                <div id="map"></div>
                                <p class="map-hint"><i class="fas fa-info-circle"></i> Klik pada peta untuk memilih lokasi
                                </p>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg btn-block">
                                <i class="fas fa-plus"></i> Tambah Alamat
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .address-page {
            padding: var(--space-6) 0 var(--space-16);
        }

        .page-header {
            display: flex;
            align-items: center;
            gap: var(--space-5);
            margin-bottom: var(--space-8);
        }

        .header-icon {
            width: 64px;
            height: 64px;
            background: var(--gradient-primary);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
        }

        .header-text h1 {
            font-size: 1.75rem;
            margin-bottom: var(--space-1);
        }

        .header-text p {
            color: var(--text-secondary);
        }

        /* Grid */
        .address-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-6);
            align-items: start;
        }

        /* Cards */
        .address-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-5);
            background: var(--bg-tertiary);
            border-bottom: 1px solid var(--border-primary);
        }

        .card-icon {
            width: 48px;
            height: 48px;
            background: var(--bg-secondary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--text-secondary);
        }

        .card-icon-green {
            background: var(--gradient-primary);
            color: white;
        }

        .card-title h3 {
            font-size: 1.1rem;
            margin-bottom: var(--space-1);
        }

        .card-title p {
            font-size: 0.85rem;
            color: var(--text-tertiary);
            margin: 0;
        }

        .card-body {
            padding: var(--space-6);
        }

        /* Address List */
        .address-list {
            display: flex;
            flex-direction: column;
            gap: var(--space-3);
        }

        .address-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-4);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
        }

        .address-info {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            flex: 1;
        }

        .address-info i {
            color: var(--success);
        }

        .btn-delete {
            width: 36px;
            height: 36px;
            background: rgba(239, 68, 68, 0.1);
            border: none;
            border-radius: var(--radius-md);
            color: var(--danger);
            cursor: pointer;
        }

        .btn-delete:hover {
            background: var(--danger);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: var(--space-10);
            color: var(--text-tertiary);
        }

        .empty-state i {
            font-size: 3rem;
            margin-bottom: var(--space-4);
        }

        /* Form */
        .form-field {
            margin-bottom: var(--space-5);
        }

        .form-field label {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: var(--space-2);
        }

        .form-field label i {
            color: var(--text-tertiary);
        }

        .form-input {
            width: 100%;
            padding: var(--space-4);
            background: var(--bg-tertiary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-lg);
            color: var(--text-primary);
            font-size: 1rem;
            outline: none;
        }

        .form-input:focus {
            border-color: var(--success);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        /* Map */
        .map-container {
            margin-bottom: var(--space-6);
        }

        #map {
            height: 300px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--border-primary);
        }

        .map-hint {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: 0.85rem;
            color: var(--text-tertiary);
            margin-top: var(--space-3);
        }

        .stagger-1 {
            animation-delay: 0.1s;
        }

        @media (max-width: 992px) {
            .address-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <script>
        setTimeout(function () {
            initAutocomplete();
        }, 4000);

        function initAutocomplete() {
            var map;
            var markers = [];

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var posisiawal = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                    };
                    document.getElementById('latitude').value = posisiawal.lat;
                    document.getElementById('longtitude').value = posisiawal.lng;
                    initMap(posisiawal);
                }, function () {
                    fallbackInput();
                });
            } else {
                fallbackInput();
            }

            function fallbackInput() {
                var posisiawal = {
                    lat: parseFloat(document.getElementById('latitude').value) || -6.200000,
                    lng: parseFloat(document.getElementById('longtitude').value) || 106.816666
                };
                initMap(posisiawal);
            }

            function initMap(posisiawal) {
                map = new google.maps.Map(document.getElementById('map'), {
                    center: posisiawal,
                    zoom: 15,
                    styles: [
                        { elementType: "geometry", stylers: [{ color: "#1d2c4d" }] },
                        { elementType: "labels.text.fill", stylers: [{ color: "#8ec3b9" }] },
                        { elementType: "labels.text.stroke", stylers: [{ color: "#1a3646" }] },
                        { featureType: "road", elementType: "geometry", stylers: [{ color: "#304a7d" }] },
                        { featureType: "water", elementType: "geometry", stylers: [{ color: "#17263c" }] }
                    ]
                });

                placeMarker(posisiawal);

                var input = document.getElementById('pac-input');
                var searchBox = new google.maps.places.SearchBox(input);

                map.addListener('bounds_changed', function () {
                    searchBox.setBounds(map.getBounds());
                });

                map.addListener('click', function (event) {
                    clearMarkers();
                    placeMarker(event.latLng);
                });

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
                document.getElementById('latitude').value = lat;
                document.getElementById('longtitude').value = lng;
            }

            function clearMarkers() {
                markers.forEach(function (marker) {
                    marker.setMap(null);
                });
                markers = [];
            }
        }
    </script>
    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVHbAYfrB3OBft96wmCAmmxYJferc_Gz0&libraries=places&callback=initAutocomplete"
        async defer></script>

    {{-- Custom Delete Confirmation Modal --}}
    <div id="deleteModal" class="delete-modal">
        <div class="delete-modal-backdrop" onclick="hideDeleteModal()"></div>
        <div class="delete-modal-content">
            <div class="delete-modal-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3 class="delete-modal-title">Hapus Alamat</h3>
            <p class="delete-modal-message">Apakah Anda yakin ingin menghapus alamat ini?</p>
            <p class="delete-modal-address" id="deleteModalAddress"></p>
            <div class="delete-modal-actions">
                <button type="button" class="btn-cancel" onclick="hideDeleteModal()">
                    <i class="fas fa-times"></i> Batal
                </button>
                <button type="button" class="btn-confirm" id="confirmDeleteBtn">
                    <i class="fas fa-trash"></i> Ya, Hapus
                </button>
            </div>
        </div>
    </div>

    <style>
        /* Delete Confirmation Modal */
        .delete-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 9999;
            align-items: center;
            justify-content: center;
        }

        .delete-modal.active {
            display: flex;
        }

        .delete-modal-backdrop {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(4px);
        }

        .delete-modal-content {
            position: relative;
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            padding: var(--space-8);
            max-width: 400px;
            width: 90%;
            text-align: center;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
            animation: modalSlideIn 0.3s ease;
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.9) translateY(-20px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        .delete-modal-icon {
            width: 80px;
            height: 80px;
            background: rgba(239, 68, 68, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-5);
        }

        .delete-modal-icon i {
            font-size: 2.5rem;
            color: var(--danger);
        }

        .delete-modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: var(--space-3);
            color: var(--text-primary);
        }

        .delete-modal-message {
            color: var(--text-secondary);
            margin-bottom: var(--space-2);
        }

        .delete-modal-address {
            font-weight: 600;
            color: var(--text-primary);
            padding: var(--space-3) var(--space-4);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
            margin-bottom: var(--space-6);
            word-break: break-word;
        }

        .delete-modal-actions {
            display: flex;
            gap: var(--space-3);
            justify-content: center;
        }

        .delete-modal-actions button {
            padding: var(--space-3) var(--space-6);
            border-radius: var(--radius-lg);
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .btn-cancel {
            background: var(--bg-tertiary);
            border: 1px solid var(--border-primary);
            color: var(--text-secondary);
        }

        .btn-cancel:hover {
            background: var(--bg-secondary);
            color: var(--text-primary);
        }

        .btn-confirm {
            background: var(--danger);
            border: none;
            color: white;
        }

        .btn-confirm:hover {
            background: #dc2626;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.4);
        }
    </style>

    <script>
        let currentFormId = null;

        function showDeleteModal(formId, address) {
            currentFormId = formId;
            document.getElementById('deleteModalAddress').textContent = address;
            document.getElementById('deleteModal').classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideDeleteModal() {
            document.getElementById('deleteModal').classList.remove('active');
            document.body.style.overflow = '';
            currentFormId = null;
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (currentFormId) {
                document.getElementById(currentFormId).submit();
            }
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                hideDeleteModal();
            }
        });
    </script>
@endsection