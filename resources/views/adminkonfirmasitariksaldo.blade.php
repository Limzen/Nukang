@extends('app')

@section('title', 'Konfirmasi Penarikan Saldo - Nukang')

@section('content')
<div class="admin-page">
    <div class="container">
        {{-- Page Header --}}
        <div class="page-header animate-fadeIn">
            <div class="header-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
            <div class="header-text">
                <h1>Konfirmasi Tarik Saldo</h1>
                <p>Proses permintaan penarikan saldo dari tukang</p>
            </div>
            <div class="header-badge">
                <span class="count">{{ count($tariksaldo) }}</span>
                <span class="label">Pending</span>
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

        {{-- Request Cards --}}
        @if(count($tariksaldo) > 0)
            <div class="request-grid">
                @foreach($tariksaldo as $key => $value)
                <div class="request-card animate-fadeIn" style="animation-delay: {{ $key * 0.1 }}s">
                    <div class="request-header">
                        <div class="request-code">
                            <i class="fas fa-hashtag"></i>
                            {{ $value->kode }}
                        </div>
                        <span class="request-badge">Pending</span>
                    </div>
                    
                    <div class="request-body">
                        <div class="user-info">
                            <div class="user-avatar">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="user-details">
                                <h4>{{ $value->namatukang }}</h4>
                                <p>{{ $value->nomorrekening }} - {{ $value->namarekening }}</p>
                            </div>
                        </div>
                        
                        <div class="amount-display">
                            <span class="amount-label">Jumlah Penarikan</span>
                            <span class="amount-value">Rp {{ number_format($value->jumlahsaldo, 0, ',', '.') }}</span>
                        </div>
                        
                        <div class="type-badge">
                            <i class="fas fa-tag"></i> {{ $value->jenistransaksi }}
                        </div>
                    </div>
                    
                    <div class="request-actions">
                        <form action="{{ url('konfirmasitariksaldo/terima') }}" method="POST" class="action-form">
                            @csrf
                            <input type="hidden" name="idriwayat" value="{{ $value->id_riwayattransaksi }}">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-check"></i> Setujui
                            </button>
                        </form>
                        <form action="{{ url('konfirmasitariksaldo/tolak') }}" method="POST" class="action-form">
                            @csrf
                            <input type="hidden" name="idriwayat" value="{{ $value->id_riwayattransaksi }}">
                            <button type="submit" class="btn btn-danger">
                                <i class="fas fa-times"></i> Tolak
                            </button>
                        </form>
                    </div>
                </div>
                @endforeach
            </div>
        @else
            <div class="empty-state animate-fadeIn">
                <div class="empty-icon">
                    <i class="fas fa-inbox"></i>
                </div>
                <h3>Tidak Ada Permintaan</h3>
                <p>Belum ada permintaan penarikan saldo dari tukang</p>
            </div>
        @endif
    </div>
</div>

<style>
.admin-page {
    padding: var(--space-6) 0 var(--space-16);
}

.page-header {
    display: flex;
    align-items: center;
    gap: var(--space-5);
    margin-bottom: var(--space-8);
}

.header-icon {
    width: 64px;
    height: 64px;
    background: var(--gradient-primary);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: white;
}

.header-text { flex: 1; }
.header-text h1 { font-size: 1.75rem; margin-bottom: var(--space-1); }
.header-text p { color: var(--text-secondary); }

.header-badge {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: var(--space-4) var(--space-6);
    background: rgba(245, 158, 11, 0.1);
    border: 1px solid rgba(245, 158, 11, 0.3);
    border-radius: var(--radius-xl);
}

.header-badge .count {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 700;
    color: #f59e0b;
}

.header-badge .label {
    font-size: 0.8rem;
    color: #f59e0b;
}

/* Request Grid */
.request-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
    gap: var(--space-6);
}

.request-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: all 0.3s ease;
}

.request-card:hover {
    border-color: rgba(245, 158, 11, 0.3);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.request-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-4) var(--space-5);
    background: var(--bg-tertiary);
    border-bottom: 1px solid var(--border-primary);
}

.request-code {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-family: var(--font-mono);
    font-weight: 600;
    color: var(--text-secondary);
}

.request-badge {
    padding: var(--space-1) var(--space-3);
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 600;
}

.request-body {
    padding: var(--space-5);
}

.user-info {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    margin-bottom: var(--space-5);
}

.user-avatar {
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

.user-details h4 {
    font-size: 1rem;
    margin-bottom: 2px;
}

.user-details p {
    font-size: 0.85rem;
    color: var(--text-tertiary);
    margin: 0;
}

.amount-display {
    background: var(--bg-tertiary);
    border-radius: var(--radius-lg);
    padding: var(--space-4);
    text-align: center;
    margin-bottom: var(--space-4);
}

.amount-label {
    display: block;
    font-size: 0.8rem;
    color: var(--text-tertiary);
    margin-bottom: var(--space-1);
}

.amount-value {
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 700;
    color: var(--success);
}

.type-badge {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-2) var(--space-3);
    background: var(--bg-tertiary);
    border-radius: var(--radius-md);
    font-size: 0.85rem;
    color: var(--text-secondary);
}

.request-actions {
    display: flex;
    gap: var(--space-3);
    padding: var(--space-4) var(--space-5);
    background: var(--bg-tertiary);
    border-top: 1px solid var(--border-primary);
}

.action-form { flex: 1; }
.action-form .btn { width: 100%; }

/* Empty State */
.empty-state {
    text-align: center;
    padding: var(--space-16);
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
}

.empty-icon {
    width: 80px;
    height: 80px;
    background: var(--bg-tertiary);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto var(--space-5);
    font-size: 2rem;
    color: var(--text-tertiary);
}

.empty-state h3 {
    font-size: 1.25rem;
    margin-bottom: var(--space-2);
}

.empty-state p {
    color: var(--text-tertiary);
}
</style>
@endsection
