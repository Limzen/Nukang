@extends('app')

@section('content')
<link href="{{ asset('/css/modern.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<div class="detail-container">
    {{-- Back Button --}}
    <div class="back-nav">
        <a href="{{ url('riwayatpemesanan') }}" class="btn-back">
            <i class="fas fa-arrow-left"></i>
            <span>Kembali ke Daftar</span>
        </a>
    </div>

    {{-- Page Header --}}
    <div class="detail-header">
        <div class="header-title">
            <i class="fas fa-file-invoice"></i>
            <div>
                <h1>Detail Pemesanan</h1>
                <p class="order-number">#{{ $value->nomorpemesanan }}</p>
            </div>
        </div>
        <div class="status-badge status-{{ $value->statuspemesanan }}">
            @include('include/statuspemesanan')
        </div>
    </div>

    {{-- Participants Info --}}
    <div class="participants-grid">
        {{-- Pelanggan Card --}}
        <div class="participant-card">
            <div class="participant-header">
                <i class="fas fa-user"></i>
                <span>Pelanggan</span>
            </div>
            <div class="participant-body">
                <div class="participant-photo">
                    <img src="{{ asset('images/fotoprofil/' . $value->fotoprofil) }}" alt="{{ $value->namapelanggan }}">
                </div>
                <div class="participant-info">
                    <span class="badge">{{ $value->kodeuser }}</span>
                    <h3>{{ $value->namapelanggan }}</h3>
                    <p><i class="fas fa-map-marker-alt"></i> {{ $value->alamat }}</p>
                </div>
            </div>
        </div>

        {{-- Tukang Card --}}
        <div class="participant-card">
            <div class="participant-header">
                <i class="fas fa-hard-hat"></i>
                <span>Tukang</span>
            </div>
            <div class="participant-body">
                <div class="participant-photo">
                    <img src="{{ asset('images/fotoprofil/' . $tukang->fotoprofil) }}" alt="{{ $tukang->namatukang }}">
                </div>
                <div class="participant-info">
                    <span class="badge">{{ $tukang->kodeuser }}</span>
                    <h3>{{ $tukang->namatukang }}</h3>
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
                <span class="rating-count">({{ \App\Ulasan::where('id_tukang', $tukang->id_tukang)->count() }}
                    ulasan)</span>
            </div>
                    <p><i class="fas fa-tags"></i> {{ $tukang->kategoritukang }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Order Details --}}
    <div class="detail-card">
        <div class="card-header">
            <h2><i class="fas fa-info-circle"></i> Informasi Pemesanan</h2>
        </div>
        <div class="card-body">
            <div class="detail-grid">
                <div class="detail-item">
                    <span class="label"><i class="fas fa-calendar"></i> Tanggal Kedatangan</span>
                    <span class="value">{{ $value->tanggalbekerja }}</span>
                </div>

                <div class="detail-item">
                    <span class="label"><i class="fas fa-map-marked-alt"></i> Alamat Pengerjaan</span>
                    <span class="value">
                        {{ $value->alamatpemesanan }}
                        <a href="{{ url('riwayatpemesanan/' . $value->id_pemesanan . '/lihatpeta') }}" 
                           target="_blank" class="link-btn">
                            <i class="fas fa-map"></i> Lihat Peta
                        </a>
                    </span>
                </div>

                <div class="detail-item">
                    <span class="label"><i class="fas fa-briefcase"></i> Jenis Pemesanan</span>
                    <span class="value">@include('include/harianorborongan')</span>
                </div>

                <div class="detail-item">
                    <span class="label"><i class="fas fa-tools"></i> Jasa Yang Dipilih</span>
                    <span class="value">{{ $value->jenispemesanan }}</span>
                </div>

                <div class="detail-item">
                    <span class="label"><i class="fas fa-money-bill-wave"></i> Biaya Jasa</span>
                    <span class="value price">Rp {{ number_format($value->biayajasa, 2) }}</span>
                </div>

                <div class="detail-item">
                    <span class="label"><i class="fas fa-truck"></i> Biaya Pengantaran</span>
                    <span class="value">
                        {{ $jarak }} KM × Rp {{ number_format($hargajarak->hargajarak, 2) }} 
                        = <span class="price">Rp {{ number_format($jarak * $hargajarak->hargajarak, 2) }}</span>
                    </span>
                </div>

                @if($value->catatan)
                <div class="detail-item full-width">
                    <span class="label"><i class="fas fa-sticky-note"></i> Catatan</span>
                    <span class="value">{{ $value->catatan }}</span>
                </div>
                @endif

                @if($value->alasanpenolakanpemesanan)
                <div class="detail-item full-width alert-item">
                    <span class="label"><i class="fas fa-exclamation-triangle"></i> Alasan Penolakan</span>
                    <span class="value">{{ $value->alasanpenolakanpemesanan }}</span>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Material Cart --}}
    <div class="detail-card">
        <div class="card-header">
            <h2><i class="fas fa-shopping-cart"></i> Keranjang Bahan Material</h2>
        </div>
        <div class="card-body">
            @if(count($pemesananbahan) == 0)
            <div class="empty-cart">
                <i class="fas fa-inbox"></i>
                <p>Belum ada bahan material yang dimasukkan ke keranjang</p>
            </div>
            @else
            <div class="material-list">
                @php $i = 1; @endphp
                @foreach($pemesananbahan as $key => $material)
                <div class="material-item">
                    <span class="material-number">{{ $i }}</span>
                    <div class="material-info">
                        <h4>{{ $material->bahanmaterial }}</h4>
                        <p>{{ $material->kodebahanmaterial }}</p>
                    </div>
                    <div class="material-price">
                        <span class="qty">× {{ $material->qtypembelian }}</span>
                        <span class="price">Rp {{ number_format($material->hargapemesananbahanmaterial, 2) }}</span>
                    </div>
                </div>
                @php $i++; @endphp
                @endforeach
            </div>
            @endif
        </div>
    </div>
</div>

<style>
/* Detail Container */
.detail-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: var(--space-8);
}

/* Back Navigation */
.back-nav {
    margin-bottom: var(--space-6);
}

.btn-back {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-3) var(--space-5);
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-lg);
    color: var(--text-secondary);
    font-weight: 500;
    text-decoration: none;
    transition: all var(--transition-base);
}

.btn-back:hover {
    background: var(--bg-tertiary);
    border-color: var(--border-hover);
    color: var(--text-primary);
    transform: translateX(-4px);
}

/* Detail Header */
.detail-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: var(--space-4);
    padding: var(--space-6);
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    margin-bottom: var(--space-6);
}

.header-title {
    display: flex;
    align items: center;
    gap: var(--space-4);
}

.header-title > i {
    width: 56px;
    height: 56px;
    background: var(--gradient-primary);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5rem;
    color: white;
}

.header-title h1 {
    font-size: 1.5rem;
    margin-bottom: var(--space-1);
}

.order-number {
    color: var(--text-tertiary);
    font-family: var(--font-display);
    font-weight: 600;
}

/* Status Badge (reuse from riwayat page) */
.status-badge {
    padding: var(--space-3) var(--space-5);
    border-radius: var(--radius-full);
    font-size: 0.875rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.status-0 { background: rgba(156, 163, 175, 0.15); color: #9ca3af; }
.status-1 { background: rgba(59, 130, 246, 0.15); color: #3b82f6; }
.status-2 { background: rgba(245, 158, 11, 0.15); color: #f59e0b; }
.status-3 { background: rgba(16, 185, 129, 0.15); color: #10b981; }
.status-4 { background: rgba(239, 68, 68, 0.15); color: #ef4444; }

/* Participants Grid */
.participants-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-6);
    margin-bottom: var(--space-6);
}

.participant-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
    transition: all var(--transition-base);
}

.participant-card:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-lg);
}

.participant-header {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    padding: var(--space-4) var(--space-5);
    background: var(--bg-tertiary);
    border-bottom: 1px solid var(--border-primary);
    font-weight: 600;
    font-size: 0.9rem;
}

.participant-header i {
    color: var(--success);
}

.participant-body {
    padding: var(--space-6);
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    gap: var(--space-4);
}

.participant-photo {
    width: 120px;
    height: 120px;
    border-radius: var(--radius-lg);
    overflow: hidden;
    border: 3px solid var(--border-primary);
}

.participant-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.participant-info {
    width: 100%;
}

.participant-info .badge {
    display: inline-block;
    padding: var(--space-1) var(--space-3);
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
    border-radius: var(--radius-md);
    font-size: 0.75rem;
    font-weight: 700;
    margin-bottom: var(--space-2);
}

.participant-info h3 {
    font-size: 1.25rem;
    margin-bottom: var(--space-2);
}

.participant-info p {
    color: var(--text-secondary);
    font-size: 0.875rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
}

.rating {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    color: #f59e0b;
    margin: var(--space-2) 0;
}

/* Detail Card */
.detail-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    margin-bottom: var(--space-6);
    overflow: hidden;
}

.card-header {
    padding: var(--space-5) var(--space-6);
    background: var(--bg-tertiary);
    border-bottom: 1px solid var(--border-primary);
}

.card-header h2 {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    font-size: 1.125rem;
    margin: 0;
}

.card-header i {
    color: var(--success);
}

.card-body {
    padding: var(--space-6);
}

/* Detail Grid */
.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: var(--space-5);
}

.detail-item {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
}

.detail-item.full-width {
    grid-column: 1 / -1;
}

.detail-item.alert-item {
    padding: var(--space-4);
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid var(--danger);
    border-radius: var(--radius-lg);
}

.detail-item .label {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    color: var(--text-tertiary);
    letter-spacing: 0.5px;
}

.detail-item .label i {
    color: var(--success);
}

.detail-item .value {
    font-size: 1rem;
    color: var(--text-primary);
    font-weight: 500;
}

.detail-item .price {
    color: var(--success);
    font-weight: 700;
}

.link-btn {
    display: inline-flex;
    align-items: center;
    gap: var(--space-1);
    padding: var(--space-1) var(--space-3);
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
    border-radius: var(--radius-md);
    font-size: 0.75rem;
    font-weight: 600;
    text-decoration: none;
    margin-left: var(--space-2);
    transition: all var(--transition-fast);
}

.link-btn:hover {
    background: #3b82f6;
    color: white;
}

/* Material List */
.empty-cart {
    text-align: center;
    padding: var(--space-10) var(--space-6);
    color: var(--text-tertiary);
}

.empty-cart i {
    font-size: 3rem;
    margin-bottom: var(--space-4);
    opacity: 0.3;
}

.material-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
}

.material-item {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-4);
    background: var(--bg-tertiary);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-lg);
    transition: all var(--transition-base);
}

.material-item:hover {
    border-color: var(--border-hover);
    background: var(--bg-card-hover);
}

.material-number {
    width: 32px;
    height: 32px;
    background: var(--gradient-primary);
    color: white;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    flex-shrink: 0;
}

.material-info {
    flex: 1;
}

.material-info h4 {
    font-size: 1rem;
    margin-bottom: var(--space-1);
}

.material-info p {
    font-size: 0.8rem;
    color: var(--text-tertiary);
}

.material-price {
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: var(--space-1);
}

.material-price .qty {
    font-size: 0.875rem;
    color: var(--text-tertiary);
    font-weight: 600;
}

.material-price .price {
    font-size: 1.125rem;
    font-weight: 700;
    color: var(--success);
}

/* Responsive */
@media (max-width: 768px) {
    .detail-container {
        padding: var(--space-4);
    }

    .detail-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .participants-grid {
        grid-template-columns: 1fr;
    }

    .detail-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endsection