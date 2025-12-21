<div class="material-card">
	<form action="{{ url('riwayatpemesanan') }}/{{ $idpemesanan }}/{{ $material->id_bahanmaterial }}/masukkeranjang"
		method="POST">
		@csrf
		<input type="hidden" name="hargapemesanan" value="{{ $material->hargabahanmaterial }}">

		{{-- Product Image --}}
		<div class="material-card-image">
			@if($material->fotobahanmaterial && file_exists(public_path('images/fotobahanmaterial/' . $material->fotobahanmaterial)))
				<img src="{{ asset('images/fotobahanmaterial/' . $material->fotobahanmaterial) }}"
					alt="{{ $material->bahanmaterial }}">
			@else
				<div class="material-card-placeholder">
					<i class="fas fa-cube"></i>
				</div>
			@endif
			<div class="material-card-badge">
				{{ $material->kodebahanmaterial }}
			</div>
		</div>

		{{-- Product Info --}}
		<div class="material-card-body">
			<h4 class="material-card-title">{{ $material->bahanmaterial }}</h4>
			<div class="material-card-price">
				Rp {{ number_format($material->hargabahanmaterial, 0, ',', '.') }}
				<span class="material-card-unit">/ unit</span>
			</div>

			@if($material->informasibahanmaterial)
				<p class="material-card-desc">{{ Str::limit($material->informasibahanmaterial, 80) }}</p>
			@endif

			{{-- Quantity Input --}}
			<div class="material-card-qty">
				<label>Kuantiti:</label>
				<div class="qty-input-group">
					<button type="button" class="qty-btn qty-minus"
						onclick="this.parentNode.querySelector('input').stepDown(); return false;">
						<i class="fas fa-minus"></i>
					</button>
					<input type="number" value="1" min="1" max="99" name="qty" class="qty-input">
					<button type="button" class="qty-btn qty-plus"
						onclick="this.parentNode.querySelector('input').stepUp(); return false;">
						<i class="fas fa-plus"></i>
					</button>
				</div>
			</div>
		</div>

		{{-- Add to Cart Button --}}
		<button type="submit" class="material-card-btn">
			<i class="fas fa-cart-plus"></i>
			<span>Tambah ke Keranjang</span>
		</button>
	</form>
</div>