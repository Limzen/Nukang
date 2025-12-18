@extends('app')

@section('title', 'Riwayat Pemesanan - Nukang')

@section('content')
<div class="container" style="padding: 2rem 1rem;">
    <!-- Page Header -->
    <div class="page-header animate-fadeIn">
        <h1><i class="fas fa-history"></i> Riwayat Pemesanan</h1>
        <p>Daftar semua pesanan Anda</p>
    </div>

    @if(count($riwayatpemesanan) > 0)
        <div class="orders-grid">
            @foreach($riwayatpemesanan as $key => $value)
            <div class="order-card animate-fadeIn" style="animation-delay: {{ $key * 0.1 }}s;">
                <div class="order-header">
                    <div class="order-number">
                        <span class="label">Nomor Pemesanan</span>
                        <a href="{{ url('riwayatpemesanan') }}/{{ $value->id_pemesanan }}@if(Auth::user()->statuspengguna == '1')?kategori=all&katakunci=@endif">
                            {{ $value->nomorpemesanan }}
                        </a>
                    </div>
                    <div class="order-status">
                        @if($value->statuspemesanan == '0')
                            <span class="badge badge-warning"><i class="fas fa-clock"></i> Menunggu</span>
                        @elseif($value->statuspemesanan == '1')
                            <span class="badge badge-info"><i class="fas fa-check"></i> Diterima</span>
                        @elseif($value->statuspemesanan == '2')
                            <span class="badge badge-danger"><i class="fas fa-times"></i> Ditolak</span>
                        @elseif($value->statuspemesanan == '3')
                            <span class="badge badge-primary"><i class="fas fa-spinner"></i> Dikerjakan</span>
                        @elseif($value->statuspemesanan == '4')
                            <span class="badge badge-success"><i class="fas fa-check-double"></i> Selesai</span>
                        @elseif($value->statuspemesanan == '5')
                            <span class="badge badge-success"><i class="fas fa-star"></i> Dinilai</span>
                        @endif
                    </div>
                </div>
                
                <div class="order-body">
                    <div class="order-avatar">
                        @if($value->fotoprofil)
                            <img src="{{ asset('images/fotoprofil') }}/{{ $value->fotoprofil }}" alt="Profile">
                        @else
                            <div class="avatar-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    
                    <div class="order-info">
                        @if(Auth::user()->statuspengguna == '2')
                            <h4>{{ $value->namapelanggan ?? 'Pelanggan' }}</h4>
                            <p class="text-muted"><i class="fas fa-id-card"></i> ID: {{ $value->kodeuser ?? '-' }}</p>
                        @else
                            <h4>{{ $value->namatukang ?? 'Tukang' }}</h4>
                            <p class="text-muted"><i class="fas fa-id-card"></i> ID: {{ $value->kodeuser ?? '-' }}</p>
                        @endif
                        
                        <div class="order-details">
                            <div class="detail-item">
                                <i class="fas fa-tags"></i>
                                <span>{{ $value->kategoritukang ?? '-' }}</span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-calendar"></i>
                                <span>{{ $value->tanggalbekerja ?? '-' }}</span>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-briefcase"></i>
                                <span>
                                    @if($value->kategoripemesanan == '0')
                                        Harian
                                    @else
                                        Borongan
                                    @endif
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="order-footer">
                    <a href="{{ url('riwayatpemesanan') }}/{{ $value->id_pemesanan }}@if(Auth::user()->statuspengguna == '1')?kategori=all&katakunci=@endif" class="btn btn-primary btn-sm">
                        <i class="fas fa-eye"></i> Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    @else
        <div class="empty-state animate-fadeIn">
            <div class="empty-icon">
                <i class="fas fa-inbox"></i>
            </div>
            <h3>Belum Ada Pemesanan</h3>
            <p>Anda belum memiliki riwayat pemesanan</p>
            @if(Auth::user()->statuspengguna == '1')
                <a href="{{ url('caritukang?kategori=all&jarak=10') }}" class="btn btn-primary">
                    <i class="fas fa-search"></i> Cari Jasa Sekarang
                </a>
            @endif
        </div>
    @endif
</div>

<style>
.page-header {
    text-align: center;
    margin-bottom: var(--space-10);
}

.page-header h1 {
    font-size: clamp(1.75rem, 3vw, 2.25rem);
    margin-bottom: var(--space-2);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-3);
}

.page-header h1 i {
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-header p {
    color: var(--text-secondary);
    font-size: 1rem;
}

.orders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(360px, 1fr));
    gap: var(--space-6);
}

.order-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
}

.order-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
    opacity: 0;
    transition: opacity 0.3s ease;
    pointer-events: none;
}

.order-card:hover {
    transform: translateY(-8px);
    border-color: rgba(16, 185, 129, 0.3);
    box-shadow: 
        0 20px 40px rgba(0, 0, 0, 0.3),
        0 0 30px rgba(16, 185, 129, 0.1);
}

.order-card:hover::before {
    opacity: 1;
}

.order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: var(--space-4) var(--space-5);
    background: var(--bg-tertiary);
    border-bottom: 1px solid var(--border-primary);
}

.order-number .label {
    display: block;
    font-size: 0.7rem;
    color: var(--text-tertiary);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: var(--space-1);
}

.order-number a {
    font-weight: 600;
    font-size: 0.95rem;
    color: var(--success);
    transition: color 0.2s ease;
}

.order-number a:hover {
    color: #14b8a6;
}

.order-status .badge {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-2) var(--space-3);
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-warning {
    background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    color: white;
}

.badge-info {
    background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
    color: white;
}

.badge-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
}

.badge-primary {
    background: linear-gradient(135deg, #8b5cf6 0%, #7c3aed 100%);
    color: white;
}

.badge-success {
    background: var(--gradient-primary);
    color: white;
}

.order-body {
    display: flex;
    gap: var(--space-4);
    padding: var(--space-5);
}

.order-avatar {
    flex-shrink: 0;
}

.order-avatar img {
    width: 64px;
    height: 64px;
    border-radius: var(--radius-lg);
    object-fit: cover;
    border: 2px solid var(--border-primary);
}

.avatar-placeholder {
    width: 64px;
    height: 64px;
    border-radius: var(--radius-lg);
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.order-info h4 {
    font-size: 1.05rem;
    margin-bottom: var(--space-1);
}

.order-info > p {
    font-size: 0.8rem;
    color: var(--text-tertiary);
    margin-bottom: var(--space-3);
}

.order-details {
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-2);
}

.detail-item {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.8rem;
    color: var(--text-secondary);
    background: var(--bg-tertiary);
    padding: var(--space-2) var(--space-3);
    border-radius: var(--radius-md);
    border: 1px solid var(--border-primary);
}

.detail-item i {
    color: var(--success);
    font-size: 0.75rem;
}

.order-footer {
    padding: var(--space-4) var(--space-5);
    border-top: 1px solid var(--border-primary);
    background: var(--bg-tertiary);
    display: flex;
    justify-content: flex-end;
}

.empty-state {
    text-align: center;
    padding: var(--space-16) var(--space-8);
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-2xl);
}

.empty-icon {
    width: 100px;
    height: 100px;
    background: var(--bg-tertiary);
    border-radius: var(--radius-full);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto var(--space-6);
    font-size: 2.5rem;
    color: var(--text-tertiary);
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: var(--space-2);
}

.empty-state p {
    color: var(--text-secondary);
    margin-bottom: var(--space-6);
}

@media (max-width: 768px) {
    .orders-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 576px) {
    .order-header {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-3);
    }
    
    .order-body {
        flex-direction: column;
        align-items: center;
        text-align: center;
    }
    
    .order-details {
        justify-content: center;
    }
    
    .order-footer {
        justify-content: center;
    }
}
</style>
@endsection
