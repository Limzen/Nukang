@extends('app')

@section('title', 'Pengaturan Jasa - Nukang')

@section('content')
<div class="settings-page">
    <div class="container">
        {{-- Page Header --}}
        <div class="page-header animate-fadeIn">
            <div class="header-icon">
                <i class="fas fa-cogs"></i>
            </div>
            <div class="header-text">
                <h1>Pengaturan Jasa & Keahlian</h1>
                <p>Kelola layanan dan skill yang Anda tawarkan</p>
            </div>
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

        @php
            $hasilpotongan3 = explode("~", Auth::user()->pengalamanbekerja);
        @endphp

        <form method="POST" action="{{ url('pengaturan-jasa-keahlian') }}" class="settings-form">
            @csrf

            {{-- Service Types Section --}}
            <div class="settings-card animate-fadeIn">
                <div class="card-header">
                    <div class="card-icon"><i class="fas fa-list-alt"></i></div>
                    <div class="card-title">
                        <h3>Jenis Pemesanan Yang Diterima</h3>
                        <p>Tentukan jasa dan biaya layanan Anda</p>
                    </div>
                </div>
                <div class="card-body">
                    {{-- Add Service Form --}}
                    <div class="add-service-row">
                        <select class="form-input" name="kategoripemesanan" id="kategoripemesanan">
                            <option value="0">Harian</option>
                            <option value="1">Borongan</option>
                        </select>
                        <select class="form-input" name="jenispemesanan" id="kurikulumjp">
                            @foreach($jenispemesanan as $value)
                                <option value="{{ $value->id_jenispemesanan }}">{{ $value->jenispemesanan }}</option>
                            @endforeach
                        </select>
                        <input type="number" class="form-input" id="kurikulumbox" placeholder="Biaya Jasa (Rp)">
                        <button type="button" class="btn btn-primary" id="tambahkurikulum">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>

                    {{-- Service Lists --}}
                    <div class="service-lists">
                        <div class="service-list">
                            <h4><i class="fas fa-calendar-day"></i> Harian</h4>
                            <div id="kurikulumdiv" class="service-items">
                                @php $i = 0; @endphp
                                @foreach($jasatersediaharian as $value)
                                <div class="service-item" id="kurikulumrow{{ $i+1 }}">
                                    <div class="service-info">
                                        <span class="service-name">{{ $value->jenispemesanan }}</span>
                                        <span class="service-price">Rp {{ number_format($value->biayajasatersedia, 0, ',', '.') }}</span>
                                    </div>
                                    <button type="button" class="btn-remove hapuskurikulum" id="{{ $i+1 }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <input id="kurikulumhidden{{ $i+1 }}" type="hidden" value="{{ $value->biayajasatersedia }}" name="kurikulum[]">
                                    <input id="kurikulumhiddenjp{{ $i+1 }}" type="hidden" value="{{ $value->id_jenispemesanan }}" name="kurikulumjp[]">
                                </div>
                                @php $i++; @endphp
                                @endforeach
                            </div>
                        </div>

                        <div class="service-list">
                            <h4><i class="fas fa-calendar-alt"></i> Borongan</h4>
                            <div id="kurikulumdiv2" class="service-items">
                                @php $i = 0; @endphp
                                @foreach($jasatersediaborongan as $value)
                                <div class="service-item" id="kurikulumrow2{{ $i+1 }}">
                                    <div class="service-info">
                                        <span class="service-name">{{ $value->jenispemesanan }}</span>
                                        <span class="service-price">Rp {{ number_format($value->biayajasatersedia, 0, ',', '.') }}</span>
                                    </div>
                                    <button type="button" class="btn-remove hapuskurikulum2" id="{{ $i+1 }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <input id="kurikulumhidden2{{ $i+1 }}" type="hidden" value="{{ $value->biayajasatersedia }}" name="kurikulum2[]">
                                    <input id="kurikulumhiddenjp2{{ $i+1 }}" type="hidden" value="{{ $value->id_jenispemesanan }}" name="kurikulumjp2[]">
                                </div>
                                @php $i++; @endphp
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Experience Section --}}
            <div class="settings-card animate-fadeIn stagger-1">
                <div class="card-header">
                    <div class="card-icon card-icon-purple"><i class="fas fa-briefcase"></i></div>
                    <div class="card-title">
                        <h3>Pengalaman Bekerja</h3>
                        <p>Tambahkan pengalaman kerja Anda</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="add-exp-row">
                        <input type="text" class="form-input" id="kurikulumbox3" placeholder="Masukkan pengalaman kerja...">
                        <button type="button" class="btn btn-primary" id="tambahkurikulum3">
                            <i class="fas fa-plus"></i> Tambah
                        </button>
                    </div>
                    
                    <div id="kurikulumdiv3" class="exp-list">
                        @if(Auth::user()->pengalamanbekerja != "")
                            @for($i = 0; $i < count($hasilpotongan3); $i++)
                            <div class="exp-item" id="kurikulumrow3{{ $i+1 }}">
                                <span>{{ $hasilpotongan3[$i] }}</span>
                                <button type="button" class="btn-remove hapuskurikulum3" id="{{ $i+1 }}">
                                    <i class="fas fa-times"></i>
                                </button>
                                <input id="kurikulumhidden3{{ $i+1 }}" type="hidden" value="{{ $hasilpotongan3[$i] }}" name="kurikulum3[]">
                            </div>
                            @endfor
                        @endif
                    </div>
                </div>
            </div>

            {{-- Expertise Section --}}
            <div class="settings-card animate-fadeIn stagger-2">
                <div class="card-header">
                    <div class="card-icon card-icon-gold"><i class="fas fa-star"></i></div>
                    <div class="card-title">
                        <h3>Keahlian</h3>
                        <p>Informasi detail tentang keahlian Anda</p>
                    </div>
                </div>
                <div class="card-body">
                    <div class="form-field">
                        <label>Lama Pengalaman Bekerja</label>
                        <select class="form-input" name="pengalaman">
                            @for($i = 1; $i <= 50; $i++)
                                <option {{ Auth::user()->pengalamanbekerja == $i ? 'selected' : '' }} value="{{ $i }}">{{ $i }} Tahun</option>
                            @endfor
                        </select>
                    </div>
                    
                    <div class="form-field">
                        <label>Deskripsi Keahlian</label>
                        <textarea class="form-input" name="deskripsi" rows="4" placeholder="Jelaskan keahlian dan spesialisasi Anda...">{{ Auth::user()->deskripsikeahlian }}</textarea>
                    </div>
                </div>
            </div>

            {{-- Submit --}}
            <div class="form-actions">
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fas fa-save"></i> Simpan Pengaturan
                </button>
            </div>
        </form>
    </div>
</div>

<style>
.settings-page {
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

.header-text h1 { font-size: 1.75rem; margin-bottom: var(--space-1); }
.header-text p { color: var(--text-secondary); }

/* Cards */
.settings-card {
    background: var(--bg-card);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-xl);
    margin-bottom: var(--space-6);
    overflow: hidden;
}

.card-header {
    display: flex;
    align-items: center;
    gap: var(--space-4);
    padding: var(--space-5);
    background: var(--bg-tertiary);
    border-bottom: 1px solid var(--border-primary);
}

.card-icon {
    width: 48px;
    height: 48px;
    background: var(--gradient-primary);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.25rem;
    color: white;
}

.card-icon-purple { background: var(--gradient-accent); }
.card-icon-gold { background: var(--gradient-gold); }

.card-title h3 { font-size: 1.1rem; margin-bottom: var(--space-1); }
.card-title p { font-size: 0.85rem; color: var(--text-tertiary); margin: 0; }

.card-body { padding: var(--space-6); }

/* Add Service Row */
.add-service-row,
.add-exp-row {
    display: flex;
    gap: var(--space-3);
    margin-bottom: var(--space-6);
    flex-wrap: wrap;
}

.add-service-row .form-input { flex: 1; min-width: 150px; }
.add-exp-row .form-input { flex: 1; }

.form-input {
    padding: var(--space-3) var(--space-4);
    background: var(--bg-tertiary);
    border: 1px solid var(--border-primary);
    border-radius: var(--radius-lg);
    color: var(--text-primary);
    font-size: 0.95rem;
    outline: none;
    transition: all 0.3s ease;
}

.form-input:focus {
    border-color: var(--success);
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
}

/* Service Lists */
.service-lists {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: var(--space-6);
}

.service-list h4 {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: 0.95rem;
    margin-bottom: var(--space-4);
    padding-bottom: var(--space-3);
    border-bottom: 1px solid var(--border-primary);
}

.service-list h4 i { color: var(--success); }

.service-items { display: flex; flex-direction: column; gap: var(--space-3); }

.service-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: var(--space-3) var(--space-4);
    background: var(--bg-tertiary);
    border-radius: var(--radius-lg);
}

.service-name { font-weight: 500; }
.service-price { color: var(--success); font-weight: 600; }

.btn-remove {
    width: 32px;
    height: 32px;
    background: rgba(239, 68, 68, 0.1);
    border: none;
    border-radius: var(--radius-md);
    color: var(--danger);
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
}

.btn-remove:hover { background: var(--danger); color: white; }

/* Experience List */
.exp-list { display: flex; flex-wrap: wrap; gap: var(--space-3); }

.exp-item {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-2) var(--space-4);
    background: var(--bg-tertiary);
    border-radius: var(--radius-full);
    font-size: 0.9rem;
}

/* Form Field */
.form-field {
    margin-bottom: var(--space-5);
}

.form-field label {
    display: block;
    font-size: 0.9rem;
    font-weight: 500;
    color: var(--text-secondary);
    margin-bottom: var(--space-2);
}

.form-field textarea.form-input {
    width: 100%;
    resize: vertical;
}

.form-field select.form-input { width: 100%; }

/* Actions */
.form-actions {
    text-align: center;
}

/* Stagger */
.stagger-1 { animation-delay: 0.1s; }
.stagger-2 { animation-delay: 0.2s; }

@media (max-width: 768px) {
    .service-lists { grid-template-columns: 1fr; }
    .add-service-row { flex-direction: column; }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Counter for Harian services
    let countHarian = {{ count($jasatersediaharian) }};
    // Counter for Borongan services
    let countBorongan = {{ count($jasatersediaborongan) }};
    // Counter for Experience
    let countExp = {{ Auth::user()->pengalamanbekerja ? count(explode('~', Auth::user()->pengalamanbekerja)) : 0 }};
    
    // Add Service (Harian or Borongan)
    document.getElementById('tambahkurikulum').addEventListener('click', function() {
        const kategori = document.getElementById('kategoripemesanan').value;
        const jenisSelect = document.getElementById('kurikulumjp');
        const jenisId = jenisSelect.value;
        const jenisNama = jenisSelect.options[jenisSelect.selectedIndex].text;
        const biaya = document.getElementById('kurikulumbox').value;
        
        if (!biaya || biaya <= 0) {
            alert('Biaya jasa harus diisi!');
            return;
        }
        
        const formattedBiaya = new Intl.NumberFormat('id-ID').format(biaya);
        
        if (kategori === '0') {
            // Harian
            countHarian++;
            const container = document.getElementById('kurikulumdiv');
            const html = `
                <div class="service-item" id="kurikulumrow${countHarian}">
                    <div class="service-info">
                        <span class="service-name">${jenisNama}</span>
                        <span class="service-price">Rp ${formattedBiaya}</span>
                    </div>
                    <button type="button" class="btn-remove hapuskurikulum" data-id="${countHarian}">
                        <i class="fas fa-trash"></i>
                    </button>
                    <input type="hidden" value="${biaya}" name="kurikulum[]">
                    <input type="hidden" value="${jenisId}" name="kurikulumjp[]">
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        } else {
            // Borongan
            countBorongan++;
            const container = document.getElementById('kurikulumdiv2');
            const html = `
                <div class="service-item" id="kurikulumrow2${countBorongan}">
                    <div class="service-info">
                        <span class="service-name">${jenisNama}</span>
                        <span class="service-price">Rp ${formattedBiaya}</span>
                    </div>
                    <button type="button" class="btn-remove hapuskurikulum2" data-id="${countBorongan}">
                        <i class="fas fa-trash"></i>
                    </button>
                    <input type="hidden" value="${biaya}" name="kurikulum2[]">
                    <input type="hidden" value="${jenisId}" name="kurikulumjp2[]">
                </div>
            `;
            container.insertAdjacentHTML('beforeend', html);
        }
        
        document.getElementById('kurikulumbox').value = '';
    });
    
    // Add Experience
    document.getElementById('tambahkurikulum3').addEventListener('click', function() {
        const exp = document.getElementById('kurikulumbox3').value;
        if (!exp.trim()) {
            alert('Pengalaman bekerja harus diisi!');
            return;
        }
        
        countExp++;
        const container = document.getElementById('kurikulumdiv3');
        const html = `
            <div class="exp-item" id="kurikulumrow3${countExp}">
                <span>${exp}</span>
                <button type="button" class="btn-remove hapuskurikulum3" data-id="${countExp}">
                    <i class="fas fa-times"></i>
                </button>
                <input type="hidden" value="${exp}" name="kurikulum3[]">
            </div>
        `;
        container.insertAdjacentHTML('beforeend', html);
        document.getElementById('kurikulumbox3').value = '';
    });
    
    // Delete handlers using event delegation
    document.addEventListener('click', function(e) {
        // Delete Harian
        if (e.target.closest('.hapuskurikulum')) {
            const btn = e.target.closest('.hapuskurikulum');
            const id = btn.dataset.id || btn.id;
            const row = document.getElementById('kurikulumrow' + id);
            if (row) row.remove();
        }
        
        // Delete Borongan
        if (e.target.closest('.hapuskurikulum2')) {
            const btn = e.target.closest('.hapuskurikulum2');
            const id = btn.dataset.id || btn.id;
            const row = document.getElementById('kurikulumrow2' + id);
            if (row) row.remove();
        }
        
        // Delete Experience
        if (e.target.closest('.hapuskurikulum3')) {
            const btn = e.target.closest('.hapuskurikulum3');
            const id = btn.dataset.id || btn.id;
            const row = document.getElementById('kurikulumrow3' + id);
            if (row) row.remove();
        }
    });
});
</script>
@endsection