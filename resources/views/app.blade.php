<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Nukang - Platform Premium Pencarian dan Pemesanan Penyedia Jasa Renovasi">
    <meta name="theme-color" content="#10b981">
    
    <title>@yield('title', 'Nukang')</title>

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.png') }}">
    
    <!-- Premium CSS -->
    <link href="{{ asset('/css/modern.css') }}" rel="stylesheet">
    
    <!-- Font Awesome Pro -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @yield('styles')
</head>
<body>
    <!-- Premium Navigation -->
    <nav class="navbar" id="mainNavbar">
        <div class="container">
            <div class="navbar-inner">
                <!-- Brand -->
                <a href="{{ Auth::check() ? url('/home') : url('/') }}" class="navbar-brand">
                    <img src="{{ asset('images/frontslider/logo.png') }}" alt="Logo">
                    <span class="brand-text">Nukang</span>
                </a>
                
                <!-- Desktop Navigation -->
                <ul class="navbar-nav d-lg-flex d-none">
                    @if(Auth::guest())
                        <li><a href="{{ url('/') }}" class="nav-link {{ Request::is('/') ? 'active' : '' }}">Beranda</a></li>
                        <li><a href="#features" class="nav-link">Fitur</a></li>
                        <li><a href="#how-it-works" class="nav-link">Cara Kerja</a></li>
                    @elseif(Auth::user()->statuspengguna == "1")
                        <li><a href="{{ url('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">Dashboard</a></li>
                        <li><a href="{{ url('caritukang?kategori=all&jarak=10') }}" class="nav-link {{ Request::is('caritukang*') ? 'active' : '' }}">Cari Jasa</a></li>
                        <li><a href="{{ url('riwayatpemesanan') }}" class="nav-link {{ Request::is('riwayatpemesanan*') ? 'active' : '' }}">Pesanan</a></li>
                    @elseif(Auth::user()->statuspengguna == "2")
                        <li><a href="{{ url('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">Dashboard</a></li>
                        <li>
                            <a href="{{ url('permintaanpesanan') }}" class="nav-link {{ Request::is('permintaanpesanan') ? 'active' : '' }}">
                                Permintaan
                                @if(isset($totalpermintaan) && $totalpermintaan > 0)
                                    <span class="badge badge-danger" style="margin-left: 4px;">{{ $totalpermintaan }}</span>
                                @endif
                            </a>
                        </li>
                        <li><a href="{{ url('riwayatpemesanan') }}" class="nav-link {{ Request::is('riwayatpemesanan*') ? 'active' : '' }}">Riwayat</a></li>
                    @elseif(Auth::user()->statuspengguna == "0")
                        <li><a href="{{ url('home') }}" class="nav-link {{ Request::is('home') ? 'active' : '' }}">Verifikasi</a></li>
                        <li class="dropdown">
                            <a href="#" class="nav-link {{ Request::is('data*') ? 'active' : '' }}">
                                Data Master <i class="fas fa-chevron-down" style="font-size: 0.6rem; margin-left: 4px;"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ url('databahanmaterial') }}" class="dropdown-item"><i class="fas fa-cube"></i> Bahan Material</a>
                                <a href="{{ url('datajenispemesanan') }}" class="dropdown-item"><i class="fas fa-list"></i> Jenis Pemesanan</a>
                                <a href="{{ url('datakategoritukang') }}" class="dropdown-item"><i class="fas fa-tags"></i> Kategori Tukang</a>
                            </div>
                        </li>
                        <li class="dropdown">
                            <a href="#" class="nav-link {{ Request::is('riwayat*') || Request::is('konfirmasi*') ? 'active' : '' }}">
                                Riwayat <i class="fas fa-chevron-down" style="font-size: 0.6rem; margin-left: 4px;"></i>
                            </a>
                            <div class="dropdown-menu">
                                <a href="{{ url('riwayattransaksi') }}" class="dropdown-item"><i class="fas fa-receipt"></i> Transaksi</a>
                                <a href="{{ url('riwayatpemesanan') }}" class="dropdown-item"><i class="fas fa-history"></i> Pemesanan</a>
                                <div class="dropdown-divider"></div>
                                <a href="{{ url('konfirmasiupdatesaldo') }}" class="dropdown-item"><i class="fas fa-check-circle"></i> Konfirmasi Saldo</a>
                                <a href="{{ url('konfirmasitariksaldo') }}" class="dropdown-item"><i class="fas fa-money-bill-wave"></i> Konfirmasi Tarik</a>
                            </div>
                        </li>
                    @endif
                </ul>
                
                <!-- Right Side Actions -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Theme Toggle -->
                    <button class="theme-toggle" id="themeToggle" title="Toggle Theme">
                        <span class="theme-toggle-icon moon"><i class="fas fa-moon"></i></span>
                        <span class="theme-toggle-icon sun"><i class="fas fa-sun"></i></span>
                    </button>
                    
                    @if(Auth::guest())
                        <a href="{{ url('/auth/register') }}" class="btn btn-secondary btn-sm d-md-inline-flex d-none">Daftar</a>
                        <a href="{{ url('/auth/login') }}" class="btn btn-primary btn-sm">Masuk</a>
                    @else
                        <!-- Notifications -->
                        <a href="{{ url('notifikasi') }}" class="btn btn-icon btn-ghost position-relative">
                            <i class="fas fa-bell"></i>
                            @if(isset($totalnotifikasi) && $totalnotifikasi > 0)
                                <span class="badge badge-danger" style="position: absolute; top: 2px; right: 2px; font-size: 0.6rem; padding: 2px 5px;">{{ $totalnotifikasi }}</span>
                            @endif
                        </a>
                        
                        <!-- User Menu -->
                        <div class="dropdown">
                            <button class="btn btn-ghost d-flex align-items-center gap-2" style="padding: 6px 12px;">
                                <div style="width: 32px; height: 32px; background: var(--gradient-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center;">
                                    <i class="fas fa-user" style="font-size: 0.8rem; color: white;"></i>
                                </div>
                                <span class="d-md-block d-none" style="font-size: 0.9rem;">
                                    @if(Auth::user()->statuspengguna == "1")
                                        {{ Auth::user()->pelanggan->namapelanggan ?? 'User' }}
                                    @elseif(Auth::user()->statuspengguna == "2")
                                        {{ Auth::user()->tukang->namatukang ?? 'Tukang' }}
                                    @else
                                        Admin
                                    @endif
                                </span>
                                <i class="fas fa-chevron-down d-md-block d-none" style="font-size: 0.6rem;"></i>
                            </button>
                            <div class="dropdown-menu" style="right: 0; left: auto; min-width: 240px;">
                                <div style="padding: var(--space-3) var(--space-4);">
                                    <div style="font-weight: 600; color: var(--text-primary);">
                                        @if(Auth::user()->statuspengguna == "1")
                                            {{ Auth::user()->pelanggan->namapelanggan ?? 'User' }}
                                        @elseif(Auth::user()->statuspengguna == "2")
                                            {{ Auth::user()->tukang->namatukang ?? 'Tukang' }}
                                        @else
                                            Administrator
                                        @endif
                                    </div>
                                </div>
                                
                                @if(Auth::user()->statuspengguna == "1")
                                    {{-- Kelola Alamat already in quick actions --}}
                                @elseif(Auth::user()->statuspengguna == "2")
                                    <a href="{{ url('penarikansaldo') }}" class="dropdown-item"><i class="fas fa-money-bill-wave"></i> Tarik Saldo</a>
                                    <a href="{{ url('riwayattransaksi') }}" class="dropdown-item"><i class="fas fa-receipt"></i> Transaksi</a>
                                    <a href="{{ url('pengaturanjasakeahlian') }}" class="dropdown-item"><i class="fas fa-tools"></i> Jasa & Keahlian</a>
                                @endif
                                
                                <div class="dropdown-divider"></div>
                                <a href="{{ url('pengaturanakun') }}" class="dropdown-item"><i class="fas fa-user-cog"></i> Pengaturan Akun</a>
                                <a href="{{ url('/auth/logout') }}" class="dropdown-item" style="color: var(--danger);"><i class="fas fa-sign-out-alt"></i> Keluar</a>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="btn btn-icon btn-ghost navbar-toggler d-lg-none" onclick="toggleMobileMenu()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Mobile Menu Overlay -->
    <div class="mobile-overlay" id="mobileOverlay" onclick="toggleMobileMenu()"></div>
    
    <!-- Mobile Slide Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-header">
            <a href="{{ Auth::check() ? url('/home') : url('/') }}" class="navbar-brand">
                <img src="{{ asset('images/frontslider/logo.png') }}" alt="Logo" style="height: 32px;">
                <span>Nukang</span>
            </a>
            <button class="btn btn-icon btn-ghost" onclick="toggleMobileMenu()">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="mobile-menu-body">
            @if(Auth::guest())
                <a href="{{ url('/') }}" class="mobile-nav-item">
                    <i class="fas fa-home"></i> Beranda
                </a>
                <div class="mobile-nav-divider"></div>
                <a href="{{ url('/auth/register') }}" class="btn btn-secondary btn-block mb-4">Daftar Akun</a>
                <a href="{{ url('/auth/login') }}" class="btn btn-primary btn-block">Masuk</a>
            @elseif(Auth::user()->statuspengguna == "1")
                <a href="{{ url('home') }}" class="mobile-nav-item"><i class="fas fa-home"></i> Dashboard</a>
                <a href="{{ url('caritukang?kategori=all&jarak=10') }}" class="mobile-nav-item"><i class="fas fa-search"></i> Cari Jasa</a>
                <a href="{{ url('notifikasi') }}" class="mobile-nav-item">
                    <i class="fas fa-bell"></i> Notifikasi
                    @if(isset($totalnotifikasi) && $totalnotifikasi > 0)
                        <span class="badge badge-danger">{{ $totalnotifikasi }}</span>
                    @endif
                </a>
                <a href="{{ url('riwayatpemesanan') }}" class="mobile-nav-item"><i class="fas fa-history"></i> Riwayat Pesanan</a>
                <a href="{{ url('tambahalamat') }}" class="mobile-nav-item"><i class="fas fa-map-marker-alt"></i> Alamat Saya</a>
                <a href="{{ url('isisaldo') }}" class="mobile-nav-item"><i class="fas fa-wallet"></i> Isi Saldo</a>
                <div class="mobile-nav-divider"></div>
                <a href="{{ url('pengaturanakun') }}" class="mobile-nav-item"><i class="fas fa-cog"></i> Pengaturan</a>
                <a href="{{ url('/auth/logout') }}" class="mobile-nav-item" style="color: var(--danger);"><i class="fas fa-sign-out-alt"></i> Keluar</a>
            @elseif(Auth::user()->statuspengguna == "2")
                <a href="{{ url('home') }}" class="mobile-nav-item"><i class="fas fa-home"></i> Dashboard</a>
                <a href="{{ url('permintaanpesanan') }}" class="mobile-nav-item">
                    <i class="fas fa-inbox"></i> Permintaan
                    @if(isset($totalpermintaan) && $totalpermintaan > 0)
                        <span class="badge badge-danger">{{ $totalpermintaan }}</span>
                    @endif
                </a>
                <a href="{{ url('riwayatpemesanan') }}" class="mobile-nav-item"><i class="fas fa-history"></i> Riwayat</a>
                <a href="{{ url('pengaturanjasakeahlian') }}" class="mobile-nav-item"><i class="fas fa-tools"></i> Jasa & Keahlian</a>
                <a href="{{ url('penarikansaldo') }}" class="mobile-nav-item"><i class="fas fa-money-bill-wave"></i> Tarik Saldo</a>
                <div class="mobile-nav-divider"></div>
                <a href="{{ url('pengaturanakun') }}" class="mobile-nav-item"><i class="fas fa-cog"></i> Pengaturan</a>
                <a href="{{ url('/auth/logout') }}" class="mobile-nav-item" style="color: var(--danger);"><i class="fas fa-sign-out-alt"></i> Keluar</a>
            @else
                <a href="{{ url('home') }}" class="mobile-nav-item"><i class="fas fa-check-circle"></i> Verifikasi</a>
                <a href="{{ url('databahanmaterial') }}" class="mobile-nav-item"><i class="fas fa-cube"></i> Bahan Material</a>
                <a href="{{ url('datajenispemesanan') }}" class="mobile-nav-item"><i class="fas fa-list"></i> Jenis Pemesanan</a>
                <a href="{{ url('datakategoritukang') }}" class="mobile-nav-item"><i class="fas fa-tags"></i> Kategori</a>
                <a href="{{ url('riwayattransaksi') }}" class="mobile-nav-item"><i class="fas fa-receipt"></i> Transaksi</a>
                <a href="{{ url('riwayatpemesanan') }}" class="mobile-nav-item"><i class="fas fa-history"></i> Pemesanan</a>
                <div class="mobile-nav-divider"></div>
                <a href="{{ url('/auth/logout') }}" class="mobile-nav-item" style="color: var(--danger);"><i class="fas fa-sign-out-alt"></i> Keluar</a>
            @endif
        </div>
    </div>

    <!-- Hero or Spacer -->
    @if((Request::is('/') || Request::is('home')) && Auth::guest())
    <section class="hero">
        <!-- Animated Orbs -->
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
        <div class="hero-orb hero-orb-3"></div>
        
        <div class="hero-content animate-fadeIn">
            <div class="hero-badge">
                <span class="hero-badge-dot"></span>
                Platform Terpercaya #1 di Indonesia
            </div>
            
            <h1 class="hero-title">
                <span>Temukan Jasa Renovasi</span>
                <span class="highlight">Professional & Terpercaya</span>
            </h1>
            
            <p class="hero-description">
                Platform premium untuk menghubungkan Anda dengan penyedia jasa renovasi berkualitas. 
                Mudah, cepat, dan transparan.
            </p>
            
            <div class="hero-actions">
                <a href="{{ url('auth/register') }}" class="btn btn-primary btn-xl">
                    <i class="fas fa-rocket"></i> Mulai Sekarang
                </a>
                <a href="{{ url('auth/registertukang') }}" class="btn btn-secondary btn-xl">
                    <i class="fas fa-hard-hat"></i> Jadi Mitra
                </a>
            </div>
            
            <div class="hero-stats">
                <div class="hero-stat animate-fadeIn stagger-1">
                    <div class="hero-stat-number">{{ \App\Tukang::count() ?: '500' }}+</div>
                    <div class="hero-stat-label">Tukang Profesional</div>
                </div>
                <div class="hero-stat animate-fadeIn stagger-2">
                    <div class="hero-stat-number">{{ \App\Pelanggan::count() ?: '1000' }}+</div>
                    <div class="hero-stat-label">Pelanggan Puas</div>
                </div>
                <div class="hero-stat animate-fadeIn stagger-3">
                    <div class="hero-stat-number">{{ \App\Pemesanan::where('statuspemesanan', '>=', 3)->count() ?: '2500' }}+</div>
                    <div class="hero-stat-label">Proyek Selesai</div>
                </div>
            </div>
        </div>
    </section>
    @else
    <div style="height: 80px;"></div>
    @endif

    <!-- Flash Messages -->
    @if(session('message_success') || session('message_failed'))
    <div class="container" style="margin-top: var(--space-6);">
        @if(session('message_success'))
        <div class="alert alert-success animate-fadeIn">
            <div class="alert-icon"><i class="fas fa-check"></i></div>
            <div class="alert-content">{{ session('message_success') }}</div>
        </div>
        @endif
        @if(session('message_failed'))
        <div class="alert alert-danger animate-fadeIn">
            <div class="alert-icon"><i class="fas fa-exclamation"></i></div>
            <div class="alert-content">{{ session('message_failed') }}</div>
        </div>
        @endif
    </div>
    @endif

    <!-- Main Content -->
    <main class="main-content">
        @yield('content')
    </main>

    <!-- Premium Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <a href="{{ Auth::check() ? url('/home') : url('/') }}" class="navbar-brand" style="margin-bottom: var(--space-4); display: inline-flex;">
                        <img src="{{ asset('images/frontslider/logo.png') }}" alt="Logo" style="height: 40px;">
                        <span class="brand-text">Nukang</span>
                    </a>
                    <p>Platform premium untuk menghubungkan Anda dengan penyedia jasa renovasi berkualitas tinggi.</p>
                    <div class="social-links" style="margin-top: var(--space-6);">
                        <a href="#" class="social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="social-link"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div>
                    <h4 class="footer-title">Platform</h4>
                    <ul class="footer-links">
                        <li><a href="#">Tentang Kami</a></li>
                        <li><a href="#">Cara Kerja</a></li>
                        <li><a href="#">Kategori Jasa</a></li>
                        <li><a href="#">Mitra Tukang</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-title">Bantuan</h4>
                    <ul class="footer-links">
                        <li><a href="#">Pusat Bantuan</a></li>
                        <li><a href="#">Syarat & Ketentuan</a></li>
                        <li><a href="#">Kebijakan Privasi</a></li>
                        <li><a href="#">Hubungi Kami</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="footer-title">Kontak</h4>
                    <ul class="footer-links">
                        <li><i class="fas fa-envelope" style="margin-right: 8px; color: var(--success);"></i> hello@markettukang.com</li>
                        <li><i class="fas fa-phone" style="margin-right: 8px; color: var(--success);"></i> +62 21 1234 5678</li>
                        <li><i class="fas fa-map-marker-alt" style="margin-right: 8px; color: var(--success);"></i> Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p class="footer-copyright">&copy; {{ date('Y') }} Nukang. All rights reserved.</p>
                <div style="display: flex; gap: var(--space-6); font-size: 0.875rem;">
                    <a href="#" style="color: var(--text-secondary);">Privacy</a>
                    <a href="#" style="color: var(--text-secondary);">Terms</a>
                    <a href="#" style="color: var(--text-secondary);">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="{{ asset('bootstrap-3.3.7-dist/googleapis/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>

    
    <script>
        // Theme Toggle
        const themeToggle = document.getElementById('themeToggle');
        const html = document.documentElement;
        
        // Load saved theme
        const savedTheme = localStorage.getItem('theme') || 'dark';
        html.setAttribute('data-theme', savedTheme);
        
        themeToggle.addEventListener('click', () => {
            const currentTheme = html.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            html.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
        });
        
        // Navbar scroll effect
        let lastScroll = 0;
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('mainNavbar');
            const currentScroll = window.pageYOffset;
            
            if (currentScroll > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            
            lastScroll = currentScroll;
        });
        
        // Mobile menu
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            const overlay = document.getElementById('mobileOverlay');
            menu.classList.toggle('active');
            overlay.classList.toggle('active');
            document.body.style.overflow = menu.classList.contains('active') ? 'hidden' : '';
        }
        
        // Dropdown toggle
        document.querySelectorAll('.dropdown > button, .dropdown > a').forEach(trigger => {
            trigger.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                const dropdown = this.closest('.dropdown');
                
                // Close other dropdowns
                document.querySelectorAll('.dropdown.show').forEach(d => {
                    if (d !== dropdown) d.classList.remove('show');
                });
                
                dropdown.classList.toggle('show');
            });
        });
        
        // Close dropdowns on outside click
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.dropdown')) {
                document.querySelectorAll('.dropdown.show').forEach(d => d.classList.remove('show'));
            }
        });
        
        // Animate elements on scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);
        
        document.querySelectorAll('.animate-fadeIn').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(20px)';
            el.style.transition = 'all 0.6s cubic-bezier(0.4, 0, 0.2, 1)';
            observer.observe(el);
        });
    </script>
    
    <style>
        /* Mobile Menu Styles */
        .mobile-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(4px);
            z-index: 1040;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }
        
        .mobile-overlay.active {
            opacity: 1;
            visibility: visible;
        }
        
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -320px;
            width: 300px;
            max-width: 85vw;
            height: 100vh;
            background: var(--bg-secondary);
            border-left: 1px solid var(--border-primary);
            z-index: 1050;
            transition: right 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow-y: auto;
        }
        
        .mobile-menu.active {
            right: 0;
        }
        
        .mobile-menu-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-4) var(--space-5);
            border-bottom: 1px solid var(--border-primary);
        }
        
        .mobile-menu-body {
            padding: var(--space-4);
        }
        
        .mobile-nav-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-3) var(--space-4);
            color: var(--text-secondary);
            border-radius: var(--radius-md);
            margin-bottom: var(--space-1);
            transition: all 0.2s ease;
        }
        
        .mobile-nav-item:hover {
            background: var(--bg-tertiary);
            color: var(--text-primary);
        }
        
        .mobile-nav-item i {
            width: 24px;
            margin-right: var(--space-3);
            color: var(--text-tertiary);
        }
        
        .mobile-nav-divider {
            height: 1px;
            background: var(--border-primary);
            margin: var(--space-4) 0;
        }
        
        .main-content {
            min-height: calc(100vh - 400px);
        }
        
        .navbar-toggler {
            display: none !important;
        }
        
        @media (max-width: 992px) {
            .navbar-toggler {
                display: flex !important;
            }
        }
        
        .d-none { display: none !important; }
        .d-md-block { display: block; }
        .d-md-none { display: block; }
        .d-lg-flex { display: flex; }
        .d-lg-none { display: none; }
        
        @media (max-width: 768px) {
            .d-md-block { display: none !important; }
            .d-md-none { display: block !important; }
        }
        
        @media (max-width: 992px) {
            .d-lg-flex { display: none !important; }
            .d-lg-none { display: block !important; }
        }
        
        .mb-4 { margin-bottom: var(--space-4); }
    </style>

    @yield('datatable')
    @yield('scriptslider')
    @yield('scripts')
</body>
</html>
