@extends('app')

@section('title', 'Ubah Harga Jarak - Nukang')

@section('content')
<div class="container" style="max-width: 800px; padding: var(--space-6) var(--space-4);">
    <!-- Page Header -->
    <div class="page-header animate-fadeIn" style="text-align: center; margin-bottom: var(--space-10);">
        <div class="page-icon" style="width: 80px; height: 80px; background: var(--gradient-primary); border-radius: var(--radius-xl); display: flex; align-items: center; justify-content: center; margin: 0 auto var(--space-6); font-size: 2rem; color: white;">
            <i class="fas fa-route"></i>
        </div>
        <h1 style="font-size: 2rem; margin-bottom: var(--space-3);">Pengaturan <span class="text-gradient">Harga Jarak</span></h1>
        <p style="color: var(--text-secondary); font-size: 1rem;">Atur tarif per kilometer untuk perhitungan biaya layanan</p>
    </div>

    <!-- Main Card -->
    <div class="card animate-fadeIn" style="animation-delay: 0.1s;">
        <div class="card-body" style="padding: var(--space-8);">
            <!-- Current Price Info -->
            <div style="background: var(--bg-tertiary); border-radius: var(--radius-lg); padding: var(--space-6); margin-bottom: var(--space-8); text-align: center;">
                <div style="font-size: 0.8rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--text-tertiary); margin-bottom: var(--space-2);">Harga Jarak Saat Ini</div>
                <div style="font-family: var(--font-display); font-size: 2.5rem; font-weight: 700;">
                    <span class="text-gradient">Rp {{ number_format($hargajarak->hargajarak ?? 0, 0, ',', '.') }}</span>
                </div>
                <div style="font-size: 0.9rem; color: var(--text-secondary); margin-top: var(--space-2);">per Kilometer</div>
            </div>

            <!-- Form -->
            <form method="POST" action="{{ url('ubah-harga-jarak') }}">
                @csrf
                
                <div class="form-group">
                    <label class="form-label">
                        <i class="fas fa-money-bill-wave"></i>
                        Harga Baru (Rp)
                    </label>
                    <div style="position: relative;">
                        <span style="position: absolute; left: var(--space-4); top: 50%; transform: translateY(-50%); color: var(--text-tertiary); font-weight: 500;">Rp</span>
                        <input type="number" 
                            class="form-control" 
                            name="hargajarak" 
                            value="{{ $hargajarak->hargajarak ?? 5000 }}" 
                            required 
                            min="0"
                            style="padding-left: var(--space-12);">
                    </div>
                    <small style="color: var(--text-tertiary); font-size: 0.8rem; margin-top: var(--space-2); display: block;">
                        <i class="fas fa-info-circle"></i> Harga ini akan digunakan untuk menghitung biaya jarak pada setiap pemesanan
                    </small>
                </div>

                <!-- Price Preview -->
                <div class="price-preview" style="background: var(--bg-glass); border: 1px solid var(--border-primary); border-radius: var(--radius-lg); padding: var(--space-5); margin: var(--space-6) 0;">
                    <div style="font-size: 0.85rem; font-weight: 600; color: var(--text-primary); margin-bottom: var(--space-4);">
                        <i class="fas fa-calculator" style="color: var(--success); margin-right: var(--space-2);"></i>
                        Contoh Perhitungan
                    </div>
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: var(--space-4); text-align: center;">
                        <div style="background: var(--bg-tertiary); padding: var(--space-3); border-radius: var(--radius-md);">
                            <div style="font-size: 0.75rem; color: var(--text-tertiary);">5 KM</div>
                            <div style="font-weight: 600; color: var(--success);" id="preview5km">Rp {{ number_format(($hargajarak->hargajarak ?? 5000) * 5, 0, ',', '.') }}</div>
                        </div>
                        <div style="background: var(--bg-tertiary); padding: var(--space-3); border-radius: var(--radius-md);">
                            <div style="font-size: 0.75rem; color: var(--text-tertiary);">10 KM</div>
                            <div style="font-weight: 600; color: var(--success);" id="preview10km">Rp {{ number_format(($hargajarak->hargajarak ?? 5000) * 10, 0, ',', '.') }}</div>
                        </div>
                        <div style="background: var(--bg-tertiary); padding: var(--space-3); border-radius: var(--radius-md);">
                            <div style="font-size: 0.75rem; color: var(--text-tertiary);">20 KM</div>
                            <div style="font-weight: 600; color: var(--success);" id="preview20km">Rp {{ number_format(($hargajarak->hargajarak ?? 5000) * 20, 0, ',', '.') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div style="display: flex; gap: var(--space-4); margin-top: var(--space-8);">
                    <a href="{{ url('home') }}" class="btn btn-secondary" style="flex: 1;">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" style="flex: 2;">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Card -->
    <div class="card animate-fadeIn" style="animation-delay: 0.2s; margin-top: var(--space-6);">
        <div class="card-body" style="padding: var(--space-6);">
            <div style="display: flex; gap: var(--space-4); align-items: flex-start;">
                <div style="width: 48px; height: 48px; background: rgba(59, 130, 246, 0.1); border-radius: var(--radius-md); display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                    <i class="fas fa-lightbulb" style="color: var(--info); font-size: 1.25rem;"></i>
                </div>
                <div>
                    <h4 style="font-size: 1rem; margin-bottom: var(--space-2);">Tentang Harga Jarak</h4>
                    <p style="font-size: 0.9rem; color: var(--text-secondary); line-height: 1.6; margin: 0;">
                        Harga jarak digunakan untuk menghitung biaya tambahan berdasarkan jarak antara lokasi tukang dengan lokasi pelanggan. 
                        Pastikan harga yang Anda tentukan sudah sesuai dengan standar biaya transportasi di wilayah Anda.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Live preview calculator
document.querySelector('input[name="hargajarak"]').addEventListener('input', function(e) {
    const harga = parseInt(e.target.value) || 0;
    document.getElementById('preview5km').textContent = 'Rp ' + (harga * 5).toLocaleString('id-ID');
    document.getElementById('preview10km').textContent = 'Rp ' + (harga * 10).toLocaleString('id-ID');
    document.getElementById('preview20km').textContent = 'Rp ' + (harga * 20).toLocaleString('id-ID');
});
</script>
@endsection