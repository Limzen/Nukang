@extends('app')

@section('title', 'Beranda - Nukang')

@section('content')
<!-- Features Section -->
<section class="features-section" id="features">
    <div class="container">
        <div class="section-header animate-fadeIn">
            <div class="section-eyebrow">Mengapa Memilih Kami</div>
            <h2 class="section-title">Platform <span class="text-gradient">Terpercaya</span> untuk Renovasi</h2>
            <p class="section-description">
                Kami menghubungkan Anda dengan tukang profesional yang terverifikasi untuk semua kebutuhan renovasi
            </p>
        </div>
        
        <div class="features-grid">
            <div class="feature-card animate-fadeIn stagger-1">
                <div class="feature-icon">
                    <i class="fas fa-search-location"></i>
                </div>
                <h3 class="feature-title">Pencarian Cerdas</h3>
                <p class="feature-description">Temukan tukang berdasarkan lokasi, kategori, dan rating dengan algoritma canggih kami.</p>
            </div>
            
            <div class="feature-card animate-fadeIn stagger-2">
                <div class="feature-icon">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <h3 class="feature-title">100% Terverifikasi</h3>
                <p class="feature-description">Semua penyedia jasa telah melalui proses verifikasi ketat untuk menjamin kualitas.</p>
            </div>
            
            <div class="feature-card animate-fadeIn stagger-3">
                <div class="feature-icon">
                    <i class="fas fa-wallet"></i>
                </div>
                <h3 class="feature-title">Harga Transparan</h3>
                <p class="feature-description">Lihat estimasi biaya upfront tanpa biaya tersembunyi. Bayar sesuai kesepakatan.</p>
            </div>
            
            <div class="feature-card animate-fadeIn stagger-4">
                <div class="feature-icon">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="feature-title">Dukungan Premium</h3>
                <p class="feature-description">Tim customer success kami siap membantu Anda 24/7 untuk pengalaman terbaik.</p>
            </div>
        </div>
    </div>
</section>

<!-- How It Works Section -->
<section class="how-it-works-section" id="how-it-works">
    <div class="container">
        <div class="section-header animate-fadeIn">
            <div class="section-eyebrow">Cara Kerja</div>
            <h2 class="section-title">Mudah dalam <span class="text-gradient-accent">4 Langkah</span></h2>
            <p class="section-description">
                Proses sederhana untuk mendapatkan jasa renovasi berkualitas
            </p>
        </div>
        
        <div class="steps-timeline">
            <div class="step-card animate-fadeIn stagger-1">
                <div class="step-number">01</div>
                <div class="step-content">
                    <h4>Cari Tukang</h4>
                    <p>Gunakan filter pencarian untuk menemukan tukang sesuai kebutuhan dan lokasi Anda</p>
                </div>
                <div class="step-icon"><i class="fas fa-search"></i></div>
            </div>
            
            <div class="step-connector"></div>
            
            <div class="step-card animate-fadeIn stagger-2">
                <div class="step-number">02</div>
                <div class="step-content">
                    <h4>Pilih & Pesan</h4>
                    <p>Lihat profil, portfolio, dan ulasan. Kemudian lakukan pemesanan langsung</p>
                </div>
                <div class="step-icon"><i class="fas fa-hand-pointer"></i></div>
            </div>
            
            <div class="step-connector"></div>
            
            <div class="step-card animate-fadeIn stagger-3">
                <div class="step-number">03</div>
                <div class="step-content">
                    <h4>Konfirmasi</h4>
                    <p>Tukang akan mengkonfirmasi jadwal dan mulai mengerjakan proyek Anda</p>
                </div>
                <div class="step-icon"><i class="fas fa-check-double"></i></div>
            </div>
            
            <div class="step-connector"></div>
            
            <div class="step-card animate-fadeIn stagger-4">
                <div class="step-number">04</div>
                <div class="step-content">
                    <h4>Selesai & Review</h4>
                    <p>Periksa hasil pekerjaan dan berikan ulasan untuk membantu pengguna lain</p>
                </div>
                <div class="step-icon"><i class="fas fa-star"></i></div>
            </div>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="categories-section">
    <div class="container">
        <div class="section-header animate-fadeIn">
            <div class="section-eyebrow">Layanan</div>
            <h2 class="section-title">Kategori <span class="text-gradient">Jasa</span> Tersedia</h2>
            <p class="section-description">
                Berbagai macam kategori jasa renovasi untuk kebutuhan Anda
            </p>
        </div>
        
        <div class="categories-grid">
            @php
                $kategoris = \App\KategoriTukang::all();
                $icons = [
                    'listrik' => 'fa-bolt',
                    'pipa' => 'fa-faucet',
                    'air' => 'fa-faucet',
                    'cat' => 'fa-paint-roller',
                    'kayu' => 'fa-hammer',
                    'bangunan' => 'fa-building',
                    'ac' => 'fa-wind',
                    'plafon' => 'fa-layer-group',
                    'keramik' => 'fa-th-large',
                    'las' => 'fa-fire',
                ];
            @endphp
            
            @foreach($kategoris as $key => $kategori)
                @php
                    $icon = 'fa-tools';
                    $namaKategori = $kategori->kategoritukang ?? '';
                    foreach($icons as $keyword => $iconClass) {
                        if(stripos($namaKategori, $keyword) !== false) {
                            $icon = $iconClass;
                            break;
                        }
                    }
                @endphp
                <a href="{{ url('caritukang?kategori=' . $kategori->id_kategoritukang . '&jarak=10') }}" class="category-card animate-fadeIn" style="animation-delay: {{ $key * 0.05 }}s;">
                    <div class="category-icon">
                        <i class="fas {{ $icon }}"></i>
                    </div>
                    <h4 class="category-name">{{ $namaKategori }}</h4>
                    <span class="category-arrow"><i class="fas fa-arrow-right"></i></span>
                </a>
            @endforeach
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid">
            <div class="stat-card animate-fadeIn stagger-1">
                <div class="stat-icon"><i class="fas fa-hard-hat"></i></div>
                <div class="stat-number">{{ \App\Tukang::count() ?: '500' }}+</div>
                <div class="stat-label">Tukang Terdaftar</div>
            </div>
            <div class="stat-card animate-fadeIn stagger-2">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-number">{{ \App\Pelanggan::count() ?: '1000' }}+</div>
                <div class="stat-label">Pelanggan Aktif</div>
            </div>
            <div class="stat-card animate-fadeIn stagger-3">
                <div class="stat-icon"><i class="fas fa-check-circle"></i></div>
                <div class="stat-number">{{ \App\Pemesanan::where('statuspemesanan', '>=', 3)->count() ?: '2500' }}+</div>
                <div class="stat-label">Proyek Selesai</div>
            </div>
            <div class="stat-card animate-fadeIn stagger-4">
                <div class="stat-icon"><i class="fas fa-star"></i></div>
                <div class="stat-number">4.9</div>
                <div class="stat-label">Rating Rata-rata</div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
@if(Auth::guest())
<section class="cta-section">
    <div class="container">
        <div class="cta-card animate-fadeIn">
            <div class="cta-orb cta-orb-1"></div>
            <div class="cta-orb cta-orb-2"></div>
            
            <div class="cta-content">
                <h2>Siap Memulai?</h2>
                <p>Bergabunglah dengan ribuan pengguna yang sudah merasakan kemudahan mencari jasa renovasi berkualitas</p>
                <div class="cta-actions">
                    <a href="{{ url('auth/register') }}" class="btn btn-primary btn-xl">
                        <i class="fas fa-rocket"></i> Daftar Gratis
                    </a>
                    <a href="{{ url('auth/login') }}" class="btn btn-secondary btn-xl">
                        <i class="fas fa-sign-in-alt"></i> Masuk
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

<style>
/* Features Section */
.features-section {
    padding: var(--space-20) 0;
}

.features-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: var(--space-6);
}

/* How It Works */
.how-it-works-section {
    padding: var(--space-20) 0;
    background: var(--bg-secondary);
}

.steps-timeline {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: var(--space-4);
}

.step-card {
    position: relative;
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    min-width: 220px;
    max-width: 260px;
    text-align: center;
    transition: all var(--transition-base);
}

.step-card:hover {
    transform: translateY(-8px);
    border-color: var(--border-hover);
    box-shadow: var(--shadow-xl);
}

.step-number {
    font-family: var(--font-display);
    font-size: 3rem;
    font-weight: 700;
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    line-height: 1;
    margin-bottom: var(--space-4);
}

.step-content h4 {
    font-size: 1.1rem;
    margin-bottom: var(--space-2);
}

.step-content p {
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.step-icon {
    position: absolute;
    top: var(--space-4);
    right: var(--space-4);
    width: 36px;
    height: 36px;
    background: var(--bg-tertiary);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--success);
    font-size: 0.9rem;
}

.step-connector {
    width: 60px;
    height: 2px;
    background: linear-gradient(90deg, var(--success) 0%, transparent 100%);
}

/* Categories Section */
.categories-section {
    padding: var(--space-20) 0;
}

.categories-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    gap: var(--space-4);
}

.category-card {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-lg);
    padding: var(--space-4) var(--space-5);
    transition: all var(--transition-base);
    cursor: pointer;
}

.category-card:hover {
    background: var(--gradient-primary);
    border-color: transparent;
    transform: translateX(8px);
}

.category-card:hover .category-icon {
    background: rgba(255, 255, 255, 0.2);
    color: white;
}

.category-card:hover .category-name {
    color: white;
}

.category-card:hover .category-arrow {
    opacity: 1;
    transform: translateX(0);
    color: white;
}

.category-icon {
    width: 48px;
    height: 48px;
    background: var(--bg-tertiary);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: var(--success);
    transition: all var(--transition-base);
    flex-shrink: 0;
}

.category-name {
    flex: 1;
    font-size: 0.95rem;
    font-weight: 500;
    margin: 0;
    transition: color var(--transition-base);
}

.category-arrow {
    opacity: 0;
    transform: translateX(-10px);
    transition: all var(--transition-base);
    color: var(--text-tertiary);
}

/* Stats Section */
.stats-section {
    padding: var(--space-16) 0;
    background: var(--gradient-primary);
    position: relative;
    overflow: hidden;
}

.stats-section::before {
    content: '';
    position: absolute;
    inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}

.stats-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: var(--space-8);
    position: relative;
    z-index: 1;
}

.stat-card {
    text-align: center;
    color: white;
}

.stat-icon {
    width: 56px;
    height: 56px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto var(--space-4);
    font-size: 1.5rem;
    backdrop-filter: blur(10px);
}

.stat-number {
    font-family: var(--font-display);
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: var(--space-1);
}

.stat-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* CTA Section */
.cta-section {
    padding: var(--space-20) 0;
}

.cta-card {
    position: relative;
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-2xl);
    padding: var(--space-16);
    text-align: center;
    overflow: hidden;
}

.cta-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.3;
}

.cta-orb-1 {
    width: 300px;
    height: 300px;
    background: var(--gradient-primary);
    top: -20%;
    left: -10%;
}

.cta-orb-2 {
    width: 250px;
    height: 250px;
    background: var(--gradient-accent);
    bottom: -20%;
    right: -10%;
}

.cta-content {
    position: relative;
    z-index: 1;
}

.cta-content h2 {
    font-size: 2.5rem;
    margin-bottom: var(--space-4);
}

.cta-content p {
    font-size: 1.1rem;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto var(--space-8);
}

.cta-actions {
    display: flex;
    justify-content: center;
    gap: var(--space-4);
    flex-wrap: wrap;
}

/* Responsive */
@media (max-width: 992px) {
    .step-connector {
        display: none;
    }
    
    .steps-timeline {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (max-width: 576px) {
    .steps-timeline {
        grid-template-columns: 1fr;
    }
    
    .step-card {
        max-width: 100%;
    }
    
    .stats-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: var(--space-4);
    }
    
    .stat-number {
        font-size: 2rem;
    }
    
    .cta-card {
        padding: var(--space-8);
    }
    
    .cta-content h2 {
        font-size: 1.75rem;
    }
    
    .cta-actions {
        flex-direction: column;
    }
    
    .cta-actions .btn {
        width: 100%;
    }
}
</style>
@endsection
