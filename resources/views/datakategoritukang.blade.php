@extends('app')

@section('title', 'Data Kategori Tukang - Nukang')

@section('content')
<div class="data-page">
    <div class="container">
        {{-- Page Header --}}
        <div class="page-header animate-fadeIn">
            <div class="header-icon">
                <i class="fas fa-tags"></i>
            </div>
            <div class="header-text">
                <h1>Data Kategori Tukang</h1>
                <p>Kelola kategori jenis tukang yang tersedia</p>
            </div>
            <a href="{{ url('datakategoritukang') }}/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Kategori
            </a>
        </div>

        {{-- Alerts --}}
        @if(Session::has('message_success'))
            <div class="alert alert-success animate-fadeIn">
                <div class="alert-icon"><i class="fas fa-check-circle"></i></div>
                <div class="alert-content">{{ Session::get('message_success') }}</div>
            </div>
        @endif
        @if(Session::has('message_failed'))
            <div class="alert alert-danger animate-fadeIn">
                <div class="alert-icon"><i class="fas fa-exclamation-circle"></i></div>
                <div class="alert-content">{{ Session::get('message_failed') }}</div>
            </div>
        @endif

        {{-- Stats --}}
        <div class="stats-row animate-fadeIn">
            <div class="stat-card">
                <div class="stat-icon"><i class="fas fa-layer-group"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ count($kategoritukang) }}</span>
                    <span class="stat-label">Total Kategori</span>
                </div>
            </div>
        </div>

        {{-- Data Table --}}
        <div class="data-card animate-fadeIn">
            <div class="card-header">
                <h3><i class="fas fa-table"></i> Daftar Kategori</h3>
            </div>
            <div class="table-wrapper">
                <table class="data-table" id="exampleRiwayatTransaksi">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Kategori Tukang</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($kategoritukang as $value)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <div class="category-name">
                                    <div class="category-icon"><i class="fas fa-hard-hat"></i></div>
                                    <span>{{ $value->kategoritukang }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ url('datakategoritukang') }}/{{ $value->id_kategoritukang }}/edit" 
                                       class="btn-action btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ url('datakategoritukang') }}/{{ $value->id_kategoritukang }}" 
                                          style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
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
.data-page {
    padding: var(--space-6) 0 var(--space-16);
}

.page-header {
    display: flex;
    align-items: center;
    gap: var(--space-5);
    margin-bottom: var(--space-8);
    flex-wrap: wrap;
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

.header-text { flex: 1; }
.header-text h1 { font-size: 1.75rem; margin-bottom: var(--space-1); }
.header-text p { color: var(--text-secondary); }

/* Stats */
.stats-row {
    display: flex;
    gap: var(--space-4);
    margin-bottom: var(--space-6);
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
    background: rgba(139, 92, 246, 0.1);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #8b5cf6;
    font-size: 1.25rem;
}

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

.card-header i { color: var(--success); }

/* Table */
.table-wrapper { overflow-x: auto; }

.data-table {
    width: 100%;
    border-collapse: collapse;
}

.data-table th,
.data-table td {
    padding: var(--space-4);
    text-align: left;
    border-bottom: 1px solid var(--border-primary);
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

.category-name {
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

.category-icon {
    width: 36px;
    height: 36px;
    background: var(--gradient-primary);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.9rem;
}

.action-buttons {
    display: flex;
    gap: var(--space-2);
}

.btn-action {
    width: 36px;
    height: 36px;
    border: none;
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.2s ease;
}

.btn-edit {
    background: rgba(59, 130, 246, 0.1);
    color: #3b82f6;
}

.btn-edit:hover {
    background: #3b82f6;
    color: white;
}

.btn-delete {
    background: rgba(239, 68, 68, 0.1);
    color: var(--danger);
}

.btn-delete:hover {
    background: var(--danger);
    color: white;
}
</style>
@endsection

@section('datatable')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
@endsection