@extends('app')

@section('title', 'Data Bahan Material - Nukang')

@section('content')
<div class="data-page">
    <div class="container">
        {{-- Page Header --}}
        <div class="page-header animate-fadeIn">
            <div class="header-icon">
                <i class="fas fa-boxes"></i>
            </div>
            <div class="header-text">
                <h1>Data Bahan Material</h1>
                <p>Kelola inventaris bahan material</p>
            </div>
            <a href="{{ url('databahanmaterial') }}/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data
            </a>
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

        {{-- Stats --}}
        <div class="stats-row animate-fadeIn">
            @php
                $total = count($bahanmaterial);
                $tersedia = collect($bahanmaterial)->where('statusbahanmaterial', '1')->count();
            @endphp
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-cubes"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ $total }}</span>
                    <span class="stat-label">Total Material</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-icon-green"><i class="fas fa-check-circle"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ $tersedia }}</span>
                    <span class="stat-label">Tersedia</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-icon-red"><i class="fas fa-times-circle"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ $total - $tersedia }}</span>
                    <span class="stat-label">Tidak Tersedia</span>
                </div>
            </div>
        </div>

        {{-- Material Grid --}}
        <div class="material-grid">
            @php $i = 1; @endphp
            @foreach($bahanmaterial as $value)
            <div class="material-card animate-fadeIn" style="animation-delay: {{ min($i * 0.05, 0.5) }}s">
                <div class="material-image">
                    <a href="{{ asset('images/fotobahanmaterial') }}/{{ $value->fotobahanmaterial }}" target="_blank">
                        <img src="{{ asset('images/fotobahanmaterial') }}/{{ $value->fotobahanmaterial }}" alt="{{ $value->bahanmaterial }}">
                    </a>
                    <span class="material-status {{ $value->statusbahanmaterial == '1' ? 'status-available' : 'status-unavailable' }}">
                        {{ $value->statusbahanmaterial == '1' ? 'Tersedia' : 'Tidak Tersedia' }}
                    </span>
                </div>
                
                <div class="material-body">
                    <div class="material-code">{{ $value->kodebahanmaterial }}</div>
                    <h4 class="material-name">{{ $value->bahanmaterial }}</h4>
                    <p class="material-info">{{ Str::limit($value->informasibahanmaterial, 60) }}</p>
                    <div class="material-price">
                        Rp {{ number_format($value->hargabahanmaterial, 0, ',', '.') }}
                    </div>
                </div>
                
                <div class="material-actions">
                    <a href="{{ url('databahanmaterial') }}/{{ $value->id_bahanmaterial }}/ubahstatus" 
                       class="btn-action {{ $value->statusbahanmaterial == '1' ? 'btn-disable' : 'btn-enable' }}" 
                       title="{{ $value->statusbahanmaterial == '1' ? 'Nonaktifkan' : 'Aktifkan' }}">
                        <i class="fas {{ $value->statusbahanmaterial == '1' ? 'fa-times' : 'fa-check' }}"></i>
                    </a>
                    <a href="{{ url('databahanmaterial') }}/{{ $value->id_bahanmaterial }}/edit" 
                       class="btn-action btn-edit" title="Edit">
                        <i class="fas fa-edit"></i>
                    </a>
                    <form method="POST" action="{{ url('databahanmaterial') }}/{{ $value->id_bahanmaterial }}" 
                          style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-action btn-delete" title="Hapus">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </div>
            @php $i++; @endphp
            @endforeach
        </div>
    </div>
</div>

<style>
.data-page { padding: var(--space-6) 0 var(--space-16); }

.page-header {
    display: flex;
    align-items: center;
    gap: var(--space-5);
    margin-bottom: var(--space-8);
    flex-wrap: wrap;
}

.header-icon {
    width: 64px;
    height: 64px;
    background: var(--gradient-gold);
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

/* Stats */
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: var(--space-4);
    margin-bottom: var(--space-8);
}

.stat-card {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-5);
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
}

.stat-icon {
    width: 48px;
    height: 48px;
    background: rgba(245, 158, 11, 0.1);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #f59e0b;
    font-size: 1.25rem;
}

.stat-icon-green { background: rgba(16, 185, 129, 0.1); color: var(--success); }
.stat-icon-red { background: rgba(239, 68, 68, 0.1); color: var(--danger); }

.stat-number { display: block; font-family: var(--font-display); font-size: 1.5rem; font-weight: 700; }
.stat-label { font-size: 0.85rem; color: var(--text-tertiary); }

/* Material Grid */
.material-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
    gap: var(--space-5);
}

.material-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: all 0.3s ease;
}

.material-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.material-image {
    position: relative;
    height: 160px;
    overflow: hidden;
}

.material-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.material-card:hover .material-image img {
    transform: scale(1.05);
}

.material-status {
    position: absolute;
    top: var(--space-3);
    right: var(--space-3);
    padding: var(--space-1) var(--space-3);
    border-radius: var(--radius-full);
    font-size: 0.7rem;
    font-weight: 600;
}

.status-available {
    background: rgba(16, 185, 129, 0.9);
    color: white;
}

.status-unavailable {
    background: rgba(239, 68, 68, 0.9);
    color: white;
}

.material-body {
    padding: var(--space-5);
}

.material-code {
    font-family: var(--font-mono);
    font-size: 0.75rem;
    color: var(--text-tertiary);
    margin-bottom: var(--space-1);
}

.material-name {
    font-size: 1rem;
    margin-bottom: var(--space-2);
}

.material-info {
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin-bottom: var(--space-3);
    line-height: 1.5;
}

.material-price {
    font-family: var(--font-display);
    font-size: 1.1rem;
    font-weight: 700;
    color: var(--success);
}

.material-actions {
    display: flex;
    gap: var(--space-2);
    padding: var(--space-4) var(--space-5);
    background: var(--bg-tertiary);
    border-top: 1px solid var(--border-primary);
}

.btn-action {
    flex: 1;
    height: 36px;
    border: none;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-enable { background: rgba(16, 185, 129, 0.1); color: var(--success); }
.btn-enable:hover { background: var(--success); color: white; }
.btn-disable { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }
.btn-disable:hover { background: #f59e0b; color: white; }
.btn-edit { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
.btn-edit:hover { background: #3b82f6; color: white; }
.btn-delete { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
.btn-delete:hover { background: var(--danger); color: white; }
</style>
@endsection