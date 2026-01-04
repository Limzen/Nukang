@extends('app')

@section('title', 'Pengalaman Bekerja - ' . $tukang->namatukang . ' - Nukang')

@section('content')
    <div class="detail-tukang-page">
        <div class="container">
            @include('include.detailtukangheader')

            {{-- Content Section --}}
            <div class="content-section">
                {{-- Experience Card --}}
                <div class="content-card animate-fadeIn">
                    <div class="card-header">
                        <div class="card-icon"><i class="fas fa-briefcase"></i></div>
                        <div class="card-title">
                            <h3>Riwayat Pengalaman Bekerja</h3>
                            <p>Pengalaman kerja yang dimiliki</p>
                        </div>
                    </div>
                    <div class="card-body">
                        @php
                            $pengalaman = $tukang->pengalamanbekerja ? explode("~", $tukang->pengalamanbekerja) : [];
                        @endphp
                        @if(count($pengalaman) > 0 && $tukang->pengalamanbekerja != "")
                            <div class="experience-list">
                                @foreach($pengalaman as $index => $item)
                                    <div class="experience-item">
                                        <div class="exp-number">{{ $index + 1 }}</div>
                                        <div class="exp-content">{{ $item }}</div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-briefcase"></i>
                                <p>Belum ada pengalaman yang ditambahkan</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Duration Card --}}
                <div class="stats-card animate-fadeIn stagger-1">
                    <div class="stat-icon"><i class="fas fa-clock"></i></div>
                    <div class="stat-info">
                        <span class="stat-value">{{ $tukang->lamapengalamanbekerja ?? 0 }} Tahun</span>
                        <span class="stat-label">Lama Pengalaman Bekerja</span>
                    </div>
                </div>

                {{-- Portfolio Card --}}
                <div class="content-card animate-fadeIn stagger-2">
                    <div class="card-header">
                        <div class="card-icon card-icon-purple"><i class="fas fa-images"></i></div>
                        <div class="card-title">
                            <h3>Foto Hasil Kerja</h3>
                            <p>Portofolio pekerjaan yang sudah selesai</p>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(!empty($tukang->fotohasilkerja))
                            @php
                                // Check both possible locations for the file
                                $filePath = null;
                                if (file_exists(public_path('images/hasilkerja/' . $tukang->fotohasilkerja))) {
                                    $filePath = 'images/hasilkerja/' . $tukang->fotohasilkerja;
                                } elseif (file_exists(public_path('files/hasil_pekerjaan/' . $tukang->fotohasilkerja))) {
                                    $filePath = 'files/hasil_pekerjaan/' . $tukang->fotohasilkerja;
                                }
                            @endphp
                            @if($filePath)
                                <a href="{{ asset($filePath) }}" class="btn btn-primary" download>
                                    <i class="fas fa-download"></i> Unduh Hasil Kerja (ZIP)
                                </a>
                            @else
                                <div class="empty-state">
                                    <i class="fas fa-images"></i>
                                    <p>File hasil kerja tidak ditemukan</p>
                                </div>
                            @endif
                        @else
                            <div class="empty-state">
                                <i class="fas fa-images"></i>
                                <p>Belum ada hasil kerja yang diupload</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- CTA --}}
                <div class="cta-section animate-fadeIn stagger-3">
                    <div class="cta-content">
                        <h3>Tertarik dengan pengalaman ini?</h3>
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

        .content-card .card-icon-purple {
            background: linear-gradient(135deg, #8b5cf6, #a855f7);
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

        .experience-list {
            display: flex;
            flex-direction: column;
            gap: var(--space-3);
        }

        .experience-item {
            display: flex;
            align-items: flex-start;
            gap: var(--space-4);
            padding: var(--space-4);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
        }

        .exp-number {
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

        .exp-content {
            color: var(--text-primary);
            line-height: 1.6;
        }

        .stats-card {
            display: flex;
            align-items: center;
            gap: var(--space-5);
            padding: var(--space-6);
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            margin-bottom: var(--space-6);
        }

        .stat-icon {
            width: 64px;
            height: 64px;
            background: var(--gradient-accent);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.75rem;
        }

        .stat-value {
            display: block;
            font-family: var(--font-display);
            font-size: 2rem;
            font-weight: 700;
            color: var(--success);
        }

        .stat-label {
            font-size: 0.9rem;
            color: var(--text-tertiary);
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

        .stagger-3 {
            animation-delay: 0.3s;
        }

        @media (max-width: 768px) {
            .cta-section {
                flex-direction: column;
                text-align: center;
                gap: var(--space-4);
            }
        }
    </style>
@endsection