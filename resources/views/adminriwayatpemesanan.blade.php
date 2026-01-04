@extends('app')

@section('content')
<link href="{{ asset('/css/modern.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="riwayat-container">
    {{-- Page Header --}}
    <div class="page-header">
        <div class="header-content">
            <div class="header-left">
                <h1 class="page-title"><i class="fas fa-history"></i> Riwayat Pemesanan</h1>
                <p class="page-subtitle">Kelola dan pantau semua pemesanan yang masuk</p>
            </div>
        </div>
    </div>

    {{-- Flash Messages --}}
    @if(Session::has('message_success'))
    <div class="alert alert-success animate-fadeIn">
        <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
        <div class="alert-content">{{ Session::get('message_success') }}</div>
    </div>
    @endif

    @if(Session::has('message_failed'))
    <div class="alert alert-danger animate-fadeIn">
        <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
        <div class="alert-content">{{ Session::get('message_failed') }}</div>
    </div>
    @endif

    {{-- Orders Grid --}}
    @if(count($riwayatpemesanan) != 0)
    <div class="orders-grid">
        @foreach($riwayatpemesanan as $key => $value)
        <div class="order-card">
            <div class="order-header">
                <div class="order-number">
                    <i class="fas fa-receipt"></i>
                    <span>{{ $value->nomorpemesanan }}</span>
                </div>
                <div class="status-badge status-{{ $value->statuspemesanan }}">
                    @include('include/statuspemesanan')
                </div>
            </div>

            <div class="order-body">
                <div class="order-detail">
                    <i class="fas fa-hard-hat"></i>
                    <div class="detail-content">
                        <span class="detail-label">Nama Tukang</span>
                        <span class="detail-value">{{ $value->namatukang }}</span>
                    </div>
                </div>

                <div class="order-detail">
                    <i class="fas fa-user"></i>
                    <div class="detail-content">
                        <span class="detail-label">Nama Pelanggan</span>
                        <span class="detail-value">{{ $value->namapelanggan }}</span>
                    </div>
                </div>

                <div class="order-detail">
                    <i class="fas fa-tags"></i>
                    <div class="detail-content">
                        <span class="detail-label">Kategori</span>
                        <span class="detail-value">{{ $value->kategoritukang }}</span>
                    </div>
                </div>

                <div class="order-detail">
                    <i class="fas fa-calendar-check"></i>
                    <div class="detail-content">
                        <span class="detail-label">Jenis Pemesanan</span>
                        <span class="detail-value">@include('include/harianorborongan')</span>
                    </div>
                </div>

                <div class="order-detail">
                    <i class="fas fa-clock"></i>
                    <div class="detail-content">
                        <span class="detail-label">Tanggal Kedatangan</span>
                        <span class="detail-value">{{ $value->tanggalbekerja }}</span>
                    </div>
                </div>
            </div>

            <div class="order-footer">
                <a href="{{ url('riwayatpemesanan/' . $value->id_pemesanan) }}" class="btn-view-detail">
                    <span>Lihat Detail</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
        @endforeach
    </div>
    @else
    {{-- Empty State --}}
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-inbox"></i>
        </div>
        <h3>Belum Ada Pemesanan</h3>
        <p>Saat ini tidak ada data pemesanan yang tersedia.</p>
    </div>
    @endif
</div>

<style>
/* Riwayat Container */
.riwayat-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: var(--space-8);
    min-height: 100vh;
}

/* Page Header */
.page-header {
    margin-bottom: var(--space-8);
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: var(--space-4);
}

.header-left {
    flex: 1;
}

.page-title {
    font-size: 2rem;
    margin-bottom: var(--space-2);
    display: flex;
    align-items: center;
    gap: var(--space-3);
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-title i {
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.page-subtitle {
    color: var(--text-secondary);
    font-size: 1rem;
}

/* Alert Messages */
.alert {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-4);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-6);
    border: 1px solid;
    backdrop-filter: blur(10px);
}

.alert-success {
    background: rgba(16, 185, 129, 0.1);
    border-color: var(--success);
    color: var(--success);
}

.alert-danger {
    background: rgba(239, 68, 68, 0.1);
    border-color: var(--danger);
    color: var(--danger);
}

.alert-icon {
    font-size: 1.25rem;
    flex-shrink: 0;
}

.alert-content {
    flex: 1;
    font-weight: 500;
}

/* Orders Grid */
.orders-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(450px, 1fr));
    gap: var(--space-6);
}

/* Order Card */
.order-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: all var(--transition-base);
    position: relative;
}

.order-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
    opacity: 0;
    transition: opacity var(--transition-base);
    pointer-events: none;
}

.order-card:hover {
    transform: translateY(-4px);
    border-color: var(--border-hover);
    box-shadow: var(--shadow-xl), var(--shadow-glow);
}

.order-card:hover::before {
    opacity: 1;
}

/* Order Header */
.order-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-5) var(--space-6);
    background: var(--bg-tertiary);
    border-bottom: 1px solid var(--border-primary);
}

.order-number {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--text-primary);
    font-family: var(--font-display);
}

.order-number i {
    color: var(--success);
    font-size: 1rem;
}

/* Status Badges */
.status-badge {
    padding: var(--space-2) var(--space-4);
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    display: inline-flex;
    align-items: center;
    gap: var(--space-1);
}

.status-badge::before {
    content: '';
    width: 6px;
    height: 6px;
    border-radius: 50%;
    background: currentColor;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

/* Status colors - adjust based on your statuspemesanan values */
.status-0 .status-badge,
.status-badge.status-0 {
    background: rgba(156, 163, 175, 0.15);
    color: #9ca3af;
}

.status-1 .status-badge,
.status-badge.status-1 {
    background: rgba(59, 130, 246, 0.15);
    color: #3b82f6;
}

.status-2 .status-badge,
.status-badge.status-2 {
    background: rgba(245, 158, 11, 0.15);
    color: #f59e0b;
}

.status-3 .status-badge,
.status-badge.status-3 {
    background: rgba(16, 185, 129, 0.15);
    color: #10b981;
}

.status-4 .status-badge,
.status-badge.status-4 {
    background: rgba(239, 68, 68, 0.15);
    color: #ef4444;
}

/* Order Body */
.order-body {
    padding: var(--space-6);
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.order-detail {
    display: flex;
    align-items: flex-start;
    gap: var(--space-3);
}

.order-detail > i {
    width: 20px;
    color: var(--success);
    font-size: 0.875rem;
    margin-top: 2px;
    flex-shrink: 0;
}

.detail-content {
    flex: 1;
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.detail-label {
    font-size: 0.75rem;
    color: var(--text-tertiary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-weight: 600;
}

.detail-value {
    font-size: 0.9rem;
    color: var(--text-primary);
    font-weight: 500;
}

/* Order Footer */
.order-footer {
    padding: var(--space-5) var(--space-6);
    border-top: 1px solid var(--border-primary);
    background: var(--bg-tertiary);
}

.btn-view-detail {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    width: 100%;
    padding: var(--space-3) var(--space-5);
    background: var(--gradient-primary);
    color: white;
    border-radius: var(--radius-lg);
    font-weight: 600;
    font-size: 0.9rem;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    transition: all var(--transition-base);
    text-decoration: none;
}

.btn-view-detail:hover {
    transform: translateX(4px);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    color: white;
}

.btn-view-detail i {
    transition: transform var(--transition-base);
}

.btn-view-detail:hover i {
    transform: translateX(4px);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: var(--space-16) var(--space-8);
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-2xl);
}

.empty-icon {
    width: 120px;
    height: 120px;
    margin: 0 auto var(--space-6);
    background: rgba(16, 185, 129, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: var(--success);
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: var(--space-2);
    color: var(--text-primary);
}

.empty-state p {
    color: var(--text-secondary);
    font-size: 1rem;
}

/* Responsive */
@media (max-width: 768px) {
    .riwayat-container {
        padding: var(--space-4);
    }

    .orders-grid {
        grid-template-columns: 1fr;
    }

    .page-title {
        font-size: 1.5rem;
    }

    .order-header {
        flex-direction: column;
        align-items: flex-start;
        gap: var(--space-3);
    }
}

/* Animation */
.animate-fadeIn {
    animation: fadeIn 0.5s ease-in-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>
@endsection
