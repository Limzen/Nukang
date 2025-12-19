@extends('app')

@section('content')
<link href="{{ asset('/css/modern.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="form-container">
    <div class="form-card">
        {{-- Form Header --}}
        <div class="form-header">
            <div class="header-icon">
                <i class="fas fa-plus-circle"></i>
            </div>
            <div class="header-text">
                <h2>Tambah Kategori Tukang</h2>
                <p>Tambahkan kategori tukang baru ke dalam sistem</p>
            </div>
        </div>

        {{-- Form Body --}}
        <div class="form-body">
            {{-- Form --}}
            <form class="premium-form" role="form" method="POST" action="{{ url('datakategoritukang') }}" enctype="multipart/form-data">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                <div class="form-group">
                    <label for="kategoritukang" class="form-label">
                        <i class="fas fa-tag"></i>
                        <span>Kategori Tukang</span>
                        <span class="required">*</span>
                    </label>
                    <div class="input-wrapper">
                        <textarea 
                            class="form-control" 
                            id="kategoritukang"
                            name="kategoritukang" 
                            rows="4"
                            placeholder="Masukkan nama kategori tukang..."
                            required
                        ></textarea>
                        <div class="input-border"></div>
                    </div>
                    <div class="form-hint">
                        <i class="fas fa-info-circle"></i>
                        <span>Contoh: Tukang Bangunan, Tukang Listrik, Tukang Cat, dll.</span>
                    </div>
                </div>

                <div class="form-actions">
                    <a href="{{ url('datakategoritukang') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        <span>Kembali</span>
                    </a>
                    <button type="submit" name="store_btn" class="btn btn-primary">
                        <i class="fas fa-save"></i>
                        <span>Simpan Kategori</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Form Container */
.form-container {
    max-width: 800px;
    margin: 0 auto;
    padding: var(--space-8);
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    justify-content: center;
}

/* Form Card */
.form-card {
    width: 100%;
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-2xl);
    overflow: hidden;
    box-shadow: var(--shadow-lg);
    transition: all var(--transition-base);
}

.form-card:hover {
    box-shadow: var(--shadow-xl), var(--shadow-glow);
}

/* Form Header */
.form-header {
    padding: var(--space-8);
    background: var(--bg-tertiary);
    border-bottom: 1px solid var(--border-primary);
    display: flex;
    align-items: center;
    gap: var(--space-4);
    position: relative;
    overflow: hidden;
}

.form-header::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.05) 0%, transparent 50%);
    pointer-events: none;
}

.header-icon {
    width: 64px;
    height: 64px;
    background: var(--gradient-primary);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2rem;
    color: white;
    flex-shrink: 0;
    box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-8px); }
}

.header-text {
    flex: 1;
    position: relative;
    z-index: 1;
}

.header-text h2 {
    font-size: 1.75rem;
    margin-bottom: var(--space-2);
    background: var(--gradient-primary);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

.header-text p {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin: 0;
}

/* Form Body */
.form-body {
    padding: var(--space-8);
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

/* Premium Form */
.premium-form {
    display: flex;
    flex-direction: column;
    gap: var(--space-6);
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
}

.form-label {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.9rem;
    font-weight: 600;
    color: var(--text-primary);
}

.form-label i {
    color: var(--success);
    font-size: 0.875rem;
}

.form-label .required {
    color: var(--danger);
    font-weight: 700;
    margin-left: 2px;
}

/* Input Wrapper with animated border */
.input-wrapper {
    position: relative;
}

.form-control {
    width: 100%;
    padding: var(--space-4);
    font-family: var(--font-body);
    font-size: 1rem;
    color: var(--text-primary);
    background: var(--bg-tertiary);
    border: 2px solid var(--border-primary);
    border-radius: var(--radius-lg);
    outline: none;
    transition: all var(--transition-fast);
    resize: vertical;
    min-height: 120px;
}

.form-control::placeholder {
    color: var(--text-tertiary);
}

.form-control:hover {
    border-color: var(--border-hover);
}

.form-control:focus {
    border-color: transparent;
    background: var(--bg-secondary);
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
}

/* Animated border effect */
.input-border {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 0;
    height: 3px;
    background: var(--gradient-primary);
    border-radius: 2px;
    transition: width 0.4s ease;
}

.form-control:focus ~ .input-border {
    width: 100%;
}

/* Form Hint */
.form-hint {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.8rem;
    color: var(--text-tertiary);
    padding-left: var(--space-2);
}

.form-hint i {
    font-size: 0.75rem;
    color: var(--info);
}

/* Form Actions */
.form-actions {
    display: flex;
    gap: var(--space-4);
    margin-top: var(--space-6);
    padding-top: var(--space-6);
    border-top: 1px solid var(--border-primary);
}

.form-actions .btn {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    padding: var(--space-4) var(--space-6);
    font-size: 1rem;
    font-weight: 600;
    border-radius: var(--radius-lg);
    border: none;
    cursor: pointer;
    transition: all var(--transition-base);
    text-decoration: none;
    position: relative;
    overflow: hidden;
}

.form-actions .btn::before {
    content: '';
    position: absolute;
    inset: 0;
    background: inherit;
    filter: brightness(1.15);
    opacity: 0;
    transition: opacity var(--transition-fast);
}

.form-actions .btn:hover::before {
    opacity: 1;
}

.form-actions .btn:active {
    transform: scale(0.98);
}

.btn-primary {
    background: var(--gradient-primary);
    color: white;
    box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
    color: white;
}

.btn-secondary {
    background: var(--bg-tertiary);
    color: var(--text-primary);
    border: 2px solid var(--border-primary);
}

.btn-secondary:hover {
    background: var(--bg-glass-hover);
    border-color: var(--border-hover);
    transform: translateY(-2px);
    color: var(--text-primary);
}

/* Responsive */
@media (max-width: 768px) {
    .form-container {
        padding: var(--space-4);
    }

    .form-header {
        flex-direction: column;
        text-align: center;
    }

    .form-body {
        padding: var(--space-6);
    }

    .header-text h2 {
        font-size: 1.5rem;
    }

    .form-actions {
        flex-direction: column-reverse;
    }

    .form-actions .btn {
        width: 100%;
    }
}

/* Animations */
.animate-slideIn {
    animation: slideIn 0.4s ease-out;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Loading state for button */
.btn:disabled {
    opacity: 0.6;
    cursor: not-allowed;
    transform: none !important;
}

.btn:disabled::before {
    display: none;
}
</style>
@endsection