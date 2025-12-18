@if($value->statuspemesanan == '0')
Menunggu Konfirmasi Penyedia Jasa Renovasi
@elseif($value->statuspemesanan == '1')
Pembelian Bahan Material
@elseif($value->statuspemesanan == '2')
Ditolak
@elseif($value->statuspemesanan == '3')
Sedang Dikerjakan Penyedia Jasa Renovasi
@elseif($value->statuspemesanan == '4')
Pemberian Rating
@elseif($value->statuspemesanan == '5')
Selesai
@endif