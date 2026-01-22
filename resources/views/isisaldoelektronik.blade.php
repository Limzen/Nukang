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
    <input type="text" name="nomorrekeninganda" 
           value="{{ Auth::user()->nomorrekening }}" required>

    <!-- Pesan error -->
    <small id="rekeningError" style="color:red; display:none;">
        Nomor rekening hanya boleh berisi angka
    </small>
</div>
                            <div class="form-field">
                                <label><i class="fas fa-user"></i> Nama Pemilik</label>
                                <input type="text" name="namapemilik" value="{{ Auth::user()->namapelanggan }}" required>
                            </div>
                        </div>

                        <div class="form-field">
                            <label><i class="fas fa-building"></i> Transfer ke Rekening Tujuan</label>
                            <p class="field-hint">Pilih salah satu rekening tujuan transfer</p>
                            <div class="bank-options">
                                <label class="bank-option">
                                    <input type="radio" name="nomorrekening" value="BCA - 8305123456" checked>
                                    <div class="bank-card bank-bca">
                                        <div class="bank-card-content">
                                            <div class="bank-header">
                                                <div class="bank-logo-wrapper">
                                                    <div class="bank-logo">
                                                        <span class="bank-logo-text">BCA</span>
                                                    </div>
                                                    <div class="bank-info">
                                                        <span class="bank-name">Bank Central Asia</span>
                                                        <span class="bank-label">Rekening Tujuan 1</span>
                                                    </div>
                                                </div>
                                                <div class="bank-check-wrapper">
                                                    <i class="fas fa-check-circle bank-check"></i>
                                                </div>
                                            </div>
                                            <div class="bank-details">
                                                <div class="bank-number-group">
                                                    <span class="bank-number-label">Nomor Rekening</span>
                                                    <span class="bank-number">
                                                        <span class="number-display">8305123456</span>
                                                        <button type="button" class="btn-copy"
                                                            onclick="copyAccount('8305123456', this)"
                                                            title="Copy nomor rekening">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="bank-holder-group">
                                                    <span class="bank-holder-label">Atas Nama</span>
                                                    <span class="bank-holder">PT. Nukang Indonesia</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bank-pattern"></div>
                                    </div>
                                </label>
                                <label class="bank-option">
                                    <input type="radio" name="nomorrekening" value="Mandiri - 123456789011">
                                    <div class="bank-card bank-mandiri">
                                        <div class="bank-card-content">
                                            <div class="bank-header">
                                                <div class="bank-logo-wrapper">
                                                    <div class="bank-logo">
                                                        <span class="bank-logo-text">Mandiri</span>
                                                    </div>
                                                    <div class="bank-info">
                                                        <span class="bank-name">Bank Mandiri</span>
                                                        <span class="bank-label">Rekening Tujuan 2</span>
                                                    </div>
                                                </div>
                                                <div class="bank-check-wrapper">
                                                    <i class="fas fa-check-circle bank-check"></i>
                                                </div>
                                            </div>
                                            <div class="bank-details">
                                                <div class="bank-number-group">
                                                    <span class="bank-number-label">Nomor Rekening</span>
                                                    <span class="bank-number">
                                                        <span class="number-display">123456789011</span>
                                                        <button type="button" class="btn-copy"
                                                            onclick="copyAccount('123456789011', this)"
                                                            title="Copy nomor rekening">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="bank-holder-group">
                                                    <span class="bank-holder-label">Atas Nama</span>
                                                    <span class="bank-holder">PT. Nukang Indonesia</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bank-pattern"></div>
                                    </div>
                                </label>
                                <label class="bank-option">
                                    <input type="radio" name="nomorrekening" value="BRI - 445566778888000">
                                    <div class="bank-card bank-bri">
                                        <div class="bank-card-content">
                                            <div class="bank-header">
                                                <div class="bank-logo-wrapper">
                                                    <div class="bank-logo">
                                                        <span class="bank-logo-text">BRI</span>
                                                    </div>
                                                    <div class="bank-info">
                                                        <span class="bank-name">Bank Rakyat Indonesia</span>
                                                        <span class="bank-label">Rekening Tujuan 3</span>
                                                    </div>
                                                </div>
                                                <div class="bank-check-wrapper">
                                                    <i class="fas fa-check-circle bank-check"></i>
                                                </div>
                                            </div>
                                            <div class="bank-details">
                                                <div class="bank-number-group">
                                                    <span class="bank-number-label">Nomor Rekening</span>
                                                    <span class="bank-number">
                                                        <span class="number-display">445566778888000</span>
                                                        <button type="button" class="btn-copy"
                                                            onclick="copyAccount('445566778888000', this)"
                                                            title="Copy nomor rekening">
                                                            <i class="fas fa-copy"></i>
                                                        </button>
                                                    </span>
                                                </div>
                                                <div class="bank-holder-group">
                                                    <span class="bank-holder-label">Atas Nama</span>
                                                    <span class="bank-holder">PT. Nukang Indonesia</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="bank-pattern"></div>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="form-field">
    <label><i class="fas fa-image"></i> Upload Bukti Transfer</label>
    <div class="upload-area" id="uploadArea">
        <div class="upload-icon"><i class="fas fa-cloud-upload-alt"></i></div>
        <p>Klik atau drop file disini</p>
        <span>JPG, PNG max 2MB</span>
        <input type="file" name="buktitransfer" accept="image/*" required
            onchange="handleUpload(this)">
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
                        <p>Pastikan nominal transfer sesuai dengan jumlah yang diinputkan untuk mempercepat proses
                            verifikasi.</p>
                    </div>
                </div>
            </div>

            {{-- Transaction History Section --}}
            @if(isset($riwayatTopup) && count($riwayatTopup) > 0)
                <div class="history-section animate-fadeIn stagger-2">
                    <div class="history-header">
                        <h3><i class="fas fa-history"></i> Riwayat Pengisian Saldo</h3>
                        <span class="history-count">{{ count($riwayatTopup) }} transaksi</span>
                    </div>
                    <div class="history-list">
                        @foreach($riwayatTopup as $trans)
                            <div class="history-item">
                                <div class="history-icon 
                                                    @if($trans->statustransaksi == '0') status-pending
                                                    @elseif($trans->statustransaksi == '1') status-success
                                                    @else status-rejected @endif">
                                    @if($trans->statustransaksi == '0')
                                        <i class="fas fa-clock"></i>
                                    @elseif($trans->statustransaksi == '1')
                                        <i class="fas fa-check"></i>
                                    @else
                                        <i class="fas fa-times"></i>
                                    @endif
                                </div>
                                <div class="history-content">
                                    <div class="history-info">
                                        <h4>Top Up Saldo</h4>
                                        <span
                                            class="history-date">{{ \Carbon\Carbon::parse($trans->created_at)->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="history-meta">
                                        <span class="history-code">{{ $trans->kode }}</span>
                                        <span class="history-bank">{{ $trans->rekeningtujuan }}</span>
                                    </div>
                                </div>
                                <div class="history-amount-status">
                                    <span class="history-amount">Rp {{ number_format($trans->jumlahsaldo, 0, ',', '.') }}</span>
                                    <span class="history-status 
                                                        @if($trans->statustransaksi == '0') badge-pending
                                                        @elseif($trans->statustransaksi == '1') badge-success
                                                        @else badge-rejected @endif">
                                        @if($trans->statustransaksi == '0')
                                            Menunggu Konfirmasi
                                        @elseif($trans->statustransaksi == '1')
                                            Berhasil
                                        @else
                                            Ditolak
                                        @endif
                                    </span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
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
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
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
            grid-template-columns: repeat(3, 1fr);
            gap: var(--space-4);
        }

        .bank-option {
            position: relative;
        }

        .bank-option input {
            display: none;
        }

        .bank-card {
            position: relative;
            display: block;
            padding: var(--space-6);
            background: var(--bg-tertiary);
            border: 2px solid var(--border-primary);
            border-radius: var(--radius-xl);
            cursor: pointer;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            min-height: 240px;
            height: 100%;
        }

        .bank-card-content {
            position: relative;
            z-index: 2;
        }

        .bank-pattern {
            position: absolute;
            top: 0;
            right: 0;
            width: 200px;
            height: 200px;
            opacity: 0.08;
            pointer-events: none;
            transition: opacity 0.3s ease;
        }

        .bank-bca .bank-pattern {
            background: radial-gradient(circle at center, #005faa 0%, transparent 70%);
        }

        .bank-mandiri .bank-pattern {
            background: radial-gradient(circle at center, #ffb500 0%, transparent 70%);
        }

        .bank-bri .bank-pattern {
            background: radial-gradient(circle at center, #0066cc 0%, transparent 70%);
        }

        .bank-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
            border-color: var(--text-tertiary);
        }

        .bank-card:hover .bank-pattern {
            opacity: 0.12;
        }

        .bank-option input:checked+.bank-card {
            border-color: var(--success);
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.03) 0%, rgba(16, 185, 129, 0.08) 100%);
            box-shadow: 0 8px 24px rgba(16, 185, 129, 0.25);
        }

        .bank-option input:checked+.bank-card .bank-pattern {
            opacity: 0.15;
        }

        .bank-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--space-5);
        }

        .bank-logo-wrapper {
            display: flex;
            align-items: center;
            gap: var(--space-4);
        }

        .bank-logo {
            width: 64px;
            height: 48px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            flex-shrink: 0;
        }

        .bank-bca .bank-logo {
            background: linear-gradient(135deg, #005faa 0%, #003d6b 100%);
        }

        .bank-mandiri .bank-logo {
            background: linear-gradient(135deg, #ffb500 0%, #d89600 100%);
        }

        .bank-bri .bank-logo {
            background: linear-gradient(135deg, #0066cc 0%, #004499 100%);
        }

        .bank-logo-text {
            color: white;
            font-size: 0.95rem;
            font-weight: 700;
            letter-spacing: 0.5px;
        }

        .bank-info {
            display: flex;
            flex-direction: column;
            gap: var(--space-1);
        }

        .bank-name {
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .bank-label {
            font-size: 0.75rem;
            color: var(--text-tertiary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .bank-check-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .bank-check {
            font-size: 1.5rem;
            color: var(--text-tertiary);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .bank-option input:checked+.bank-card .bank-check {
            color: var(--success);
            transform: scale(1.2);
        }

        .bank-details {
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
            padding-top: var(--space-4);
            border-top: 1px solid var(--border-primary);
        }

        .bank-number-group,
        .bank-holder-group {
            display: flex;
            flex-direction: column;
            gap: var(--space-2);
        }

        .bank-number-label,
        .bank-holder-label {
            font-size: 0.75rem;
            color: var(--text-tertiary);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 500;
        }

        .bank-number {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: var(--space-3);
        }

        .number-display {
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--text-primary);
            font-family: 'Courier New', monospace;
            letter-spacing: 1px;
        }

        .bank-holder {
            font-size: 0.95rem;
            color: var(--text-secondary);
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .btn-copy {
            padding: var(--space-2) var(--space-3);
            background: var(--bg-secondary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-md);
            color: var(--text-tertiary);
            cursor: pointer;
            transition: all 0.2s ease;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .btn-copy:hover {
            background: var(--success);
            color: white;
            border-color: var(--success);
            transform: translateY(-1px);
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

        /* History Section */
        .history-section {
            margin-top: var(--space-8);
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            overflow: hidden;
        }

        .history-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-5);
            background: var(--bg-tertiary);
            border-bottom: 1px solid var(--border-primary);
        }

        .history-header h3 {
            display: flex;
            align-items: center;
            gap: var(--space-3);
            font-size: 1.1rem;
            margin: 0;
        }

        .history-header h3 i {
            color: var(--success);
        }

        .history-count {
            background: var(--bg-secondary);
            padding: var(--space-2) var(--space-4);
            border-radius: var(--radius-full);
            font-size: 0.8rem;
            color: var(--text-secondary);
        }

        .history-list {
            padding: var(--space-4);
        }

        .history-item {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-4);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
            margin-bottom: var(--space-3);
            transition: all 0.3s ease;
        }

        .history-item:last-child {
            margin-bottom: 0;
        }

        .history-item:hover {
            transform: translateX(4px);
        }

        .history-icon {
            width: 44px;
            height: 44px;
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .history-icon.status-pending {
            background: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
        }

        .history-icon.status-success {
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
        }

        .history-icon.status-rejected {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }

        .history-content {
            flex: 1;
            min-width: 0;
        }

        .history-info {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--space-1);
        }

        .history-info h4 {
            font-size: 0.95rem;
            margin: 0;
        }

        .history-date {
            font-size: 0.8rem;
            color: var(--text-tertiary);
        }

        .history-meta {
            display: flex;
            gap: var(--space-3);
        }

        .history-code {
            font-size: 0.8rem;
            color: var(--text-tertiary);
            font-family: monospace;
        }

        .history-bank {
            font-size: 0.8rem;
            color: var(--text-tertiary);
        }

        .history-amount-status {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            gap: var(--space-2);
        }

        .history-amount {
            font-family: var(--font-display);
            font-size: 1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .history-status {
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
            font-size: 0.75rem;
            font-weight: 500;
        }

        .badge-pending {
            background: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
        }

        .badge-success {
            background: rgba(16, 185, 129, 0.15);
            color: var(--success);
        }

        .badge-rejected {
            background: rgba(239, 68, 68, 0.15);
            color: #ef4444;
        }

        /* Stagger */
        .stagger-1 {
            animation-delay: 0.1s;
        }

        .stagger-2 {
            animation-delay: 0.2s;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .topup-grid {
                grid-template-columns: 1fr;
            }

            .info-card {
                position: static;
            }

            .bank-options {
                grid-template-columns: 1fr;
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

            .bank-logo-wrapper {
                gap: var(--space-3);
            }

            .bank-logo {
                width: 56px;
                height: 42px;
            }

            .bank-name {
                font-size: 0.9rem;
            }

            .number-display {
                font-size: 1rem;
            }
        }
    </style>

    <script>
    // Set quick amount
    function setAmount(amount) {
        document.querySelector('input[name="jumlahsaldouser"]').value = amount;
    }

    // Handle file upload dengan validasi
    function handleUpload(input) {
        const file = input.files[0];
        if (!file) return;
        
        // Validasi tipe file
        const allowedTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        if (!allowedTypes.includes(file.type)) {
            alert('Format file tidak valid! Hanya JPG/PNG yang diperbolehkan');
            input.value = '';
            return;
        }
        
        // Validasi ukuran (2MB = 2 * 1024 * 1024 bytes)
        const maxSize = 2 * 1024 * 1024;
        if (file.size > maxSize) {
            alert('Ukuran file terlalu besar! Maksimal 2MB');
            input.value = '';
            return;
        }
        
        // Preview image
        const preview = document.getElementById('uploadPreview');
        const reader = new FileReader();
        
        reader.onload = function(e) {
            preview.innerHTML = `
                <div style="position:relative;display:inline-block;margin-top:10px;">
                    <img src="${e.target.result}" style="max-width:200px;border-radius:8px;border:2px solid #10b981;">
                    <button type="button" onclick="removeUpload()" 
                        style="position:absolute;top:-8px;right:-8px;background:#ef4444;color:#fff;border:none;border-radius:50%;width:28px;height:28px;cursor:pointer;font-size:18px;line-height:1;">
                        ×
                    </button>
                </div>
            `;
        };
        
        reader.readAsDataURL(file);
    }

    // Remove upload preview
    function removeUpload() {
        document.querySelector('input[name="buktitransfer"]').value = '';
        document.getElementById('uploadPreview').innerHTML = '';
    }

    // Copy account number
    function copyAccount(accountNumber, button) {
        navigator.clipboard.writeText(accountNumber).then(() => {
            button.classList.add('copied');
            setTimeout(() => {
                button.classList.remove('copied');
            }, 2000);
        }).catch(err => {
            console.error('Failed to copy:', err);
        });
    }

    // ===================================
    // VALIDASI INPUT NOMOR REKENING
    // ===================================
    document.addEventListener('DOMContentLoaded', function() {
    const nomorRekeningInput = document.querySelector('input[name="nomorrekeninganda"]');
    const errorMessage = document.getElementById('rekeningError');

    if (nomorRekeningInput) {

        nomorRekeningInput.addEventListener('input', function () {
            const originalValue = this.value;
            const filteredValue = originalValue.replace(/[^0-9]/g, '');

            errorMessage.style.display = 
                originalValue !== filteredValue ? 'block' : 'none';

            this.value = filteredValue;
        });

        nomorRekeningInput.addEventListener('paste', function () {
            setTimeout(() => {
                const filteredValue = this.value.replace(/[^0-9]/g, '');

                errorMessage.style.display = 
                    this.value !== filteredValue ? 'block' : 'none';

                this.value = filteredValue;
            }, 0);
        });
    }
});

    </script>
@endsection