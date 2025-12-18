<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\DataBahanMaterialController;
use App\Http\Controllers\DataJenisPemesananController;
use App\Http\Controllers\DataKategoriTukangController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// ============================================
// PUBLIC ROUTES
// ============================================

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// ============================================
// AUTHENTICATED ROUTES
// ============================================

Route::middleware(['auth'])->group(function () {
    
    // Home/Dashboard
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    
    // ============================================
    // INVOICE & PDF
    // ============================================
    
    Route::get('riwayatpemesanan/{idpemesanan}/invoice', function($idpemesanan) {
        $pemesananbahan = "";
        $totalkeranjang = "0";
        $statuspemesanan = "";
        $biayajasa = "";
        
        function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000) {
            $latFrom = deg2rad($latitudeFrom);
            $lonFrom = deg2rad($longitudeFrom);
            $latTo = deg2rad($latitudeTo);
            $lonTo = deg2rad($longitudeTo);
            $latDelta = $latTo - $latFrom;
            $lonDelta = $lonTo - $lonFrom;
            $angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
            return $angle * $earthRadius;
        }
        
        $hargajarak = \App\HargaJarak::find("1");
        $pemesananbahan = \App\PemesananBahanMaterial::join('bahanmaterial','bahanmaterial.id_bahanmaterial','=','pemesananbahanmaterial.id_bahanmaterial')
            ->where('id_pemesanan','=',$idpemesanan)->get();
        
        for($i=0;$i<count($pemesananbahan);$i++) {
            $totalkeranjang += $pemesananbahan[$i]['hargapemesananbahanmaterial'] * $pemesananbahan[$i]['qtypembelian'];
        }
        
        $value = \App\Pemesanan::join('jenispemesanan','jenispemesanan.id_jenispemesanan','=','pemesanan.id_jenispemesanan')
            ->join('kategoritukang','kategoritukang.id_kategoritukang','=','pemesanan.id_kategoritukang')
            ->join('tukang','tukang.id_tukang','=','pemesanan.id_tukang')
            ->join('users','users.id','=','tukang.id')
            ->find($idpemesanan);
        
        $biayajasa = $value->biayajasa;
        $statuspemesanan = $value->statuspemesanan;
        $jarak = haversineGreatCircleDistance(3.587971813394123,98.69062542915344,$value->latitudepemesanan,$value->longtitudepemesanan)/1000;
        
        $pdf = \PDF::loadView('invoice',compact('hargajarak','pemesananbahan','value','statuspemesanan','jarak','totalkeranjang','biayajasa'))
            ->setPaper('a4','portrait');
        return $pdf->stream("invoice.pdf");
    })->name('invoice.show');
    
    // ============================================
    // RESOURCE CONTROLLERS
    // ============================================
    
    Route::resource('databahanmaterial', DataBahanMaterialController::class);
    Route::resource('datajenispemesanan', DataJenisPemesananController::class);
    Route::resource('datakategoritukang', DataKategoriTukangController::class);
    
    // ============================================
    // DATA BAHAN MATERIAL
    // ============================================
    
    Route::get('databahanmaterial/{id}/ubahstatus', [DataBahanMaterialController::class, 'ubahstatus'])
        ->name('databahanmaterial.ubahstatus');
    
    // ============================================
    // HARGA JARAK
    // ============================================
    
    Route::get('ubahhargajarak', function() {
        $hargajarak = \App\HargaJarak::find("1");
        return view('ubahhargajarak',compact('hargajarak'));
    })->name('hargajarak.edit');
    
    Route::post('ubahhargajarak', function(Request $request) {
        $hargajarak = \App\HargaJarak::find("1");
        $hargajarak->hargajarak = $request->input('hargajarak');
        $hargajarak->save();
        return redirect()->to('ubahhargajarak')->with('message_success', 'Harga Jarak Berhasil Diubah!!');
    })->name('hargajarak.update');
    
    // ============================================
    // KONFIRMASI UPDATE SALDO
    // ============================================
    
    Route::get('konfirmasiupdatesaldo', function() {
        $updatesaldo = \App\RiwayatTransaksi::join('users','users.id','=','riwayattransaksi.id')
            ->join('pelanggan','pelanggan.id','=','riwayattransaksi.id')
            ->where('statustransaksi','=','0')
            ->where('jenistransaksi','=','Pengisian Saldo')
            ->get();
        return view('adminkonfirmasiupdatesaldo',compact('updatesaldo'));
    })->name('saldo.konfirmasi');
    
    Route::post('konfirmasiupdatesaldo/terima', function(Request $request) {
        $terima = \App\RiwayatTransaksi::find($request->input('idriwayat'));
        $terima->statustransaksi = "1";
        $user = \App\User::find($terima->id);
        $user->saldo += $terima->jumlahsaldo;
        $user->save();    
        $terima->save();
        
        $notifikasi = new \App\Notifikasi;
        $notifikasi->kepada = $terima->id;
        $notifikasi->isinotifikasi = "berhasil melakukan pengupdatean saldo dengan nominal Rp. " . number_format($terima->jumlahsaldo,2) . " pada tanggal " . date("Y-m-d H:i:s");
        $notifikasi->statusnotifikasi = '0';
        $notifikasi->dari = '1';
        $notifikasi->jenisnotifikasi = "riwayattransaksi";
        $notifikasi->save();
        
        return redirect()->to('konfirmasiupdatesaldo')->with('message_success', 'Update Saldo Berhasil Dilakukan!!');
    })->name('saldo.terima');
    
    Route::post('konfirmasiupdatesaldo/tolak', function(Request $request) {
        $terima = \App\RiwayatTransaksi::find($request->input('idriwayat'));
        $terima->statustransaksi = "2";
        $terima->save();
        
        $notifikasi = new \App\Notifikasi;
        $notifikasi->kepada = $terima->id;
        $notifikasi->isinotifikasi = "telah melakukan penolakan pengisian saldo dengan nominal Rp. " . number_format($terima->jumlahsaldo,2) . " pada tanggal " . date("Y-m-d H:i:s");
        $notifikasi->statusnotifikasi = '0';
        $notifikasi->dari = '1';
        $notifikasi->jenisnotifikasi = "riwayattransaksi";
        $notifikasi->save();
        
        return redirect()->to('konfirmasiupdatesaldo')->with('message_failed', 'Penolakan Update Saldo Berhasil Dilakukan!!');
    })->name('saldo.tolak');
    
    // ============================================
    // KONFIRMASI TARIK SALDO
    // ============================================
    
    Route::get('konfirmasitariksaldo', function() {
        $tariksaldo = \App\RiwayatTransaksi::join('users','users.id','=','riwayattransaksi.id')
            ->join('tukang','tukang.id','=','riwayattransaksi.id')
            ->where('statustransaksi','=','0')
            ->where('jenistransaksi','=','Penarikan Saldo')
            ->get();
        return view('adminkonfirmasitariksaldo',compact('tariksaldo'));
    })->name('tarik.konfirmasi');
    
    Route::post('konfirmasitariksaldo/terima', function(Request $request) {
        $terima = \App\RiwayatTransaksi::find($request->input('idriwayat'));
        $terima->statustransaksi = "1";
        $terima->save();
        
        $notifikasi = new \App\Notifikasi;
        $notifikasi->kepada = $terima->id;
        $notifikasi->isinotifikasi = "telah mengkonfirmasi penarikan saldo dengan nominal Rp. " . number_format($terima->jumlahsaldo,2) . " pada tanggal " . date("Y-m-d H:i:s");
        $notifikasi->statusnotifikasi = '0';
        $notifikasi->dari = '1';
        $notifikasi->jenisnotifikasi = "riwayattransaksi";
        $notifikasi->save();
        
        return redirect()->to('konfirmasitariksaldo')->with('message_success', 'Penarikan Saldo Berhasil Dikonfirmasikan!!');
    })->name('tarik.terima');
    
    Route::post('konfirmasitariksaldo/tolak', function(Request $request) {
        $terima = \App\RiwayatTransaksi::find($request->input('idriwayat'));
        $terima->statustransaksi = "2";
        $user = \App\User::find($terima->id);
        $user->saldo += $terima->jumlahsaldo;
        $user->save();    
        $terima->save();
        
        $notifikasi = new \App\Notifikasi;
        $notifikasi->kepada = $terima->id;
        $notifikasi->isinotifikasi = "telah melakukan penolakan penarikan saldo dengan nominal Rp. " . number_format($terima->jumlahsaldo,2) . " pada tanggal " . date("Y-m-d H:i:s");
        $notifikasi->statusnotifikasi = '0';
        $notifikasi->dari = '1';
        $notifikasi->jenisnotifikasi = "riwayattransaksi";
        $notifikasi->save();
        
        return redirect()->to('konfirmasitariksaldo')->with('message_failed', 'Penolakan Penarikan Saldo Berhasil Dilakukan!!');
    })->name('tarik.tolak');
    
    // TO BE CONTINUED... (File ini akan sangat panjang, saya akan split menjadi beberapa bagian)
    // Saya akan lanjutkan konversi routes lainnya di message berikutnya
    
});

// Auth routes (handled by Laravel UI or Breeze)
require __DIR__.'/auth.php';
