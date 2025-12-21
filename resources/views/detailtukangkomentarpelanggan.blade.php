@extends('app')

@section('title', 'Komentar Pelanggan - ' . $tukang->namatukang . ' - Nukang')

@section('content')
    <div class="detail-tukang-page">
        <div class="container">
            @include('include.detailtukangheader')

            {{-- Content Section --}}
            <div class="content-section">
                {{-- Reviews Summary --}}
                <div class="reviews-summary animate-fadeIn">
                    <div class="summary-rating">
                        <span class="big-rating">{{ number_format($tukang->rating ?? 0, 1) }}</span>
                        <div class="stars">
                            @php $rating = $tukang->rating ?? 0; @endphp
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
                        <span class="review-count">{{ count($ulasan) }} ulasan</span>
                    </div>
                </div>

                {{-- Add Review Form --}}
                @if(count($jumlahkomentar) != 0)
                    <div class="content-card animate-fadeIn stagger-1">
                        <div class="card-header">
                            <div class="card-icon"><i class="fas fa-edit"></i></div>
                            <div class="card-title">
                                <h3>Berikan Ulasan</h3>
                                <p>Anda memiliki {{ count($jumlahkomentar) }} kuota ulasan</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ url('cari-tukang/' . $idtukang . '/komentar-pelanggan') }}" method="POST">
                                @csrf
                                <input type="hidden" name="idpemesanan" value="{{ $jumlahkomentar[0]['id_pemesanan'] }}">
                                <div class="form-group">
                                    <label><i class="fas fa-star"></i> Rating</label>
                                    <div class="star-rating-input">
                                        @for($i = 5; $i >= 1; $i--)
                                            <input type="radio" name="nilairating" value="{{ $i }}" id="star{{ $i }}" {{ $i == 5 ? 'checked' : '' }}>
                                            <label for="star{{ $i }}"><i class="fas fa-star"></i></label>
                                        @endfor
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label><i class="fas fa-comment"></i> Isi Ulasan</label>
                                    <textarea class="form-control" name="isiulasan" rows="4"
                                        placeholder="Bagikan pengalaman Anda..." required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim
                                    Ulasan</button>
                            </form>
                        </div>
                    </div>
                @endif

                {{-- Reviews List --}}
                <div class="content-card animate-fadeIn stagger-2">
                    <div class="card-header">
                        <div class="card-icon card-icon-purple"><i class="fas fa-comments"></i></div>
                        <div class="card-title">
                            <h3>Ulasan Pelanggan</h3>
                            <p>{{ count($ulasan) }} ulasan dari pelanggan</p>
                        </div>
                    </div>
                    <div class="card-body">
                        @if(count($ulasan) > 0)
                            <div class="reviews-list">
                                @foreach($ulasan as $value)
                                    <div class="review-item">
                                        <div class="review-avatar">
                                            <img src="{{ asset('images/fotoprofil') }}/{{ $value->fotoprofil }}"
                                                onerror="this.src='{{ asset('images/fotoprofil/default.png') }}'">
                                        </div>
                                        <div class="review-content">
                                            <div class="review-header">
                                                <h4>{{ $value->namapelanggan }}</h4>
                                                <span
                                                    class="review-date">{{ \Carbon\Carbon::parse($value->tanggalulasan)->format('d M Y') }}</span>
                                            </div>
                                            <div class="review-rating">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <i class="fas fa-star {{ $i <= $value->nilairating ? 'active' : '' }}"></i>
                                                @endfor
                                            </div>
                                            <p class="review-text">{{ $value->isiulasan }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="empty-state">
                                <i class="fas fa-comments"></i>
                                <p>Belum ada ulasan dari pelanggan</p>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- CTA --}}
                <div class="cta-section animate-fadeIn stagger-3">
                    <div class="cta-content">
                        <h3>Tertarik dengan layanan ini?</h3>
                        <p>Pesan sekarang dan jadilah pelanggan berikutnya</p>
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

        .reviews-summary {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            padding: var(--space-8);
            text-align: center;
            margin-bottom: var(--space-6);
        }

        .summary-rating .big-rating {
            font-family: var(--font-display);
            font-size: 4rem;
            font-weight: 700;
            color: var(--text-primary);
            display: block;
        }

        .summary-rating .stars {
            color: #fbbf24;
            font-size: 1.5rem;
            margin: var(--space-2) 0;
        }

        .summary-rating .review-count {
            color: var(--text-tertiary);
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

        .form-group {
            margin-bottom: var(--space-5);
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: 0.9rem;
            font-weight: 500;
            color: var(--text-secondary);
            margin-bottom: var(--space-2);
        }

        .form-control {
            width: 100%;
            padding: var(--space-3) var(--space-4);
            background: var(--bg-tertiary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-lg);
            color: var(--text-primary);
        }

        .form-control:focus {
            outline: none;
            border-color: var(--success);
        }

        .star-rating-input {
            display: flex;
            flex-direction: row-reverse;
            justify-content: flex-end;
            gap: var(--space-1);
        }

        .star-rating-input input {
            display: none;
        }

        .star-rating-input label {
            cursor: pointer;
            font-size: 1.5rem;
            color: var(--border-primary);
            transition: color 0.2s;
        }

        .star-rating-input input:checked~label,
        .star-rating-input label:hover,
        .star-rating-input label:hover~label {
            color: #fbbf24;
        }

        .reviews-list {
            display: flex;
            flex-direction: column;
            gap: var(--space-4);
        }

        .review-item {
            display: flex;
            gap: var(--space-4);
            padding: var(--space-5);
            background: var(--bg-tertiary);
            border-radius: var(--radius-lg);
        }

        .review-avatar img {
            width: 50px;
            height: 50px;
            border-radius: var(--radius-lg);
            object-fit: cover;
        }

        .review-content {
            flex: 1;
        }

        .review-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: var(--space-2);
        }

        .review-header h4 {
            font-size: 0.95rem;
        }

        .review-date {
            font-size: 0.8rem;
            color: var(--text-tertiary);
        }

        .review-rating {
            margin-bottom: var(--space-2);
        }

        .review-rating i {
            font-size: 0.85rem;
            color: var(--border-primary);
        }

        .review-rating i.active {
            color: #fbbf24;
        }

        .review-text {
            color: var(--text-secondary);
            line-height: 1.6;
            margin: 0;
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
            .review-item {
                flex-direction: column;
            }

            .cta-section {
                flex-direction: column;
                text-align: center;
                gap: var(--space-4);
            }
        }
    </style>
@endsection