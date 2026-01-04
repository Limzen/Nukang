@extends('app')

@section('title', 'Informasi User - Nukang')

@section('content')
<div class="users-page">
    <div class="container">
        {{-- Page Header --}}
        <div class="page-header animate-fadeIn">
            <div class="header-icon">
                <i class="fas fa-users"></i>
            </div>
            <div class="header-text">
                <h1>Informasi User</h1>
                <p>Kelola semua pengguna Nukang</p>
            </div>
        </div>

        {{-- Stats Row --}}
        <div class="stats-row animate-fadeIn">
            @php
                $total = $user->count();
                $pelanggan = $user->where('statuspengguna', '1')->count();
                $tukang = $user->where('statuspengguna', '2')->count();
                $aktif = $user->where('statusverifikasi', '1')->count();
            @endphp
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-users"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ $total }}</span>
                    <span class="stat-label">Total User</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-icon-blue"><i class="fas fa-user"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ $pelanggan }}</span>
                    <span class="stat-label">Pelanggan</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-icon-purple"><i class="fas fa-hard-hat"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ $tukang }}</span>
                    <span class="stat-label">Tukang</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-icon-green"><i class="fas fa-check-circle"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ $aktif }}</span>
                    <span class="stat-label">Aktif</span>
                </div>
            </div>
        </div>

        {{-- User Cards Grid --}}
        <div class="user-grid">
            @php $i = 1; @endphp
            @foreach($user as $value)
            <div class="user-card animate-fadeIn" style="animation-delay: {{ min($i * 0.05, 0.5) }}s">
                <div class="user-header">
                    <div class="user-avatar">
                        @if($value->fotoprofil)
                            <img src="{{ asset('images/fotoprofil') }}/{{ $value->fotoprofil }}" alt="Avatar">
                        @else
                            <i class="fas fa-user"></i>
                        @endif
                    </div>
                    <div class="user-info">
                        <h4>{{ $value->email }}</h4>
                        <span class="user-code">{{ $value->kodeuser }}</span>
                    </div>
                    <span class="user-type 
    {{ $value->statuspengguna == '1' ? 'type-pelanggan' : 
       ($value->statuspengguna == '2' ? 'type-tukang' : 'type-admin') }}">
    {{ $value->statuspengguna == '1' ? 'Pelanggan' : 
       ($value->statuspengguna == '2' ? 'Tukang' : 'Admin') }}
</span>

                </div>
                
                <div class="user-details">
                    <div class="detail-item">
                        <i class="fas fa-phone"></i>
                        <span>{{ $value->nomorhandphone ?: '-' }}</span>
                    </div>
                    <div class="detail-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>{{ Str::limit($value->alamat, 40) ?: '-' }}</span>
                    </div>
                </div>
                
                <div class="user-footer">
                    <div class="user-status {{ $value->statusverifikasi == '1' ? 'status-active' : 'status-blocked' }}">
                        <i class="fas {{ $value->statusverifikasi == '1' ? 'fa-check' : 'fa-ban' }}"></i>
                        {{ $value->statusverifikasi == '1' ? 'Aktif' : 'Blokir' }}
                    </div>
                    
                    @if($value->statusverifikasi == '1')
                        <form method="POST" action="{{ url('informasi-user/blokir') }}">
                            @csrf
                            <input type="hidden" name="iduser" value="{{ $value->id }}">
                            <button type="submit" class="btn btn-sm btn-danger">
                                <i class="fas fa-ban"></i> Blokir
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{ url('informasi-user/buka') }}">
                            @csrf
                            <input type="hidden" name="iduser" value="{{ $value->id }}">
                            <button type="submit" class="btn btn-sm btn-primary">
                                <i class="fas fa-unlock"></i> Buka
                            </button>
                        </form>
                    @endif
                </div>
            </div>
            @php $i++; @endphp
            @endforeach
        </div>
    </div>
</div>

<style>
.users-page {
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
    background: var(--gradient-accent);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.75rem;
    color: white;
}

.header-text h1 {
    font-size: 1.75rem;
    margin-bottom: var(--space-1);
}

.header-text p {
    color: var(--text-secondary);
}

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
    background: var(--bg-tertiary);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-secondary);
    font-size: 1.25rem;
}

.stat-icon-blue { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
.stat-icon-purple { background: rgba(139, 92, 246, 0.1); color: #8b5cf6; }
.stat-icon-green { background: rgba(16, 185, 129, 0.1); color: var(--success); }

.stat-number {
    display: block;
    font-family: var(--font-display);
    font-size: 1.5rem;
    font-weight: 700;
}

.stat-label {
    font-size: 0.85rem;
    color: var(--text-tertiary);
}

/* User Grid */
.user-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: var(--space-5);
}

.user-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: all 0.3s ease;
}

.user-card:hover {
    border-color: rgba(139, 92, 246, 0.3);
    transform: translateY(-4px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
}

.user-header {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-5);
    background: var(--bg-tertiary);
}

.user-avatar {
    width: 48px;
    height: 48px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    background: var(--gradient-accent);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.25rem;
}

.user-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.user-info {
    flex: 1;
    min-width: 0;
}

.user-info h4 {
    font-size: 0.95rem;
    margin-bottom: 2px;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.user-code {
    font-size: 0.8rem;
    color: var(--text-tertiary);
}

.user-type {
    padding: var(--space-1) var(--space-3);
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 600;
}

.user-type.type-tukang {
    background: rgba(139, 92, 246, 0.1);
    color: #8b5cf6;
}

.user-details {
    padding: var(--space-4) var(--space-5);
}

.detail-item {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    font-size: 0.85rem;
    color: var(--text-secondary);
    margin-bottom: var(--space-2);
}

.detail-item i {
    width: 20px;
    color: var(--text-tertiary);
}

.user-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-4) var(--space-5);
    border-top: 1px solid var(--border-primary);
}

.user-status {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.85rem;
    font-weight: 500;
}

.status-active { color: var(--success); }
.status-blocked { color: var(--danger); }

.btn-danger {
    background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
    color: white;
}
</style>
@endsection