{{-- Premium Tukang Header & Tab Component --}}
<div class="tukang-profile-card animate-fadeIn">
    <div class="profile-header">
        <div class="profile-avatar">
            @if($tukang->fotoprofil)
                <img src="{{ asset('images/fotoprofil') }}/{{$tukang->fotoprofil}}" alt="{{$tukang->namatukang}}">
            @else
                <div class="avatar-placeholder">
                    <i class="fas fa-user"></i>
                </div>
            @endif
            <span class="status-badge online"></span>
        </div>
        <div class="profile-info">
            <div class="profile-badges">
                <span class="badge badge-verified"><i class="fas fa-check-circle"></i> Terverifikasi</span>
                <span class="badge badge-category">{{ $tukang->kategoritukang }}</span>
            </div>
            <h1>{{ $tukang->namatukang }}</h1>
            <p class="code">{{ $tukang->kodeuser }}</p>
            <div class="profile-meta">
                <span><i class="fas fa-map-marker-alt"></i> {{ $tukang->alamat ?? 'Lokasi tidak tersedia' }}</span>
            </div>
            <div class="profile-rating">
                @php $rating = $tukang->rating ?? 0; @endphp
                <div class="stars">
                    @for($i = 1; $i <= 5; $i++)
                        @if($i <= floor($rating))
                            <i class="fas fa-star"></i>
                        @elseif($i - 0.5 <= $rating)
                            <i class="fas fa-star-half-alt"></i>
                        @else
                            <i class="far fa-star"></i>
                        @endif
                    @endfor
                </div>
                <span class="rating-value">{{ number_format($rating, 1) }}</span>
                <span class="rating-count">({{ $tukang->jumlahrating ?? 0 }} ulasan)</span>
            </div>
        </div>
        <div class="profile-actions">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#orderModal">
                <i class="fas fa-shopping-cart"></i> Pesan Sekarang
            </button>
        </div>
    </div>
</div>

{{-- Tab Navigation --}}
<div class="tab-navigation animate-fadeIn">
    <a href="{{ url('cari-tukang') }}/{{ $idtukang }}/rincian-biaya" class="tab-item {{ Request::is('cari-tukang/*/rincian-biaya') ? 'active' : '' }}">
        <i class="fas fa-money-bill-wave"></i> Rincian Biaya
    </a>
    <a href="{{ url('cari-tukang') }}/{{ $idtukang }}/pengalaman-bekerja" class="tab-item {{ Request::is('cari-tukang/*/pengalaman-bekerja') ? 'active' : '' }}">
        <i class="fas fa-briefcase"></i> Pengalaman
    </a>
    <a href="{{ url('cari-tukang') }}/{{ $idtukang }}/deskripsi-keahlian" class="tab-item {{ Request::is('cari-tukang/*/deskripsi-keahlian') ? 'active' : '' }}">
        <i class="fas fa-tools"></i> Keahlian
    </a>
    <a href="{{ url('cari-tukang') }}/{{ $idtukang }}/komentar-pelanggan" class="tab-item {{ Request::is('cari-tukang/*/komentar-pelanggan') ? 'active' : '' }}">
        <i class="fas fa-comments"></i> Ulasan
    </a>
    <a href="{{ url('cari-tukang') }}/{{ $idtukang }}/lokasi" class="tab-item {{ Request::is('cari-tukang/*/lokasi') ? 'active' : '' }}">
        <i class="fas fa-map-marker-alt"></i> Lokasi
    </a>
</div>

<style>
/* Profile Card */
.tukang-profile-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-2xl);
    overflow: hidden;
    margin-bottom: var(--space-6);
}

.profile-header {
    display: flex;
    align-items: center;
    gap: var(--space-6);
    padding: var(--space-8);
    background: var(--bg-tertiary);
}

.profile-avatar {
    position: relative;
    flex-shrink: 0;
}

.profile-avatar img,
.profile-avatar .avatar-placeholder {
    width: 120px;
    height: 120px;
    border-radius: var(--radius-xl);
    object-fit: cover;
    border: 4px solid var(--success);
}

.profile-avatar .avatar-placeholder {
    background: var(--gradient-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 3rem;
    color: white;
}

.status-badge {
    position: absolute;
    bottom: 8px;
    right: 8px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    border: 3px solid var(--bg-tertiary);
}

.status-badge.online { background: var(--success); }

.profile-info { flex: 1; }

.profile-badges {
    display: flex;
    gap: var(--space-2);
    margin-bottom: var(--space-2);
}

.badge-verified {
    background: rgba(16, 185, 129, 0.15);
    color: var(--success);
    padding: var(--space-1) var(--space-3);
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-category {
    background: rgba(139, 92, 246, 0.15);
    color: #8b5cf6;
    padding: var(--space-1) var(--space-3);
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 600;
}

.profile-info h1 {
    font-size: 1.75rem;
    margin-bottom: var(--space-1);
}

.profile-info .code {
    color: var(--text-tertiary);
    font-size: 0.9rem;
    margin-bottom: var(--space-2);
}

.profile-meta {
    color: var(--text-secondary);
    font-size: 0.9rem;
    margin-bottom: var(--space-3);
}

.profile-meta i {
    color: var(--success);
    margin-right: var(--space-2);
}

.profile-rating {
    display: flex;
    align-items: center;
    gap: var(--space-2);
}

.profile-rating .stars { color: #fbbf24; }
.profile-rating .rating-value { font-weight: 700; }
.profile-rating .rating-count { color: var(--text-tertiary); font-size: 0.85rem; }

.profile-actions { flex-shrink: 0; }

/* Tab Navigation */
.tab-navigation {
    display: flex;
    gap: var(--space-2);
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    padding: var(--space-2);
    margin-bottom: var(--space-6);
    overflow-x: auto;
}

.tab-item {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-5);
    border-radius: var(--radius-lg);
    color: var(--text-secondary);
    font-weight: 500;
    white-space: nowrap;
    transition: all 0.3s ease;
}

.tab-item:hover {
    background: var(--bg-tertiary);
    color: var(--text-primary);
}

.tab-item.active {
    background: var(--gradient-primary);
    color: white;
}

.tab-item i { font-size: 0.9rem; }

@media (max-width: 768px) {
    .profile-header {
        flex-direction: column;
        text-align: center;
    }
    .profile-actions { width: 100%; }
    .profile-actions .btn { width: 100%; }
    .tab-item { padding: var(--space-2) var(--space-3); font-size: 0.85rem; }
}
</style>
