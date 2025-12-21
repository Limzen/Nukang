{{-- Premium Order Modal Component --}}
<div class="modal fade premium-modal" id="orderModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ url('cari-tukang') }}/{{ $tukang->id_tukang }}/pesan"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <div class="modal-title-wrapper">
                        <div class="modal-icon"><i class="fas fa-shopping-cart"></i></div>
                        <div>
                            <h5 class="modal-title">Pesan Jasa</h5>
                            <p>Lengkapi detail pemesanan</p>
                        </div>
                    </div>
                    <button type="button" class="close-btn" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="balance-info">
                        <div class="balance-icon"><i class="fas fa-wallet"></i></div>
                        <div class="balance-details">
                            <span class="balance-label">Saldo Anda</span>
                            <span class="balance-amount">Rp {{ number_format(Auth::user()->saldo, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ url('isi-saldo') }}" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i>
                            Top Up</a>
                    </div>

                    <div class="tukang-preview">
                        <img src="{{ asset('images/fotoprofil') }}/{{ $tukang->fotoprofil }}"
                            onerror="this.src='{{ asset('images/fotoprofil/default.png') }}'">
                        <div class="preview-info">
                            <h4>{{ $tukang->namatukang }}</h4>
                            <span>{{ $tukang->kategoritukang }}</span>
                        </div>
                        <div class="preview-rating"><i
                                class="fas fa-star"></i><span>{{ number_format($tukang->rating ?? 0, 1) }}</span></div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-list"></i> Jenis Pemesanan</label>
                        <div class="radio-group">
                            <label class="radio-card">
                                <input type="radio" name="jenis" id="jenisHarian" value="0" checked>
                                <span class="radio-content"><i
                                        class="fas fa-calendar-day"></i><span>Harian</span></span>
                            </label>
                            <label class="radio-card">
                                <input type="radio" name="jenis" id="jenisBorongan" value="1">
                                <span class="radio-content"><i
                                        class="fas fa-project-diagram"></i><span>Borongan</span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group" id="harianGroup">
                        <label><i class="fas fa-wrench"></i> Pilih Jasa</label>
                        @if(count($jasatersediaharian) > 0)
                            <select class="form-control" name="jenispemesanan">
                                @foreach($jasatersediaharian as $value)
                                    <option value="{{ $value->id_jenispemesanan }},{{ $value->biayajasatersedia }}">
                                        {{ $value->jenispemesanan }} - Rp
                                        {{ number_format($value->biayajasatersedia, 0, ',', '.') }}/hari
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <div class="alert-inline alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Tukang ini belum menyediakan jasa harian.</span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group" id="boronganGroup" style="display: none;">
                        <label><i class="fas fa-hard-hat"></i> Pilih Jasa</label>
                        @if(count($jasatersediaborongan) > 0)
                            <select class="form-control" name="jenispemesanan2">
                                @foreach($jasatersediaborongan as $value)
                                    <option value="{{ $value->id_jenispemesanan }},{{ $value->biayajasatersedia }}">
                                        {{ $value->jenispemesanan }} - Rp
                                        {{ number_format($value->biayajasatersedia, 0, ',', '.') }}
                                    </option>
                                @endforeach
                            </select>
                        @else
                            <div class="alert-inline alert-warning">
                                <i class="fas fa-exclamation-triangle"></i>
                                <span>Tukang ini belum menyediakan jasa borongan.</span>
                            </div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-map-marker-alt"></i> Alamat Pengerjaan</label>

                        {{-- Address Type Selection --}}
                        <div class="address-type-selector">
                            <label class="address-type-option">
                                <input type="radio" name="alamat_type" value="default" checked
                                    onchange="toggleAddressType()">
                                <span class="address-type-content">
                                    <i class="fas fa-home"></i>
                                    <span>Alamat Akun Saya</span>
                                </span>
                            </label>
                            <label class="address-type-option">
                                <input type="radio" name="alamat_type" value="saved" onchange="toggleAddressType()">
                                <span class="address-type-content">
                                    <i class="fas fa-bookmark"></i>
                                    <span>Alamat Tersimpan</span>
                                </span>
                            </label>
                        </div>

                        {{-- Default Address from Account Settings --}}
                        @php
                            $userLng = Auth::user()->longtitude ?? Auth::user()->longitude ?? null;
                            $hasValidCoordinates = Auth::user()->latitude && $userLng;
                        @endphp
                        <div id="defaultAddressSection" class="address-section active-section">
                            @if($hasValidCoordinates)
                                <div class="default-address-card">
                                    <div class="address-icon"><i class="fas fa-map-pin"></i></div>
                                    <div class="address-info">
                                        <span class="address-label">Alamat dari Pengaturan Akun</span>
                                        <span class="address-text" id="geocodedAddress">
                                            @if(Auth::user()->alamat)
                                                {{ Auth::user()->alamat }}
                                            @else
                                                <i class="fas fa-spinner fa-spin"></i> Memuat lokasi...
                                            @endif
                                        </span>
                                    </div>
                                    <i class="fas fa-check-circle address-check"></i>
                                </div>
                                <input type="hidden" id="defaultAlamat"
                                    value="{{ Auth::user()->alamat ?: 'Lokasi' }},{{ Auth::user()->latitude }},{{ $userLng }}">
                                <input type="hidden" id="userLatitude" value="{{ Auth::user()->latitude }}">
                                <input type="hidden" id="userLongitude" value="{{ $userLng }}">
                                <input type="hidden" id="userTextAddress" value="{{ Auth::user()->alamat }}">
                            @else
                                <div class="alert-inline">
                                    <i class="fas fa-exclamation-triangle"></i>
                                    <span>Lokasi belum diatur di Pengaturan Akun.</span>
                                    <a href="{{ url('pengaturan-akun') }}">Atur Sekarang</a>
                                </div>
                            @endif
                        </div>

                        {{-- Saved Addresses Section --}}
                        <div id="savedAddressSection" class="address-section hidden-section">
                            @if(count($alamatpelanggan) > 0)
                                <select class="form-control" id="savedAddressSelect" onchange="updateAddressInput()">
                                    @foreach($alamatpelanggan as $value)
                                        <option
                                            value="{{ $value->alamatpelanggan }},{{ $value->latitudealamat }},{{ $value->longtitudealamat }}">
                                            {{ $value->alamatpelanggan }}
                                        </option>
                                    @endforeach
                                </select>
                                <a href="{{ url('tambah-alamat') }}" target="_blank" class="form-hint"><i
                                        class="fas fa-plus-circle"></i> Tambah alamat baru</a>
                            @else
                                <div class="alert-inline alert-info">
                                    <i class="fas fa-info-circle"></i>
                                    <span>Belum ada alamat tersimpan.</span>
                                    <a href="{{ url('tambah-alamat') }}">Tambah Alamat</a>
                                </div>
                            @endif
                        </div>

                        {{-- Hidden input for actual form submission --}}
                        <input type="hidden" name="alamatpemesanan" id="alamatpemesananInput">
                    </div>


                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-calendar-alt"></i> Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tanggalbekerja"
                                min="{{ date('Y-m-d', strtotime('+1 days')) }}" required>
                        </div>
                        <div class="form-group" id="tanggalSelesaiGroup" style="display: none;">
                            <label><i class="fas fa-calendar-check"></i> Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tanggalselesai"
                                min="{{ date('Y-m-d', strtotime('+1 days')) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-sticky-note"></i> Catatan</label>
                        <textarea class="form-control" name="catatan" rows="3" placeholder="Jelaskan kebutuhan..."
                            required></textarea>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-camera"></i> Foto (Opsional)</label>
                        <div class="photo-upload-grid">
                            <div class="photo-upload-item">
                                <input type="file" name="foto1" id="foto1" accept="image/*"
                                    onchange="previewImg(this, 'prev1')">
                                <label for="foto1">
                                    <div id="prev1" class="photo-preview"><i class="fas fa-plus"></i></div>
                                </label>
                            </div>
                            <div class="photo-upload-item">
                                <input type="file" name="foto2" id="foto2" accept="image/*"
                                    onchange="previewImg(this, 'prev2')">
                                <label for="foto2">
                                    <div id="prev2" class="photo-preview"><i class="fas fa-plus"></i></div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="info-notice"><i class="fas fa-info-circle"></i>
                        <p>Jam kerja 07:00 - 23:00 WIB</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    /* Bootstrap Modal Base CSS */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1050;
        overflow: hidden;
        -webkit-overflow-scrolling: touch;
        outline: 0;
    }

    .modal.fade .modal-dialog {
        transform: translateY(-50px);
        transition: transform 0.3s ease-out;
    }

    .modal.in {
        display: block;
    }

    .modal.in .modal-dialog {
        transform: translateY(0);
    }

    .modal-open .modal {
        overflow-x: hidden;
        overflow-y: auto;
    }

    .modal-dialog {
        position: relative;
        width: auto;
        margin: 30px auto;
        max-width: 700px;
    }

    .modal-backdrop {
        position: fixed;
        top: 0;
        right: 0;
        bottom: 0;
        left: 0;
        z-index: 1040;
        background-color: #000;
    }

    .modal-backdrop.fade {
        opacity: 0;
    }

    .modal-backdrop.in {
        opacity: 0.7;
    }

    .modal-content {
        position: relative;
        background-color: var(--bg-card);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-xl);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
    }

    /* Premium Modal Styles */
    .premium-modal .modal-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: var(--space-4) var(--space-5);
        border-bottom: 1px solid var(--border-primary);
        background: var(--bg-tertiary);
        border-radius: var(--radius-xl) var(--radius-xl) 0 0;
    }

    .modal-title-wrapper {
        display: flex;
        align-items: center;
        gap: var(--space-3);
    }

    .modal-icon {
        width: 44px;
        height: 44px;
        background: var(--gradient-primary);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.1rem;
    }

    .modal-title-wrapper h5 {
        font-size: 1rem;
        margin-bottom: 2px;
    }

    .modal-title-wrapper p {
        font-size: 0.8rem;
        color: var(--text-tertiary);
        margin: 0;
    }

    .close-btn {
        width: 36px;
        height: 36px;
        border-radius: var(--radius-md);
        background: var(--bg-secondary);
        border: none;
        color: var(--text-secondary);
        cursor: pointer;
    }

    .close-btn:hover {
        background: var(--danger);
        color: white;
    }

    .premium-modal .modal-body {
        padding: var(--space-5);
        max-height: 65vh;
        overflow-y: auto;
    }

    /* Balance Info - more compact */
    .balance-info {
        display: flex;
        align-items: center;
        gap: var(--space-3);
        padding: var(--space-3);
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.2);
        border-radius: var(--radius-lg);
        margin-bottom: var(--space-4);
    }

    .balance-icon {
        width: 36px;
        height: 36px;
        background: var(--gradient-primary);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .balance-details {
        flex: 1;
    }

    .balance-label {
        display: block;
        font-size: 0.75rem;
        color: var(--text-tertiary);
    }

    .balance-amount {
        font-family: var(--font-display);
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--success);
    }

    /* Tukang Preview - more compact */
    .tukang-preview {
        display: flex;
        align-items: center;
        gap: var(--space-3);
        padding: var(--space-3);
        background: var(--bg-tertiary);
        border-radius: var(--radius-lg);
        margin-bottom: var(--space-4);
    }

    .tukang-preview img {
        width: 45px;
        height: 45px;
        border-radius: var(--radius-md);
        object-fit: cover;
    }

    .preview-info {
        flex: 1;
    }

    .preview-info h4 {
        font-size: 0.95rem;
        margin-bottom: 2px;
    }

    .preview-info span {
        font-size: 0.8rem;
        color: var(--text-tertiary);
    }

    .preview-rating {
        display: flex;
        align-items: center;
        gap: 4px;
        color: #fbbf24;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* Form Groups - reduced spacing */
    .form-group {
        margin-bottom: var(--space-4);
    }

    .form-group label {
        display: flex;
        align-items: center;
        gap: var(--space-2);
        font-weight: 600;
        margin-bottom: var(--space-2);
        color: var(--text-primary);
        font-size: 0.9rem;
    }

    .form-group label i {
        color: var(--success);
        font-size: 0.85rem;
    }

    .form-control {
        width: 100%;
        padding: var(--space-4);
        background: var(--bg-tertiary);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        color: var(--text-primary);
        font-size: 1rem;
        transition: all 0.2s ease;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--success);
        box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
    }

    /* Radio Group - full width, no gap */
    .radio-group {
        display: flex;
    }

    .radio-card {
        flex: 1;
        cursor: pointer;
        margin: 0;
        display: block;
    }

    .radio-card input {
        display: none;
    }

    .radio-content {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: var(--space-2);
        padding: var(--space-4);
        background: var(--bg-tertiary);
        border: 1px solid var(--border-primary);
        transition: all 0.2s ease;
        width: 100%;
        box-sizing: border-box;
    }

    .radio-card:first-child .radio-content {
        border-radius: var(--radius-lg) 0 0 var(--radius-lg);
        border-right: none;
    }

    .radio-card:last-child .radio-content {
        border-radius: 0 var(--radius-lg) var(--radius-lg) 0;
    }

    .radio-content i {
        font-size: 1.25rem;
        color: var(--text-tertiary);
    }

    .radio-content span {
        font-weight: 600;
        font-size: 0.95rem;
    }

    .radio-card input:checked+.radio-content {
        border-color: var(--success);
        background: rgba(16, 185, 129, 0.1);
    }

    .radio-card input:checked+.radio-content i {
        color: var(--success);
    }

    /* Address Type Selector - full width, no gap */
    .address-type-selector {
        display: flex;
        margin-bottom: var(--space-3);
    }

    .address-type-option {
        flex: 1;
        cursor: pointer;
        margin: 0;
        display: block;
    }

    .address-type-option input {
        display: none;
    }

    .address-type-content {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--space-2);
        padding: var(--space-4);
        background: var(--bg-tertiary);
        border: 1px solid var(--border-primary);
        transition: all 0.2s ease;
        font-size: 0.95rem;
        width: 100%;
        box-sizing: border-box;
    }

    .address-type-option:first-child .address-type-content {
        border-radius: var(--radius-lg) 0 0 var(--radius-lg);
        border-right: none;
    }

    .address-type-option:last-child .address-type-content {
        border-radius: 0 var(--radius-lg) var(--radius-lg) 0;
    }

    .address-type-content i {
        color: var(--text-tertiary);
    }

    .address-type-option input:checked+.address-type-content {
        border-color: var(--success);
        background: rgba(16, 185, 129, 0.1);
    }

    .address-type-option input:checked+.address-type-content i {
        color: var(--success);
    }

    /* Address Section */
    .address-section {
        margin-top: var(--space-2);
    }

    .default-address-card {
        display: flex;
        align-items: center;
        gap: var(--space-3);
        padding: var(--space-3);
        background: rgba(16, 185, 129, 0.1);
        border: 1px solid rgba(16, 185, 129, 0.2);
        border-radius: var(--radius-lg);
    }

    .address-icon {
        width: 36px;
        height: 36px;
        background: var(--gradient-primary);
        border-radius: var(--radius-md);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
    }

    .address-info {
        flex: 1;
    }

    .address-label {
        display: block;
        font-size: 0.75rem;
        color: var(--text-tertiary);
    }

    .address-text {
        font-size: 0.9rem;
        color: var(--text-primary);
    }

    .address-check {
        color: var(--success);
        font-size: 1.1rem;
    }

    .alert-inline {
        display: flex;
        align-items: center;
        gap: var(--space-2);
        padding: var(--space-3);
        background: rgba(245, 158, 11, 0.1);
        border-radius: var(--radius-lg);
        font-size: 0.85rem;
    }

    .alert-inline i {
        color: #f59e0b;
    }

    .alert-inline a {
        color: var(--success);
        font-weight: 600;
        margin-left: auto;
    }

    .alert-inline.alert-info {
        background: rgba(59, 130, 246, 0.1);
    }

    .alert-inline.alert-info i {
        color: #3b82f6;
    }

    /* Address Section Visibility */
    .address-section.active-section {
        display: block;
    }

    .address-section.hidden-section {
        display: none;
    }

    .form-hint {
        display: inline-flex;
        align-items: center;
        gap: var(--space-1);
        margin-top: var(--space-2);
        font-size: 0.8rem;
        color: var(--success);
    }


    /* Form Row */
    .form-row {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-4);
    }

    .form-row .form-group {
        margin-bottom: 0;
    }

    /* Photo Upload */
    .photo-upload-grid {
        display: flex;
        gap: var(--space-3);
    }

    .photo-upload-item {
        position: relative;
    }

    .photo-upload-item input {
        display: none;
    }

    .photo-preview {
        width: 70px;
        height: 70px;
        background: var(--bg-secondary);
        border: 2px dashed var(--border-primary);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
        overflow: hidden;
    }

    .photo-preview:hover {
        border-color: var(--success);
        background: rgba(16, 185, 129, 0.1);
    }

    .photo-preview i {
        font-size: 1.25rem;
        color: var(--text-tertiary);
    }

    .photo-preview img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Info Notice */
    .info-notice {
        display: flex;
        align-items: center;
        gap: var(--space-2);
        padding: var(--space-3);
        background: rgba(59, 130, 246, 0.1);
        border-radius: var(--radius-lg);
        margin-top: var(--space-4);
    }

    .info-notice i {
        color: #3b82f6;
    }

    .info-notice p {
        margin: 0;
        font-size: 0.85rem;
        color: var(--text-secondary);
    }

    /* Modal Footer */
    .premium-modal .modal-footer {
        display: flex;
        justify-content: flex-end;
        gap: var(--space-3);
        padding: var(--space-4) var(--space-5);
        border-top: 1px solid var(--border-primary);
        background: var(--bg-tertiary);
        border-radius: 0 0 var(--radius-xl) var(--radius-xl);
    }

    .btn {
        padding: var(--space-3) var(--space-5);
        border-radius: var(--radius-md);
        font-weight: 600;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: var(--space-2);
    }

    .btn-secondary {
        background: var(--bg-secondary);
        border: 1px solid var(--border-primary);
        color: var(--text-secondary);
    }

    .btn-secondary:hover {
        background: var(--bg-tertiary);
    }

    .btn-primary {
        background: var(--gradient-primary);
        border: none;
        color: white;
    }

    .btn-primary:hover {
        opacity: 0.9;
        transform: translateY(-1px);
    }

    .btn-sm {
        padding: var(--space-2) var(--space-3);
        font-size: 0.8rem;
    }

    @media (max-width: 768px) {
        .modal-dialog {
            margin: 15px;
        }

        .form-row {
            grid-template-columns: 1fr;
        }
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const h = document.getElementById('jenisHarian');
        const b = document.getElementById('jenisBorongan');
        const hg = document.getElementById('harianGroup');
        const bg = document.getElementById('boronganGroup');
        const tg = document.getElementById('tanggalSelesaiGroup');

        function toggleJenis() {
            if (b && b.checked) {
                hg.style.display = 'none';
                bg.style.display = 'block';
                tg.style.display = 'block';
            } else {
                hg.style.display = 'block';
                bg.style.display = 'none';
                tg.style.display = 'none';
            }
        }
        if (h) h.addEventListener('change', toggleJenis);
        if (b) b.addEventListener('change', toggleJenis);

        // Modal handlers
        const modal = document.getElementById('orderModal');
        const triggers = document.querySelectorAll('[data-target="#orderModal"]');
        const closeBtns = modal ? modal.querySelectorAll('[data-dismiss="modal"]') : [];

        function openModal() {
            if (!modal) return;
            let backdrop = document.querySelector('.modal-backdrop');
            if (!backdrop) {
                backdrop = document.createElement('div');
                backdrop.className = 'modal-backdrop fade in';
                document.body.appendChild(backdrop);
            }
            modal.style.display = 'block';
            setTimeout(() => modal.classList.add('in'), 10);
            document.body.classList.add('modal-open');
            document.body.style.overflow = 'hidden';
        }

        function closeModal() {
            if (!modal) return;
            modal.classList.remove('in');
            setTimeout(() => {
                modal.style.display = 'none';
                const backdrop = document.querySelector('.modal-backdrop');
                if (backdrop) backdrop.remove();
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
            }, 250);
        }

        triggers.forEach(t => t.addEventListener('click', e => {
            e.preventDefault();
            openModal();
        }));
        closeBtns.forEach(btn => btn.addEventListener('click', e => {
            e.preventDefault();
            closeModal();
        }));
        if (modal) modal.addEventListener('click', e => {
            if (e.target === modal) closeModal();
        });
        document.addEventListener('keydown', e => {
            if (e.key === 'Escape' && modal && modal.classList.contains('in')) closeModal();
        });

        updateAddressInput();

        // Try to get address from coordinates if text address is empty
        reverseGeocodeIfNeeded();
    });

    function previewImg(input, previewId) {
        const preview = document.getElementById(previewId);
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = e => {
                preview.innerHTML = `<img src="${e.target.result}">`;
            };
            reader.readAsDataURL(input.files[0]);
        }
    }

    function toggleAddressType() {
        const defaultSection = document.getElementById('defaultAddressSection');
        const savedSection = document.getElementById('savedAddressSection');
        const selected = document.querySelector('input[name="alamat_type"]:checked');

        if (selected && selected.value === 'default') {
            defaultSection.classList.remove('hidden-section');
            defaultSection.classList.add('active-section');
            savedSection.classList.remove('active-section');
            savedSection.classList.add('hidden-section');
        } else {
            defaultSection.classList.remove('active-section');
            defaultSection.classList.add('hidden-section');
            savedSection.classList.remove('hidden-section');
            savedSection.classList.add('active-section');
        }
        updateAddressInput();
    }

    function updateAddressInput() {
        const input = document.getElementById('alamatpemesananInput');
        const selected = document.querySelector('input[name="alamat_type"]:checked');
        if (!input) return;

        if (selected && selected.value === 'default') {
            const def = document.getElementById('defaultAlamat');
            input.value = def ? def.value : '';
        } else {
            const sel = document.getElementById('savedAddressSelect');
            input.value = sel ? sel.value : '';
        }
    }

    // Reverse geocoding to get location name from coordinates
    function reverseGeocodeIfNeeded() {
        const textAddress = document.getElementById('userTextAddress');
        const lat = document.getElementById('userLatitude');
        const lng = document.getElementById('userLongitude');
        const geocodedAddress = document.getElementById('geocodedAddress');
        const defaultAlamat = document.getElementById('defaultAlamat');

        // Only proceed if we have coordinates but no text address
        if (textAddress && lat && lng && geocodedAddress && !textAddress.value) {
            const latitude = lat.value;
            const longitude = lng.value;

            // Use Google Maps Geocoding API
            if (typeof google !== 'undefined' && google.maps) {
                const geocoder = new google.maps.Geocoder();
                const latlng = { lat: parseFloat(latitude), lng: parseFloat(longitude) };

                geocoder.geocode({ location: latlng }, function (results, status) {
                    if (status === 'OK' && results[0]) {
                        const address = results[0].formatted_address;
                        geocodedAddress.textContent = address;
                        // Update hidden input value
                        if (defaultAlamat) {
                            defaultAlamat.value = address + ',' + latitude + ',' + longitude;
                            updateAddressInput();
                        }
                    } else {
                        geocodedAddress.textContent = 'Lat: ' + latitude + ', Lng: ' + longitude;
                    }
                });
            } else {
                // If Google Maps not loaded, just show coordinates
                geocodedAddress.textContent = 'Lokasi: ' + latitude.substring(0, 10) + ', ' + longitude.substring(0, 10);
            }
        }
    }

    // Update on saved address change
    const savedSelect = document.getElementById('savedAddressSelect');
    if (savedSelect) savedSelect.addEventListener('change', updateAddressInput);
</script>