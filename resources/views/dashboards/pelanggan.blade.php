@extends('app')

@section('content')
    <link href="{{ asset('/css/modern.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <div class="dashboard-container">
        {{-- Dashboard Header --}}
        <div class="dashboard-header">
            <div class="header-content">
                <div class="header-text">
                    <h1>Selamat Datang! 👋</h1>
                    <p>Halo, <span class="user-name">{{ Auth::user()->pelanggan->namapelanggan ?? 'Pelanggan' }}</span></p>
                </div>
                <div class="header-actions">
                    <span class="header-time"><i class="far fa-clock"></i>
                        {{ \Carbon\Carbon::now('Asia/Jakarta')->format('d M Y, H:i') }} WIB</span>
                </div>
            </div>
        </div>

        {{-- Quick Stats --}}
        <div class="stats-grid">
            <div class="stat-card stat-primary">
                <div class="stat-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-label">Pesanan Aktif</span>
                    <span class="stat-value">{{ $activeOrders }}</span>
                </div>
            </div>

            <div class="stat-card stat-success">
                <div class="stat-icon">
                    <i class="fas fa-hard-hat"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-label">Tukang Tersedia</span>
                    <span class="stat-value">{{ count($tukang) }}</span>
                </div>
            </div>

            <div class="stat-card stat-purple">
                <div class="stat-icon">
                    <i class="fas fa-th-large"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-label">Kategori Jasa</span>
                    <span class="stat-value">{{ count($kategoritukang) }}</span>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="quick-actions-section">
            <h2 class="section-title"><i class="fas fa-rocket"></i> Akses Cepat</h2>
            <div class="quick-actions-grid">
                <a href="{{ url('caritukang?kategori=all&jarak=10') }}" class="action-card">
                    <div class="action-icon action-icon-green">
                        <i class="fas fa-search"></i>
                    </div>
                    <div class="action-content">
                        <span class="action-title">Cari Tukang</span>
                        <span class="action-desc">Temukan tukang terbaik</span>
                    </div>
                </a>

                <a href="{{ url('riwayatpemesanan') }}" class="action-card">
                    <div class="action-icon action-icon-blue">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="action-content">
                        <span class="action-title">Riwayat Pesanan</span>
                        <span class="action-desc">Lihat pesanan Anda</span>
                    </div>
                </a>

                <a href="{{ url('isisaldo') }}" class="action-card">
                    <div class="action-icon action-icon-gold">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="action-content">
                        <span class="action-title">Isi Saldo</span>
                        <span class="action-desc">Top-up saldo Anda</span>
                    </div>
                </a>

                <a href="{{ url('riwayat-transaksi') }}" class="action-card">
                    <div class="action-icon action-icon-pink">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="action-content">
                        <span class="action-title">Riwayat Transaksi</span>
                        <span class="action-desc">Lihat semua transaksi</span>
                    </div>
                </a>
            </div>
        </div>

        {{-- Recommended Tukang --}}
        @if(count($tukang) > 0)
            <div class="tukang-section">
                <h2 class="section-title"><i class="fas fa-star"></i> Tukang Terbaik Untuk Anda</h2>
                <div class="tukang-grid">
                    @foreach($tukang as $t)
                        <div class="tukang-card">
                            <div class="tukang-header">
                                <div class="tukang-avatar">
                                    @if($t->fotoprofil && $t->fotoprofil != 'nopicture.jpg')
                                        <img src="{{ asset('images/fotoprofil/' . $t->fotoprofil) }}" alt="{{ $t->namatukang }}">
                                    @else
                                        <div class="avatar-placeholder">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="tukang-rating">
                                    <i class="fas fa-star"></i>
                                    <span>{{ $t->rating > 0 ? number_format($t->rating, 1) : '0.0' }}</span>
                                </div>
                            </div>

                            <div class="tukang-info">
                                <h4>{{ $t->namatukang }}</h4>
                                <div class="tukang-category">
                                    <i class="fas fa-briefcase"></i>
                                    <span>{{ $t->kategoritukang }}</span>
                                </div>
                                @if($t->alamat)
                                    <div class="tukang-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ Str::limit($t->alamat, 30) }}</span>
                                    </div>
                                @endif
                            </div>

                            <a href="{{ url('detailtukang/' . $t->id_tukang) }}" class="btn-view-tukang">
                                <i class="fas fa-eye"></i> Lihat Detail
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- Category Quick Access --}}
        @if(count($kategoritukang) > 0)
            <div class="category-section">
                <h2 class="section-title"><i class="fas fa-th-large"></i> Kategori Jasa</h2>
                <div class="category-grid">
                    @foreach($kategoritukang as $kategori)
                        <a href="{{ url('caritukang?kategori=' . $kategori->id_kategoritukang . '&jarak=10') }}"
                            class="category-card">
                            <div class="category-icon">
                                <i class="fas fa-tools"></i>
                            </div>
                            <span class="category-name">{{ $kategori->kategoritukang }}</span>
                        </a>
                    @endforeach
                </div>
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

        .stat-primary .stat-icon {
            background: var(--gradient-primary);
        }

        .stat-success .stat-icon {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        }

        .stat-purple .stat-icon {
            background: var(--gradient-accent);
        }

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

        .action-icon-green {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .action-icon-blue {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .action-icon-gold {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .action-icon-pink {
            background: linear-gradient(135deg, #ec4899, #db2777);
        }

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

        /* Tukang Section */
        .tukang-section {
            margin-bottom: var(--space-10);
        }

        .tukang-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-6);
        }

        .tukang-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            transition: all 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .tukang-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.1);
            border-color: var(--success);
        }

        .tukang-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: var(--space-4);
        }

        .tukang-avatar {
            width: 80px;
            height: 80px;
            border-radius: var(--radius-lg);
            overflow: hidden;
        }

        .tukang-avatar img {
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
            font-size: 2rem;
            color: white;
        }

        .tukang-rating {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-2) var(--space-3);
            background: rgba(251, 191, 36, 0.1);
            border-radius: var(--radius-lg);
            color: #fbbf24;
            font-weight: 600;
        }

        .tukang-info {
            flex: 1;
            margin-bottom: var(--space-4);
        }

        .tukang-info h4 {
            font-size: 1.25rem;
            margin-bottom: var(--space-3);
            color: var(--text-primary);
        }

        .tukang-category,
        .tukang-location {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin-bottom: var(--space-2);
        }

        .tukang-category i,
        .tukang-location i {
            color: var(--success);
            width: 16px;
        }

        .btn-view-tukang {
            width: 100%;
            padding: var(--space-3);
            background: var(--gradient-primary);
            color: white;
            border: none;
            border-radius: var(--radius-lg);
            font-weight: 600;
            text-align: center;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
        }

        .btn-view-tukang:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.3);
            color: white;
        }

        /* Category Section */
        .category-section {
            margin-bottom: var(--space-10);
        }

        .category-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--space-4);
        }

        .category-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-lg);
            padding: var(--space-5);
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--space-3);
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .category-card:hover {
            background: var(--bg-tertiary);
            border-color: var(--success);
            transform: translateY(-2px);
        }

        .category-icon {
            width: 48px;
            height: 48px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .category-name {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--text-primary);
            text-align: center;
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

            .tukang-grid {
                grid-template-columns: 1fr;
            }

            .category-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .header-text h1 {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection