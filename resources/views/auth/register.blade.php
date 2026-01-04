<!DOCTYPE html>
<html lang="id" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Daftar sebagai Pelanggan di Nukang">
    <title>Daftar Pelanggan - Nukang</title>
    <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
    <link href="{{ asset('/css/modern.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="auth-body">

<div class="register-page">
    {{-- Background --}}
    <div class="register-bg">
        <div class="bg-orb bg-orb-1"></div>
        <div class="bg-orb bg-orb-2"></div>
        <div class="bg-grid"></div>
    </div>

    <div class="register-wrapper">
        {{-- Left Side --}}
        <div class="register-side">
            <div class="side-content">
                <a href="{{ url('/') }}" class="side-logo">
                    <img src="{{ asset('images/frontslider/logo.png') }}" alt="Nukang">
                    <span>Nukang</span>
                </a>
                
                <div class="side-tagline">
                    <h1>Bergabung Sekarang!</h1>
                    <p>Daftar dan nikmati kemudahan mencari jasa renovasi profesional</p>
                </div>
                
                <div class="side-features">
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Gratis Pendaftaran</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Akses Ribuan Tukang</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Review & Rating</span>
                    </div>
                    <div class="feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Pembayaran Aman</span>
                    </div>
                </div>
                
                <div class="side-stats">
                    <div class="stat-item">
                        <span class="stat-num">{{ \App\Tukang::count() ?: '500' }}+</span>
                        <span class="stat-label">Tukang</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">{{ \App\Pelanggan::count() ?: '1000' }}+</span>
                        <span class="stat-label">Pelanggan</span>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <span class="stat-num">4.9</span>
                        <span class="stat-label">Rating</span>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- Right Side - Form --}}
        <div class="register-form-side">
            {{-- Theme Toggle --}}
            <button class="theme-toggle" id="themeToggle">
                <span class="theme-toggle-icon moon"><i class="fas fa-moon"></i></span>
                <span class="theme-toggle-icon sun"><i class="fas fa-sun"></i></span>
            </button>
            
            <div class="form-container">
                {{-- Mobile Logo --}}
                <a href="{{ url('/') }}" class="mobile-logo">
                    <img src="{{ asset('images/frontslider/logo.png') }}" alt="Nukang">
                    <span>Nukang</span>
                </a>
                
                <div class="form-header">
                    <h2>Buat Akun Baru 🚀</h2>
                    <p>Daftar sebagai pelanggan untuk mulai mencari jasa</p>
                </div>
                
                @if(count($errors) > 0)
                    <div class="form-alert">
                        <i class="fas fa-exclamation-triangle"></i>
                        <div>
                            @foreach($errors->all() as $error)
                                <p>{{ $error }}</p>
                            @endforeach
                        </div>
                    </div>
                @endif
                
                <form method="POST" action="{{ url('/auth/register') }}" class="auth-form">
                    @csrf
                    
                    <div class="form-field">
                        <label><i class="fas fa-user"></i> Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap" required autofocus>
                    </div>
                    
                    <div class="form-field">
                        <label><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" required>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-field">
                            <label><i class="fas fa-lock"></i> Kata Sandi</label>
                            <div class="password-field">
                                <input type="password" name="password" id="password" placeholder="Min. 6 karakter" required>
                                <button type="button" class="toggle-password" onclick="togglePassword('password', 'icon1')">
                                    <i class="fas fa-eye" id="icon1"></i>
                                </button>
                            </div>
                        </div>
                        <div class="form-field">
                            <label><i class="fas fa-lock"></i> Konfirmasi</label>
                            <div class="password-field">
                                <input type="password" name="password_confirmation" id="password_confirm" placeholder="Ulangi sandi" required>
                                <button type="button" class="toggle-password" onclick="togglePassword('password_confirm', 'icon2')">
                                    <i class="fas fa-eye" id="icon2"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="form-check">
                        <label class="checkbox-wrapper">
                            <input type="checkbox" id="terms" required>
                            <span class="checkmark"></span>
                            <span>Saya setuju dengan <a href="#">Syarat & Ketentuan</a> dan <a href="#">Kebijakan Privasi</a></span>
                        </label>
                    </div>
                    
                    <button type="submit" class="btn-submit">
                        <i class="fas fa-rocket"></i> Daftar Sekarang
                    </button>
                </form>
                
                <div class="form-divider">
                    <span>atau</span>
                </div>
                
                <a href="{{ url('/auth/registertukang') }}" class="btn-alt">
                    <i class="fas fa-hard-hat"></i>
                    <div>
                        <span class="btn-title">Daftar sebagai Tukang</span>
                        <span class="btn-desc">Tawarkan jasa renovasi Anda</span>
                    </div>
                </a>
                
                <div class="form-footer">
                    <p>Sudah punya akun? <a href="{{ url('/auth/login') }}">Masuk</a></p>
                </div>
                
                <a href="{{ url('/') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.auth-body { margin: 0; padding: 0; min-height: 100vh; overflow-x: hidden; }

.register-page {
    min-height: 100vh;
    display: flex;
    position: relative;
}

/* Background */
.register-bg {
    position: fixed;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
}

.bg-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(100px);
}

.bg-orb-1 {
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(16, 185, 129, 0.2) 0%, transparent 70%);
    top: -25%;
    left: -15%;
}

.bg-orb-2 {
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.15) 0%, transparent 70%);
    bottom: -20%;
    right: -10%;
}

.bg-grid {
    position: absolute;
    inset: 0;
    background-image: 
        linear-gradient(rgba(16, 185, 129, 0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(16, 185, 129, 0.02) 1px, transparent 1px);
    background-size: 60px 60px;
}

/* Wrapper */
.register-wrapper {
    display: flex;
    width: 100%;
    min-height: 100vh;
    position: relative;
    z-index: 1;
}

/* Left Side */
.register-side {
    flex: 1;
    background: var(--gradient-primary);
    padding: var(--space-10);
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
}

.register-side::before {
    content: '';
    position: absolute;
    inset: 0;
    background: 
        radial-gradient(circle at 20% 80%, rgba(255,255,255,0.1) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.08) 0%, transparent 50%);
}

.side-content {
    position: relative;
    z-index: 1;
    color: white;
    max-width: 400px;
}

.side-logo {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    margin-bottom: var(--space-10);
}

.side-logo img { height: 48px; }

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
    font-size: 2.25rem;
    margin-bottom: var(--space-4);
    color: white;
}

.side-tagline p {
    font-size: 1.1rem;
    opacity: 0.9;
    color: rgba(255, 255, 255, 0.9);
}

.side-features {
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
    margin-bottom: var(--space-10);
}

.feature-item {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    font-size: 0.95rem;
    opacity: 0.95;
}

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

.stat-num {
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

/* Right Side */
.register-form-side {
    flex: 0 0 500px;
    background: var(--bg-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: var(--space-8);
    position: relative;
}

.form-container {
    width: 100%;
    max-width: 400px;
    position: relative;
}

.theme-toggle {
    position: absolute;
    top: var(--space-6);
    right: var(--space-6);
    z-index: 10;
}

.mobile-logo {
    display: none;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    margin-bottom: var(--space-6);
}

.mobile-logo img { height: 36px; }

.mobile-logo span {
    font-family: var(--font-display);
    font-size: 1.25rem;
    font-weight: 700;
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.form-header {
    text-align: center;
    margin-bottom: var(--space-6);
}

.form-header h2 {
    font-size: 1.5rem;
    margin-bottom: var(--space-2);
}

.form-header p {
    color: var(--text-secondary);
    font-size: 0.9rem;
}

.form-alert {
    display: flex;
    gap: var(--space-3);
    padding: var(--space-4);
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-5);
    color: var(--danger);
}

.form-alert p { margin: 0; font-size: 0.9rem; }

.form-field {
    margin-bottom: var(--space-4);
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
    color: var(--text-tertiary);
    font-size: 0.8rem;
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

.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-3);
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

.form-check {
    margin-bottom: var(--space-5);
}

.checkbox-wrapper {
    display: flex;
    align-items: flex-start;
    gap: var(--space-3);
    cursor: pointer;
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.checkbox-wrapper input { display: none; }

.checkmark {
    width: 18px;
    height: 18px;
    border: 2px solid var(--border-primary);
    border-radius: 4px;
    flex-shrink: 0;
    transition: all 0.2s ease;
}

.checkbox-wrapper input:checked + .checkmark {
    background: var(--gradient-primary);
    border-color: transparent;
}

.checkbox-wrapper input:checked + .checkmark::after {
    content: '✓';
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.65rem;
    height: 100%;
}

.checkbox-wrapper a {
    color: var(--success);
}

.btn-submit {
    width: 100%;
    padding: var(--space-4);
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
    gap: var(--space-2);
    transition: all 0.3s ease;
}

.btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
}

.form-divider {
    text-align: center;
    margin: var(--space-5) 0;
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

.btn-alt {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-4);
    background: var(--bg-tertiary);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-lg);
    margin-bottom: var(--space-5);
    transition: all 0.3s ease;
}

.btn-alt:hover {
    border-color: var(--success);
    background: rgba(16, 185, 129, 0.05);
}

.btn-alt i {
    width: 40px;
    height: 40px;
    background: var(--gradient-accent);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
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

.form-footer {
    text-align: center;
    margin-bottom: var(--space-5);
}

.form-footer p {
    font-size: 0.9rem;
    color: var(--text-secondary);
}

.form-footer a {
    color: var(--success);
    font-weight: 600;
}

.back-link {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    color: var(--text-tertiary);
    font-size: 0.9rem;
}

.back-link:hover { color: var(--success); }

/* Responsive */
@media (max-width: 1024px) {
    .register-side { display: none; }
    .register-form-side { flex: 1; }
    .mobile-logo { display: flex; }
}

@media (max-width: 576px) {
    .register-form-side { padding: var(--space-6); }
    .form-row { grid-template-columns: 1fr; }
}
</style>

<script>
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

function togglePassword(inputId, iconId) {
    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.replace('fa-eye', 'fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.replace('fa-eye-slash', 'fa-eye');
    }
}
</script>
</body>
</html>
