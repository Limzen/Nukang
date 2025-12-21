@extends('app')

@section('title', 'Pengaturan Akun - Nukang')

@section('content')
    <div class="settings-page">
        <div class="container">
            {{-- Page Header --}}
            <div class="settings-header animate-fadeIn">
                <div class="header-content">
                    <h1><i class="fas fa-cog"></i> Pengaturan Akun & Profil</h1>
                    <p>Kelola informasi akun dan profil Anda</p>
                </div>
                <div class="header-avatar">
                    @if(Auth::user()->fotoprofil)
                        <img src="{{ asset('images/fotoprofil') }}/{{ Auth::user()->fotoprofil }}" alt="Profile">
                    @else
                        <div class="avatar-placeholder">
                            <i class="fas fa-user"></i>
                        </div>
                    @endif
                    <div class="avatar-badge">
                        @if(Auth::user()->statuspengguna == '1')
                            <span>Pelanggan</span>
                        @elseif(Auth::user()->statuspengguna == '2')
                            <span>Tukang</span>
                        @else
                            <span>Admin</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Alerts are shown in app.blade.php layout --}}

            <form method="POST" action="{{ url('pengaturan-akun') }}" enctype="multipart/form-data">
                @csrf

                <div class="settings-grid">
                    {{-- Account Info Card --}}
                    <div class="settings-card animate-fadeIn">
                        <div class="card-header">
                            <div class="card-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <div class="card-title">
                                <h3>Informasi Akun</h3>
                                <p>Email dan kata sandi</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-field">
                                <label><i class="fas fa-envelope"></i> Email</label>
                                <input type="email" name="email" value="{{ Auth::user()->email }}" required>
                            </div>
                            <div class="form-field">
                                <label><i class="fas fa-lock"></i> Kata Sandi Baru</label>
                                <input type="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah">
                                <span class="field-hint">Minimal 6 karakter</span>
                            </div>
                        </div>
                    </div>

                    {{-- Personal Info Card --}}
                    <div class="settings-card animate-fadeIn stagger-1">
                        <div class="card-header">
                            <div class="card-icon card-icon-accent">
                                <i class="fas fa-user"></i>
                            </div>
                            <div class="card-title">
                                <h3>Informasi Pribadi</h3>
                                <p>Data diri Anda</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-field">
                                <label><i class="fas fa-id-card"></i> Nama Lengkap</label>
                                <input type="text" name="name"
                                    value="@if(Auth::user()->statuspengguna == '2'){{ Auth::user()->tukang->namatukang ?? Auth::user()->namaLengkap }}@elseif(Auth::user()->statuspengguna == '1'){{ Auth::user()->pelanggan->namapelanggan ?? Auth::user()->namaLengkap }}@else{{ Auth::user()->namaLengkap }}@endif"
                                    required>
                            </div>
                            <div class="form-field">
                                <label><i class="fas fa-phone"></i> Nomor Handphone</label>
                                <input type="tel" name="nomorhandphone" value="{{ Auth::user()->nomorhandphone }}"
                                    placeholder="+62 xxx xxxx xxxx">
                            </div>
                            <div class="form-field">
                                <label><i class="fas fa-map-marker-alt"></i> Alamat</label>
                                <textarea name="alamat" rows="3"
                                    placeholder="Masukkan alamat lengkap">{{ Auth::user()->alamat }}</textarea>
                            </div>
                        </div>
                    </div>

                    {{-- Bank Info Card --}}
                    <div class="settings-card animate-fadeIn stagger-2">
                        <div class="card-header">
                            <div class="card-icon card-icon-gold">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <div class="card-title">
                                <h3>Informasi Rekening</h3>
                                <p>Untuk penarikan dana</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="form-row">
                                <div class="form-field">
                                    <label><i class="fas fa-university"></i> Nomor Rekening</label>
                                    <input type="text" name="nomorrekening" value="{{ Auth::user()->nomorrekening }}"
                                        placeholder="xxxx-xxxx-xxxx">
                                </div>
                                <div class="form-field">
                                    <label><i class="fas fa-user-tag"></i> Nama Rekening</label>
                                    <input type="text" name="namarekening" value="{{ Auth::user()->namarekening }}"
                                        placeholder="Nama sesuai rekening">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Profile Photo Card --}}
                    <div class="settings-card animate-fadeIn stagger-3">
                        <div class="card-header">
                            <div class="card-icon card-icon-purple">
                                <i class="fas fa-camera"></i>
                            </div>
                            <div class="card-title">
                                <h3>Foto Profil</h3>
                                <p>Upload foto Anda</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="photo-upload">
                                <div class="photo-preview" id="photoPreview">
                                    @if(Auth::user()->fotoprofil)
                                        <img src="{{ asset('images/fotoprofil') }}/{{ Auth::user()->fotoprofil }}" alt="Profile"
                                            id="previewImg">
                                    @else
                                        <div class="photo-placeholder" id="photoPlaceholder">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="photo-info">
                                    <label class="upload-btn">
                                        <i class="fas fa-upload"></i> Pilih Foto
                                        <input type="file" name="fotoprofil" accept="image/*" onchange="previewPhoto(this)">
                                    </label>
                                    <p>Format: JPG, PNG. Max 2MB</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Location Card - Full Width --}}
                <div class="settings-card settings-card-full animate-fadeIn stagger-4">
                    <div class="card-header">
                        <div class="card-icon">
                            <i class="fas fa-map-marked-alt"></i>
                        </div>
                        <div class="card-title">
                            <h3>Lokasi</h3>
                            <p>Pilih lokasi di peta atau gunakan GPS</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="location-search">
                            <i class="fas fa-search"></i>
                            <input type="text" id="pac-input" placeholder="Cari alamat atau lokasi...">
                        </div>

                        <input type="hidden" name="latitude" id="latitude" value="{{ Auth::user()->latitude }}">
                        <input type="hidden" name="longtitude" id="longtitude" value="{{ Auth::user()->longtitude }}">

                        <div id="map" class="location-map"></div>

                        <div class="location-coords">
                            <span id="coordsDisplay">
                                @if(Auth::user()->latitude && Auth::user()->longtitude)
                                    <i class="fas fa-check-circle"></i> Lokasi tersimpan: {{ Auth::user()->latitude }},
                                    {{ Auth::user()->longtitude }}
                                @else
                                    <i class="fas fa-info-circle"></i> Klik peta untuk memilih lokasi
                                @endif
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Submit Section --}}
                <div class="settings-submit animate-fadeIn">
                    <button type="submit" class="btn btn-primary btn-lg">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .settings-page {
            padding: var(--space-8) 0 var(--space-16);
        }

        .settings-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--space-8);
            padding: var(--space-8);
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-2xl);
        }

        .header-content h1 {
            font-size: 1.75rem;
            margin-bottom: var(--space-2);
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

        .header-content h1 i {
            color: var(--success);
        }

        .header-content p {
            color: var(--text-secondary);
        }

        .header-avatar {
            position: relative;
        }

        .header-avatar img,
        .header-avatar .avatar-placeholder {
            width: 80px;
            height: 80px;
            border-radius: var(--radius-xl);
            object-fit: cover;
            border: 3px solid var(--success);
        }

        .header-avatar .avatar-placeholder {
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
        }

        .avatar-badge {
            position: absolute;
            bottom: -8px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--gradient-primary);
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
            font-size: 0.7rem;
            font-weight: 600;
            color: white;
            white-space: nowrap;
        }

        /* Settings Grid */
        .settings-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--space-6);
            margin-bottom: var(--space-6);
        }

        .settings-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .settings-card:hover {
            border-color: rgba(16, 185, 129, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .settings-card-full {
            grid-column: 1 / -1;
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
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            flex-shrink: 0;
        }

        .card-icon-accent {
            background: var(--gradient-accent);
        }

        .card-icon-gold {
            background: var(--gradient-gold);
        }

        .card-icon-purple {
            background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
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

        /* Form Fields */
        .form-field {
            margin-bottom: var(--space-5);
        }

        .form-field:last-child {
            margin-bottom: 0;
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
            font-size: 0.8rem;
        }

        .form-field input,
        .form-field textarea {
            width: 100%;
            padding: var(--space-4);
            font-size: 1rem;
            color: var(--text-primary);
            background: var(--bg-tertiary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-lg);
            outline: none;
            transition: all 0.3s ease;
        }

        .form-field input:focus,
        .form-field textarea:focus {
            border-color: var(--success);
            background: var(--bg-secondary);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-field textarea {
            resize: vertical;
            min-height: 100px;
        }

        .field-hint {
            display: block;
            font-size: 0.8rem;
            color: var(--text-tertiary);
            margin-top: var(--space-2);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-4);
        }

        /* Photo Upload */
        .photo-upload {
            display: flex;
            align-items: center;
            gap: var(--space-6);
        }

        .photo-preview {
            width: 120px;
            height: 120px;
            border-radius: var(--radius-xl);
            overflow: hidden;
            border: 3px dashed var(--border-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-tertiary);
        }

        .photo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .photo-placeholder {
            font-size: 3rem;
            color: var(--text-tertiary);
        }

        .photo-info {
            flex: 1;
        }

        .upload-btn {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-3) var(--space-5);
            background: var(--bg-tertiary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-lg);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .upload-btn:hover {
            background: var(--success);
            border-color: var(--success);
            color: white;
        }

        .upload-btn input {
            display: none;
        }

        .photo-info p {
            font-size: 0.8rem;
            color: var(--text-tertiary);
            margin-top: var(--space-2);
        }

        /* Location */
        .location-search {
            position: relative;
            margin-bottom: var(--space-4);
        }

        .location-search i {
            position: absolute;
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-tertiary);
        }

        .location-search input {
            width: 100%;
            padding: var(--space-4) var(--space-4) var(--space-4) 48px;
            font-size: 1rem;
            color: var(--text-primary);
            background: var(--bg-tertiary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-lg);
            outline: none;
            transition: all 0.3s ease;
        }

        .location-search input:focus {
            border-color: var(--success);
        }

        .location-map {
            height: 400px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            border: 1px solid var(--border-primary);
        }

        .location-coords {
            margin-top: var(--space-4);
            padding: var(--space-3) var(--space-4);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .location-coords i {
            margin-right: var(--space-2);
            color: var(--success);
        }

        /* Submit */
        .settings-submit {
            text-align: center;
            padding-top: var(--space-6);
        }

        .settings-submit .btn {
            min-width: 250px;
        }

        /* Stagger Animations */
        .stagger-1 {
            animation-delay: 0.1s;
        }

        .stagger-2 {
            animation-delay: 0.2s;
        }

        .stagger-3 {
            animation-delay: 0.3s;
        }

        .stagger-4 {
            animation-delay: 0.4s;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .settings-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 576px) {
            .settings-header {
                flex-direction: column;
                text-align: center;
                gap: var(--space-6);
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .photo-upload {
                flex-direction: column;
                text-align: center;
            }
        }
    </style>

    <script>
        function previewPhoto(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('photoPreview');
                    preview.innerHTML = `<img src="${e.target.result}" alt="Preview" id="previewImg">`;
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        function initAutocomplete() {
            let map;
            let markers = [];

            let latInput = document.getElementById('latitude').value;
            let lngInput = document.getElementById('longtitude').value;

            let startPos;

            if (latInput !== '' && lngInput !== '') {
                startPos = {
                    lat: parseFloat(latInput),
                    lng: parseFloat(lngInput)
                };
            } else {
                startPos = { lat: 3.597031, lng: 98.678513 };
            }

            // Dark mode map styling
            const darkStyle = [
                { elementType: "geometry", stylers: [{ color: "#1a1a25" }] },
                { elementType: "labels.text.stroke", stylers: [{ color: "#1a1a25" }] },
                { elementType: "labels.text.fill", stylers: [{ color: "#746855" }] },
                { featureType: "water", elementType: "geometry", stylers: [{ color: "#0a0a0f" }] },
                { featureType: "road", elementType: "geometry", stylers: [{ color: "#2a2a35" }] },
            ];

            map = new google.maps.Map(document.getElementById('map'), {
                center: startPos,
                zoom: 16,
                styles: document.documentElement.getAttribute('data-theme') === 'dark' ? darkStyle : [],
                mapTypeControl: false,
                streetViewControl: false,
            });

            placeMarker(startPos);

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
                    },
                    function () {
                        console.log('GPS tidak diizinkan');
                    }
                );
            }

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
            });

            map.addListener('click', function (event) {
                clearMarkers();
                placeMarker(event.latLng);
            });

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
                    map: map,
                    icon: {
                        path: google.maps.SymbolPath.CIRCLE,
                        scale: 12,
                        fillColor: "#10b981",
                        fillOpacity: 1,
                        strokeColor: "#059669",
                        strokeWeight: 3,
                    },
                });

                markers.push(marker);

                document.getElementById('latitude').value = lat;
                document.getElementById('longtitude').value = lng;
                document.getElementById('coordsDisplay').innerHTML =
                    `<i class="fas fa-check-circle"></i> Lokasi dipilih: ${lat.toFixed(6)}, ${lng.toFixed(6)}`;
            }

            function clearMarkers() {
                markers.forEach(m => m.setMap(null));
                markers = [];
            }
        }
    </script>

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDVHbAYfrB3OBft96wmCAmmxYJferc_Gz0&libraries=places&callback=initAutocomplete"
        async defer></script>
@endsection