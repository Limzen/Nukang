@extends('app')

@section('title', 'Permintaan Pesanan - Nukang')

@section('content')
    <div class="request-page">
        <div class="container">
            {{-- Page Header --}}
            <div class="page-header animate-fadeIn">
                <div class="header-icon">
                    <i class="fas fa-inbox"></i>
                    @if(count($permintaan) > 0)
                        <span class="badge">{{ count($permintaan) }}</span>
                    @endif
                </div>
                <div class="header-text">
                    <h1>Permintaan Pesanan</h1>
                    <p>Kelola permintaan order dari pelanggan</p>
                </div>
            </div>

            {{-- Alerts handled by app.blade.php --}}

            {{-- Note --}}
            <div class="info-note animate-fadeIn">
                <i class="fas fa-lightbulb"></i>
                <p>Sebelum menerima pemesanan, sebaiknya survei terlebih dahulu ke tempat pelanggan untuk memastikan detail
                    pekerjaan.</p>
            </div>

            {{-- Request Cards --}}
            @if(count($permintaan) > 0)
                <div class="request-list">
                    @foreach($permintaan as $key => $value)
                        <div class="request-card animate-fadeIn" style="animation-delay: {{ $key * 0.1 }}s">
                            <div class="request-header">
                                <div class="customer-info">
                                    <div class="customer-avatar">
                                        @if($value->fotoprofil)
                                            <img src="{{ asset('images/fotoprofil') }}/{{ $value->fotoprofil }}" alt="Customer">
                                        @else
                                            <i class="fas fa-user"></i>
                                        @endif
                                    </div>
                                    <div class="customer-details">
                                        <h4>{{ $value->namapelanggan }}</h4>
                                        <span class="customer-id">ID: {{ $value->kodeuser }}</span>
                                    </div>
                                </div>
                                <div class="order-badge">
                                    <span>{{ $value->nomorpemesanan }}</span>
                                </div>
                            </div>

                            <div class="request-body">
                                <div class="info-grid">
                                    <div class="info-item">
                                        <i class="fas fa-phone"></i>
                                        <div>
                                            <label>No HP</label>
                                            <span>{{ $value->nomorhandphone }}</span>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-tags"></i>
                                        <div>
                                            <label>Kategori</label>
                                            <span>{{ $value->kategoritukang }}</span>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-list"></i>
                                        <div>
                                            <label>Jenis</label>
                                            <span>@include('include/harianorborongan')</span>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <i class="fas fa-calendar"></i>
                                        <div>
                                            <label>Kedatangan</label>
                                            <span>{{ $value->tanggalbekerja }}</span>
                                        </div>
                                    </div>
                                    @if($value->kategoripemesanan != '0')
                                        <div class="info-item">
                                            <i class="fas fa-calendar-check"></i>
                                            <div>
                                                <label>Selesai</label>
                                                <span>{{ $value->tanggalselesai }}</span>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="info-item info-item-full">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <div>
                                            <label>Alamat</label>
                                            @if($value->latitudepemesanan && $value->longtitudepemesanan)
                                                <a href="https://www.google.com/maps?q={{ $value->latitudepemesanan }},{{ $value->longtitudepemesanan }}"
                                                    target="_blank" class="address-link" title="Lihat di Google Maps">
                                                    <span>{{ $value->alamatpemesanan }}</span>
                                                    <i class="fas fa-external-link-alt"></i>
                                                </a>
                                            @else
                                                <span>{{ $value->alamatpemesanan }}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="service-info">
                                    <div class="service-badge">
                                        <i class="fas fa-tools"></i>
                                        <span>{{ $value->jenispemesanan }}</span>
                                    </div>
                                    <div class="service-price">
                                        Rp {{ number_format($value->biayajasa, 0, ',', '.') }}
                                    </div>
                                </div>

                                @if($value->catatan)
                                    <div class="notes-section">
                                        <label><i class="fas fa-sticky-note"></i> Catatan:</label>
                                        <p>{{ $value->catatan }}</p>
                                    </div>
                                @endif

                                @if($value->fotopemesanan1 || $value->fotopemesanan2)
                                    <div class="photos-section">
                                        <label><i class="fas fa-images"></i> Foto:</label>
                                        <div class="photo-grid">
                                            @if($value->fotopemesanan1)
                                                <a href="{{ asset('images/fotoproduk') }}/{{ $value->fotopemesanan1 }}" target="_blank"
                                                    class="photo-item">
                                                    <img src="{{ asset('images/fotoproduk') }}/{{ $value->fotopemesanan1 }}" alt="Foto 1">
                                                </a>
                                            @endif
                                            @if($value->fotopemesanan2)
                                                <a href="{{ asset('images/fotoproduk') }}/{{ $value->fotopemesanan2 }}" target="_blank"
                                                    class="photo-item">
                                                    <img src="{{ asset('images/fotoproduk') }}/{{ $value->fotopemesanan2 }}" alt="Foto 2">
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            </div>

                            <div class="request-footer">
                                <form action="{{ url('permintaan-pesanan/' . $value->id_pemesanan . '/tolak') }}" method="POST"
                                    class="reject-form" id="reject-form-{{ $value->id_pemesanan }}">
                                    @csrf
                                    <div class="reject-reason">
                                        <label for="alasan-{{ $value->id_pemesanan }}">Alasan Penolakan: <span
                                                class="required-mark">*</span></label>
                                        <textarea name="alasanpenolakan" id="alasan-{{ $value->id_pemesanan }}"
                                            placeholder="Masukkan alasan penolakan..." required></textarea>
                                    </div>
                                    <div class="action-buttons">
                                        <button type="submit" class="btn btn-danger">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>
                                        <button type="button" class="btn btn-primary"
                                            onclick="document.getElementById('terima-form-{{ $value->id_pemesanan }}').submit()">
                                            <i class="fas fa-check"></i> Terima
                                        </button>
                                    </div>
                                </form>
                                <form action="{{ url('permintaan-pesanan/' . $value->id_pemesanan . '/terima') }}" method="POST"
                                    id="terima-form-{{ $value->id_pemesanan }}" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state animate-fadeIn">
                    <div class="empty-icon">
                        <i class="fas fa-inbox"></i>
                    </div>
                    <h3>Belum Ada Permintaan</h3>
                    <p>Saat ini tidak ada permintaan pesanan baru dari pelanggan</p>
                </div>
            @endif
        </div>
    </div>

    <style>
        .request-page {
            padding: var(--space-6) 0 var(--space-16);
        }

        .page-header {
            display: flex;
            align-items: center;
            gap: var(--space-5);
            margin-bottom: var(--space-8);
        }

        .header-icon {
            position: relative;
            width: 64px;
            height: 64px;
            background: var(--gradient-accent);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
        }

        .header-icon .badge {
            position: absolute;
            top: -4px;
            right: -4px;
            width: 24px;
            height: 24px;
            background: var(--danger);
            border-radius: 50%;
            font-size: 0.75rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }

        .header-text h1 {
            font-size: 1.75rem;
            margin-bottom: var(--space-1);
        }

        .header-text p {
            color: var(--text-secondary);
        }

        /* Info Note */
        .info-note {
            display: flex;
            align-items: flex-start;
            gap: var(--space-3);
            padding: var(--space-4);
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid rgba(245, 158, 11, 0.3);
            border-radius: var(--radius-lg);
            margin-bottom: var(--space-8);
        }

        .info-note i {
            color: #f59e0b;
            font-size: 1.25rem;
        }

        .info-note p {
            margin: 0;
            color: var(--text-secondary);
        }

        /* Request Cards */
        .request-list {
            display: flex;
            flex-direction: column;
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
            border-color: rgba(139, 92, 246, 0.3);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .request-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-5);
            background: var(--bg-tertiary);
            border-bottom: 1px solid var(--border-primary);
        }

        .customer-info {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        .customer-avatar {
            width: 56px;
            height: 56px;
            border-radius: var(--radius-lg);
            overflow: hidden;
            background: var(--gradient-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
        }

        .customer-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .customer-details h4 {
            font-size: 1.1rem;
            margin-bottom: var(--space-1);
        }

        .customer-id {
            font-size: 0.85rem;
            color: var(--text-tertiary);
        }

        .order-badge {
            padding: var(--space-2) var(--space-4);
            background: var(--gradient-accent);
            border-radius: var(--radius-full);
            color: white;
            font-size: 0.85rem;
            font-weight: 600;
        }

        .request-body {
            padding: var(--space-6);
        }

        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--space-4);
            margin-bottom: var(--space-6);
        }

        .info-item {
            display: flex;
            align-items: flex-start;
            gap: var(--space-3);
        }

        .info-item-full {
            grid-column: 1 / -1;
        }

        .info-item i {
            width: 32px;
            height: 32px;
            background: var(--bg-tertiary);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--success);
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .info-item label {
            display: block;
            font-size: 0.75rem;
            color: var(--text-tertiary);
            margin-bottom: 2px;
        }

        .info-item span {
            font-size: 0.9rem;
        }

        .address-link {
            display: inline-flex;
            align-items: center;
            gap: var(--space-2);
            color: var(--success);
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .address-link span {
            color: var(--text-primary);
            transition: color 0.2s ease;
        }

        .address-link:hover span {
            color: var(--success);
        }

        .address-link i.fa-external-link-alt {
            font-size: 0.75rem;
            opacity: 0.7;
            width: auto;
            height: auto;
            background: none;
        }

        .address-link:hover i.fa-external-link-alt {
            opacity: 1;
        }

        .service-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-4);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
            margin-bottom: var(--space-4);
        }

        .service-badge {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            color: var(--text-secondary);
        }

        .service-badge i {
            color: var(--success);
        }

        .service-price {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--success);
        }

        .notes-section,
        .photos-section {
            margin-bottom: var(--space-4);
        }

        .notes-section label,
        .photos-section label {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: 0.85rem;
            color: var(--text-tertiary);
            margin-bottom: var(--space-2);
        }

        .notes-section p {
            padding: var(--space-3);
            background: var(--bg-tertiary);
            border-radius: var(--radius-md);
            font-size: 0.9rem;
            margin: 0;
        }

        .photo-grid {
            display: flex;
            gap: var(--space-3);
        }

        .photo-item {
            width: 120px;
            height: 90px;
            border-radius: var(--radius-md);
            overflow: hidden;
            border: 1px solid var(--border-primary);
        }

        .photo-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .request-footer {
            padding: var(--space-5);
            background: var(--bg-tertiary);
            border-top: 1px solid var(--border-primary);
        }

        .reject-reason {
            margin-bottom: var(--space-4);
        }

        .reject-reason label {
            display: block;
            font-size: 0.85rem;
            color: var(--text-tertiary);
            margin-bottom: var(--space-2);
        }

        .required-mark {
            color: var(--danger);
            font-weight: bold;
        }

        .reject-reason textarea {
            width: 100%;
            padding: var(--space-3);
            background: var(--bg-secondary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-md);
            color: var(--text-primary);
            font-size: 0.9rem;
            min-height: 60px;
            resize: vertical;
        }

        .action-buttons {
            display: flex;
            gap: var(--space-3);
            justify-content: flex-end;
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
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
            background: var(--bg-tertiary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-6);
            font-size: 2rem;
            color: var(--text-tertiary);
        }

        .empty-state h3 {
            margin-bottom: var(--space-2);
        }

        .empty-state p {
            color: var(--text-secondary);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .request-header {
                flex-direction: column;
                gap: var(--space-4);
                text-align: center;
            }

            .customer-info {
                flex-direction: column;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn {
                width: 100%;
            }
        }
    </style>

@endsection