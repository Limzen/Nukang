@extends('app')

@section('title', 'Verifikasi Tukang - Nukang')

@section('content')
    <div class="admin-page">
        <div class="container">
            {{-- Page Header --}}
            <div class="page-header animate-fadeIn">
                <div class="header-icon">
                    <i class="fas fa-user-check"></i>
                </div>
                <div class="header-text">
                    <h1>Verifikasi Tukang</h1>
                    <p>Kelola verifikasi pendaftaran penyedia jasa renovasi</p>
                </div>
                <div class="header-badge">
                    <span class="count">{{ count($verifikasitukang) }}</span>
                    <span class="label">Pending</span>
                </div>
            </div>

            {{-- Pending Verifications --}}
            @if(count($verifikasitukang) > 0)
                <div class="request-grid">
                    @foreach($verifikasitukang as $key => $tukang)
                        <div class="request-card animate-fadeIn" style="animation-delay: {{ $key * 0.1 }}s">
                            <div class="request-header">
                                <div class="request-code">
                                    <i class="fas fa-hashtag"></i>
                                    {{ $tukang->kodeuser }}
                                </div>
                                <span class="request-badge">Pending</span>
                            </div>

                            <div class="request-body">
                                <div class="user-info">
                                    <div class="user-avatar">
                                        @if($tukang->fotoprofil && $tukang->fotoprofil != 'nopicture.jpg')
                                            <img src="{{ asset('images/profil/' . $tukang->fotoprofil) }}"
                                                alt="{{ $tukang->namatukang }}"
                                                style="width: 100%; height: 100%; object-fit: cover; border-radius: var(--radius-lg);">
                                        @else
                                            <i class="fas fa-user"></i>
                                        @endif
                                    </div>
                                    <div class="user-details">
                                        <h4>{{ $tukang->namatukang }}</h4>
                                        <p>{{ $tukang->email }}</p>
                                    </div>
                                </div>

                                <div class="detail-list">
                                    <div class="detail-item">
                                        <i class="fas fa-phone"></i>
                                        <span>{{ $tukang->nomorhandphone ?: 'Tidak ada' }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $tukang->alamat ?: 'Tidak ada alamat' }}</span>
                                    </div>
                                </div>

                                {{-- Document Photos Section --}}
                                <div class="documents-section">
                                    <h5><i class="fas fa-file-image"></i> Dokumen Pendaftaran</h5>
                                    <div class="documents-grid">
                                        {{-- Foto KTP --}}
                                        <div class="document-item">
                                            <div class="document-label">
                                                <i class="fas fa-id-card"></i> Foto KTP
                                            </div>
                                            <div class="document-preview"
                                                onclick="showImageModal('{{ $tukang->fotoktp && $tukang->fotoktp != 'nopicture.jpg' ? asset('images/dokumen/' . $tukang->fotoktp) : '' }}', 'Foto KTP - {{ $tukang->namatukang }}')">
                                                @if($tukang->fotoktp && $tukang->fotoktp != 'nopicture.jpg')
                                                    <img src="{{ asset('images/dokumen/' . $tukang->fotoktp) }}" alt="KTP">
                                                    <div class="document-overlay">
                                                        <i class="fas fa-search-plus"></i>
                                                    </div>
                                                @else
                                                    <div class="no-document">
                                                        <i class="fas fa-image"></i>
                                                        <span>Tidak ada</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Foto SIM --}}
                                        <div class="document-item">
                                            <div class="document-label">
                                                <i class="fas fa-address-card"></i> Foto SIM
                                            </div>
                                            <div class="document-preview"
                                                onclick="showImageModal('{{ $tukang->fotosim && $tukang->fotosim != 'nopicture.jpg' ? asset('images/dokumen/' . $tukang->fotosim) : '' }}', 'Foto SIM - {{ $tukang->namatukang }}')">
                                                @if($tukang->fotosim && $tukang->fotosim != 'nopicture.jpg')
                                                    <img src="{{ asset('images/dokumen/' . $tukang->fotosim) }}" alt="SIM">
                                                    <div class="document-overlay">
                                                        <i class="fas fa-search-plus"></i>
                                                    </div>
                                                @else
                                                    <div class="no-document">
                                                        <i class="fas fa-image"></i>
                                                        <span>Tidak ada</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        {{-- Foto Hasil Pekerjaan (ZIP file) --}}
                                        <div class="document-item">
                                            <div class="document-label">
                                                <i class="fas fa-briefcase"></i> Hasil Pekerjaan
                                            </div>
                                            @if($tukang->fotohasilkerja && $tukang->fotohasilkerja != 'nopicture.jpg' && $tukang->fotohasilkerja != '')
                                                @php
                                                    // Check both possible locations for the file
                                                    $hasilkerjaPath = null;
                                                    if (file_exists(public_path('images/hasilkerja/' . $tukang->fotohasilkerja))) {
                                                        $hasilkerjaPath = 'images/hasilkerja/' . $tukang->fotohasilkerja;
                                                    } elseif (file_exists(public_path('files/hasil_pekerjaan/' . $tukang->fotohasilkerja))) {
                                                        $hasilkerjaPath = 'files/hasil_pekerjaan/' . $tukang->fotohasilkerja;
                                                    }
                                                @endphp
                                                @if($hasilkerjaPath)
                                                    <a href="{{ asset($hasilkerjaPath) }}" download class="document-preview zip-download">
                                                        <div class="zip-icon">
                                                            <i class="fas fa-file-archive"></i>
                                                        </div>
                                                        <span class="zip-label">Download ZIP</span>
                                                    </a>
                                                @else
                                                    <div class="document-preview">
                                                        <div class="no-document">
                                                            <i class="fas fa-file-archive"></i>
                                                            <span>File tidak ditemukan</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            @else
                                                <div class="document-preview">
                                                    <div class="no-document">
                                                        <i class="fas fa-file-archive"></i>
                                                        <span>Tidak ada</span>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="request-actions">
                                <form action="{{ url('/verifikasi-tukang/terima') }}" method="POST" class="action-form">
                                    @csrf
                                    <input type="hidden" name="iduser" value="{{ $tukang->id }}">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-check"></i> Terima
                                    </button>
                                </form>
                                <form action="{{ url('/verifikasi-tukang/tolak') }}" method="POST" class="action-form">
                                    @csrf
                                    <input type="hidden" name="iduser" value="{{ $tukang->id }}">
                                    <button type="submit" class="btn btn-danger">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state animate-fadeIn">
                    <div class="empty-icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <h3>Semua Verifikasi Selesai!</h3>
                    <p>Tidak ada tukang yang menunggu verifikasi saat ini.</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Image Preview Modal --}}
    <div class="image-modal" id="imageModal">
        <div class="image-modal-content">
            <button class="image-modal-close" onclick="hideImageModal()">
                <i class="fas fa-times"></i>
            </button>
            <h3 id="imageModalTitle"></h3>
            <img src="" alt="Preview" id="imageModalImg">
        </div>
    </div>

    <style>
        .admin-page {
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
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
        }

        .header-text {
            flex: 1;
        }

        .header-text h1 {
            font-size: 1.75rem;
            margin-bottom: var(--space-1);
        }

        .header-text p {
            color: var(--text-secondary);
        }

        .header-badge {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: var(--space-4) var(--space-6);
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: var(--radius-xl);
        }

        .header-badge .count {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 700;
            color: #ef4444;
        }

        .header-badge .label {
            font-size: 0.8rem;
            color: #ef4444;
        }

        /* Request Grid */
        .request-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(400px, 1fr));
            gap: var(--space-6);
        }

        .request-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .request-card:hover {
            border-color: rgba(239, 68, 68, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .request-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-4) var(--space-5);
            background: var(--bg-tertiary);
            border-bottom: 1px solid var(--border-primary);
        }

        .request-code {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-family: var(--font-mono);
            font-weight: 600;
            color: var(--text-secondary);
        }

        .request-badge {
            padding: var(--space-1) var(--space-3);
            background: rgba(239, 68, 68, 0.1);
            color: #ef4444;
            border-radius: var(--radius-full);
            font-size: 0.75rem;
            font-weight: 600;
        }

        .request-body {
            padding: var(--space-5);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            margin-bottom: var(--space-5);
        }

        .user-avatar {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            overflow: hidden;
        }

        .user-details h4 {
            font-size: 1rem;
            margin-bottom: 2px;
        }

        .user-details p {
            font-size: 0.85rem;
            color: var(--text-tertiary);
            margin: 0;
        }

        .detail-list {
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
            padding: var(--space-4);
            margin-bottom: var(--space-5);
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .detail-item+.detail-item {
            margin-top: var(--space-3);
        }

        .detail-item i {
            width: 20px;
            color: var(--success);
        }

        /* Documents Section */
        .documents-section {
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
            padding: var(--space-4);
        }

        .documents-section h5 {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: 0.9rem;
            color: var(--text-primary);
            margin-bottom: var(--space-4);
        }

        .documents-section h5 i {
            color: var(--success);
        }

        .documents-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: var(--space-3);
        }

        .document-item {
            text-align: center;
        }

        .document-label {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-1);
            font-size: 0.75rem;
            color: var(--text-tertiary);
            margin-bottom: var(--space-2);
        }

        .document-label i {
            color: var(--text-tertiary);
            font-size: 0.7rem;
        }

        .document-preview {
            position: relative;
            aspect-ratio: 4/3;
            background: var(--bg-secondary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-md);
            overflow: hidden;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .document-preview:hover {
            border-color: var(--success);
            transform: scale(1.02);
        }

        .document-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .document-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.5);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.2s ease;
        }

        .document-preview:hover .document-overlay {
            opacity: 1;
        }

        .document-overlay i {
            color: white;
            font-size: 1.25rem;
        }

        .no-document {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            color: var(--text-tertiary);
            gap: var(--space-1);
        }

        .no-document i {
            font-size: 1.25rem;
            opacity: 0.5;
        }

        .no-document span {
            font-size: 0.7rem;
        }

        /* ZIP Download Styling */
        .zip-download {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(16, 185, 129, 0.2));
            border-color: rgba(16, 185, 129, 0.3);
        }

        .zip-download:hover {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.2), rgba(16, 185, 129, 0.3));
            border-color: var(--success);
        }

        .zip-icon {
            font-size: 1.5rem;
            color: var(--success);
            margin-bottom: var(--space-2);
        }

        .zip-label {
            font-size: 0.7rem;
            color: var(--success);
            font-weight: 600;
        }

        .request-actions {
            display: flex;
            gap: var(--space-3);
            padding: var(--space-4) var(--space-5);
            background: var(--bg-tertiary);
            border-top: 1px solid var(--border-primary);
        }

        .action-form {
            flex: 1;
        }

        .action-form .btn {
            width: 100%;
        }

        /* Image Modal */
        .image-modal {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.9);
            z-index: 1200;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--space-4);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .image-modal.active {
            opacity: 1;
            visibility: visible;
        }

        .image-modal-content {
            max-width: 90vw;
            max-height: 90vh;
            position: relative;
            text-align: center;
        }

        .image-modal-content h3 {
            color: white;
            margin-bottom: var(--space-4);
            font-size: 1.1rem;
        }

        .image-modal-content img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: var(--radius-lg);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .image-modal-close {
            position: absolute;
            top: calc(-40px);
            right: 0;
            width: 36px;
            height: 36px;
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-lg);
            color: var(--text-primary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
        }

        .image-modal-close:hover {
            background: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: var(--space-16);
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-5);
            font-size: 2rem;
            color: var(--success);
        }

        .empty-state h3 {
            font-size: 1.25rem;
            margin-bottom: var(--space-2);
        }

        .empty-state p {
            color: var(--text-tertiary);
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                text-align: center;
            }

            .request-grid {
                grid-template-columns: 1fr;
            }

            .documents-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: var(--space-2);
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        function showImageModal(src, title) {
            if (!src) return;

            const modal = document.getElementById('imageModal');
            const img = document.getElementById('imageModalImg');
            const titleEl = document.getElementById('imageModalTitle');

            img.src = src;
            titleEl.textContent = title;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close on click outside
        document.getElementById('imageModal').addEventListener('click', function (e) {
            if (e.target === this) {
                hideImageModal();
            }
        });

        // Close on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                hideImageModal();
            }
        });
    </script>
@endsection