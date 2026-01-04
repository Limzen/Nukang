<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $value->nomorpemesanan }} - Nukang</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
            color: #1e293b;
            padding: 2rem;
        }
        
        .invoice {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .invoice-header {
            background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
            color: white;
            padding: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .logo-icon {
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
        }
        
        .logo-text {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
        }
        
        .invoice-title {
            text-align: right;
        }
        
        .invoice-title h1 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }
        
        .invoice-title .number {
            opacity: 0.9;
            font-size: 0.9rem;
        }
        
        .invoice-body {
            padding: 2rem;
        }
        
        .info-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
            padding-bottom: 2rem;
            border-bottom: 1px solid #e2e8f0;
        }
        
        .info-box h3 {
            font-size: 0.75rem;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 0.75rem;
            letter-spacing: 0.05em;
        }
        
        .info-box .name {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }
        
        .info-box .code {
            color: #10b981;
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .info-box .category {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            background: rgba(16, 185, 129, 0.1);
            color: #10b981;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            margin-top: 0.5rem;
        }
        
        .details-section {
            margin-bottom: 2rem;
        }
        
        .details-section h3 {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid #10b981;
            display: inline-block;
        }
        
        .detail-row {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f5f9;
        }
        
        .detail-row:last-child {
            border-bottom: none;
        }
        
        .detail-label {
            color: #64748b;
            font-size: 0.9rem;
        }
        
        .detail-value {
            font-weight: 500;
            text-align: right;
        }
        
        .materials-section {
            background: #f8fafc;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }
        
        .materials-section h3 {
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .material-item {
            display: flex;
            justify-content: space-between;
            padding: 0.5rem 0;
            font-size: 0.9rem;
        }
        
        .material-name {
            color: #475569;
        }
        
        .material-qty {
            font-weight: 500;
        }
        
        .empty-materials {
            color: #94a3b8;
            font-size: 0.9rem;
            text-align: center;
            padding: 1rem 0;
        }
        
        .total-section {
            background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
            border-radius: 12px;
            padding: 1.5rem;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .total-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .total-value {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 1.75rem;
            font-weight: 700;
        }
        
        .invoice-footer {
            text-align: center;
            padding: 1.5rem 2rem;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
        }
        
        .footer-text {
            font-size: 0.8rem;
            color: #64748b;
        }
        
        .print-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, #10b981 0%, #14b8a6 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            margin-bottom: 1rem;
        }
        
        .print-btn:hover {
            opacity: 0.9;
        }
        
        @media print {
            body { padding: 0; background: white; }
            .invoice { box-shadow: none; }
            .print-btn { display: none; }
        }
    </style>
</head>
<body>
    <div style="text-align: center; margin-bottom: 1rem;">
        <button class="print-btn" onclick="window.print()">
            🖨️ Cetak Invoice
        </button>
    </div>
    
    <div class="invoice">
        <div class="invoice-header">
            <div class="logo">
                <div class="logo-icon">🔧</div>
                <span class="logo-text">Nukang</span>
            </div>
            <div class="invoice-title">
                <h1>INVOICE</h1>
                <div class="number">#{{ $value->nomorpemesanan }}</div>
            </div>
        </div>
        
        <div class="invoice-body">
            <div class="info-section">
                <div class="info-box">
                    <h3>Penyedia Jasa</h3>
                    <div class="name">{{ $value->namatukang }}</div>
                    <div class="code">{{ $value->kodeuser }}</div>
                    <span class="category">{{ $value->kategoritukang }}</span>
                </div>
                <div class="info-box" style="text-align: right;">
                    <h3>Status</h3>
                    @include('include/statuspemesanan')
                </div>
            </div>
            
            <div class="details-section">
                <h3>Detail Pemesanan</h3>
                <div class="detail-row">
                    <span class="detail-label">Tanggal Kedatangan</span>
                    <span class="detail-value">{{ $value->tanggalbekerja }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Alamat Pengerjaan</span>
                    <span class="detail-value">{{ $value->alamatpemesanan }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Jenis Pemesanan</span>
                    <span class="detail-value">@include('include/harianorborongan')</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Jasa Yang Dipilih</span>
                    <span class="detail-value">{{ $value->jenispemesanan }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Biaya Jasa</span>
                    <span class="detail-value">Rp {{ number_format($value->biayajasa, 0, ',', '.') }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">Biaya Pengantaran ({{ $jarak }} Km)</span>
                    <span class="detail-value">Rp {{ number_format($jarak * $hargajarak->hargajarak, 0, ',', '.') }}</span>
                </div>
                @if($value->catatan)
                <div class="detail-row">
                    <span class="detail-label">Catatan</span>
                    <span class="detail-value">{{ $value->catatan }}</span>
                </div>
                @endif
            </div>
            
            <div class="materials-section">
                <h3>📦 Bahan Material</h3>
                @if(count($pemesananbahan) > 0)
                    @php $i = 1; @endphp
                    @foreach($pemesananbahan as $item)
                    <div class="material-item">
                        <span class="material-name">{{ $i }}. {{ $item->kodebahanmaterial }} - {{ $item->bahanmaterial }}</span>
                        <span class="material-qty">{{ $item->qtypembelian }}x @ Rp {{ number_format($item->hargapemesananbahanmaterial, 0, ',', '.') }}</span>
                    </div>
                    @php $i++; @endphp
                    @endforeach
                @else
                    <div class="empty-materials">Tidak ada bahan material</div>
                @endif
            </div>
            
            <div class="total-section">
                <div class="total-label">Total Pembayaran</div>
                <div class="total-value">Rp {{ number_format($biayajasa + $totalkeranjang + ($jarak * $hargajarak->hargajarak), 0, ',', '.') }}</div>
            </div>
        </div>
        
        <div class="invoice-footer">
            <p class="footer-text">Terima kasih telah menggunakan layanan Nukang</p>
            <p class="footer-text">Invoice ini digenerate secara otomatis oleh sistem</p>
        </div>
    </div>
</body>
</html>