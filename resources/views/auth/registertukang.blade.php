<!DOCTYPE html>
<html lang="id" data-theme="dark">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Daftar sebagai Mitra Tukang di Nukang">
    <title>Daftar Tukang - Nukang</title>
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

        <div class="register-container">
            {{-- Header --}}
            <div class="register-header">
                <a href="{{ url('/') }}" class="logo">
                    <img src="{{ asset('images/frontslider/logo.png') }}" alt="Nukang">
                    <span>Nukang</span>
                </a>
                <button class="theme-toggle" id="themeToggle">
                    <span class="theme-toggle-icon moon"><i class="fas fa-moon"></i></span>
                    <span class="theme-toggle-icon sun"><i class="fas fa-sun"></i></span>
                </button>
            </div>

            {{-- Content --}}
            <div class="register-content">
                {{-- Step Indicator --}}
                <div class="steps-indicator">
                    <div class="step-item active" data-step="1">
                        <span class="step-num">1</span>
                        <span class="step-label">Info Akun</span>
                    </div>
                    <div class="step-line" data-line="1"></div>
                    <div class="step-item" data-step="2">
                        <span class="step-num">2</span>
                        <span class="step-label">Keahlian</span>
                    </div>
                    <div class="step-line" data-line="2"></div>
                    <div class="step-item" data-step="3">
                        <span class="step-num">3</span>
                        <span class="step-label">Dokumen</span>
                    </div>
                </div>

                {{-- Main Card --}}
                <div class="register-card">
                    <div class="card-header">
                        <div class="header-icon">
                            <i class="fas fa-hard-hat"></i>
                        </div>
                        <div class="header-text">
                            <h1>Daftar Sebagai Mitra Tukang</h1>
                            <p id="step-description">Langkah 1: Isi informasi akun Anda</p>
                        </div>
                    </div>

                    {{-- Errors --}}
                    @if(count($errors) > 0)
                        <div class="register-alert">
                            <i class="fas fa-exclamation-triangle"></i>
                            <div>
                                <strong>Terjadi Kesalahan</strong>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ url('/auth/registertukang') }}" enctype="multipart/form-data"
                        class="register-form" id="registerForm">
                        @csrf
                        <input type="hidden" name="statuspengguna" value="2">

                        {{-- Step 1: Account Info --}}
                        <div class="form-step active" id="step-1">
                            <div class="form-section">
                                <h3><i class="fas fa-user"></i> Informasi Akun</h3>

                                <div class="form-field">
                                    <label>Nama Lengkap <span class="required">*</span></label>
                                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                                        placeholder="Masukkan nama lengkap">
                                </div>

                                <div class="form-row">
                                    <div class="form-field">
                                        <label>Email <span class="required">*</span></label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            placeholder="nama@email.com">
                                    </div>
                                    <div class="form-field">
                                        <label>Kata Sandi <span class="required">*</span></label>
                                        <input type="password" name="password" id="password"
                                            placeholder="Min. 6 karakter">
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label>Konfirmasi Kata Sandi <span class="required">*</span></label>
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        placeholder="Ulangi kata sandi">
                                </div>
                            </div>

                            <div class="step-buttons">
                                <span></span>
                                <button type="button" class="btn-next" onclick="nextStep(1)">
                                    <span>Lanjut ke Keahlian</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Step 2: Expertise --}}
                        <div class="form-step" id="step-2">
                            <div class="form-section">
                                <h3><i class="fas fa-tools"></i> Keahlian</h3>

                                <div class="form-row">
                                    <div class="form-field">
                                        <label>Kategori Keahlian <span class="required">*</span></label>
                                        <select name="kategori" id="kategori">
                                            <option value="">-- Pilih Kategori --</option>
                                            @foreach($kategoritukang as $value)
                                                <option value="{{ $value->id_kategoritukang }}">{{ $value->kategoritukang }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-field">
                                        <label>Pengalaman Bekerja <span class="required">*</span></label>
                                        <select name="pengalaman" id="pengalaman">
                                            @for($i = 1; $i <= 30; $i++)
                                                <option value="{{ $i }}">{{ $i }} Tahun</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label>Deskripsi Keahlian <span class="required">*</span></label>
                                    <textarea name="deskripsi" id="deskripsi" rows="4"
                                        placeholder="Jelaskan keahlian dan pengalaman Anda secara singkat. Contoh: Sudah berpengalaman mengerjakan berbagai proyek pembangunan rumah dan gedung..."></textarea>
                                </div>
                            </div>

                            <div class="step-buttons">
                                <button type="button" class="btn-prev" onclick="prevStep(2)">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Kembali</span>
                                </button>
                                <button type="button" class="btn-next" onclick="nextStep(2)">
                                    <span>Lanjut ke Dokumen</span>
                                    <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>

                        {{-- Step 3: Documents --}}
                        <div class="form-step" id="step-3">
                            <div class="form-section">
                                <h3><i class="fas fa-file-alt"></i> Dokumen Verifikasi</h3>

                                <div class="upload-grid">
                                    <div class="upload-item">
                                        <input type="file" name="fotoktp" id="fotoktp" accept=".jpg,.jpeg,.png" hidden>
                                        <label for="fotoktp" class="upload-label" id="label-fotoktp">
                                            <i class="fas fa-id-card"></i>
                                            <span>Foto KTP <span class="required">*</span></span>
                                            <small class="file-hint">JPG, PNG (Max 2MB)</small>
                                            <small class="file-name"></small>
                                        </label>
                                    </div>
                                    <div class="upload-item">
                                        <input type="file" name="fotosim" id="fotosim" accept=".jpg,.jpeg,.png" hidden>
                                        <label for="fotosim" class="upload-label" id="label-fotosim">
                                            <i class="fas fa-address-card"></i>
                                            <span>Foto SIM</span>
                                            <small class="file-hint">Opsional</small>
                                            <small class="file-name"></small>
                                        </label>
                                    </div>
                                    <div class="upload-item">
                                        <input type="file" name="fotoprofil" id="fotoprofil" accept=".jpg,.jpeg,.png"
                                            hidden>
                                        <label for="fotoprofil" class="upload-label" id="label-fotoprofil">
                                            <i class="fas fa-portrait"></i>
                                            <span>Foto Profil <span class="required">*</span></span>
                                            <small class="file-hint">JPG, PNG (Max 2MB)</small>
                                            <small class="file-name"></small>
                                        </label>
                                    </div>
                                    <div class="upload-item">
                                        <input type="file" name="fotohasilkerja" id="fotohasilkerja" accept=".zip"
                                            hidden>
                                        <label for="fotohasilkerja" class="upload-label" id="label-fotohasilkerja">
                                            <i class="fas fa-images"></i>
                                            <span>Hasil Kerja <span class="required">*</span></span>
                                            <small class="file-hint">ZIP file (Max 10MB)</small>
                                            <small class="file-name"></small>
                                        </label>
                                    </div>
                                </div>
                            </div>

                            {{-- Agreement --}}
                            <div class="agreement-section">
                                <label class="checkbox-wrapper">
                                    <input type="checkbox" name="verifikasi" id="verifikasi">
                                    <span class="checkmark"></span>
                                    <span>Saya bersedia mengikuti proses verifikasi dan testing dari tim Nukang</span>
                                </label>
                            </div>

                            <div class="step-buttons">
                                <button type="button" class="btn-prev" onclick="prevStep(3)">
                                    <i class="fas fa-arrow-left"></i>
                                    <span>Kembali</span>
                                </button>
                                <button type="submit" class="btn-submit">
                                    <span>Daftar Sekarang</span>
                                    <i class="fas fa-check"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    {{-- Footer --}}
                    <div class="card-footer">
                        <p>Ingin mendaftar sebagai pelanggan? <a href="{{ url('auth/register') }}">Daftar Pelanggan</a>
                        </p>
                        <p>Sudah punya akun? <a href="{{ url('auth/login') }}">Masuk</a></p>
                    </div>
                </div>

                {{-- Back Link --}}
                <a href="{{ url('/') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

    <style>
        .auth-body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
        }

        .register-page {
            min-height: 100vh;
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
            filter: blur(120px);
        }

        .bg-orb-1 {
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(139, 92, 246, 0.2) 0%, transparent 70%);
            top: -20%;
            right: -15%;
        }

        .bg-orb-2 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(16, 185, 129, 0.15) 0%, transparent 70%);
            bottom: -15%;
            left: -10%;
        }

        .bg-grid {
            position: absolute;
            inset: 0;
            background-image:
                linear-gradient(rgba(139, 92, 246, 0.02) 1px, transparent 1px),
                linear-gradient(90deg, rgba(139, 92, 246, 0.02) 1px, transparent 1px);
            background-size: 60px 60px;
        }

        /* Container */
        .register-container {
            max-width: 800px;
            margin: 0 auto;
            padding: var(--space-6);
            position: relative;
            z-index: 1;
        }

        /* Header */
        .register-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--space-8);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .logo img {
            height: 36px;
        }

        .logo span {
            font-family: var(--font-display);
            font-size: 1.25rem;
            font-weight: 700;
            background: var(--gradient-accent);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Steps Indicator */
        .steps-indicator {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            margin-bottom: var(--space-8);
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--space-2);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .step-num {
            width: 40px;
            height: 40px;
            background: var(--bg-tertiary);
            border: 2px solid var(--border-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .step-item.active .step-num {
            background: var(--gradient-accent);
            border-color: transparent;
            color: white;
            box-shadow: 0 4px 15px rgba(139, 92, 246, 0.4);
        }

        .step-item.completed .step-num {
            background: var(--success);
            border-color: transparent;
            color: white;
        }

        .step-item.completed .step-num::after {
            content: '✓';
        }

        .step-label {
            font-size: 0.85rem;
            color: var(--text-tertiary);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .step-item.active .step-label {
            color: var(--text-primary);
        }

        .step-item.completed .step-label {
            color: var(--success);
        }

        .step-line {
            width: 80px;
            height: 3px;
            background: var(--border-primary);
            margin-bottom: 24px;
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .step-line.completed {
            background: var(--success);
        }

        /* Card */
        .register-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-2xl);
            overflow: hidden;
        }

        .card-header {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-6);
            background: var(--bg-tertiary);
            border-bottom: 1px solid var(--border-primary);
        }

        .header-icon {
            width: 56px;
            height: 56px;
            background: var(--gradient-accent);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
        }

        .header-text h1 {
            font-size: 1.35rem;
            margin-bottom: var(--space-1);
        }

        .header-text p {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin: 0;
        }

        /* Alert */
        .register-alert {
            display: flex;
            gap: var(--space-3);
            margin: var(--space-5);
            padding: var(--space-4);
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: var(--radius-lg);
            color: var(--danger);
        }

        .register-alert ul {
            margin: var(--space-2) 0 0;
            padding-left: var(--space-5);
        }

        .register-alert li {
            font-size: 0.85rem;
        }

        /* Form */
        .register-form {
            padding: var(--space-6);
        }

        .form-step {
            display: none;
            animation: fadeIn 0.4s ease;
        }

        .form-step.active {
            display: block;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateX(20px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .form-section {
            margin-bottom: var(--space-6);
        }

        .form-section h3 {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: 1.1rem;
            margin-bottom: var(--space-5);
            padding-bottom: var(--space-3);
            border-bottom: 1px solid var(--border-primary);
        }

        .form-section h3 i {
            color: var(--success);
        }

        .form-field {
            margin-bottom: var(--space-4);
        }

        .form-field label {
            display: block;
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: var(--space-2);
        }

        .required {
            color: var(--danger);
        }

        .form-field input,
        .form-field select,
        .form-field textarea {
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

        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus {
            border-color: var(--success);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-field input.error,
        .form-field select.error,
        .form-field textarea.error {
            border-color: var(--danger);
            box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: var(--space-4);
        }

        /* Upload Grid */
        .upload-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--space-4);
        }

        .upload-label {
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: var(--space-2);
            padding: var(--space-5);
            background: var(--bg-tertiary);
            border: 2px dashed var(--border-primary);
            border-radius: var(--radius-lg);
            cursor: pointer;
            transition: all 0.3s ease;
            text-align: center;
        }

        .upload-label:hover {
            border-color: var(--success);
            background: rgba(16, 185, 129, 0.05);
        }

        .upload-label.selected {
            border-color: var(--success);
            border-style: solid;
            background: rgba(16, 185, 129, 0.1);
        }

        .upload-label i {
            font-size: 1.75rem;
            color: var(--text-tertiary);
            transition: all 0.3s ease;
        }

        .upload-label.selected i {
            color: var(--success);
        }

        .upload-label span {
            font-size: 0.9rem;
            font-weight: 500;
        }

        .upload-label small {
            font-size: 0.75rem;
            color: var(--text-tertiary);
        }

        .upload-label .file-name {
            color: var(--success);
            font-weight: 500;
            word-break: break-all;
            max-width: 100%;
        }

        .upload-label.error {
            border-color: var(--danger);
        }

        /* Agreement */
        .agreement-section {
            margin-bottom: var(--space-6);
            padding: var(--space-4);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
        }

        .checkbox-wrapper {
            display: flex;
            align-items: flex-start;
            gap: var(--space-3);
            cursor: pointer;
            font-size: 0.9rem;
            color: var(--text-secondary);
        }

        .checkbox-wrapper input {
            display: none;
        }

        .checkmark {
            width: 22px;
            height: 22px;
            border: 2px solid var(--border-primary);
            border-radius: 6px;
            flex-shrink: 0;
            margin-top: 2px;
            transition: all 0.2s ease;
        }

        .checkbox-wrapper input:checked+.checkmark {
            background: var(--gradient-primary);
            border-color: transparent;
        }

        .checkbox-wrapper input:checked+.checkmark::after {
            content: '✓';
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.75rem;
            height: 100%;
        }

        /* Step Buttons */
        .step-buttons {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: var(--space-4);
            border-top: 1px solid var(--border-primary);
            margin-top: var(--space-4);
        }

        .btn-prev,
        .btn-next {
            padding: var(--space-3) var(--space-5);
            border: none;
            border-radius: var(--radius-lg);
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: var(--space-2);
            transition: all 0.3s ease;
        }

        .btn-prev {
            background: var(--bg-tertiary);
            color: var(--text-secondary);
            border: 1px solid var(--border-primary);
        }

        .btn-prev:hover {
            background: var(--bg-secondary);
            color: var(--text-primary);
        }

        .btn-next {
            background: var(--gradient-accent);
            color: white;
        }

        .btn-next:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(139, 92, 246, 0.3);
        }

        /* Submit */
        .btn-submit {
            padding: var(--space-4) var(--space-6);
            background: var(--gradient-accent);
            border: none;
            border-radius: var(--radius-lg);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            gap: var(--space-3);
            transition: all 0.3s ease;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(139, 92, 246, 0.3);
        }

        .btn-submit:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        /* Footer */
        .card-footer {
            padding: var(--space-5);
            background: var(--bg-tertiary);
            border-top: 1px solid var(--border-primary);
            text-align: center;
        }

        .card-footer p {
            font-size: 0.9rem;
            color: var(--text-secondary);
            margin: var(--space-2) 0;
        }

        .card-footer a {
            color: var(--success);
            font-weight: 500;
        }

        /* Back Link */
        .back-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: var(--space-2);
            margin-top: var(--space-6);
            color: var(--text-tertiary);
            font-size: 0.9rem;
        }

        .back-link:hover {
            color: var(--success);
        }

        /* Validation Message */
        .validation-msg {
            font-size: 0.8rem;
            color: var(--danger);
            margin-top: var(--space-1);
        }

        /* Responsive */
        @media (max-width: 768px) {

            .form-row,
            .upload-grid {
                grid-template-columns: 1fr;
            }

            .step-line {
                width: 40px;
            }

            .step-label {
                font-size: 0.75rem;
            }
        }
    </style>

    <script>
        let currentStep = 1;
        const totalSteps = 3;

        const stepDescriptions = {
            1: 'Langkah 1: Isi informasi akun Anda',
            2: 'Langkah 2: Masukkan keahlian Anda',
            3: 'Langkah 3: Upload dokumen verifikasi'
        };

        // Theme Toggle
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

        // Validate Step 1
        function validateStep1() {
            let isValid = true;
            const name = document.getElementById('name');
            const email = document.getElementById('email');
            const password = document.getElementById('password');
            const passwordConfirm = document.getElementById('password_confirmation');

            // Clear previous errors
            [name, email, password, passwordConfirm].forEach(el => el.classList.remove('error'));

            if (!name.value.trim()) {
                name.classList.add('error');
                isValid = false;
            }

            if (!email.value.trim() || !email.value.includes('@')) {
                email.classList.add('error');
                isValid = false;
            }

            if (!password.value || password.value.length < 6) {
                password.classList.add('error');
                isValid = false;
            }

            if (password.value !== passwordConfirm.value) {
                passwordConfirm.classList.add('error');
                isValid = false;
            }

            if (!isValid) {
                showNotification('Mohon lengkapi semua field dengan benar', 'error');
            }

            return isValid;
        }

        // Validate Step 2
        function validateStep2() {
            let isValid = true;
            const kategori = document.getElementById('kategori');
            const deskripsi = document.getElementById('deskripsi');

            [kategori, deskripsi].forEach(el => el.classList.remove('error'));

            if (!kategori.value) {
                kategori.classList.add('error');
                isValid = false;
            }

            if (!deskripsi.value.trim()) {
                deskripsi.classList.add('error');
                isValid = false;
            }

            if (!isValid) {
                showNotification('Mohon lengkapi kategori dan deskripsi keahlian', 'error');
            }

            return isValid;
        }

        // Validate Step 3
        function validateStep3() {
            let isValid = true;
            const fotoktp = document.getElementById('fotoktp');
            const fotoprofil = document.getElementById('fotoprofil');
            const fotohasilkerja = document.getElementById('fotohasilkerja');
            const verifikasi = document.getElementById('verifikasi');

            // Clear previous errors
            document.querySelectorAll('.upload-label').forEach(el => el.classList.remove('error'));

            if (!fotoktp.files.length) {
                document.getElementById('label-fotoktp').classList.add('error');
                isValid = false;
            }

            if (!fotoprofil.files.length) {
                document.getElementById('label-fotoprofil').classList.add('error');
                isValid = false;
            }

            if (!fotohasilkerja.files.length) {
                document.getElementById('label-fotohasilkerja').classList.add('error');
                isValid = false;
            }

            if (!verifikasi.checked) {
                showNotification('Anda harus menyetujui proses verifikasi', 'error');
                isValid = false;
            }

            if (!isValid && verifikasi.checked) {
                showNotification('Mohon upload semua dokumen yang diperlukan', 'error');
            }

            return isValid;
        }

        function nextStep(step) {
            // Validate current step
            if (step === 1 && !validateStep1()) return;
            if (step === 2 && !validateStep2()) return;

            // Mark current step as completed
            document.querySelector(`.step-item[data-step="${step}"]`).classList.remove('active');
            document.querySelector(`.step-item[data-step="${step}"]`).classList.add('completed');
            document.querySelector(`.step-line[data-line="${step}"]`).classList.add('completed');

            // Show next step
            document.getElementById(`step-${step}`).classList.remove('active');
            document.getElementById(`step-${step + 1}`).classList.add('active');
            document.querySelector(`.step-item[data-step="${step + 1}"]`).classList.add('active');

            // Update description
            document.getElementById('step-description').textContent = stepDescriptions[step + 1];

            currentStep = step + 1;

            // Scroll to top of form
            document.querySelector('.register-card').scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function prevStep(step) {
            // Update indicators
            document.querySelector(`.step-item[data-step="${step}"]`).classList.remove('active');
            document.querySelector(`.step-item[data-step="${step - 1}"]`).classList.remove('completed');
            document.querySelector(`.step-item[data-step="${step - 1}"]`).classList.add('active');
            document.querySelector(`.step-line[data-line="${step - 1}"]`).classList.remove('completed');

            // Show previous step
            document.getElementById(`step-${step}`).classList.remove('active');
            document.getElementById(`step-${step - 1}`).classList.add('active');

            // Update description
            document.getElementById('step-description').textContent = stepDescriptions[step - 1];

            currentStep = step - 1;
        }

        // File upload visual feedback
        document.querySelectorAll('.upload-item input').forEach(input => {
            input.addEventListener('change', function () {
                const label = this.nextElementSibling;
                if (this.files.length > 0) {
                    label.classList.add('selected');
                    label.classList.remove('error');
                    const fileName = this.files[0].name;
                    label.querySelector('.file-name').textContent = fileName.length > 20 ? fileName.substring(0, 17) + '...' : fileName;
                } else {
                    label.classList.remove('selected');
                    label.querySelector('.file-name').textContent = '';
                }
            });
        });

        // Form submission validation
        document.getElementById('registerForm').addEventListener('submit', function (e) {
            if (!validateStep3()) {
                e.preventDefault();
            }
        });

        // Show notification
        function showNotification(message, type = 'error') {
            // Remove existing notification
            const existing = document.querySelector('.toast-notification');
            if (existing) existing.remove();

            const toast = document.createElement('div');
            toast.className = `toast-notification ${type}`;
            toast.innerHTML = `
        <i class="fas fa-${type === 'error' ? 'exclamation-circle' : 'check-circle'}"></i>
        <span>${message}</span>
    `;
            document.body.appendChild(toast);

            setTimeout(() => toast.classList.add('show'), 100);
            setTimeout(() => {
                toast.classList.remove('show');
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // Add toast notification styles
        const style = document.createElement('style');
        style.textContent = `
    .toast-notification {
        position: fixed;
        bottom: 20px;
        right: 20px;
        padding: 16px 24px;
        background: var(--bg-card);
        border: 1px solid var(--border-primary);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        gap: 12px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
        transform: translateY(100px);
        opacity: 0;
        transition: all 0.3s ease;
        z-index: 9999;
    }
    .toast-notification.show {
        transform: translateY(0);
        opacity: 1;
    }
    .toast-notification.error {
        border-color: var(--danger);
    }
    .toast-notification.error i {
        color: var(--danger);
    }
    .toast-notification.success {
        border-color: var(--success);
    }
    .toast-notification.success i {
        color: var(--success);
    }
`;
        document.head.appendChild(style);
    </script>
</body>

</html>