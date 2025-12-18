@extends('app')

@section('title', 'Nukang - Jasa Renovasi Premium')

@section('content')

{{-- Session Messages --}}
@if(Session::has('message_success') || Session::has('message_failed'))
<div class="container" style="margin-top: var(--space-4);">
    @if(Session::has('message_success'))
    <div class="alert alert-success animate-fadeIn">
        <div class="alert-icon"><i class="fas fa-check"></i></div>
        <div class="alert-content">{{ Session::get('message_success') }}</div>
    </div>
    @endif
    @if(Session::has('message_failed'))
    <div class="alert alert-danger animate-fadeIn">
        <div class="alert-icon"><i class="fas fa-exclamation"></i></div>
        <div class="alert-content">{{ Session::get('message_failed') }}</div>
    </div>
    @endif
</div>
@endif

{{-- Premium Services Section --}}
<section class="services-section">
    <div class="container">
        <div class="section-header animate-fadeIn">
            <div class="section-eyebrow">
                <span class="eyebrow-dot"></span>
                Layanan Premium
            </div>
            <h2 class="section-title">
                Solusi <span class="text-gradient">Renovasi</span> Lengkap
            </h2>
            <p class="section-description">
                Dari pencarian hingga pembayaran, semua dalam satu platform terintegrasi
            </p>
        </div>
        
        <div class="services-grid">
            {{-- Service Card 1 --}}
            <div class="service-card animate-fadeIn stagger-1">
                <div class="service-card-glow"></div>
                <div class="service-icon-wrapper">
                    <div class="service-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div class="service-icon-ring"></div>
                </div>
                <div class="service-content">
                    <span class="service-tag">Fitur Utama</span>
                    <h3>Pencarian Berbasis Lokasi</h3>
                    <p>Temukan tukang profesional terdekat menggunakan teknologi GPS dan Google Maps terintegrasi.</p>
                </div>
                <div class="service-footer">
                    <div class="service-stats">
                        <span><i class="fas fa-users"></i> 500+ Tukang</span>
                    </div>
                </div>
            </div>

            {{-- Service Card 2 --}}
            <div class="service-card animate-fadeIn stagger-2">
                <div class="service-card-glow"></div>
                <div class="service-icon-wrapper">
                    <div class="service-icon service-icon-accent">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <div class="service-icon-ring"></div>
                </div>
                <div class="service-content">
                    <span class="service-tag">Mudah & Cepat</span>
                    <h3>Pemesanan Instan</h3>
                    <p>Booking jasa renovasi dalam hitungan menit dengan sistem pemesanan real-time yang efisien.</p>
                </div>
                <div class="service-footer">
                    <div class="service-stats">
                        <span><i class="fas fa-bolt"></i> 5 Menit</span>
                    </div>
                </div>
            </div>

            {{-- Service Card 3 --}}
            <div class="service-card animate-fadeIn stagger-3">
                <div class="service-card-glow"></div>
                <div class="service-icon-wrapper">
                    <div class="service-icon service-icon-gold">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <div class="service-icon-ring"></div>
                </div>
                <div class="service-content">
                    <span class="service-tag">100% Aman</span>
                    <h3>Pembayaran Terlindungi</h3>
                    <p>Sistem escrow yang aman - dana ditahan hingga pekerjaan selesai dengan memuaskan.</p>
                </div>
                <div class="service-footer">
                    <div class="service-stats">
                        <span><i class="fas fa-lock"></i> Escrow</span>
                    </div>
                </div>
            </div>

            {{-- Service Card 4 --}}
            <div class="service-card animate-fadeIn stagger-4">
                <div class="service-card-glow"></div>
                <div class="service-icon-wrapper">
                    <div class="service-icon service-icon-purple">
                        <i class="fas fa-cubes"></i>
                    </div>
                    <div class="service-icon-ring"></div>
                </div>
                <div class="service-content">
                    <span class="service-tag">All-in-One</span>
                    <h3>Material Marketplace</h3>
                    <p>Beli bahan material renovasi langsung dari platform tanpa repot cari vendor terpisah.</p>
                </div>
                <div class="service-footer">
                    <div class="service-stats">
                        <span><i class="fas fa-box"></i> 1000+ Produk</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- About Section with Glassmorphism --}}
<section class="about-section">
    <div class="about-orbs">
        <div class="about-orb about-orb-1"></div>
        <div class="about-orb about-orb-2"></div>
        <div class="about-orb about-orb-3"></div>
    </div>
    
    <div class="container">
        <div class="about-card animate-fadeIn">
            <div class="about-content">
                <div class="about-badge">
                    <i class="fas fa-rocket"></i>
                    Tentang Nukang
                </div>
                <h2>Platform Renovasi Rumah <span class="text-gradient">Masa Depan</span></h2>
                <p class="about-text">
                    Nukang adalah platform revolusioner yang menghubungkan pelanggan dengan penyedia jasa renovasi profesional. 
                    Dengan teknologi pencarian berbasis lokasi, sistem pembayaran aman, dan proses pemesanan yang transparan, 
                    kami memastikan setiap proyek renovasi berjalan lancar dari awal hingga akhir.
                </p>
                
                <div class="about-features">
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <span>Tukang Terverifikasi</span>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <span>Harga Transparan</span>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <span>Garansi Kepuasan</span>
                    </div>
                    <div class="about-feature">
                        <div class="about-feature-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <span>Support 24/7</span>
                    </div>
                </div>
            </div>
            
            <div class="about-visual">
                <div class="about-visual-card">
                    <div class="visual-stats">
                        <div class="visual-stat">
                            <div class="visual-stat-number">{{ \App\Tukang::count() ?: '500' }}+</div>
                            <div class="visual-stat-label">Mitra Tukang</div>
                        </div>
                        <div class="visual-stat">
                            <div class="visual-stat-number">{{ \App\Pelanggan::count() ?: '1000' }}+</div>
                            <div class="visual-stat-label">Pelanggan</div>
                        </div>
                        <div class="visual-stat">
                            <div class="visual-stat-number">{{ \App\Pemesanan::where('statuspemesanan', '>=', 3)->count() ?: '2500' }}+</div>
                            <div class="visual-stat-label">Proyek Selesai</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Expertise Section --}}
<section class="expertise-section">
    <div class="container">
        <div class="section-header animate-fadeIn">
            <div class="section-eyebrow">
                <span class="eyebrow-dot"></span>
                Keahlian
            </div>
            <h2 class="section-title">
                Jasa Renovasi <span class="text-gradient-accent">Berbagai Keahlian</span>
            </h2>
        </div>
        
        <div class="expertise-grid">
            <div class="expertise-card expertise-card-large animate-fadeIn">
                <div class="expertise-card-bg"></div>
                <div class="expertise-icon">
                    <i class="fas fa-home"></i>
                </div>
                <div class="expertise-content">
                    <h3>Renovasi Indoor</h3>
                    <p>Listrik, AC, elektronik, interior, plafon, keramik, dan semua kebutuhan renovasi dalam ruangan dengan standar profesional.</p>
                    <ul class="expertise-list">
                        <li><i class="fas fa-bolt"></i> Instalasi Listrik</li>
                        <li><i class="fas fa-wind"></i> Pasang AC</li>
                        <li><i class="fas fa-couch"></i> Interior Design</li>
                        <li><i class="fas fa-th-large"></i> Pemasangan Keramik</li>
                    </ul>
                </div>
                <a href="{{ url('auth/login') }}" class="expertise-cta">
                    <span>Lihat Kategori</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
            
            <div class="expertise-card expertise-card-large animate-fadeIn stagger-1">
                <div class="expertise-card-bg expertise-card-bg-accent"></div>
                <div class="expertise-icon expertise-icon-accent">
                    <i class="fas fa-building"></i>
                </div>
                <div class="expertise-content">
                    <h3>Renovasi Outdoor</h3>
                    <p>Dinding, atap, pagar, cat eksterior, struktur bangunan, dan semua pekerjaan luar ruangan dengan kualitas terjamin.</p>
                    <ul class="expertise-list">
                        <li><i class="fas fa-paint-roller"></i> Pengecatan</li>
                        <li><i class="fas fa-hammer"></i> Konstruksi</li>
                        <li><i class="fas fa-fire"></i> Las & Besi</li>
                        <li><i class="fas fa-faucet"></i> Pipa & Ledeng</li>
                    </ul>
                </div>
                <a href="{{ url('auth/login') }}" class="expertise-cta">
                    <span>Lihat Kategori</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
/* ========================================
   PREMIUM LANDING PAGE STYLES - NUKANG
   ======================================== */

/* Section Headers */
.section-header {
    text-align: center;
    margin-bottom: var(--space-12);
}

.section-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-2) var(--space-4);
    background: var(--bg-glass);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-full);
    font-size: 0.8rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--success);
    margin-bottom: var(--space-4);
}

.eyebrow-dot {
    width: 8px;
    height: 8px;
    background: var(--gradient-primary);
    border-radius: 50%;
    animation: pulse 2s ease-in-out infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.5; transform: scale(1.2); }
}

.section-title {
    font-size: clamp(2rem, 4vw, 3rem);
    margin-bottom: var(--space-4);
}

.section-description {
    font-size: 1.1rem;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
}

/* Services Section */
.services-section {
    padding: var(--space-20) 0;
}

.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: var(--space-6);
}

.service-card {
    position: relative;
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    padding: var(--space-8);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
}

.service-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
    opacity: 0;
    transition: opacity 0.4s ease;
}

.service-card:hover {
    transform: translateY(-12px) scale(1.02);
    border-color: rgba(16, 185, 129, 0.3);
    box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.3),
        0 0 50px rgba(16, 185, 129, 0.1);
}

.service-card:hover::before {
    opacity: 1;
}

.service-card-glow {
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 50%);
    opacity: 0;
    transition: opacity 0.4s ease;
    pointer-events: none;
}

.service-card:hover .service-card-glow {
    opacity: 1;
}

.service-icon-wrapper {
    position: relative;
    width: 80px;
    height: 80px;
    margin-bottom: var(--space-6);
}

.service-icon {
    position: relative;
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    z-index: 1;
    transition: transform 0.4s ease;
}

.service-card:hover .service-icon {
    transform: scale(1.1) rotate(5deg);
}

.service-icon-accent {
    background: var(--gradient-accent);
}

.service-icon-gold {
    background: var(--gradient-gold);
}

.service-icon-purple {
    background: linear-gradient(135deg, #8b5cf6 0%, #a855f7 100%);
}

.service-icon-ring {
    position: absolute;
    inset: -8px;
    border: 2px dashed rgba(16, 185, 129, 0.3);
    border-radius: var(--radius-xl);
    animation: spin 20s linear infinite;
}

@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.service-content {
    position: relative;
    z-index: 1;
}

.service-tag {
    display: inline-block;
    padding: var(--space-1) var(--space-3);
    background: var(--bg-tertiary);
    border-radius: var(--radius-full);
    font-size: 0.7rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--success);
    margin-bottom: var(--space-3);
}

.service-content h3 {
    font-size: 1.25rem;
    margin-bottom: var(--space-3);
}

.service-content p {
    font-size: 0.9rem;
    color: var(--text-secondary);
    line-height: 1.7;
}

.service-footer {
    margin-top: var(--space-6);
    padding-top: var(--space-4);
    border-top: 1px solid var(--border-primary);
    position: relative;
    z-index: 1;
}

.service-stats {
    display: flex;
    gap: var(--space-4);
}

.service-stats span {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.85rem;
    color: var(--text-tertiary);
}

.service-stats i {
    color: var(--success);
}

/* About Section */
.about-section {
    padding: var(--space-20) 0;
    position: relative;
    overflow: hidden;
}

.about-orbs {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.about-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(100px);
    opacity: 0.3;
}

.about-orb-1 {
    width: 500px;
    height: 500px;
    background: var(--gradient-primary);
    top: -20%;
    left: -10%;
    animation: float 8s ease-in-out infinite;
}

.about-orb-2 {
    width: 400px;
    height: 400px;
    background: var(--gradient-accent);
    bottom: -20%;
    right: -10%;
    animation: float 10s ease-in-out infinite reverse;
}

.about-orb-3 {
    width: 300px;
    height: 300px;
    background: var(--gradient-gold);
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    animation: float 12s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-30px) rotate(5deg); }
}

.about-card {
    position: relative;
    background: var(--bg-glass);
    backdrop-filter: blur(20px) saturate(180%);
    -webkit-backdrop-filter: blur(20px) saturate(180%);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-2xl);
    padding: var(--space-12);
    display: grid;
    grid-template-columns: 1.2fr 1fr;
    gap: var(--space-12);
    align-items: center;
    overflow: hidden;
}

.about-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(135deg, rgba(255, 255, 255, 0.1) 0%, transparent 100%);
    pointer-events: none;
}

.about-badge {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-2) var(--space-4);
    background: var(--gradient-primary);
    border-radius: var(--radius-full);
    font-size: 0.8rem;
    font-weight: 600;
    color: white;
    margin-bottom: var(--space-6);
}

.about-content h2 {
    font-size: clamp(1.75rem, 3vw, 2.5rem);
    margin-bottom: var(--space-6);
    line-height: 1.3;
}

.about-text {
    font-size: 1.05rem;
    line-height: 1.8;
    color: var(--text-secondary);
    margin-bottom: var(--space-8);
}

.about-features {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-4);
}

.about-feature {
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

.about-feature-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--success);
    font-size: 1rem;
}

.about-feature span {
    font-size: 0.9rem;
    font-weight: 500;
}

.about-visual-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    padding: var(--space-8);
}

.visual-stats {
    display: flex;
    flex-direction: column;
    gap: var(--space-6);
}

.visual-stat {
    text-align: center;
    padding: var(--space-4);
    background: var(--bg-tertiary);
    border-radius: var(--radius-lg);
    transition: all 0.3s ease;
}

.visual-stat:hover {
    transform: scale(1.05);
    background: var(--gradient-primary);
}

.visual-stat:hover .visual-stat-number {
    background: none;
    -webkit-background-clip: unset;
    -webkit-text-fill-color: white;
    background-clip: unset;
    color: white;
}

.visual-stat:hover .visual-stat-label {
    color: rgba(255, 255, 255, 0.9);
}

.visual-stat-number {
    font-family: var(--font-display);
    font-size: 2.5rem;
    font-weight: 700;
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    transition: all 0.3s ease;
}

.visual-stat-label {
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin-top: var(--space-1);
    transition: all 0.3s ease;
}

/* Expertise Section */
.expertise-section {
    padding: var(--space-20) 0;
    background: var(--bg-secondary);
}

.expertise-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-8);
}

.expertise-card {
    position: relative;
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-2xl);
    padding: var(--space-10);
    overflow: hidden;
    transition: all 0.4s ease;
}

.expertise-card:hover {
    transform: translateY(-8px);
    box-shadow: var(--shadow-xl), var(--shadow-glow);
}

.expertise-card-bg {
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.1) 0%, transparent 70%);
    pointer-events: none;
}

.expertise-card-bg-accent {
    background: radial-gradient(circle, rgba(139, 92, 246, 0.1) 0%, transparent 70%);
}

.expertise-icon {
    width: 72px;
    height: 72px;
    background: var(--gradient-primary);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: white;
    margin-bottom: var(--space-6);
    position: relative;
    z-index: 1;
}

.expertise-icon-accent {
    background: var(--gradient-accent);
}

.expertise-content {
    position: relative;
    z-index: 1;
}

.expertise-content h3 {
    font-size: 1.5rem;
    margin-bottom: var(--space-4);
}

.expertise-content p {
    font-size: 1rem;
    color: var(--text-secondary);
    line-height: 1.7;
    margin-bottom: var(--space-6);
}

.expertise-list {
    list-style: none;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: var(--space-3);
    margin-bottom: var(--space-6);
}

.expertise-list li {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.expertise-list i {
    color: var(--success);
    font-size: 0.85rem;
}

.expertise-cta {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-5);
    background: var(--bg-tertiary);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-lg);
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-primary);
    transition: all 0.3s ease;
    position: relative;
    z-index: 1;
}

.expertise-cta:hover {
    background: var(--gradient-primary);
    border-color: transparent;
    color: white;
    transform: translateX(8px);
}

.expertise-cta i {
    transition: transform 0.3s ease;
}

.expertise-cta:hover i {
    transform: translateX(4px);
}

/* Animation Stagger */
.stagger-1 { animation-delay: 0.1s; }
.stagger-2 { animation-delay: 0.2s; }
.stagger-3 { animation-delay: 0.3s; }
.stagger-4 { animation-delay: 0.4s; }

/* Responsive */
@media (max-width: 992px) {
    .about-card {
        grid-template-columns: 1fr;
        padding: var(--space-8);
    }
    
    .expertise-grid {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .about-features {
        grid-template-columns: 1fr;
    }
    
    .expertise-list {
        grid-template-columns: 1fr;
    }
    
    .expertise-card {
        padding: var(--space-6);
    }
}

@media (max-width: 576px) {
    .services-section,
    .about-section,
    .expertise-section {
        padding: var(--space-12) 0;
    }
    
    .section-header {
        margin-bottom: var(--space-8);
    }
}
</style>

@endsection