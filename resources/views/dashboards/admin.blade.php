@extends('app')

@section('content')
<link href="{{ asset('/css/modern.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="dashboard-container">
    {{-- Dashboard Header --}}
    <div class="dashboard-header">
        <div class="header-content">
            <div class="header-text">
                <h1>Dashboard Admin 👔</h1>
                <p>Selamat datang kembali, <span class="user-name">{{ Auth::user()->email }}</span></p>
            </div>
            <div class="header-actions">
                <span class="header-time"><i class="far fa-clock"></i> {{ date('d M Y, H:i') }}</span>
            </div>
        </div>
    </div>

    {{-- Quick Stats --}}
    <div class="stats-grid">
        <div class="stat-card stat-primary">
            <div class="stat-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Total Users</span>
                <span class="stat-value">{{ $totalUsers }}</span>
            </div>
        </div>

        <div class="stat-card stat-success">
            <div class="stat-icon">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Pelanggan</span>
                <span class="stat-value">{{ $totalPelanggan }}</span>
            </div>
        </div>

        <div class="stat-card stat-purple">
            <div class="stat-icon">
                <i class="fas fa-hard-hat"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Tukang</span>
                <span class="stat-value">{{ $totalTukang }}</span>
            </div>
        </div>

        <div class="stat-card stat-warning">
            <div class="stat-icon">
                <i class="fas fa-clock"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Pending Transactions</span>
                <span class="stat-value">{{ $pendingTransactions }}</span>
            </div>
        </div>

        <div class="stat-card stat-info">
            <div class="stat-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Total Orders</span>
                <span class="stat-value">{{ $totalOrders }}</span>
            </div>
        </div>

        <div class="stat-card stat-danger">
            <div class="stat-icon">
                <i class="fas fa-user-check"></i>
            </div>
            <div class="stat-content">
                <span class="stat-label">Pending Verifications</span>
                <span class="stat-value">{{ count($verifikasitukang) }}</span>
            </div>
        </div>
    </div>

    {{-- Quick Actions --}}
    <div class="quick-actions-section">
        <h2 class="section-title"><i class="fas fa-bolt"></i> Quick Actions</h2>
        <div class="quick-actions-grid">
            <a href="{{ url('/konfirmasi-update-saldo') }}" class="action-card">
                <div class="action-icon action-icon-green">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="action-content">
                    <span class="action-title">Konfirmasi Top-Up</span>
                    <span class="action-desc">Verifikasi pengisian saldo</span>
                </div>
            </a>

            <a href="{{ url('/konfirmasi-tarik-saldo') }}" class="action-card">
                <div class="action-icon action-icon-purple">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="action-content">
                    <span class="action-title">Konfirmasi Penarikan</span>
                    <span class="action-desc">Proses penarikan saldo</span>
                </div>
            </a>

            <a href="{{ url('/riwayat-transaksi') }}" class="action-card">
                <div class="action-icon action-icon-blue">
                    <i class="fas fa-history"></i>
                </div>
                <div class="action-content">
                    <span class="action-title">Riwayat Transaksi</span>
                    <span class="action-desc">Lihat semua transaksi</span>
                </div>
            </a>

            <a href="{{ url('/riwayatpemesanan') }}" class="action-card">
                <div class="action-icon action-icon-gold">
                    <i class="fas fa-receipt"></i>
                </div>
                <div class="action-content">
                    <span class="action-title">Riwayat Pemesanan</span>
                    <span class="action-desc">Kelola pesanan</span>
                </div>
            </a>

            <a href="{{ url('/ubah-harga-jarak') }}" class="action-card">
                <div class="action-icon action-icon-pink">
                    <i class="fas fa-route"></i>
                </div>
                <div class="action-content">
                    <span class="action-title">Harga Jarak</span>
                    <span class="action-desc">Atur biaya per KM</span>
                </div>
            </a>

            <a href="{{ url('/datakategoritukang') }}" class="action-card">
                <div class="action-icon action-icon-cyan">
                    <i class="fas fa-th-large"></i>
                </div>
                <div class="action-content">
                    <span class="action-title">Kategori Tukang</span>
                    <span class="action-desc">Kelola kategori</span>
                </div>
            </a>

            <a href="{{ url('/informasi-user') }}" class="action-card">
                <div class="action-icon action-icon-orange">
                    <i class="fas fa-users"></i>
                </div>
                <div class="action-content">
                    <span class="action-title">Info User</span>
                    <span class="action-desc">Daftar pengguna</span>
                </div>
            </a>
        </div>
    </div>

    {{-- Pending Verifications --}}
    @if(count($verifikasitukang) > 0)
    <div class="verifications-section">
        <h2 class="section-title"><i class="fas fa-user-check"></i> Pending Verifications ({{ count($verifikasitukang) }})</h2>
        <div class="verifications-grid">
            @foreach($verifikasitukang as $tukang)
            <div class="verification-card">
                <div class="verification-header">
                    <div class="user-avatar">
                        @if($tukang->fotoprofil && $tukang->fotoprofil != 'nopicture.jpg')
                            <img src="{{ asset('images/fotoprofil/' . $tukang->fotoprofil) }}" alt="{{ $tukang->namatukang }}">
                        @else
                            <div class="avatar-placeholder">
                                <i class="fas fa-user"></i>
                            </div>
                        @endif
                    </div>
                    <div class="user-info">
                        <h4>{{ $tukang->namatukang }}</h4>
                        <p>{{ $tukang->email }}</p>
                        <span class="user-code">{{ $tukang->kodeuser }}</span>
                    </div>
                </div>

                <div class="verification-details">
                    <div class="detail-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $tukang->nomorhandphone ?: 'Tidak ada' }}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ $tukang->alamat ?: 'Tidak ada alamat' }}</span>
                    </div>
                </div>

                <div class="verification-actions">
                    <form method="POST" action="{{ url('/home/terima') }}" style="display:inline;">
                        {!! csrf_field() !!}
                        <input type="hidden" name="iduser" value="{{ $tukang->id }}">
                        <button type="submit" class="btn-verify btn-approve">
                            <i class="fas fa-check"></i> Terima
                        </button>
                    </form>
                    <form method="POST" action="{{ url('/home/tolak') }}" style="display:inline;">
                        {!! csrf_field() !!}
                        <input type="hidden" name="iduser" value="{{ $tukang->id }}">
                        <button type="submit" class="btn-verify btn-reject">
                            <i class="fas fa-times"></i> Tolak
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <div class="empty-state">
        <div class="empty-icon">
            <i class="fas fa-check-circle"></i>
        </div>
        <h3>Semua Verifikasi Selesai!</h3>
        <p>Tidak ada tukang yang menunggu verifikasi saat ini.</p>
    </div>
    @endif
</div>

<style>
/* Dashboard Container */
.dashboard-container {
    max-width: 1400px;
    margin: 0 auto;
    padding: var(--space-8);
    min-height: 100vh;
}

/* Dashboard Header */
.dashboard-header {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-2xl);
    padding: var(--space-8);
    margin-bottom: var(--space-8);
}

.header-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: var(--space-4);
}

.header-text h1 {
    font-size: 2rem;
    margin-bottom: var(--space-2);
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.header-text p {
    color: var(--text-secondary);
    font-size: 1rem;
}

.user-name {
    color: var(--success);
    font-weight: 600;
}

.header-time {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    color: var(--text-tertiary);
    font-size: 0.9rem;
    padding: var(--space-3) var(--space-4);
    background: var(--bg-tertiary);
    border-radius: var(--radius-lg);
}

/* Stats Grid */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: var(--space-6);
    margin-bottom: var(--space-10);
}

.stat-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    display: flex;
    align-items: center;
    gap: var(--space-4);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.stat-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 4px;
    height: 100%;
    background: var(--gradient-primary);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 12px 30px rgba(16, 185, 129, 0.15);
}

.stat-card:hover::before {
    opacity: 1;
}

.stat-icon {
    width: 64px;
    height: 64px;
    background: var(--gradient-primary);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: white;
    flex-shrink: 0;
}

.stat-primary .stat-icon { background: var(--gradient-primary); }
.stat-success .stat-icon { background: linear-gradient(135deg, #10b981 0%, #059669 100%); }
.stat-purple .stat-icon { background: var(--gradient-accent); }
.stat-warning .stat-icon { background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%); }
.stat-info .stat-icon { background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%); }
.stat-danger .stat-icon { background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); }

.stat-content {
    display: flex;
    flex-direction: column;
    gap: var(--space-1);
}

.stat-label {
    font-size: 0.85rem;
    color: var(--text-secondary);
    font-weight: 500;
}

.stat-value {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-primary);
    font-family: var(--font-display);
}

/* Section Title */
.section-title {
    font-size: 1.5rem;
    margin-bottom: var(--space-6);
    display: flex;
    align-items: center;
    gap: var(--space-3);
    color: var(--text-primary);
}

.section-title i {
    color: var(--success);
}

/* Quick Actions */
.quick-actions-section {
    margin-bottom: var(--space-10);
}

.quick-actions-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: var(--space-5);
}

.action-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    padding: var(--space-5);
    display: flex;
    align-items: center;
    gap: var(--space-4);
    transition: all 0.3s ease;
    text-decoration: none;
}

.action-card:hover {
    transform: translateY(-2px);
    border-color: var(--success);
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.1);
}

.action-icon {
    width: 56px;
    height: 56px;
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
    flex-shrink: 0;
}

.action-icon-green { background: linear-gradient(135deg, #10b981, #059669); }
.action-icon-purple { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
.action-icon-blue { background: linear-gradient(135deg, #3b82f6, #2563eb); }
.action-icon-gold { background: linear-gradient(135deg, #f59e0b, #d97706); }
.action-icon-pink { background: linear-gradient(135deg, #ec4899, #db2777); }
.action-icon-cyan { background: linear-gradient(135deg, #06b6d4, #0891b2); }
.action-icon-orange { background: linear-gradient(135deg, #f97316, #ea580c); }

.action-content {
    display: flex;
    flex-direction: column;
    gap: var(--space-1);
}

.action-title {
    font-size: 1rem;
    font-weight: 600;
    color: var(--text-primary);
}

.action-desc {
    font-size: 0.85rem;
    color: var(--text-tertiary);
}

/* Verifications */
.verifications-section {
    margin-bottom: var(--space-10);
}

.verifications-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
    gap: var(--space-6);
}

.verification-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    transition: all 0.3s ease;
}

.verification-card:hover {
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    transform: translateY(-2px);
}

.verification-header {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    margin-bottom: var(--space-5);
}

.user-avatar {
    width: 64px;
    height: 64px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    flex-shrink: 0;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.avatar-placeholder {
    width: 100%;
    height: 100%;
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.user-info h4 {
    font-size: 1.1rem;
    margin-bottom: var(--space-1);
    color: var(--text-primary);
}

.user-info p {
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin-bottom: var(--space-2);
}

.user-code {
    display: inline-block;
    padding: 4px 12px;
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
    border-radius: var(--radius-md);
    font-size: 0.75rem;
    font-weight: 600;
}

.verification-details {
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
    margin-bottom: var(--space-5);
    padding: var(--space-4);
    background: var(--bg-tertiary);
    border-radius: var(--radius-lg);
}

.detail-item {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.detail-item i {
    width: 20px;
    color: var(--success);
}

.verification-actions {
    display: flex;
    gap: var(--space-3);
}

.btn-verify {
    flex: 1;
    padding: var(--space-3) var(--space-4);
    border: none;
    border-radius: var(--radius-lg);
    font-size: 0.9rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
}

.btn-approve {
    background: var(--gradient-primary);
    color: white;
}

.btn-approve:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(16, 185, 129, 0.3);
}

.btn-reject {
    background: var(--bg-tertiary);
    color: var(--text-secondary);
    border: 1px solid var(--border-primary);
}

.btn-reject:hover {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger);
    border-color: var(--danger);
}

/* Empty State */
.empty-state {
    text-align: center;
    padding: var(--space-10);
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-2xl);
}

.empty-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto var(--space-5);
    background: rgba(16, 185, 129, 0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    color: var(--success);
}

.empty-state h3 {
    font-size: 1.5rem;
    margin-bottom: var(--space-2);
    color: var(--text-primary);
}

.empty-state p {
    color: var(--text-secondary);
}

/* Responsive */
@media (max-width: 768px) {
    .dashboard-container {
        padding: var(--space-4);
    }

    .stats-grid {
        grid-template-columns: 1fr;
    }

    .quick-actions-grid {
        grid-template-columns: 1fr;
    }

    .verifications-grid {
        grid-template-columns: 1fr;
    }

    .header-text h1 {
        font-size: 1.5rem;
    }
}
</style>
@endsection
