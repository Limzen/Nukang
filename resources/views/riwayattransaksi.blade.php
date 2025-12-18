@extends('app')

@section('title', 'Riwayat Transaksi - Nukang')

@section('content')
<div class="transaction-page">
    <div class="container">
        {{-- Page Header --}}
        <div class="page-header animate-fadeIn">
            <div class="header-icon">
                <i class="fas fa-exchange-alt"></i>
            </div>
            <div class="header-text">
                <h1>Riwayat Transaksi</h1>
                <p>Pantau semua transaksi saldo Anda</p>
            </div>
        </div>

        {{-- Stats Row --}}
        <div class="stats-row animate-fadeIn">
            @php
                $total = $riwayattransaksi->count();
                $topup = $riwayattransaksi->where('jenistransaksi', 'Top Up')->count();
                $withdraw = $riwayattransaksi->where('jenistransaksi', 'Penarikan')->count();
            @endphp
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-list"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ $total }}</span>
                    <span class="stat-label">Total Transaksi</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-icon-green"><i class="fas fa-plus-circle"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ $topup }}</span>
                    <span class="stat-label">Top Up</span>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon stat-icon-orange"><i class="fas fa-minus-circle"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ $withdraw }}</span>
                    <span class="stat-label">Penarikan</span>
                </div>
            </div>
        </div>

        {{-- Table --}}
        <div class="data-card animate-fadeIn">
            <div class="card-header">
                <h3><i class="fas fa-table"></i> Daftar Transaksi</h3>
            </div>
            <div class="table-wrapper">
                <table class="data-table" id="exampleRiwayatTransaksi">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode</th>
                            <th>Tanggal</th>
                            <th>Rekening</th>
                            <th>Nama</th>
                            <th>Jumlah</th>
                            <th>Tujuan</th>
                            <th>Jenis</th>
                            <th>Bukti</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($riwayattransaksi as $value)
                        <tr>
                            <td>{{ $i }}</td>
                            <td><code>{{ $value->kode }}</code></td>
                            <td>{{ $value->created_at }}</td>
                            <td>{{ $value->rekening }}</td>
                            <td>{{ $value->namarekening }}</td>
                            <td class="amount">Rp {{ number_format($value->jumlahsaldo, 0, ',', '.') }}</td>
                            <td>{{ $value->rekeningtujuan }}</td>
                            <td>
                                <span class="badge {{ $value->jenistransaksi == 'Top Up' ? 'badge-success' : 'badge-warning' }}">
                                    {{ $value->jenistransaksi }}
                                </span>
                            </td>
                            <td>
                                @if($value->buktitransaksi)
                                <a href="{{ asset('images/buktitransfer') }}/{{ $value->buktitransaksi }}" target="_blank" class="btn btn-sm btn-ghost">
                                    <i class="fas fa-image"></i>
                                </a>
                                @else
                                <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>@include('include/statustransaksi')</td>
                        </tr>
                        @php $i++; @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.transaction-page {
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
    background: var(--gradient-primary);
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

/* Stats Row */
.stats-row {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
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

.stat-icon-green { background: rgba(16, 185, 129, 0.1); color: var(--success); }
.stat-icon-orange { background: rgba(245, 158, 11, 0.1); color: #f59e0b; }

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

/* Data Card */
.data-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-5);
    background: var(--bg-tertiary);
    border-bottom: 1px solid var(--border-primary);
}

.card-header h3 {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 1rem;
    margin: 0;
}

.card-header i {
    color: var(--success);
}

/* Table */
.table-wrapper {
    overflow-x: auto;
}

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th,
.data-table td {
    padding: var(--space-4);
    text-align: left;
    border-bottom: 1px solid var(--border-primary);
    font-size: 0.9rem;
}

.data-table th {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    color: var(--text-tertiary);
    background: var(--bg-secondary);
}

.data-table tbody tr:hover {
    background: var(--bg-tertiary);
}

.data-table code {
    padding: var(--space-1) var(--space-2);
    background: var(--bg-tertiary);
    border-radius: var(--radius-sm);
    font-size: 0.8rem;
}

.amount {
    font-weight: 600;
    color: var(--success);
}

.badge {
    display: inline-block;
    padding: var(--space-1) var(--space-3);
    border-radius: var(--radius-full);
    font-size: 0.75rem;
    font-weight: 600;
}

.badge-success {
    background: rgba(16, 185, 129, 0.1);
    color: var(--success);
}

.badge-warning {
    background: rgba(245, 158, 11, 0.1);
    color: #f59e0b;
}

.text-muted {
    color: var(--text-tertiary);
}
</style>
@endsection

@section('datatable')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
@endsection