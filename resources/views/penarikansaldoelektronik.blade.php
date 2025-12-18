@extends('app')

@section('title', 'Penarikan Saldo - Nukang')

@section('content')
<div class="withdraw-page">
    <div class="container">
        {{-- Balance Card --}}
        <div class="balance-card animate-fadeIn">
            <div class="balance-bg">
                <div class="balance-pattern"></div>
            </div>
            <div class="balance-content">
                <div class="balance-info">
                    <span class="balance-label">Saldo Tersedia</span>
                    <h2 class="balance-amount">Rp {{ number_format(Auth::user()->saldo, 0, ',', '.') }}</h2>
                </div>
                <div class="balance-icon">
                    <i class="fas fa-wallet"></i>
                </div>
            </div>
        </div>

        {{-- Page Header --}}
        <div class="page-header animate-fadeIn">
            <h1><i class="fas fa-money-bill-wave"></i> Penarikan Saldo</h1>
            <p>Cairkan saldo ke rekening bank Anda</p>
        </div>

        {{-- Info Note --}}
        <div class="withdraw-note animate-fadeIn">
            <div class="note-icon">
                <i class="fas fa-info-circle"></i>
            </div>
            <div class="note-content">
                <h4>Informasi Penting</h4>
                <ul>
                    <li><i class="fas fa-check"></i> Biaya admin: <strong>5%</strong> dari jumlah penarikan</li>
                    <li><i class="fas fa-check"></i> Minimal penarikan: <strong>Rp 20.000</strong></li>
                    <li><i class="fas fa-check"></i> Proses verifikasi: <strong>1x24 jam</strong></li>
                </ul>
            </div>
        </div>

        {{-- Alerts --}}
        @if(Session::has('message_success'))
            <div class="alert alert-success animate-fadeIn">
                <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
                <div class="alert-content">{{ Session::get('message_success') }}</div>
            </div>
        @endif
        
        @if(Session::has('message_failed'))
            <div class="alert alert-danger animate-fadeIn">
                <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                <div class="alert-content">{{ Session::get('message_failed') }}</div>
            </div>
        @endif

        <div class="withdraw-grid">
            {{-- Form Card --}}
            <div class="withdraw-card animate-fadeIn">
                <div class="card-header">
                    <div class="card-icon">
                        <i class="fas fa-hand-holding-usd"></i>
                    </div>
                    <div class="card-title">
                        <h3>Form Penarikan</h3>
                        <p>Masukkan detail penarikan</p>
                    </div>
                </div>
                
                <form method="POST" action="" class="withdraw-form">
                    @csrf
                    
                    <div class="form-field">
                        <label><i class="fas fa-coins"></i> Jumlah Penarikan</label>
                        <div class="amount-input">
                            <span class="currency">Rp</span>
                            <input type="number" name="jumlahsaldouser" min="20000" max="{{ Auth::user()->saldo }}" placeholder="Minimal 20.000" required>
                        </div>
                        <div class="quick-amounts">
                            <button type="button" onclick="setAmount(50000)">50rb</button>
                            <button type="button" onclick="setAmount(100000)">100rb</button>
                            <button type="button" onclick="setAmount(200000)">200rb</button>
                            <button type="button" onclick="setAmount({{ Auth::user()->saldo }})">Semua</button>
                        </div>
                    </div>
                    
                    <div class="form-field">
                        <label><i class="fas fa-university"></i> Nomor Rekening Tujuan</label>
                        <input type="text" name="rekeninganda" value="{{ Auth::user()->nomorrekening }}" required>
                    </div>

                    <div class="calculation-preview" id="calcPreview">
                        <div class="calc-row">
                            <span>Jumlah Penarikan</span>
                            <span id="previewAmount">Rp 0</span>
                        </div>
                        <div class="calc-row calc-fee">
                            <span>Biaya Admin (5%)</span>
                            <span id="previewFee">- Rp 0</span>
                        </div>
                        <div class="calc-row calc-total">
                            <span>Yang Diterima</span>
                            <span id="previewTotal">Rp 0</span>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        <i class="fas fa-paper-plane"></i> Ajukan Penarikan
                    </button>
                </form>
            </div>
            
            {{-- Info Card --}}
            <div class="info-card animate-fadeIn stagger-1">
                <h4><i class="fas fa-clock"></i> Proses Penarikan</h4>
                <div class="timeline">
                    <div class="timeline-item">
                        <div class="timeline-dot active"></div>
                        <div class="timeline-content">
                            <h5>Pengajuan</h5>
                            <p>Anda mengajukan penarikan saldo</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h5>Verifikasi Admin</h5>
                            <p>Tim kami memverifikasi permintaan</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h5>Transfer</h5>
                            <p>Dana ditransfer ke rekening Anda</p>
                        </div>
                    </div>
                    <div class="timeline-item">
                        <div class="timeline-dot"></div>
                        <div class="timeline-content">
                            <h5>Selesai</h5>
                            <p>Penarikan berhasil</p>
                        </div>
                    </div>
                </div>
                
                <div class="help-box">
                    <i class="fas fa-question-circle"></i>
                    <div>
                        <h5>Butuh Bantuan?</h5>
                        <p>Hubungi support jika ada kendala penarikan</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.withdraw-page {
    padding: var(--space-6) 0 var(--space-16);
}

/* Balance Card */
.balance-card {
    position: relative;
    background: var(--gradient-accent);
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
    margin-bottom: var(--space-6);
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

/* Withdraw Note */
.withdraw-note {
    display: flex;
    gap: var(--space-5);
    padding: var(--space-5);
    background: rgba(139, 92, 246, 0.1);
    border: 1px solid rgba(139, 92, 246, 0.3);
    border-radius: var(--radius-xl);
    margin-bottom: var(--space-8);
}

.note-icon {
    width: 48px;
    height: 48px;
    background: var(--gradient-accent);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
    flex-shrink: 0;
}

.note-content h4 {
    margin-bottom: var(--space-3);
    color: #a855f7;
}

.note-content ul {
    list-style: none;
    margin: 0;
    padding: 0;
}

.note-content li {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.9rem;
    color: var(--text-secondary);
    margin-bottom: var(--space-2);
}

.note-content li i {
    color: var(--success);
    font-size: 0.75rem;
}

/* Grid */
.withdraw-grid {
    display: grid;
    grid-template-columns: 1fr 350px;
    gap: var(--space-6);
    align-items: start;
}

/* Form Card */
.withdraw-card {
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
    background: var(--gradient-accent);
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

.withdraw-form {
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

/* Calculation Preview */
.calculation-preview {
    background: var(--bg-tertiary);
    border-radius: var(--radius-lg);
    padding: var(--space-4);
    margin-bottom: var(--space-6);
}

.calc-row {
    display: flex;
    justify-content: space-between;
    padding: var(--space-2) 0;
    font-size: 0.9rem;
}

.calc-fee {
    color: var(--warning);
}

.calc-total {
    border-top: 1px solid var(--border-primary);
    padding-top: var(--space-3);
    margin-top: var(--space-2);
    font-weight: 700;
    font-size: 1.1rem;
}

.calc-total span:last-child {
    color: var(--success);
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

/* Timeline */
.timeline {
    position: relative;
    margin-bottom: var(--space-6);
}

.timeline::before {
    content: '';
    position: absolute;
    left: 11px;
    top: 24px;
    bottom: 24px;
    width: 2px;
    background: var(--border-primary);
}

.timeline-item {
    display: flex;
    gap: var(--space-4);
    padding: var(--space-3) 0;
}

.timeline-dot {
    width: 24px;
    height: 24px;
    background: var(--bg-tertiary);
    border: 2px solid var(--border-primary);
    border-radius: 50%;
    flex-shrink: 0;
    position: relative;
    z-index: 1;
}

.timeline-dot.active {
    background: var(--gradient-primary);
    border-color: transparent;
}

.timeline-content h5 {
    font-size: 0.9rem;
    margin-bottom: var(--space-1);
}

.timeline-content p {
    font-size: 0.8rem;
    color: var(--text-tertiary);
    margin: 0;
}

.help-box {
    display: flex;
    gap: var(--space-3);
    padding: var(--space-4);
    background: var(--bg-tertiary);
    border-radius: var(--radius-lg);
}

.help-box i {
    color: var(--info);
    font-size: 1.25rem;
}

.help-box h5 {
    font-size: 0.9rem;
    margin-bottom: var(--space-1);
}

.help-box p {
    font-size: 0.8rem;
    color: var(--text-tertiary);
    margin: 0;
}

/* Responsive */
@media (max-width: 992px) {
    .withdraw-grid {
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
    
    .withdraw-note {
        flex-direction: column;
    }
}
</style>

<script>
function setAmount(amount) {
    document.querySelector('input[name="jumlahsaldouser"]').value = amount;
    updateCalculation(amount);
}

function updateCalculation(amount) {
    const fee = amount * 0.05;
    const total = amount - fee;
    
    document.getElementById('previewAmount').textContent = 'Rp ' + amount.toLocaleString('id-ID');
    document.getElementById('previewFee').textContent = '- Rp ' + fee.toLocaleString('id-ID');
    document.getElementById('previewTotal').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

document.querySelector('input[name="jumlahsaldouser"]').addEventListener('input', function() {
    updateCalculation(parseInt(this.value) || 0);
});
</script>
@endsection
