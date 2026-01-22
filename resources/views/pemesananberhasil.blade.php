@extends('app')

@section('title', 'Pemesanan Berhasil - Nukang')

@section('content')
    <div class="success-page">
        <div class="success-card">
            {{-- Success Icon --}}
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>

            {{-- Success Message --}}
            <h1>Pemesanan Berhasil! 🎉</h1>
            <p class="subtitle">Pesanan telah dikirim ke tukang</p>

            {{-- Order Summary --}}
            <div class="order-summary">
                <div class="summary-row">
                    <span>No. Pesanan</span>
                    <strong>{{ $pesanan->nomorpemesanan }}</strong>
                </div>
                <div class="summary-row">
                    <span>Tukang</span>
                    <strong>{{ $tukang->namatukang }}</strong>
                </div>
                <div class="summary-row">
                    <span>Jasa</span>
                    <strong>{{ $jenispemesanan->namajenispemesanan ?? 'Renovasi' }}</strong>
                </div>
                <div class="summary-row">
                    <span>Tanggal</span>
                    <strong>{{ \Carbon\Carbon::parse($pesanan->tanggalbekerja)->format('d M Y') }}</strong>
                </div>
                <div class="summary-row total">
                    <span>Total</span>
                    <strong>Rp {{ number_format($pesanan->biayajasa, 0, ',', '.') }}</strong>
                </div>
            </div>

            {{-- Status --}}
            <div class="status-badge">
                <i class="fas fa-clock"></i> Menunggu Konfirmasi
            </div>

            {{-- Buttons --}}
            <div class="btn-group">
                <a href="{{ url('riwayatpemesanan') }}" class="btn-action btn-primary-custom">
                    <i class="fas fa-history"></i> Lihat Riwayat
                </a>
                <form action="{{ url('pemesanan/' . $pesanan->id_pemesanan . '/batalkan') }}" method="POST" class="btn-form"
                    onsubmit="return confirm('Batalkan pesanan? Saldo akan dikembalikan.');">
                    @csrf
                    <button type="submit" class="btn-action btn-danger-custom">
                        <i class="fas fa-times"></i> Batalkan
                    </button>
                </form>
            </div>

            <a href="{{ url('home') }}" class="home-link">
                <i class="fas fa-home"></i> Kembali ke Dashboard
            </a>
        </div>
    </div>

    <style>
        .success-page {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .success-card {
            width: 100%;
            max-width: 400px;
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: 1.5rem;
            padding: 2rem;
            text-align: center;
        }

        .success-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 1rem;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            color: white;
            box-shadow: 0 8px 25px rgba(16, 185, 129, 0.4);
            animation: pop 0.4s ease-out;
        }

        @keyframes pop {
            0% {
                transform: scale(0);
            }

            80% {
                transform: scale(1.1);
            }

            100% {
                transform: scale(1);
            }
        }

        .success-card h1 {
            font-size: 1.4rem;
            margin-bottom: 0.25rem;
            color: var(--success);
        }

        .subtitle {
            color: var(--text-secondary);
            font-size: 0.9rem;
            margin-bottom: 1.5rem;
        }

        .order-summary {
            background: var(--bg-tertiary);
            border-radius: 0.75rem;
            padding: 1rem;
            margin-bottom: 1rem;
            text-align: left;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            border-bottom: 1px solid var(--border-primary);
            font-size: 0.85rem;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-row span {
            color: var(--text-tertiary);
        }

        .summary-row strong {
            color: var(--text-primary);
        }

        .summary-row.total {
            margin-top: 0.5rem;
            padding-top: 0.75rem;
            border-top: 1px dashed var(--border-primary);
            border-bottom: none;
        }

        .summary-row.total strong {
            color: var(--success);
            font-size: 1rem;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: rgba(245, 158, 11, 0.15);
            color: #f59e0b;
            border-radius: 2rem;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }

        /* Fixed Button Group */
        .btn-group {
            display: flex;
            gap: 0.75rem;
            margin-bottom: 1.5rem;
        }

        .btn-form {
            flex: 1;
        }

        .btn-action {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            flex: 1;
            padding: 0.875rem 1rem;
            border-radius: 0.75rem;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            border: none;
        }

        .btn-primary-custom {
            background: var(--gradient-primary);
            color: white;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.3);
        }

        .btn-primary-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .btn-danger-custom {
            width: 100%;
            background: transparent;
            border: 2px solid #ef4444;
            color: #ef4444;
        }

        .btn-danger-custom:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        .home-link {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
            color: var(--text-tertiary);
            font-size: 0.85rem;
            padding-top: 1rem;
            border-top: 1px solid var(--border-primary);
            text-decoration: none;
        }

        .home-link:hover {
            color: var(--success);
        }

        @media (max-width: 480px) {
            .success-card {
                padding: 1.5rem;
            }

            .btn-group {
                flex-direction: column;
            }

            .btn-action {
                width: 100%;
            }
        }
    </style>
@endsection