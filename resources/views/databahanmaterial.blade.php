@extends('app')

@section('title', 'Data Bahan Material - Nukang')

@section('content')
    <div class="data-page">
        <div class="container">
            {{-- Page Header --}}
            <div class="page-header animate-fadeIn">
                <div class="header-icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <div class="header-text">
                    <h1>Data Bahan Material</h1>
                    <p>Kelola inventaris bahan material</p>
                </div>
                <button type="button" class="btn btn-primary" onclick="showMaterialModal()">
                    <i class="fas fa-plus"></i> Tambah Data
                </button>
            </div>

            {{-- Stats --}}
            <div class="stats-row animate-fadeIn">
                @php
                    $total = count($bahanmaterial);
                    $tersedia = collect($bahanmaterial)->where('statusbahanmaterial', '1')->count();
                @endphp
                <div class="stat-card">
                    <div class="stat-icon"><i class="fas fa-cubes"></i></div>
                    <div class="stat-info">
                        <span class="stat-number">{{ $total }}</span>
                        <span class="stat-label">Total Material</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-green"><i class="fas fa-check-circle"></i></div>
                    <div class="stat-info">
                        <span class="stat-number">{{ $tersedia }}</span>
                        <span class="stat-label">Tersedia</span>
                    </div>
                </div>
                <div class="stat-card">
                    <div class="stat-icon stat-icon-red"><i class="fas fa-times-circle"></i></div>
                    <div class="stat-info">
                        <span class="stat-number">{{ $total - $tersedia }}</span>
                        <span class="stat-label">Tidak Tersedia</span>
                    </div>
                </div>
            </div>

            {{-- Material Grid --}}
            @if(count($bahanmaterial) > 0)
                <div class="material-grid">
                    @php $i = 1; @endphp
                    @foreach($bahanmaterial as $value)
                        <div class="material-card animate-fadeIn" style="animation-delay: {{ min($i * 0.05, 0.5) }}s">
                            <div class="material-image">
                                <a href="{{ asset('images/fotobahanmaterial') }}/{{ $value->fotobahanmaterial }}" target="_blank">
                                    <img src="{{ asset('images/fotobahanmaterial') }}/{{ $value->fotobahanmaterial }}"
                                        alt="{{ $value->bahanmaterial }}">
                                </a>
                                <span
                                    class="material-status {{ $value->statusbahanmaterial == '1' ? 'status-available' : 'status-unavailable' }}">
                                    {{ $value->statusbahanmaterial == '1' ? 'Tersedia' : 'Tidak Tersedia' }}
                                </span>
                            </div>

                            <div class="material-body">
                                <div class="material-code">{{ $value->kodebahanmaterial }}</div>
                                <h4 class="material-name">{{ $value->bahanmaterial }}</h4>
                                <p class="material-info">{{ Str::limit($value->informasibahanmaterial, 60) }}</p>
                                <div class="material-price">
                                    Rp {{ number_format($value->hargabahanmaterial, 0, ',', '.') }}
                                </div>
                            </div>

                            <div class="material-actions">
                                <a href="{{ url('databahanmaterial') }}/{{ $value->id_bahanmaterial }}/ubahstatus"
                                    class="btn-action {{ $value->statusbahanmaterial == '1' ? 'btn-disable' : 'btn-enable' }}"
                                    title="{{ $value->statusbahanmaterial == '1' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                    <i class="fas {{ $value->statusbahanmaterial == '1' ? 'fa-times' : 'fa-check' }}"></i>
                                </a>
                                <button type="button" class="btn-action btn-edit" title="Edit"
                                    onclick="showEditModal({{ $value->id_bahanmaterial }}, '{{ addslashes($value->bahanmaterial) }}', {{ $value->hargabahanmaterial }}, '{{ addslashes($value->informasibahanmaterial) }}', {{ $value->id_kategoritukang }}, '{{ $value->fotobahanmaterial }}')">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button type="button" class="btn-action btn-delete" title="Hapus"
                                    onclick="showDeleteModal('{{ $value->id_bahanmaterial }}', '{{ $value->bahanmaterial }}')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        </div>
                        @php $i++; @endphp
                    @endforeach
                </div>
            @else
                <div class="empty-state animate-fadeIn">
                    <div class="empty-icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <h3>Belum Ada Bahan Material</h3>
                    <p>Tambahkan bahan material pertama Anda</p>
                    <button type="button" class="btn btn-primary" onclick="showMaterialModal()">
                        <i class="fas fa-plus"></i> Tambah Data
                    </button>
                </div>
            @endif
        </div>
    </div>

    {{-- Material Form Modal (Create/Edit) --}}
    <div class="modal-overlay" id="materialModal">
        <div class="modal-container">
            <div class="modal-header">
                <div class="modal-header-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <div class="modal-header-text">
                    <h2 id="modalTitle">Tambah Bahan Material</h2>
                    <p id="modalSubtitle">Isi form di bawah untuk menambahkan material baru</p>
                </div>
                <button type="button" class="modal-close" onclick="hideMaterialModal()">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            <form id="materialForm" method="POST" action="{{ url('databahanmaterial') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" name="oldfile" id="oldfile" value="">

                <div class="modal-body">
                    <div class="form-grid">
                        <div class="form-group">
                            <label for="kategoritukang">
                                <i class="fas fa-tag"></i> Kategori
                            </label>
                            <select name="kategoritukang" id="kategoritukang" class="form-control" required>
                                @foreach($kategoritukang as $kat)
                                    <option value="{{ $kat->id_kategoritukang }}">{{ $kat->kategoritukang }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="namabahan">
                                <i class="fas fa-cube"></i> Nama Bahan <span class="required">*</span>
                            </label>
                            <input type="text" name="namabahan" id="namabahan" class="form-control"
                                placeholder="Contoh: Semen Portland" required>
                        </div>

                        <div class="form-group">
                            <label for="hargabahanmaterial">
                                <i class="fas fa-money-bill-wave"></i> Harga <span class="required">*</span>
                            </label>
                            <div class="input-group">
                                <span class="input-prefix">Rp</span>
                                <input type="number" name="hargabahanmaterial" id="hargabahanmaterial" class="form-control"
                                    placeholder="0" required min="0">
                            </div>
                        </div>

                        <div class="form-group full-width">
                            <label for="informasibahanmaterial">
                                <i class="fas fa-info-circle"></i> Informasi Bahan <span class="required">*</span>
                            </label>
                            <textarea name="informasibahanmaterial" id="informasibahanmaterial" class="form-control"
                                rows="3" placeholder="Deskripsi lengkap bahan material..." required></textarea>
                        </div>

                        <div class="form-group full-width">
                            <label for="fotobahanmaterial">
                                <i class="fas fa-image"></i> Foto Bahan Material <span class="required"
                                    id="fotoRequired">*</span>
                            </label>
                            <div class="image-upload-area" id="uploadArea">
                                <div class="upload-placeholder" id="uploadPlaceholder">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Klik untuk upload atau drag & drop</p>
                                    <span>PNG, JPG, JPEG (Max. 5MB)</span>
                                </div>
                                <img src="" alt="Preview" class="image-preview" id="imagePreview">
                                <input type="file" name="fotobahanmaterial" id="fotobahanmaterial"
                                    accept="image/png,image/jpg,image/jpeg" hidden>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="hideMaterialModal()">
                        <i class="fas fa-times"></i> Batal
                    </button>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
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
            background: var(--gradient-gold);
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

        /* Stats */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
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
            background: rgba(245, 158, 11, 0.1);
            border-radius: var(--radius-lg);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #f59e0b;
            font-size: 1.25rem;
        }

        .stat-icon-green {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .stat-icon-red {
            background: rgba(239, 68, 68, 0.1);
            color: var(--danger);
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

        /* Material Grid */
        .material-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: var(--space-5);
        }

        .material-card {
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .material-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .material-image {
            position: relative;
            height: 160px;
            overflow: hidden;
        }

        .material-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .material-card:hover .material-image img {
            transform: scale(1.05);
        }

        .material-status {
            position: absolute;
            top: var(--space-3);
            right: var(--space-3);
            padding: var(--space-1) var(--space-3);
            border-radius: var(--radius-full);
            font-size: 0.7rem;
            font-weight: 600;
        }

        .status-available {
            background: rgba(16, 185, 129, 0.9);
            color: white;
        }

        .status-unavailable {
            background: rgba(239, 68, 68, 0.9);
            color: white;
        }

        .material-body {
            padding: var(--space-5);
        }

        .material-code {
            font-family: var(--font-mono);
            font-size: 0.75rem;
            color: var(--text-tertiary);
            margin-bottom: var(--space-1);
        }

        .material-name {
            font-size: 1rem;
            margin-bottom: var(--space-2);
        }

        .material-info {
            font-size: 0.85rem;
            color: var(--text-secondary);
            margin-bottom: var(--space-3);
            line-height: 1.5;
        }

        .material-price {
            font-family: var(--font-display);
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--success);
        }

        .material-actions {
            display: flex;
            gap: var(--space-2);
            padding: var(--space-4) var(--space-5);
            background: var(--bg-tertiary);
            border-top: 1px solid var(--border-primary);
        }

        .btn-action {
            flex: 1;
            height: 36px;
            border: none;
            border-radius: var(--radius-md);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .btn-enable {
            background: rgba(16, 185, 129, 0.1);
            color: var(--success);
        }

        .btn-enable:hover {
            background: var(--success);
            color: white;
        }

        .btn-disable {
            background: rgba(245, 158, 11, 0.1);
            color: #f59e0b;
        }

        .btn-disable:hover {
            background: #f59e0b;
            color: white;
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

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: var(--space-16);
            background: var(--bg-card);
            border: 1px solid var(--border-primary);
            border-radius: var(--radius-xl);
        }

        .empty-icon {
            width: 80px;
            height: 80px;
            background: rgba(245, 158, 11, 0.1);
            border-radius: var(--radius-xl);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto var(--space-5);
            font-size: 2rem;
            color: #f59e0b;
        }

        .empty-state h3 {
            font-size: 1.25rem;
            margin-bottom: var(--space-2);
        }

        .empty-state p {
            color: var(--text-tertiary);
            margin-bottom: var(--space-6);
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
            max-width: 600px;
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
            background: linear-gradient(to bottom, rgba(245, 158, 11, 0.05), transparent);
        }

        .modal-header-icon {
            width: 56px;
            height: 56px;
            background: var(--gradient-gold);
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: var(--space-5);
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: var(--space-2);
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--text-secondary);
            display: flex;
            align-items: center;
            gap: var(--space-2);
        }

        .form-group label i {
            color: #f59e0b;
            font-size: 0.9rem;
        }

        .required {
            color: var(--danger);
        }

        .form-control {
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
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        .form-control::placeholder {
            color: var(--text-tertiary);
        }

        textarea.form-control {
            resize: vertical;
            min-height: 100px;
        }

        select.form-control {
            cursor: pointer;
        }

        .input-group {
            display: flex;
            align-items: stretch;
        }

        .input-prefix {
            padding: var(--space-3) var(--space-4);
            background: rgba(245, 158, 11, 0.1);
            border: 1px solid var(--border-primary);
            border-right: none;
            border-radius: var(--radius-lg) 0 0 var(--radius-lg);
            color: #f59e0b;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .input-group .form-control {
            border-radius: 0 var(--radius-lg) var(--radius-lg) 0;
        }

        /* Image Upload Area */
        .image-upload-area {
            position: relative;
            border: 2px dashed var(--border-primary);
            border-radius: var(--radius-xl);
            padding: var(--space-8);
            text-align: center;
            cursor: pointer;
            transition: all 0.3s ease;
            overflow: hidden;
            min-height: 180px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .image-upload-area:hover {
            border-color: #f59e0b;
            background: rgba(245, 158, 11, 0.03);
        }

        .image-upload-area.has-image {
            padding: 0;
            border-style: solid;
        }

        .upload-placeholder {
            pointer-events: none;
        }

        .upload-placeholder i {
            font-size: 3rem;
            color: #f59e0b;
            margin-bottom: var(--space-3);
            display: block;
        }

        .upload-placeholder p {
            font-weight: 500;
            margin-bottom: var(--space-1);
        }

        .upload-placeholder span {
            font-size: 0.8rem;
            color: var(--text-tertiary);
        }

        .image-preview {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: none;
        }

        .image-upload-area.has-image .upload-placeholder {
            display: none;
        }

        .image-upload-area.has-image .image-preview {
            display: block;
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

        /* Delete Modal Specific */
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

        /* Responsive */
        @media (max-width: 768px) {
            .page-header {
                flex-direction: column;
                text-align: center;
                gap: var(--space-4);
            }

            .material-grid {
                grid-template-columns: 1fr;
            }

            .stats-row {
                grid-template-columns: 1fr;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }

            .modal-header {
                flex-wrap: wrap;
            }

            .modal-header-icon {
                width: 48px;
                height: 48px;
                font-size: 1.25rem;
            }

            .modal-footer {
                flex-direction: column;
            }
        }
    </style>
@endsection

@section('scripts')
    <script>
        // Material Modal Functions
        let isEditMode = false;
        let editId = null;

        function showMaterialModal() {
            isEditMode = false;
            editId = null;

            const modal = document.getElementById('materialModal');
            const form = document.getElementById('materialForm');

            // Reset form
            form.reset();
            form.action = '{{ url("databahanmaterial") }}';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('oldfile').value = '';
            document.getElementById('fotoRequired').style.display = '';
            document.getElementById('fotobahanmaterial').required = true;

            // Update modal title
            document.getElementById('modalTitle').textContent = 'Tambah Bahan Material';
            document.getElementById('modalSubtitle').textContent = 'Isi form di bawah untuk menambahkan material baru';
            document.getElementById('submitBtnText').textContent = 'Simpan';

            // Reset image preview
            const uploadArea = document.getElementById('uploadArea');
            const preview = document.getElementById('imagePreview');
            uploadArea.classList.remove('has-image');
            preview.src = '';

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function showEditModal(id, nama, harga, informasi, kategori, foto) {
            isEditMode = true;
            editId = id;

            const modal = document.getElementById('materialModal');
            const form = document.getElementById('materialForm');

            // Set form action for edit
            form.action = '{{ url("databahanmaterial") }}/' + id;
            document.getElementById('formMethod').value = 'PUT';
            document.getElementById('oldfile').value = foto;
            document.getElementById('fotoRequired').style.display = 'none';
            document.getElementById('fotobahanmaterial').required = false;

            // Fill form fields
            document.getElementById('namabahan').value = nama;
            document.getElementById('hargabahanmaterial').value = harga;
            document.getElementById('informasibahanmaterial').value = informasi;
            document.getElementById('kategoritukang').value = kategori;

            // Update modal title
            document.getElementById('modalTitle').textContent = 'Edit Bahan Material';
            document.getElementById('modalSubtitle').textContent = 'Perbarui informasi material';
            document.getElementById('submitBtnText').textContent = 'Update';

            // Show current image
            const uploadArea = document.getElementById('uploadArea');
            const preview = document.getElementById('imagePreview');
            preview.src = '{{ asset("images/fotobahanmaterial") }}/' + foto;
            uploadArea.classList.add('has-image');

            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideMaterialModal() {
            const modal = document.getElementById('materialModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Delete Modal Functions
        function showDeleteModal(id, name) {
            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const itemName = document.getElementById('deleteItemName');

            form.action = '{{ url("databahanmaterial") }}/' + id;
            itemName.textContent = name;
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function hideDeleteModal() {
            const modal = document.getElementById('deleteModal');
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Image Upload Handling
        const uploadArea = document.getElementById('uploadArea');
        const fileInput = document.getElementById('fotobahanmaterial');
        const imagePreview = document.getElementById('imagePreview');

        uploadArea.addEventListener('click', () => {
            fileInput.click();
        });

        fileInput.addEventListener('change', (e) => {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    uploadArea.classList.add('has-image');
                };
                reader.readAsDataURL(file);
            }
        });

        // Drag and drop
        uploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '#f59e0b';
            uploadArea.style.background = 'rgba(245, 158, 11, 0.05)';
        });

        uploadArea.addEventListener('dragleave', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '';
            uploadArea.style.background = '';
        });

        uploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            uploadArea.style.borderColor = '';
            uploadArea.style.background = '';

            const file = e.dataTransfer.files[0];
            if (file && file.type.startsWith('image/')) {
                fileInput.files = e.dataTransfer.files;
                const reader = new FileReader();
                reader.onload = (e) => {
                    imagePreview.src = e.target.result;
                    uploadArea.classList.add('has-image');
                };
                reader.readAsDataURL(file);
            }
        });

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