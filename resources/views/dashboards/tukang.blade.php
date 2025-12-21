@extends('app')

@section('content')
    <link href="{{ asset('/css/modern.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <div class="dashboard-container">
        {{-- Dashboard Header --}}
        <div class="dashboard-header">
            <div class="header-content">
                <div class="header-text">
                    <h1>Dashboard Tukang 🔧</h1>
                    <p>Selamat datang kembali, <span class="user-name">{{ Auth::user()->kodeuser }}</span></p>
                </div>
                <div class="header-badge">
                    <div class="rating-badge">
                        <i class="fas fa-star"></i>
                        <span>{{ $tukangData ? number_format($tukangData->rating, 1) : '0.0' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Quick Stats --}}
        <div class="stats-grid">
            <div class="stat-card stat-warning">
                <div class="stat-icon">
                    <i class="fas fa-clock"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-label">Permintaan Baru</span>
                    <span class="stat-value">{{ $pendingOrders }}</span>
                </div>
            </div>

            <div class="stat-card stat-info">
                <div class="stat-icon">
                    <i class="fas fa-briefcase"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-label">Pekerjaan Aktif</span>
                    <span class="stat-value">{{ $pbs }}</span>
                </div>
            </div>

            <div class="stat-card stat-success">
                <div class="stat-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-label">Selesai</span>
                    <span class="stat-value">{{ $ps }}</span>
                </div>
            </div>

            <div class="stat-card stat-purple">
                <div class="stat-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-label">Total Pendapatan</span>
                    <span class="stat-value earnings">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="stat-card stat-primary">
                <div class="stat-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-label">Saldo Saat Ini</span>
                    <span class="stat-value earnings">Rp {{ number_format(Auth::user()->saldo, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="stat-card stat-gold">
                <div class="stat-icon">
                    <i class="fas fa-star"></i>
                </div>
                <div class="stat-content">
                    <span class="stat-label">Total Ulasan</span>
                    <span class="stat-value">{{ $tukangData ? $tukangData->jumlahvote : 0 }}</span>
                </div>
            </div>
        </div>

        {{-- Quick Actions --}}
        <div class="quick-actions-section">
            <h2 class="section-title"><i class="fas fa-bolt"></i> Quick Actions</h2>
            <div class="quick-actions-grid">
                @if($pendingOrders > 0)
                    <a href="{{ url('/permintaan-pesanan') }}" class="action-card action-highlight">
                        <div class="action-icon action-icon-orange">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <div class="action-content">
                            <span class="action-title">Permintaan Pesanan</span>
                            <span class="action-desc">{{ $pendingOrders }} pesanan menunggu</span>
                        </div>
                        <div class="action-badge">{{ $pendingOrders }}</div>
                    </a>
                @else
                    <a href="{{ url('/permintaan-pesanan') }}" class="action-card">
                        <div class="action-icon action-icon-blue">
                            <i class="fas fa-inbox"></i>
                        </div>
                        <div class="action-content">
                            <span class="action-title">Permintaan Pesanan</span>
                            <span class="action-desc">Tidak ada permintaan baru</span>
                        </div>
                    </a>
                @endif

                <a href="{{ url('/riwayatpemesanan') }}" class="action-card">
                    <div class="action-icon action-icon-green">
                        <i class="fas fa-history"></i>
                    </div>
                    <div class="action-content">
                        <span class="action-title">Riwayat Pemesanan</span>
                        <span class="action-desc">Lihat semua pesanan</span>
                    </div>
                </a>

                <a href="{{ url('/pengaturan-jasa-keahlian') }}" class="action-card">
                    <div class="action-icon action-icon-purple">
                        <i class="fas fa-tools"></i>
                    </div>
                    <div class="action-content">
                        <span class="action-title">Pengaturan Jasa</span>
                        <span class="action-desc">Kelola layanan Anda</span>
                    </div>
                </a>

                <a href="{{ url('/penarikan-saldo') }}" class="action-card">
                    <div class="action-icon action-icon-gold">
                        <i class="fas fa-money-bill-wave"></i>
                    </div>
                    <div class="action-content">
                        <span class="action-title">Penarikan Saldo</span>
                        <span class="action-desc">Tarik penghasilan</span>
                    </div>
                </a>

                <a href="{{ url('/riwayat-transaksi') }}" class="action-card">
                    <div class="action-icon action-icon-blue">
                        <i class="fas fa-receipt"></i>
                    </div>
                    <div class="action-content">
                        <span class="action-title">Riwayat Transaksi</span>
                        <span class="action-desc">Lihat semua transaksi</span>
                    </div>
                </a>

            </div>
        </div>

        {{-- Profile Status Card --}}
        @if($tukangData)
            <div class="profile-section">
                <h2 class="section-title"><i class="fas fa-id-card"></i> Status Profil</h2>
                <div class="profile-status-card">
                    <div class="profile-header">
                        <div class="profile-avatar">
                            @if(Auth::user()->fotoprofil && Auth::user()->fotoprofil != 'nopicture.jpg')
                                <img src="{{ asset('images/fotoprofil/' . Auth::user()->fotoprofil) }}" alt="Profile">
                            @else
                                <div class="avatar-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            @endif
                        </div>
                        <div class="profile-info">
                            <h3>{{ $tukangData->namatukang }}</h3>
                            <p class="profile-email">{{ Auth::user()->email }}</p>
                            <span class="profile-code">{{ Auth::user()->kodeuser }}</span>
                        </div>
                    </div>

                    <div class="profile-stats-grid">
                        <div class="profile-stat-item">
                            <div class="stat-icon-sm">
                                <i class="fas fa-star"></i>
                            </div>
                            <div>
                                <span class="stat-label-sm">Rating</span>
                                <span class="stat-value-sm">{{ number_format($tukangData->rating, 1) }} / 5.0</span>
                            </div>
                        </div>

                        <div class="profile-stat-item">
                            <div class="stat-icon-sm">
                                <i class="fas fa-briefcase"></i>
                            </div>
                            <div>
                                <span class="stat-label-sm">Pengalaman</span>
                                <span class="stat-value-sm">{{ $tukangData->lamapengalamanbekerja }} Tahun</span>
                            </div>
                        </div>

                        <div class="profile-stat-item">
                            <div class="stat-icon-sm">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div>
                                <span class="stat-label-sm">Status</span>
                                <span
                                    class="stat-value-sm {{ $tukangData->statusjasakeahlian == '1' ? 'status-active' : 'status-inactive' }}">
                                    {{ $tukangData->statusjasakeahlian == '1' ? 'Aktif' : 'Nonaktif' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="profile-description">
                        <h4><i class="fas fa-info-circle"></i> Deskripsi Keahlian</h4>
                        <p>{{ $tukangData->deskripsikeahlian ?: 'Belum ada deskripsi' }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- Tips Section --}}
        <div class="tips-section">
            <h2 class="section-title"><i class="fas fa-lightbulb"></i> Tips untuk Anda</h2>
            <div class="tips-grid">
                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h4>Respon Cepat</h4>
                    <p>Tanggapi permintaan pesanan dengan cepat untuk meningkatkan kepercayaan pelanggan.</p>
                </div>

                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h4>Komunikasi Baik</h4>
                    <p>Jaga komunikasi yang baik dengan pelanggan selama pengerjaan proyek.</p>
                </div>

                <div class="tip-card">
                    <div class="tip-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h4>Kualitas Kerja</h4>
                    <p>Berikan hasil terbaik untuk mendapatkan rating dan review yang baik.</p>
                </div>
            </div>
        </div>
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
            background: var(--gradient-accent);
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

        .rating-badge {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-3) var(--space-5);
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border-radius: var(--radius-lg);
            color: white;
            font-size: 1.25rem;
            font-weight: 700;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: var(--space-6);
            margin-bottom: var(--space-10);
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            display: flex;
            align-items: flex-start;
            gap: var(--space-4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
            border-radius: 50%;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
        }

        .stat-icon {
            width: 56px;
            height: 56px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            flex-shrink: 0;
        }

        .stat-warning .stat-icon {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .stat-info .stat-icon {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
        }

        .stat-success .stat-icon {
            background: linear-gradient(135deg, #10b981, #059669);
        }

        .stat-purple .stat-icon {
            background: var(--gradient-accent);
        }

        .stat-primary .stat-icon {
            background: var(--gradient-primary);
        }

        .stat-gold .stat-icon {
            background: linear-gradient(135deg, #f59e0b, #d97706);
        }

        .stat-content {
            display: flex;
            flex-direction: column;
            gap: var(--space-1);
            flex: 1;
        }

        .stat-label {
            font-size: 0.85rem;
            color: var(--text-secondary);
            font-weight: 500;
        }

        .stat-value {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-primary);
            font-family: var(--font-display);
        }

        .stat-value.earnings {
            font-size: 1.25rem;
        }

        .stat-badge {
            position: absolute;
            top: var(--space-3);
            right: var(--space-3);
            padding: 4px 12px;
            border-radius: var(--radius-md);
            font-size: 0.75rem;
            font-weight: 600;
        }

        .badge-warning {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .badge-info {
            background: rgba(59, 130, 246, 0.1);
            color: #3b82f6;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
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
            position: relative;
        }

        .action-card:hover {
            transform: translateY(-2px);
            border-color: var(--success);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.1);
        }

        .action-highlight {
            border-color: #f59e0b;
            background: rgba(245, 158, 11, 0.05);
        }

        .action-highlight:hover {
            border-color: #f59e0b;
            box-shadow: 0 8px 20px rgba(245, 158, 11, 0.2);
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

        .action-icon-purple {
            background: linear-gradient(135deg, #8b5cf6, #7c3aed);
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

        .action-icon-cyan {
            background: linear-gradient(135deg, #06b6d4, #0891b2);
        }

        .action-icon-orange {
            background: linear-gradient(135deg, #f97316, #ea580c);
        }

        .action-content {
            display: flex;
            flex-direction: column;
            gap: var(--space-1);
            flex: 1;
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

        .action-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            width: 28px;
            height: 28px;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            border: 3px solid var(--bg-primary);
        }

        /* Profile Section */
        .profile-section {
            margin-bottom: var(--space-10);
        }

        .profile-status-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-2xl);
            padding: var(--space-8);
        }

        .profile-header {
            display: flex;
            align-items: center;
            gap: var(--space-5);
            margin-bottom: var(--space-8);
            padding-bottom: var(--space-8);
            border-bottom: 1px solid var(--border-primary);
        }

        .profile-avatar {
            width: 100px;
            height: 100px;
            border-radius: var(--radius-xl);
            overflow: hidden;
            flex-shrink: 0;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .profile-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .avatar-placeholder {
            width: 100%;
            height: 100%;
            background: var(--gradient-accent);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: white;
        }

        .profile-info h3 {
            font-size: 1.5rem;
            margin-bottom: var(--space-2);
            color: var(--text-primary);
        }

        .profile-email {
            color: var(--text-secondary);
            margin-bottom: var(--space-3);
        }

        .profile-code {
            display: inline-block;
            padding: 6px 16px;
            background: rgba(139, 92, 246, 0.1);
            color: var(--success);
            border-radius: var(--radius-md);
            font-size: 0.85rem;
            font-weight: 600;
        }

        .profile-stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: var(--space-5);
            margin-bottom: var(--space-8);
        }

        .profile-stat-item {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            padding: var(--space-4);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
        }

        .stat-icon-sm {
            width: 40px;
            height: 40px;
            background: var(--gradient-primary);
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            flex-shrink: 0;
        }

        .stat-label-sm {
            display: block;
            font-size: 0.75rem;
            color: var(--text-tertiary);
            margin-bottom: 4px;
        }

        .stat-value-sm {
            display: block;
            font-size: 1rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .status-active {
            color: var(--success);
        }

        .status-inactive {
            color: var(--danger);
        }

        .profile-description {
            padding: var(--space-5);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
        }

        .profile-description h4 {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            margin-bottom: var(--space-3);
            color: var(--text-primary);
            font-size: 1rem;
        }

        .profile-description h4 i {
            color: var(--success);
        }

        .profile-description p {
            color: var(--text-secondary);
            line-height: 1.6;
        }

        /* Tips Section */
        .tips-section {
            margin-bottom: var(--space-10);
        }

        .tips-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: var(--space-6);
        }

        .tip-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            transition: all 0.3s ease;
        }

        .tip-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .tip-icon {
            width: 48px;
            height: 48px;
            background: rgba(16, 185, 129, 0.1);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            color: var(--success);
            margin-bottom: var(--space-4);
        }

        .tip-card h4 {
            font-size: 1.1rem;
            margin-bottom: var(--space-2);
            color: var(--text-primary);
        }

        .tip-card p {
            font-size: 0.9rem;
            color: var(--text-secondary);
            line-height: 1.6;
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

            .profile-header {
                flex-direction: column;
                text-align: center;
            }

            .profile-stats-grid {
                grid-template-columns: 1fr;
            }

            .tips-grid {
                grid-template-columns: 1fr;
            }

            .header-text h1 {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection