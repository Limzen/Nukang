@extends('app')

@section('title', 'Isi Saldo - Nukang')

@section('content')
<div class="topup-page">
    <div class="container">
        {{-- Balance Card --}}
        <div class="balance-card animate-fadeIn">
            <div class="balance-bg">
                <div class="balance-pattern"></div>
            </div>
            <div class="balance-content">
                <div class="balance-info">
                    <span class="balance-label">Saldo Anda</span>
                    <h2 class="balance-amount">Rp {{ number_format(Auth::user()->saldo, 0, ',', '.') }}</h2>
                </div>
                <div class="balance-icon">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>

        {{-- Page Header --}}
        <div class="page-header animate-fadeIn">
            <h1><i class="fas fa-plus-circle"></i> Isi Saldo</h1>
            <p>Top up saldo untuk melakukan transaksi</p>
        </div>

        {{-- Alerts are shown in app.blade.php layout --}}

        <div class="topup-grid">
            {{-- Form Card --}}
            <div class="topup-card animate-fadeIn">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-credit-card"></i>
                    </div>
                    <div class="card-title">
                        <h3>Form Top Up</h3>
                        <p>Isi detail transfer Anda</p>
                    </div>
                </div>
                
                <form method="POST" action="" enctype="multipart/form-data" class="topup-form">
                    @csrf
                    
                    <div class="form-field">
                        <label><i class="fas fa-coins"></i> Jumlah Saldo</label>
                        <div class="amount-input">
                            <span class="currency">Rp</span>
                            <input type="number" name="jumlahsaldouser" placeholder="100000" required>
                        </div>
                        <div class="quick-amounts">
                            <button type="button" onclick="setAmount(50000)">50rb</button>
                            <button type="button" onclick="setAmount(100000)">100rb</button>
                            <button type="button" onclick="setAmount(200000)">200rb</button>
                            <button type="button" onclick="setAmount(500000)">500rb</button>
                        </div>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-field">
                            <label><i class="fas fa-university"></i> Nomor Rekening Anda</label>
                            <input type="text" name="nomorrekeninganda" value="{{ Auth::user()->nomorrekening }}" required>
                        </div>
                        <div class="form-field">
                            <label><i class="fas fa-user"></i> Nama Pemilik</label>
                            <input type="text" name="namapemilik" value="{{ Auth::user()->namapelanggan }}" required>
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label><i class="fas fa-building"></i> Transfer ke Rekening Tujuan</label>
                        <p class="field-hint">Pilih rekening tujuan transfer</p>
                        <div class="bank-options">
                            <label class="bank-option">
                                <input type="radio" name="nomorrekening" value="BCA - 8305123456" checked>
                                <span class="bank-card bank-bca">
                                    <div class="bank-header">
                                        <div class="bank-logo">
                                            <span class="bank-logo-text">BCA</span>
                                        </div>
                                        <i class="fas fa-check-circle bank-check"></i>
                                    </div>
                                    <div class="bank-details">
                                        <span class="bank-number">
                                            8305123456
                                            <button type="button" class="btn-copy" onclick="copyAccount('8305123456', this)" title="Copy nomor rekening">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </span>
                                        <span class="bank-holder">A/N KEVIN LIANG</span>
                                    </div>
                                </span>
                            </label>
                            <label class="bank-option">
                                <input type="radio" name="nomorrekening" value="Mandiri - 123456789011">
                                <span class="bank-card bank-mandiri">
                                    <div class="bank-header">
                                        <div class="bank-logo">
                                            <span class="bank-logo-text">Mandiri</span>
                                        </div>
                                        <i class="fas fa-check-circle bank-check"></i>
                                    </div>
                                    <div class="bank-details">
                                        <span class="bank-number">
                                            123456789011
                                            <button type="button" class="btn-copy" onclick="copyAccount('123456789011', this)" title="Copy nomor rekening">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </span>
                                        <span class="bank-holder">A/N KEVIN LIANG</span>
                                    </div>
                                </span>
                            </label>
                            <label class="bank-option">
                                <input type="radio" name="nomorrekening" value="BRI - 445566778888000">
                                <span class="bank-card bank-bri">
                                    <div class="bank-header">
                                        <div class="bank-logo">
                                            <span class="bank-logo-text">BRI</span>
                                        </div>
                                        <i class="fas fa-check-circle bank-check"></i>
                                    </div>
                                    <div class="bank-details">
                                        <span class="bank-number">
                                            445566778888000
                                            <button type="button" class="btn-copy" onclick="copyAccount('445566778888000', this)" title="Copy nomor rekening">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </span>
                                        <span class="bank-holder">A/N KEVIN LIANG</span>
                                    </div>
                                </span>
                            </label>
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label><i class="fas fa-image"></i> Upload Bukti Transfer</label>
                        <div class="upload-area" id="uploadArea">
                            <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
                            <p>Klik atau drop file disini</p>
                            <span>JPG, PNG max 2MB</span>
                            <input type="file" name="buktitransfer" accept="image/*" required onchange="handleUpload(this)">
                        </div>
                        <div class="upload-preview" id="uploadPreview"></div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        <i class="fas fa-paper-plane"></i> Kirim Permintaan Top Up
                    </button>
                </form>
            </div>
            
            {{-- Info Card --}}
            <div class="info-card animate-fadeIn stagger-1">
                <h4><i class="fas fa-info-circle"></i> Cara Top Up</h4>
                <div class="steps">
                    <div class="step">
                        <div class="step-number">1</div>
                        <div class="step-text">
                            <h5>Masukkan Jumlah</h5>
                            <p>Tentukan jumlah saldo yang ingin diisi</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">2</div>
                        <div class="step-text">
                            <h5>Transfer</h5>
                            <p>Transfer ke salah satu rekening tujuan</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">3</div>
                        <div class="step-text">
                            <h5>Upload Bukti</h5>
                            <p>Upload bukti transfer Anda</p>
                        </div>
                    </div>
                    <div class="step">
                        <div class="step-number">4</div>
                        <div class="step-text">
                            <h5>Verifikasi</h5>
                            <p>Tunggu verifikasi dari admin (max 1x24 jam)</p>
                        </div>
                    </div>
                </div>
                
                <div class="info-note">
                    <i class="fas fa-exclamation-triangle"></i>
                    <p>Pastikan nominal transfer sesuai dengan jumlah yang diinputkan untuk mempercepat proses verifikasi.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.topup-page {
    padding: var(--space-6) 0 var(--space-16);
}

/* Balance Card */
.balance-card {
    position: relative;
    background: var(--gradient-primary);
    border-radius: var(--radius-2xl);
    padding: var(--space-8);
    margin-bottom: var(--space-8);
    overflow: hidden;
}

.balance-bg {
    position: absolute;
    inset: 0;
    overflow: hidden;
}

.balance-pattern {
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(circle at 20% 80%, rgba(255,255,255,0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 20%, rgba(255,255,255,0.1) 0%, transparent 50%);
}

.balance-content {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: space-between;
    color: white;
}

.balance-label {
    display: block;
    font-size: 0.9rem;
    opacity: 0.9;
    margin-bottom: var(--space-2);
}

.balance-amount {
    font-family: var(--font-display);
    font-size: 2.5rem;
    font-weight: 700;
    margin: 0;
    color: white;
}

.balance-icon {
    width: 80px;
    height: 80px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 2.5rem;
    backdrop-filter: blur(10px);
}

/* Page Header */
.page-header {
    text-align: center;
    margin-bottom: var(--space-8);
}

.page-header h1 {
    font-size: 1.75rem;
    margin-bottom: var(--space-2);
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-3);
}

.page-header h1 i {
    color: var(--success);
}

.page-header p {
    color: var(--text-secondary);
}

/* Grid */
.topup-grid {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: var(--space-6);
    align-items: start;
}

/* Form Card */
.topup-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.card-header {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-5);
    background: var(--bg-tertiary);
    border-bottom: 1px solid var(--border-primary);
}

.card-icon {
    width: 48px;
    height: 48px;
    background: var(--gradient-primary);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.card-title h3 {
    font-size: 1.1rem;
    margin-bottom: var(--space-1);
}

.card-title p {
    font-size: 0.85rem;
    color: var(--text-tertiary);
    margin: 0;
}

.topup-form {
    padding: var(--space-6);
}

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
    color: var(--text-tertiary);
}

.field-hint {
    font-size: 0.85rem;
    color: var(--text-tertiary);
    margin: var(--space-1) 0 var(--space-3);
}

.form-field input,
.form-field select {
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
    gap: var(--space-4);
}

/* Amount Input */
.amount-input {
    position: relative;
}

.amount-input .currency {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: var(--text-tertiary);
    font-weight: 600;
}

.amount-input input {
    padding-left: 48px;
    font-size: 1.25rem;
    font-weight: 600;
}

.quick-amounts {
    display: flex;
    gap: var(--space-2);
    margin-top: var(--space-3);
}

.quick-amounts button {
    flex: 1;
    padding: var(--space-2) var(--space-3);
    background: var(--bg-tertiary);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-md);
    color: var(--text-secondary);
    font-size: 0.85rem;
    cursor: pointer;
    transition: all 0.2s ease;
}

.quick-amounts button:hover {
    border-color: var(--success);
    color: var(--success);
}

/* Bank Options */
.bank-options {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: var(--space-4);
}

.bank-option {
    position: relative;
}

.bank-option input {
    display: none;
}

.bank-card {
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
    padding: var(--space-5);
    background: var(--bg-tertiary);
    border: 2px solid var(--border-primary);
    border-radius: var(--radius-xl);
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    min-height: 120px;
}

.bank-card::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 60px;
    height: 60px;
    opacity: 0.1;
    transition: all 0.3s ease;
}

.bank-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.bank-option input:checked + .bank-card {
    border-color: var(--success);
    background: rgba(16, 185, 129, 0.05);
    box-shadow: 0 4px 16px rgba(16, 185, 129, 0.2);
}

/* Bank Brand Colors */
.bank-bca::before {
    background: linear-gradient(135deg, #005faa, #003d6b);
}

.bank-mandiri::before {
    background: linear-gradient(135deg, #ffb500, #d89600);
}

.bank-bri::before {
    background: linear-gradient(135deg, #0066cc, #004499);
}

.bank-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

.bank-logo {
    width: 56px;
    height: 40px;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    position: relative;
    z-index: 1;
}

.bank-bca .bank-logo {
    background: linear-gradient(135deg, #005faa, #003d6b);
}

.bank-mandiri .bank-logo {
    background: linear-gradient(135deg, #ffb500, #d89600);
}

.bank-bri .bank-logo {
    background: linear-gradient(135deg, #0066cc, #004499);
}

.bank-logo-text {
    color: white;
    font-size: 0.85rem;
    font-weight: 700;
    letter-spacing: 0.5px;
}

.bank-check {
    font-size: 1.25rem;
    color: var(--text-tertiary);
    transition: all 0.3s ease;
}

.bank-option input:checked + .bank-card .bank-check {
    color: var(--success);
    transform: scale(1.1);
}

.bank-details {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
    position: relative;
    z-index: 1;
}

.bank-number {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: var(--space-2);
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
    font-family: 'Courier New', monospace;
}

.bank-holder {
    font-size: 0.8rem;
    color: var(--text-tertiary);
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.btn-copy {
    padding: var(--space-1) var(--space-2);
    background: var(--bg-secondary);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-md);
    color: var(--text-tertiary);
    cursor: pointer;
    transition: all 0.2s ease;
    font-size: 0.85rem;
}

.btn-copy:hover {
    background: var(--success);
    color: white;
    border-color: var(--success);
}

.btn-copy.copied {
    background: var(--success);
    color: white;
    border-color: var(--success);
}

.btn-copy.copied i::before {
    content: '\f00c';
}

/* Upload Area */
.upload-area {
    position: relative;
    padding: var(--space-8);
    background: var(--bg-tertiary);
    border: 2px dashed var(--border-primary);
    border-radius: var(--radius-lg);
    text-align: center;
    cursor: pointer;
    transition: all 0.3s ease;
}

.upload-area:hover {
    border-color: var(--success);
}

.upload-area input {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
}

.upload-icon {
    font-size: 2.5rem;
    color: var(--text-tertiary);
    margin-bottom: var(--space-3);
}

.upload-area p {
    color: var(--text-secondary);
    margin-bottom: var(--space-1);
}

.upload-area span {
    font-size: 0.8rem;
    color: var(--text-tertiary);
}

.upload-preview img {
    max-width: 200px;
    margin-top: var(--space-4);
    border-radius: var(--radius-lg);
}

/* Info Card */
.info-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    padding: var(--space-6);
    position: sticky;
    top: 100px;
}

.info-card h4 {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 1.1rem;
    margin-bottom: var(--space-6);
}

.info-card h4 i {
    color: var(--success);
}

/* Steps */
.steps {
    display: flex;
    flex-direction: column;
    gap: var(--space-5);
    margin-bottom: var(--space-6);
}

.step {
    display: flex;
    align-items: flex-start;
    gap: var(--space-4);
}

.step-number {
    width: 32px;
    height: 32px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: 700;
    font-size: 0.9rem;
    flex-shrink: 0;
}

.step-text h5 {
    font-size: 0.95rem;
    margin-bottom: var(--space-1);
}

.step-text p {
    font-size: 0.85rem;
    color: var(--text-tertiary);
    margin: 0;
}

.info-note {
    display: flex;
    align-items: flex-start;
    gap: var(--space-3);
    padding: var(--space-4);
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.3);
    border-radius: var(--radius-lg);
}

.info-note i {
    color: #f59e0b;
    flex-shrink: 0;
    margin-top: 2px;
}

.info-note p {
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin: 0;
}

/* Stagger */
.stagger-1 { animation-delay: 0.1s; }

/* Responsive */
@media (max-width: 992px) {
    .topup-grid {
        grid-template-columns: 1fr;
    }
    
    .info-card {
        position: static;
    }
}

@media (max-width: 576px) {
    .balance-amount {
        font-size: 1.75rem;
    }
    
    .balance-icon {
        width: 60px;
        height: 60px;
        font-size: 1.75rem;
    }
    
    .form-row {
        grid-template-columns: 1fr;
    }
    
    .bank-options {
        flex-direction: column;
    }
    
    .bank-option {
        min-width: 100%;
    }
}
</style>

<script>
function setAmount(amount) {
    document.querySelector('input[name="jumlahsaldouser"]').value = amount;
}

function handleUpload(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('uploadPreview').innerHTML = 
                `<img src="${e.target.result}" alt="Preview">`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

function copyAccount(accountNumber, button) {
    // Copy to clipboard
    navigator.clipboard.writeText(accountNumber).then(() => {
        // Visual feedback
        button.classList.add('copied');
        setTimeout(() => {
            button.classList.remove('copied');
        }, 2000);
    }).catch(err => {
        console.error('Failed to copy:', err);
    });
}
</script>
@endsection
