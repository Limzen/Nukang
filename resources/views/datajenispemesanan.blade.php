@extends('app')

@section('title', 'Data Jenis Pemesanan - Nukang')

@section('content')
<div class="data-page">
    <div class="container">
        {{-- Page Header --}}
        <div class="page-header animate-fadeIn">
            <div class="header-icon">
                <i class="fas fa-clipboard-list"></i>
            </div>
            <div class="header-text">
                <h1>Data Jenis Pemesanan</h1>
                <p>Kelola jenis layanan yang tersedia</p>
            </div>
            <a href="{{ url('datajenispemesanan') }}/create" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Data
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
                <div class="stat-icon"><i class="fas fa-list-alt"></i></div>
                <div class="stat-info">
                    <span class="stat-number">{{ count($jenispemesanan) }}</span>
                    <span class="stat-label">Total Jenis</span>
                </div>
            </div>
        </div>

        {{-- Data Table --}}
        <div class="data-card animate-fadeIn">
            <div class="card-header">
                <h3><i class="fas fa-table"></i> Daftar Jenis Pemesanan</h3>
            </div>
            <div class="table-wrapper">
                <table class="data-table" id="exampleRiwayatTransaksi">
                    <thead>
                        <tr>
                            <th width="60">No</th>
                            <th>Kategori Tukang</th>
                            <th>Jenis Pemesanan</th>
                            <th width="120">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($jenispemesanan as $value)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>
                                <span class="category-badge">{{ $value->kategoritukang }}</span>
                            </td>
                            <td>
                                <div class="item-name">
                                    <div class="item-icon"><i class="fas fa-wrench"></i></div>
                                    <span>{{ $value->jenispemesanan }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ url('datajenispemesanan') }}/{{ $value->id_jenispemesanan }}/edit" 
                                       class="btn-action btn-edit" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form method="POST" action="{{ url('datajenispemesanan') }}/{{ $value->id_jenispemesanan }}" 
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
.data-page { padding: var(--space-6) 0 var(--space-16); }

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
    background: var(--gradient-primary);
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

.stats-row { display: flex; gap: var(--space-4); margin-bottom: var(--space-6); }

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
    background: rgba(16, 185, 129, 0.1);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--success);
    font-size: 1.25rem;
}

.stat-number { display: block; font-family: var(--font-display); font-size: 1.5rem; font-weight: 700; }
.stat-label { font-size: 0.85rem; color: var(--text-tertiary); }

.data-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    overflow: hidden;
}

.card-header {
    display: flex;
    align-items: center;
    padding: var(--space-5);
    background: var(--bg-tertiary);
    border-bottom: 1px solid var(--border-primary);
}

.card-header h3 { display: flex; align-items: center; gap: var(--space-2); font-size: 1rem; margin: 0; }
.card-header i { color: var(--success); }

.table-wrapper { overflow-x: auto; }

.data-table { width: 100%; border-collapse: collapse; }

.data-table th, .data-table td {
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

.data-table tbody tr:hover { background: var(--bg-tertiary); }

.category-badge {
    padding: var(--space-1) var(--space-3);
    background: rgba(139, 92, 246, 0.1);
    color: #8b5cf6;
    border-radius: var(--radius-full);
    font-size: 0.8rem;
    font-weight: 500;
}

.item-name { display: flex; align-items: center; gap: var(--space-3); }

.item-icon {
    width: 32px;
    height: 32px;
    background: var(--gradient-primary);
    border-radius: var(--radius-md);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 0.8rem;
}

.action-buttons { display: flex; gap: var(--space-2); }

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

.btn-edit { background: rgba(59, 130, 246, 0.1); color: #3b82f6; }
.btn-edit:hover { background: #3b82f6; color: white; }
.btn-delete { background: rgba(239, 68, 68, 0.1); color: var(--danger); }
.btn-delete:hover { background: var(--danger); color: white; }
</style>
@endsection

@section('datatable')
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('js/dataTables.bootstrap.min.js') }}"></script>
@endsection