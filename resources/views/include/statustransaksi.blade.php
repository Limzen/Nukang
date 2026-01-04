@if($value->statustransaksi == '0')
Menunggu Konfirmasi Admin
@elseif($value->statustransaksi == '1')
Sukses
@elseif($value->statustransaksi == '2')
Ditolak
@endif