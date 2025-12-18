@extends('app')

@section('title', 'Rincian Biaya - ' . $tukang->namatukang . ' - Nukang')

@section('content')
<div class="detail-tukang-page">
    <div class="container">
        @include('include.detailtukangheader')
        
        {{-- Content Section --}}
        <div class="content-section">
            {{-- Harian Services --}}
            <div class="services-card animate-fadeIn">
                <div class="card-header">
                    <div class="card-icon"><i class="fas fa-calendar-day"></i></div>
                    <div class="card-title">
                        <h3>Jasa Harian</h3>
                        <p>Pembayaran per hari kerja</p>
                    </div>
                    <span class="service-count">{{ count($jasatersediaharian) }} layanan</span>
                </div>
                <div class="services-list">
                    @if(count($jasatersediaharian) > 0)
                        @foreach($jasatersediaharian as $value)
                        <div class="service-item">
                            <div class="service-info">
                                <div class="service-icon"><i class="fas fa-wrench"></i></div>
                                <div class="service-details">
                                    <h4>{{ $value->jenispemesanan }}</h4>
                                    <span class="service-type">Harian</span>
                                </div>
                            </div>
                            <div class="service-price">
                                <span class="price">Rp {{ number_format($value->biayajasatersedia, 0, ',', '.') }}</span>
                                <span class="period">/hari</span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="empty-state"><i class="fas fa-inbox"></i><p>Tidak ada layanan harian</p></div>
                    @endif
                </div>
            </div>

            {{-- Borongan Services --}}
            <div class="services-card animate-fadeIn stagger-1">
                <div class="card-header">
                    <div class="card-icon card-icon-purple"><i class="fas fa-project-diagram"></i></div>
                    <div class="card-title">
                        <h3>Jasa Borongan</h3>
                        <p>Pembayaran per proyek</p>
                    </div>
                    <span class="service-count">{{ count($jasatersediaborongan) }} layanan</span>
                </div>
                <div class="services-list">
                    @if(count($jasatersediaborongan) > 0)
                        @foreach($jasatersediaborongan as $value)
                        <div class="service-item">
                            <div class="service-info">
                                <div class="service-icon service-icon-purple"><i class="fas fa-hard-hat"></i></div>
                                <div class="service-details">
                                    <h4>{{ $value->jenispemesanan }}</h4>
                                    <span class="service-type">Borongan</span>
                                </div>
                            </div>
                            <div class="service-price">
                                <span class="price">Rp {{ number_format($value->biayajasatersedia, 0, ',', '.') }}</span>
                                <span class="period">/proyek</span>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <div class="empty-state"><i class="fas fa-inbox"></i><p>Tidak ada layanan borongan</p></div>
                    @endif
                </div>
            </div>

            {{-- CTA --}}
            <div class="cta-section animate-fadeIn stagger-2">
                <div class="cta-content">
                    <h3>Tertarik dengan layanan ini?</h3>
                    <p>Pesan sekarang dan dapatkan layanan terbaik</p>
                </div>
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#orderModal">
                    <i class="fas fa-shopping-cart"></i> Pesan Sekarang
                </button>
            </div>
        </div>
    </div>
</div>

@include('include.ordermodal')

<style>
.detail-tukang-page { padding: var(--space-6) 0 var(--space-16); }
.services-card { background: var(--bg-card); border: 1px solid var(--border-primary); border-radius: var(--radius-xl); overflow: hidden; margin-bottom: var(--space-6); }
.services-card .card-header { display: flex; align-items: center; gap: var(--space-4); padding: var(--space-5); background: var(--bg-tertiary); border-bottom: 1px solid var(--border-primary); }
.services-card .card-icon { width: 48px; height: 48px; background: var(--gradient-primary); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.25rem; }
.services-card .card-icon-purple { background: linear-gradient(135deg, #8b5cf6, #a855f7); }
.services-card .card-title { flex: 1; }
.services-card .card-title h3 { font-size: 1.1rem; margin-bottom: var(--space-1); }
.services-card .card-title p { font-size: 0.85rem; color: var(--text-tertiary); margin: 0; }
.service-count { background: var(--bg-secondary); padding: var(--space-2) var(--space-4); border-radius: var(--radius-full); font-size: 0.8rem; color: var(--text-secondary); }
.services-list { padding: var(--space-4); }
.service-item { display: flex; align-items: center; justify-content: space-between; padding: var(--space-4); background: var(--bg-tertiary); border-radius: var(--radius-lg); margin-bottom: var(--space-3); transition: all 0.3s ease; }
.service-item:last-child { margin-bottom: 0; }
.service-item:hover { transform: translateX(4px); border-left: 3px solid var(--success); }
.service-info { display: flex; align-items: center; gap: var(--space-4); }
.service-icon { width: 40px; height: 40px; background: rgba(16, 185, 129, 0.15); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; color: var(--success); }
.service-icon-purple { background: rgba(139, 92, 246, 0.15); color: #8b5cf6; }
.service-details h4 { font-size: 0.95rem; margin-bottom: var(--space-1); }
.service-type { font-size: 0.75rem; color: var(--text-tertiary); text-transform: uppercase; letter-spacing: 0.5px; }
.service-price { text-align: right; }
.service-price .price { display: block; font-family: var(--font-display); font-size: 1.1rem; font-weight: 700; color: var(--success); }
.service-price .period { font-size: 0.8rem; color: var(--text-tertiary); }
.empty-state { text-align: center; padding: var(--space-8); color: var(--text-tertiary); }
.empty-state i { font-size: 2.5rem; margin-bottom: var(--space-3); }
.cta-section { display: flex; align-items: center; justify-content: space-between; padding: var(--space-6); background: var(--gradient-primary); border-radius: var(--radius-xl); color: white; }
.cta-content h3 { font-size: 1.25rem; margin-bottom: var(--space-2); color: white; }
.cta-content p { opacity: 0.9; margin: 0; }
.cta-section .btn { background: white; color: var(--success); }
.stagger-1 { animation-delay: 0.1s; }
.stagger-2 { animation-delay: 0.2s; }
@media (max-width: 768px) { .cta-section { flex-direction: column; text-align: center; gap: var(--space-4); } }
</style>
@endsection