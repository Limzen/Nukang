@extends('app')

@section('title', 'Deskripsi Keahlian - ' . $tukang->namatukang . ' - Nukang')

@section('content')
    <div class="detail-tukang-page">
        <div class="container">
            @include('include.detailtukangheader')

            {{-- Content Section --}}
            <div class="content-section">
                {{-- Skills Card --}}
                <div class="content-card animate-fadeIn">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-tools"></i></div>
                        <div class="card-title">
                            <h3>Deskripsi Keahlian</h3>
                            <p>Keahlian dan kemampuan yang dimiliki</p>
                        </div>
                    </div>
                    <div class="card-body">
                        @if($tukang->deskripsikeahlian)
                            <div class="skill-description">
                                <div class="quote-icon"><i class="fas fa-quote-left"></i></div>
                                <p>{{ $tukang->deskripsikeahlian }}</p>
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-tools"></i>
                                <p>Belum ada deskripsi keahlian</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Skills Stats --}}
                <div class="stats-grid animate-fadeIn stagger-1">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-clock"></i></div>
                        <div class="stat-value">{{ $tukang->lamapengalamanbekerja ?? 0 }}</div>
                        <div class="stat-label">Tahun Pengalaman</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon stat-icon-purple"><i class="fas fa-star"></i></div>
                        <div class="stat-value">{{ number_format($tukang->rating ?? 0, 1) }}</div>
                        <div class="stat-label">Rating</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon stat-icon-blue"><i class="fas fa-check-circle"></i></div>
                        <div class="stat-value">{{ $jumlahProyekSelesai ?? 0 }}</div>
                        <div class="stat-label">Proyek Selesai</div>
                    </div>
                </div>

                {{-- CTA --}}
                <div class="cta-section animate-fadeIn stagger-2">
                    <div class="cta-content">
                        <h3>Butuh keahlian ini?</h3>
                        <p>Pesan sekarang dan dapatkan layanan profesional</p>
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
        .detail-tukang-page {
            padding: var(--space-6) 0 var(--space-16);
        }

        .content-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            overflow: hidden;
            margin-bottom: var(--space-6);
        }

        .content-card .card-header {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-5);
            background: var(--bg-tertiary);
            border-bottom: 1px solid var(--border-primary);
        }

        .content-card .card-icon {
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

        .content-card .card-title {
            flex: 1;
        }

        .content-card .card-title h3 {
            font-size: 1.1rem;
            margin-bottom: var(--space-1);
        }

        .content-card .card-title p {
            font-size: 0.85rem;
            color: var(--text-tertiary);
            margin: 0;
        }

        .content-card .card-body {
            padding: var(--space-6);
        }

        .skill-description {
            position: relative;
            padding: var(--space-6);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
            border-left: 4px solid var(--success);
        }

        .quote-icon {
            position: absolute;
            top: var(--space-4);
            left: var(--space-4);
            color: var(--success);
            opacity: 0.3;
            font-size: 2rem;
        }

        .skill-description p {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-primary);
            margin: 0;
            padding-left: var(--space-8);
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: var(--space-4);
            margin-bottom: var(--space-6);
        }

        .stat-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            padding: var(--space-6);
            text-align: center;
        }

        .stat-card .stat-icon {
            width: 56px;
            height: 56px;
            background: var(--gradient-primary);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.5rem;
            margin: 0 auto var(--space-4);
        }

        .stat-card .stat-icon-purple {
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
        }

        .stat-card .stat-icon-blue {
            background: linear-gradient(135deg, #3b82f6, #60a5fa);
        }

        .stat-card .stat-value {
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-primary);
        }

        .stat-card .stat-label {
            font-size: 0.85rem;
            color: var(--text-tertiary);
            margin-top: var(--space-1);
        }

        .empty-state {
            text-align: center;
            padding: var(--space-8);
            color: var(--text-tertiary);
        }

        .empty-state i {
            font-size: 2.5rem;
            margin-bottom: var(--space-3);
            display: block;
        }

        .cta-section {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: var(--space-6);
            background: var(--gradient-primary);
            border-radius: var(--radius-xl);
            color: white;
        }

        .cta-content h3 {
            font-size: 1.25rem;
            margin-bottom: var(--space-2);
            color: white;
        }

        .cta-content p {
            opacity: 0.9;
            margin: 0;
        }

        .cta-section .btn {
            background: white;
            color: var(--success);
        }

        .stagger-1 {
            animation-delay: 0.1s;
        }

        .stagger-2 {
            animation-delay: 0.2s;
        }

        @media (max-width: 768px) {
            .stats-grid {
                grid-template-columns: 1fr;
            }

            .cta-section {
                flex-direction: column;
                text-align: center;
                gap: var(--space-4);
            }
        }
    </style>
@endsection