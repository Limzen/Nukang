{{-- Premium Order Modal Component --}}
<div class="modal fade premium-modal" id="orderModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ url('cari-tukang') }}/{{ $tukang->id_tukang }}/pesan" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <div class="modal-title-wrapper">
                        <div class="modal-icon"><i class="fas fa-shopping-cart"></i></div>
                        <div>
                            <h5 class="modal-title">Pesan Jasa</h5>
                            <p>Lengkapi detail pemesanan</p>
                        </div>
                    </div>
                    <button type="button" class="close-btn" data-dismiss="modal"><i class="fas fa-times"></i></button>
                </div>
                <div class="modal-body">
                    <div class="balance-info">
                        <div class="balance-icon"><i class="fas fa-wallet"></i></div>
                        <div class="balance-details">
                            <span class="balance-label">Saldo Anda</span>
                            <span class="balance-amount">Rp {{ number_format(Auth::user()->saldo, 0, ',', '.') }}</span>
                        </div>
                        <a href="{{ url('isi-saldo') }}" class="btn btn-sm btn-secondary"><i class="fas fa-plus"></i> Top Up</a>
                    </div>

                    <div class="tukang-preview">
                        <img src="{{ asset('images/fotoprofil') }}/{{ $tukang->fotoprofil }}" 
                             onerror="this.src='{{ asset('images/fotoprofil/default.png') }}'">
                        <div class="preview-info">
                            <h4>{{ $tukang->namatukang }}</h4>
                            <span>{{ $tukang->kategoritukang }}</span>
                        </div>
                        <div class="preview-rating"><i class="fas fa-star"></i><span>{{ number_format($tukang->rating ?? 0, 1) }}</span></div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-list"></i> Jenis Pemesanan</label>
                        <div class="radio-group">
                            <label class="radio-card">
                                <input type="radio" name="jenis" id="jenisHarian" value="0" checked>
                                <span class="radio-content"><i class="fas fa-calendar-day"></i><span>Harian</span></span>
                            </label>
                            <label class="radio-card">
                                <input type="radio" name="jenis" id="jenisBorongan" value="1">
                                <span class="radio-content"><i class="fas fa-project-diagram"></i><span>Borongan</span></span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group" id="harianGroup">
                        <label><i class="fas fa-wrench"></i> Pilih Jasa</label>
                        <select class="form-control" name="jenispemesanan">
                            @foreach($jasatersediaharian as $value)
                            <option value="{{ $value->id_jenispemesanan }},{{ $value->biayajasatersedia }}">
                                {{ $value->jenispemesanan }} - Rp {{ number_format($value->biayajasatersedia, 0, ',', '.') }}/hari
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="boronganGroup" style="display: none;">
                        <label><i class="fas fa-hard-hat"></i> Pilih Jasa</label>
                        <select class="form-control" name="jenispemesanan2">
                            @foreach($jasatersediaborongan as $value)
                            <option value="{{ $value->id_jenispemesanan }},{{ $value->biayajasatersedia }}">
                                {{ $value->jenispemesanan }} - Rp {{ number_format($value->biayajasatersedia, 0, ',', '.') }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-map-marker-alt"></i> Alamat</label>
                        @if(count($alamatpelanggan) > 0)
                            <select class="form-control" name="alamatpemesanan">
                                @foreach($alamatpelanggan as $value)
                                <option value="{{ $value->alamatpelanggan }},{{ $value->latitudealamat }},{{ $value->longtitudealamat }}">{{ $value->alamatpelanggan }}</option>
                                @endforeach
                            </select>
                            <a href="{{ url('tambah-alamat') }}" target="_blank" class="form-hint"><i class="fas fa-plus-circle"></i> Tambah alamat baru</a>
                        @else
                            <div class="alert-inline"><i class="fas fa-info-circle"></i><span>Belum ada alamat.</span><a href="{{ url('tambah-alamat') }}">Tambah</a></div>
                        @endif
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label><i class="fas fa-calendar-alt"></i> Tanggal Mulai</label>
                            <input type="date" class="form-control" name="tanggalbekerja" min="{{ date('Y-m-d', strtotime('+1 days')) }}" required>
                        </div>
                        <div class="form-group" id="tanggalSelesaiGroup" style="display: none;">
                            <label><i class="fas fa-calendar-check"></i> Tanggal Selesai</label>
                            <input type="date" class="form-control" name="tanggalselesai" min="{{ date('Y-m-d', strtotime('+1 days')) }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-sticky-note"></i> Catatan</label>
                        <textarea class="form-control" name="catatan" rows="3" placeholder="Jelaskan kebutuhan..." required></textarea>
                    </div>

                    <div class="form-group">
                        <label><i class="fas fa-camera"></i> Foto (Opsional)</label>
                        <div class="photo-upload-grid">
                            <div class="photo-upload-item">
                                <input type="file" name="foto1" id="foto1" accept="image/*" onchange="previewImg(this, 'prev1')">
                                <label for="foto1"><div id="prev1" class="photo-preview"><i class="fas fa-plus"></i></div></label>
                            </div>
                            <div class="photo-upload-item">
                                <input type="file" name="foto2" id="foto2" accept="image/*" onchange="previewImg(this, 'prev2')">
                                <label for="foto2"><div id="prev2" class="photo-preview"><i class="fas fa-plus"></i></div></label>
                            </div>
                        </div>
                    </div>

                    <div class="info-notice"><i class="fas fa-info-circle"></i><p>Jam kerja 07:00 - 23:00 WIB</p></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="fas fa-paper-plane"></i> Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Bootstrap Modal Base CSS */
.modal { display: none; position: fixed; top: 0; right: 0; bottom: 0; left: 0; z-index: 1050; overflow: hidden; -webkit-overflow-scrolling: touch; outline: 0; }
.modal.fade .modal-dialog { transform: translateY(-50px); transition: transform 0.3s ease-out; }
.modal.in { display: block; }
.modal.in .modal-dialog { transform: translateY(0); }
.modal-open .modal { overflow-x: hidden; overflow-y: auto; }
.modal-dialog { position: relative; width: auto; margin: 30px auto; max-width: 800px; }
.modal-backdrop { position: fixed; top: 0; right: 0; bottom: 0; left: 0; z-index: 1040; background-color: #000; }
.modal-backdrop.fade { opacity: 0; }
.modal-backdrop.in { opacity: 0.7; }
.modal-content { position: relative; background-color: var(--bg-card); border: 1px solid var(--border-primary); border-radius: var(--radius-xl); box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); }

/* Premium Modal Styles */
.premium-modal .modal-header { display: flex; align-items: center; justify-content: space-between; padding: var(--space-5); border-bottom: 1px solid var(--border-primary); background: var(--bg-tertiary); border-radius: var(--radius-xl) var(--radius-xl) 0 0; }

.modal-title-wrapper { display: flex; align-items: center; gap: var(--space-4); }
.modal-icon { width: 48px; height: 48px; background: var(--gradient-primary); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.25rem; }
.modal-title-wrapper h5 { font-size: 1.1rem; margin-bottom: var(--space-1); }
.modal-title-wrapper p { font-size: 0.85rem; color: var(--text-tertiary); margin: 0; }
.close-btn { width: 36px; height: 36px; border-radius: var(--radius-md); background: var(--bg-secondary); border: none; color: var(--text-secondary); cursor: pointer; }
.close-btn:hover { background: var(--danger); color: white; }
.premium-modal .modal-body { padding: var(--space-6); max-height: 70vh; overflow-y: auto; }
.balance-info { display: flex; align-items: center; gap: var(--space-4); padding: var(--space-4); background: rgba(16, 185, 129, 0.1); border: 1px solid rgba(16, 185, 129, 0.2); border-radius: var(--radius-lg); margin-bottom: var(--space-5); }
.balance-icon { width: 40px; height: 40px; background: var(--gradient-primary); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; color: white; }
.balance-details { flex: 1; }
.balance-label { display: block; font-size: 0.8rem; color: var(--text-tertiary); }
.balance-amount { font-family: var(--font-display); font-size: 1.25rem; font-weight: 700; color: var(--success); }
.tukang-preview { display: flex; align-items: center; gap: var(--space-4); padding: var(--space-4); background: var(--bg-tertiary); border-radius: var(--radius-lg); margin-bottom: var(--space-5); }
.tukang-preview img { width: 50px; height: 50px; border-radius: var(--radius-md); object-fit: cover; }
.tukang-preview .preview-info { flex: 1; }
.tukang-preview h4 { font-size: 0.95rem; margin-bottom: var(--space-1); }
.tukang-preview span { font-size: 0.8rem; color: var(--text-tertiary); }
.preview-rating { display: flex; align-items: center; gap: var(--space-1); color: #fbbf24; }
.preview-rating span { color: var(--text-primary); font-weight: 600; }
.form-group { margin-bottom: var(--space-5); }
.form-group label { display: flex; align-items: center; gap: var(--space-2); font-size: 0.9rem; font-weight: 500; color: var(--text-secondary); margin-bottom: var(--space-2); }
.form-group label i { color: var(--text-tertiary); }
.form-control { width: 100%; padding: var(--space-3) var(--space-4); background: var(--bg-tertiary); border: 1px solid var(--border-primary); border-radius: var(--radius-lg); color: var(--text-primary); font-size: 0.95rem; }
.form-control:focus { outline: none; border-color: var(--success); box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1); }
.radio-group { display: flex; gap: var(--space-3); }
.radio-card { flex: 1; cursor: pointer; }
.radio-card input { display: none; }
.radio-content { display: flex; align-items: center; justify-content: center; gap: var(--space-2); padding: var(--space-4); background: var(--bg-tertiary); border: 2px solid var(--border-primary); border-radius: var(--radius-lg); }
.radio-card input:checked + .radio-content { border-color: var(--success); background: rgba(16, 185, 129, 0.1); }
.form-row { display: grid; grid-template-columns: 1fr 1fr; gap: var(--space-4); }
.form-hint { display: inline-flex; align-items: center; gap: var(--space-1); font-size: 0.8rem; color: var(--success); margin-top: var(--space-2); }
.alert-inline { display: flex; align-items: center; gap: var(--space-3); padding: var(--space-4); background: rgba(245, 158, 11, 0.1); border: 1px solid rgba(245, 158, 11, 0.3); border-radius: var(--radius-lg); font-size: 0.9rem; }
.alert-inline i { color: #f59e0b; }
.alert-inline a { color: var(--success); font-weight: 500; }
.photo-upload-grid { display: flex; gap: var(--space-3); }
.photo-upload-item input { display: none; }
.photo-preview { width: 80px; height: 80px; background: var(--bg-tertiary); border: 2px dashed var(--border-primary); border-radius: var(--radius-lg); display: flex; align-items: center; justify-content: center; cursor: pointer; overflow: hidden; }
.photo-preview:hover { border-color: var(--success); }
.photo-preview i { color: var(--text-tertiary); font-size: 1.5rem; }
.photo-preview img { width: 100%; height: 100%; object-fit: cover; }
.info-notice { display: flex; align-items: flex-start; gap: var(--space-3); padding: var(--space-4); background: rgba(59, 130, 246, 0.1); border: 1px solid rgba(59, 130, 246, 0.2); border-radius: var(--radius-lg); font-size: 0.85rem; }
.info-notice i { color: #3b82f6; flex-shrink: 0; }
.info-notice p { margin: 0; color: var(--text-secondary); }
.premium-modal .modal-footer { display: flex; justify-content: flex-end; gap: var(--space-3); padding: var(--space-5); border-top: 1px solid var(--border-primary); background: var(--bg-tertiary); border-radius: 0 0 var(--radius-xl) var(--radius-xl); }
@media (max-width: 576px) { .form-row { grid-template-columns: 1fr; } }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Jenis Pemesanan Toggle
    const h = document.getElementById('jenisHarian');
    const b = document.getElementById('jenisBorongan');
    const hg = document.getElementById('harianGroup');
    const bg = document.getElementById('boronganGroup');
    const tg = document.getElementById('tanggalSelesaiGroup');
    function toggle() {
        if (b && b.checked) { hg.style.display='none'; bg.style.display='block'; tg.style.display='block'; }
        else { hg.style.display='block'; bg.style.display='none'; tg.style.display='none'; }
    }
    if(h) h.addEventListener('change', toggle);
    if(b) b.addEventListener('change', toggle);
    
    // Fallback Modal Handler (in case Bootstrap JS doesn't load)
    const modal = document.getElementById('orderModal');
    const modalTriggers = document.querySelectorAll('[data-target="#orderModal"]');
    const closeButtons = modal ? modal.querySelectorAll('[data-dismiss="modal"]') : [];
    
    function openModal() {
        if (!modal) return;
        // Create backdrop
        let backdrop = document.querySelector('.modal-backdrop');
        if (!backdrop) {
            backdrop = document.createElement('div');
            backdrop.className = 'modal-backdrop fade in';
            document.body.appendChild(backdrop);
        }
        modal.style.display = 'block';
        setTimeout(() => { modal.classList.add('in'); }, 10);
        document.body.classList.add('modal-open');
        document.body.style.overflow = 'hidden';
    }
    
    function closeModal() {
        if (!modal) return;
        modal.classList.remove('in');
        setTimeout(() => { 
            modal.style.display = 'none'; 
            const backdrop = document.querySelector('.modal-backdrop');
            if (backdrop) backdrop.remove();
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
        }, 300);
    }
    
    // Attach click handlers to triggers
    modalTriggers.forEach(trigger => {
        trigger.addEventListener('click', function(e) {
            e.preventDefault();
            openModal();
        });
    });
    
    // Attach click handlers to close buttons
    closeButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.preventDefault();
            closeModal();
        });
    });
    
    // Close modal when clicking on backdrop
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeModal();
        });
    }
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal && modal.classList.contains('in')) closeModal();
    });
});

function previewImg(i, p) {
    const pr = document.getElementById(p);
    if (i.files && i.files[0]) {
        const r = new FileReader();
        r.onload = function(e) { pr.innerHTML = `<img src="${e.target.result}">`; };
        r.readAsDataURL(i.files[0]);
    }
}
</script>


