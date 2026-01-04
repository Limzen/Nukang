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
                <button type="button" class="btn btn-primary" onclick="showCreateModal()">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
            </div>

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
                    <table class="data-table">
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
                                            <button type="button" class="btn-action btn-edit" title="Edit"
                                                onclick="showEditModal({{ $value->id_jenispemesanan }}, '{{ addslashes($value->jenispemesanan) }}', {{ $value->id_kategoritukang }})">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn-action btn-delete" title="Hapus"
                                                onclick="showDeleteModal({{ $value->id_jenispemesanan }}, '{{ addslashes($value->jenispemesanan) }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
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

    {{-- Create/Edit Modal --}}
    <div class="modal-overlay" id="formModal">
        <div class="modal-container">
            <div class="modal-header">
                <div class="modal-header-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <div class="modal-header-text">
                    <h2 id="modalTitle">Tambah Jenis Pemesanan</h2>
                    <p id="modalSubtitle">Isi form di bawah untuk menambahkan data baru</p>
                </div>
                <button type="button" class="modal-close" onclick="hideFormModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="formJenisPemesanan" method="POST" action="{{ url('datajenispemesanan') }}">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="modal-body">
                    <div class="form-group">
                        <label for="kategoritukang">
                            <i class="fas fa-tag"></i> Kategori Tukang <span class="required">*</span>
                        </label>
                        <select name="kategoritukang" id="kategoritukang" class="form-control" required>
                            @foreach($kategoritukang as $kat)
                                <option value="{{ $kat->id_kategoritukang }}">{{ $kat->kategoritukang }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="jenispemesanan">
                            <i class="fas fa-clipboard"></i> Jenis Pemesanan <span class="required">*</span>
                        </label>
                        <input type="text" name="jenispemesanan" id="jenispemesanan" class="form-control"
                            placeholder="Contoh: Perbaikan AC, Instalasi Listrik" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="hideFormModal()">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> <span id="submitBtnText">Simpan</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-container modal-sm">
            <div class="delete-modal-icon">
                <i class="fas fa-exclamation-triangle"></i>
            </div>
            <h3>Konfirmasi Hapus</h3>
            <p>Apakah Anda yakin ingin menghapus <strong id="deleteItemName"></strong>?</p>
            <p class="delete-warning">Tindakan ini tidak dapat dibatalkan.</p>
            <div class="modal-footer centered">
                <button type="button" class="btn btn-secondary" onclick="hideDeleteModal()">
                    <i class="fas fa-times"></i> Batal
                </button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash"></i> Hapus
                    </button>
                </form>
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
            background: var(--gradient-primary);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            color: white;
        }

        .header-text {
            flex: 1;
        }

        .header-text h1 {
            font-size: 1.75rem;
            margin-bottom: var(--space-1);
        }

        .header-text p {
            color: var(--text-secondary);
        }

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
            background: rgba(16, 185, 129, 0.1);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--success);
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

        .category-badge {
            padding: var(--space-1) var(--space-3);
            background: rgba(139, 92, 246, 0.1);
            color: #8b5cf6;
            border-radius: var(--radius-full);
            font-size: 0.8rem;
            font-weight: 500;
        }

        .item-name {
            display: flex;
            align-items: center;
            gap: var(--space-3);
        }

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

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.85);
            backdrop-filter: blur(8px);
            z-index: 1100;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: var(--space-4);
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-container {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-2xl);
            max-width: 500px;
            width: 100%;
            max-height: 90vh;
            overflow-y: auto;
            transform: translateY(20px) scale(0.95);
            transition: transform 0.3s ease;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        }

        .modal-overlay.active .modal-container {
            transform: translateY(0) scale(1);
        }

        .modal-container.modal-sm {
            max-width: 420px;
            text-align: center;
            padding: var(--space-8);
        }

        .modal-header {
            display: flex;
            align-items: center;
            gap: var(--space-4);
            padding: var(--space-6);
            border-bottom: 1px solid var(--border-primary);
            background: linear-gradient(to bottom, rgba(16, 185, 129, 0.05), transparent);
        }

        .modal-header-icon {
            width: 56px;
            height: 56px;
            background: var(--gradient-primary);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            flex-shrink: 0;
        }

        .modal-header-text {
            flex: 1;
        }

        .modal-header-text h2 {
            font-size: 1.25rem;
            margin-bottom: var(--space-1);
        }

        .modal-header-text p {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .modal-close {
            width: 40px;
            height: 40px;
            background: var(--bg-tertiary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-lg);
            color: var(--text-secondary);
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            font-size: 1.1rem;
        }

        .modal-close:hover {
            background: var(--danger);
            border-color: var(--danger);
            color: white;
        }

        .modal-body {
            padding: var(--space-6);
        }

        .form-group {
            margin-bottom: var(--space-5);
        }

        .form-group label {
            display: flex;
            align-items: center;
            gap: var(--space-2);
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-secondary);
            margin-bottom: var(--space-2);
        }

        .form-group label i {
            color: var(--success);
            font-size: 0.9rem;
        }

        .required {
            color: var(--danger);
        }

        .form-control {
            width: 100%;
            padding: var(--space-3) var(--space-4);
            background: var(--bg-tertiary);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-lg);
            color: var(--text-primary);
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: var(--success);
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-tertiary);
        }

        select.form-control {
            cursor: pointer;
        }

        .modal-footer {
            display: flex;
            gap: var(--space-3);
            padding: var(--space-6);
            border-top: 1px solid var(--border-primary);
            background: var(--bg-tertiary);
        }

        .modal-footer.centered {
            justify-content: center;
            border-top: none;
            background: transparent;
            padding-top: var(--space-4);
        }

        .modal-footer .btn {
            flex: 1;
        }

        .modal-footer .btn-secondary {
            background: var(--bg-secondary);
            border: 1px solid var(--border-primary);
        }

        /* Delete Modal */
        .delete-modal-icon {
            width: 80px;
            height: 80px;
            background: rgba(239, 68, 68, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-5);
            font-size: 2rem;
            color: var(--danger);
        }

        .modal-container.modal-sm h3 {
            font-size: 1.5rem;
            margin-bottom: var(--space-3);
        }

        .modal-container.modal-sm p {
            color: var(--text-secondary);
            margin-bottom: var(--space-2);
        }

        .delete-warning {
            font-size: 0.85rem;
            color: var(--danger);
            margin-bottom: var(--space-6) !important;
        }

        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                text-align: center;
                gap: var(--space-4);
            }

            .modal-footer {
                flex-direction: column;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Form Modal Functions
        let editId = null;

        function showCreateModal() {
            editId = null;
            const modal = document.getElementById('formModal');
            const form = document.getElementById('formJenisPemesanan');

            form.reset();
            form.action = '{{ url("datajenispemesanan") }}';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('modalTitle').textContent = 'Tambah Jenis Pemesanan';
            document.getElementById('modalSubtitle').textContent = 'Isi form di bawah untuk menambahkan data baru';
            document.getElementById('submitBtnText').textContent = 'Simpan';

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function showEditModal(id, nama, kategori) {
            editId = id;
            const modal = document.getElementById('formModal');
            const form = document.getElementById('formJenisPemesanan');

            form.action = '{{ url("datajenispemesanan") }}/' + id;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('jenispemesanan').value = nama;
            document.getElementById('kategoritukang').value = kategori;
            document.getElementById('modalTitle').textContent = 'Edit Jenis Pemesanan';
            document.getElementById('modalSubtitle').textContent = 'Perbarui informasi jenis pemesanan';
            document.getElementById('submitBtnText').textContent = 'Update';

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideFormModal() {
            const modal = document.getElementById('formModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Delete Modal Functions
        function showDeleteModal(id, name) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const itemName = document.getElementById('deleteItemName');

            form.action = '{{ url("datajenispemesanan") }}/' + id;
            itemName.textContent = name;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Close modals on overlay click
        document.querySelectorAll('.modal-overlay').forEach(modal => {
            modal.addEventListener('click', function (e) {
                if (e.target === this) {
                    this.classList.remove('active');
                    document.body.style.overflow = '';
                }
            });
        });

        // Close modal on Escape key
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') {
                document.querySelectorAll('.modal-overlay.active').forEach(modal => {
                    modal.classList.remove('active');
                });
                document.body.style.overflow = '';
            }
        });
    </script>
@endsection