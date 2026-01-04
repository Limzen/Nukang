<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Masuk ke akun Nukang Anda">
    <meta name="theme-color" content="#10b981">
    
    <title>Masuk - Nukang</title>

    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="{{ asset('/css/modern.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="auth-body">

<div class="auth-page">
    {{-- Animated Background --}}
    <div class="auth-bg">
        <div class="auth-orb auth-orb-1"></div>
        <div class="auth-orb auth-orb-2"></div>
        <div class="auth-orb auth-orb-3"></div>
        <div class="auth-grid"></div>
    </div>
    
    <div class="auth-wrapper">
        {{-- Left Side - Branding & Features --}}
        <div class="auth-side">
            {{-- Floating Decoration --}}
            <div class="floating-shapes">
                <div class="shape shape-1"><i class="fas fa-hammer"></i></div>
                <div class="shape shape-2"><i class="fas fa-home"></i></div>
                <div class="shape shape-3"><i class="fas fa-paint-roller"></i></div>
                <div class="shape shape-4"><i class="fas fa-wrench"></i></div>
                <div class="shape shape-5"><i class="fas fa-tools"></i></div>
            </div>
            
            <div class="side-content">
                {{-- Logo --}}
                <a href="{{ url('/') }}" class="side-logo">
                    <img src="{{ asset('images/frontslider/logo.png') }}" alt="Nukang">
                    <span>Nukang</span>
                </a>
                
                {{-- Tagline --}}
                <div class="side-tagline">
                    <h1>Selamat Datang di <span class="text-glow">Nukang</span></h1>
                    <p>Platform premium untuk mencari jasa renovasi profesional dan terpercaya di Indonesia</p>
                </div>
                
                {{-- Features --}}
                <div class="side-features">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Pencarian Berbasis Lokasi</h4>
                            <p>Temukan tukang terdekat dari lokasi Anda</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon feature-icon-purple">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Tukang Terverifikasi</h4>
                            <p>Semua mitra sudah melalui proses verifikasi</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon feature-icon-gold">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Pembayaran Aman</h4>
                            <p>Transaksi terlindungi dengan sistem escrow</p>
                        </div>
                    </div>
                    
                    <div class="feature-item">
                        <div class="feature-icon feature-icon-blue">
                            <i class="fas fa-star"></i>
                        </div>
                        <div class="feature-text">
                            <h4>Rating & Review</h4>
                            <p>Pilih tukang berdasarkan ulasan pengguna</p>
                        </div>
                    </div>
                </div>
                
                {{-- Stats --}}
                <div class="side-stats">
                    <div class="stat-item">
                        <span class="stat-number">{{ \App\Tukang::count() ?: '500' }}+</span>
                        <span class="stat-label">Tukang</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-number">{{ \App\Pelanggan::count() ?: '1000' }}+</span>
                        <span class="stat-label">Pelanggan</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-number">4.9</span>
                        <span class="stat-label">Rating</span>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Right Side - Login Form --}}
        <div class="auth-form-side">
            {{-- Theme Toggle --}}
            <button class="theme-toggle" id="themeToggle" title="Toggle Theme">
                <span class="theme-toggle-icon moon"><i class="fas fa-moon"></i></span>
                <span class="theme-toggle-icon sun"><i class="fas fa-sun"></i></span>
            </button>
            
            <div class="auth-form-container">
                {{-- Mobile Logo --}}
                <a href="{{ url('/') }}" class="mobile-logo">
                    <img src="{{ asset('images/frontslider/logo.png') }}" alt="Nukang">
                    <span>Nukang</span>
                </a>
                
                {{-- Header --}}
                <div class="form-header">
                    <h2>Masuk ke Akun</h2>
                    <p>Silakan masuk untuk melanjutkan</p>
                </div>
                
                {{-- Error Messages --}}
                @if(count($errors) > 0)
                    <div class="auth-alert animate-shake">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                {{-- Login Form --}}
                <form method="POST" action="{{ url('/auth/login') }}" class="auth-form">
                    {!! csrf_field() !!}
                    
                    <div class="form-field">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" placeholder="nama@email.com" 
                               value="{{ old('email') }}" required autofocus>
                    </div>
                    
                    <div class="form-field">
                        <label><i class="fas fa-lock"></i> Kata Sandi</label>
                        <div class="password-field">
                            <input type="password" name="password" id="password" 
                                   placeholder="Masukkan kata sandi" required>
                            <button type="button" class="toggle-password" onclick="togglePassword()">
                                <i class="fas fa-eye" id="toggleIcon"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="form-options">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" name="remember">
                            <span class="checkmark"></span>
                            <span>Ingat saya</span>
                        </label>
                        <a href="{{ url('/password/email') }}" class="forgot-link">Lupa kata sandi?</a>
                    </div>
                    
                    <button type="submit" class="btn-login">
                        <span>Masuk</span>
                        <i class="fas fa-arrow-right"></i>
                    </button>
                </form>
                
                {{-- Divider --}}
                <div class="form-divider">
                    <span>Belum punya akun?</span>
                </div>
                
                {{-- Register Options --}}
                <div class="register-options">
                    <a href="{{ url('/auth/register') }}" class="register-btn">
                        <i class="fas fa-user"></i>
                        <div>
                            <span class="btn-title">Daftar Pelanggan</span>
                            <span class="btn-desc">Cari jasa renovasi</span>
                        </div>
                    </a>
                    
                    <a href="{{ url('/auth/registertukang') }}" class="register-btn register-btn-alt">
                        <i class="fas fa-hard-hat"></i>
                        <div>
                            <span class="btn-title">Daftar Tukang</span>
                            <span class="btn-desc">Tawarkan jasamu</span>
                        </div>
                    </a>
                </div>
                
                {{-- Back to Home --}}
                <a href="{{ url('/') }}" class="back-home">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<style>
/* Base */
.auth-body {
    margin: 0;
    padding: 0;
    min-height: 100vh;
    overflow-x: hidden;
}

.auth-page {
    min-height: 100vh;
    display: flex;
    position: relative;
}

/* Background */
.auth-bg {
    position: fixed;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
}

.auth-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(100px);
}

.auth-orb-1 {
    width: 800px;
    height: 800px;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.25) 0%, transparent 70%);
    top: -30%;
    left: -20%;
    animation: float1 20s ease-in-out infinite;
}

.auth-orb-2 {
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.2) 0%, transparent 70%);
    bottom: -20%;
    right: -15%;
    animation: float2 25s ease-in-out infinite;
}

.auth-orb-3 {
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
    top: 50%;
    left: 40%;
    animation: float3 18s ease-in-out infinite;
}

@keyframes float1 { 0%, 100% { transform: translate(0, 0); } 50% { transform: translate(50px, 50px); } }
@keyframes float2 { 0%, 100% { transform: translate(0, 0); } 50% { transform: translate(-40px, -40px); } }
@keyframes float3 { 0%, 100% { transform: translate(0, 0); } 50% { transform: translate(30px, -30px); } }

.auth-grid {
    position: absolute;
    inset: 0;
    background-image: 
        linear-gradient(rgba(16, 185, 129, 0.03) 1px, transparent 1px),
        linear-gradient(90deg, rgba(16, 185, 129, 0.03) 1px, transparent 1px);
    background-size: 80px 80px;
}

/* Wrapper */
.auth-wrapper {
    display: flex;
    width: 100%;
    min-height: 100vh;
    position: relative;
    z-index: 1;
}

/* Left Side */
.auth-side {
    flex: 1;
    background: var(--gradient-primary);
    padding: var(--space-10);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.auth-side::before {
    content: '';
    position: absolute;
    inset: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 50%);
}

/* Floating Shapes */
.floating-shapes {
    position: absolute;
    inset: 0;
    pointer-events: none;
}

.shape {
    position: absolute;
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.5rem;
    animation: floatShape 8s ease-in-out infinite;
}

.shape-1 { top: 10%; left: 10%; animation-delay: 0s; }
.shape-2 { top: 20%; right: 15%; animation-delay: -2s; }
.shape-3 { bottom: 30%; left: 5%; animation-delay: -4s; }
.shape-4 { bottom: 15%; right: 10%; animation-delay: -6s; }
.shape-5 { top: 60%; left: 20%; animation-delay: -3s; }

@keyframes floatShape {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
}

/* Side Content */
.side-content {
    position: relative;
    z-index: 1;
    color: white;
    max-width: 500px;
}

.side-logo {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    margin-bottom: var(--space-10);
}

.side-logo img {
    height: 48px;
}

.side-logo span {
    font-family: var(--font-display);
    font-size: 1.75rem;
    font-weight: 700;
    color: white;
}

.side-tagline {
    margin-bottom: var(--space-10);
}

.side-tagline h1 {
    font-size: 2.5rem;
    margin-bottom: var(--space-4);
    line-height: 1.2;
    color: white;
}

.text-glow {
    text-shadow: 0 0 30px rgba(255, 255, 255, 0.5);
}

.side-tagline p {
    font-size: 1.1rem;
    opacity: 0.9;
    line-height: 1.6;
    color: rgba(255, 255, 255, 0.9);
}

/* Features */
.side-features {
    display: flex;
    flex-direction: column;
    gap: var(--space-5);
    margin-bottom: var(--space-10);
}

.feature-item {
    display: flex;
    align-items: flex-start;
    gap: var(--space-4);
}

.feature-icon {
    width: 48px;
    height: 48px;
    background: rgba(255, 255, 255, 0.95);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    flex-shrink: 0;
    color: #10b981;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

.feature-icon-purple { background: rgba(255, 255, 255, 0.95); color: #8b5cf6; }
.feature-icon-gold { background: rgba(255, 255, 255, 0.95); color: #f59e0b; }
.feature-icon-blue { background: rgba(255, 255, 255, 0.95); color: #3b82f6; }

.feature-text h4 {
    font-size: 1rem;
    margin-bottom: var(--space-1);
    color: white;
}

.feature-text p {
    font-size: 0.875rem;
    opacity: 0.8;
    margin: 0;
    color: rgba(255, 255, 255, 0.8);
}

/* Stats */
.side-stats {
    display: flex;
    align-items: center;
    padding: var(--space-5);
    background: rgba(255, 255, 255, 0.15);
    border-radius: var(--radius-xl);
    backdrop-filter: blur(10px);
}

.stat-item {
    flex: 1;
    text-align: center;
    padding: var(--space-2) 0;
}

.stat-number {
    display: block;
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 700;
    color: white;
}

.stat-label {
    font-size: 0.85rem;
    color: rgba(255, 255, 255, 0.9);
}

.stat-divider {
    width: 1px;
    height: 50px;
    background: rgba(255, 255, 255, 0.3);
    flex-shrink: 0;
}

/* Right Side - Form */
.auth-form-side {
    flex: 0 0 500px;
    background: var(--bg-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-8);
    position: relative;
}

.theme-toggle {
    position: absolute;
    top: var(--space-6);
    right: var(--space-6);
}

.auth-form-container {
    width: 100%;
    max-width: 380px;
}

.mobile-logo {
    display: none;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    margin-bottom: var(--space-6);
}

.mobile-logo img {
    height: 36px;
}

.mobile-logo span {
    font-family: var(--font-display);
    font-size: 1.25rem;
    font-weight: 700;
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Form Header */
.form-header {
    text-align: center;
    margin-bottom: var(--space-8);
}

.form-header h2 {
    font-size: 1.75rem;
    margin-bottom: var(--space-2);
}

.form-header p {
    color: var(--text-secondary);
}

/* Alert */
.auth-alert {
    display: flex;
    align-items: flex-start;
    gap: var(--space-3);
    padding: var(--space-4);
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-6);
    color: var(--danger);
}

.auth-alert i { margin-top: 2px; }
.auth-alert p { margin: 0; font-size: 0.9rem; }

@keyframes shake {
    0%, 100% { transform: translateX(0); }
    20%, 60% { transform: translateX(-5px); }
    40%, 80% { transform: translateX(5px); }
}
.animate-shake { animation: shake 0.4s ease; }

/* Form Fields */
.form-field {
    margin-bottom: var(--space-5);
}

.form-field label {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-secondary);
    margin-bottom: var(--space-2);
}

.form-field label i {
    font-size: 0.8rem;
    color: var(--text-tertiary);
}

.form-field input {
    width: 100%;
    padding: var(--space-4);
    font-size: 1rem;
    color: var(--text-primary);
    background: var(--bg-tertiary);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-lg);
    outline: none;
    transition: all 0.3s ease;
}

.form-field input:focus {
    border-color: var(--success);
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

.password-field {
    position: relative;
}

.password-field input {
    padding-right: 48px;
}

.toggle-password {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    color: var(--text-tertiary);
    cursor: pointer;
    padding: var(--space-2);
}

.toggle-password:hover { color: var(--text-primary); }

/* Form Options */
.form-options {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: var(--space-6);
}

.checkbox-wrapper {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    cursor: pointer;
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.checkbox-wrapper input { display: none; }

.checkmark {
    width: 18px;
    height: 18px;
    border: 2px solid var(--border-primary);
    border-radius: 4px;
    position: relative;
    transition: all 0.2s ease;
}

.checkbox-wrapper input:checked + .checkmark {
    background: var(--gradient-primary);
    border-color: transparent;
}

.checkbox-wrapper input:checked + .checkmark::after {
    content: '✓';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    color: white;
    font-size: 0.65rem;
}

.forgot-link {
    font-size: 0.9rem;
    color: var(--success);
}

/* Login Button */
.btn-login {
    width: 100%;
    padding: var(--space-4) var(--space-6);
    background: var(--gradient-primary);
    border: none;
    border-radius: var(--radius-lg);
    color: white;
    font-size: 1rem;
    font-weight: 600;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-3);
    transition: all 0.3s ease;
}

.btn-login:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
}

.btn-login i {
    transition: transform 0.3s ease;
}

.btn-login:hover i {
    transform: translateX(4px);
}

/* Divider */
.form-divider {
    text-align: center;
    margin: var(--space-6) 0;
    position: relative;
}

.form-divider::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 0;
    right: 0;
    height: 1px;
    background: var(--border-primary);
}

.form-divider span {
    position: relative;
    background: var(--bg-primary);
    padding: 0 var(--space-4);
    font-size: 0.85rem;
    color: var(--text-tertiary);
}

/* Register Options */
.register-options {
    display: flex;
    gap: var(--space-3);
    margin-bottom: var(--space-6);
}

.register-btn {
    flex: 1;
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-4);
    background: var(--bg-tertiary);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-lg);
    transition: all 0.3s ease;
}

.register-btn:hover {
    border-color: var(--success);
    background: rgba(16, 185, 129, 0.05);
}

.register-btn i {
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

.register-btn-alt i {
    background: var(--gradient-accent);
}

.btn-title {
    display: block;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--text-primary);
}

.btn-desc {
    font-size: 0.75rem;
    color: var(--text-tertiary);
}

/* Back Home */
.back-home {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    color: var(--text-tertiary);
    font-size: 0.9rem;
    transition: color 0.2s ease;
}

.back-home:hover {
    color: var(--success);
}

/* Responsive */
@media (max-width: 1024px) {
    .auth-side {
        display: none;
    }
    
    .auth-form-side {
        flex: 1;
    }
    
    .mobile-logo {
        display: flex;
    }
}

@media (max-width: 576px) {
    .auth-form-side {
        padding: var(--space-6);
    }
    
    .register-options {
        flex-direction: column;
    }
    
    .form-header h2 {
        font-size: 1.5rem;
    }
}
</style>

<script>
// Theme toggle
const themeToggle = document.getElementById('themeToggle');
const html = document.documentElement;
const savedTheme = localStorage.getItem('theme') || 'dark';
html.setAttribute('data-theme', savedTheme);

themeToggle.addEventListener('click', () => {
    const currentTheme = html.getAttribute('data-theme');
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
    html.setAttribute('data-theme', newTheme);
    localStorage.setItem('theme', newTheme);
});

// Password toggle
function togglePassword() {
    const password = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');
    
    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>

</body>
</html>
