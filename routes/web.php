<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Helpers\GeoHelper;
use App\Helpers\StringHelper;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::middleware(['auth'])->group(function () {

	Route::get('riwayatpemesanan/{idpemesanan}/invoice', function ($idpemesanan, Request $request) {
		$pemesananbahan = "";
		$totalkeranjang = "0";
		$statuspemesanan = "";
		$biayajasa = "";
		function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
		{
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
		$pemesananbahan = \App\PemesananBahanMaterial::join('bahanmaterial', 'bahanmaterial.id_bahanmaterial', '=', 'pemesananbahanmaterial.id_bahanmaterial')->where('id_pemesanan', '=', $idpemesanan)->get();
		for ($i = 0; $i < count($pemesananbahan); $i++) {
			$totalkeranjang += $pemesananbahan[$i]['hargapemesananbahanmaterial'] * $pemesananbahan[$i]['qtypembelian'];
		}
		$value = \App\Pemesanan::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'pemesanan.id_jenispemesanan')->join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'pemesanan.id_kategoritukang')->join('tukang', 'tukang.id_tukang', '=', 'pemesanan.id_tukang')->join('users', 'users.id', '=', 'tukang.id')->find($idpemesanan);
		$biayajasa = $value->biayajasa;
		$statuspemesanan = $value->statuspemesanan;
		$jarak = haversineGreatCircleDistance(3.587971813394123, 98.69062542915344, $value->latitudepemesanan, $value->longtitudepemesanan) / 1000;
		$pdf = PDF::loadView('invoice', compact('hargajarak', 'pemesananbahan', 'value', 'statuspemesanan', 'jarak', 'totalkeranjang', 'biayajasa'))->setPaper('a4', 'portrait');
		return $pdf->stream("invoice.pdf");
	});

	// Route untuk lihat peta lokasi pemesanan
	Route::get('riwayatpemesanan/{idpemesanan}/lihatpeta', function ($idpemesanan, Request $request) {
		$pemesanan = \App\Pemesanan::find($idpemesanan);
		if (!$pemesanan) {
			return redirect()->back()->with('message_failed', 'Pemesanan tidak ditemukan');
		}
		return view('lihatpetapemesanan')->with([
			'pemesanan' => $pemesanan,
			'latitude' => $pemesanan->latitudepemesanan,
			'longitude' => $pemesanan->longtitudepemesanan,
			'alamat' => $pemesanan->alamatpemesanan
		]);
	});

	Route::resource('databahanmaterial', \App\Http\Controllers\DataBahanMaterialController::class);

	Route::resource('datajenispemesanan', \App\Http\Controllers\DataJenisPemesananController::class);

	Route::resource('datakategoritukang', \App\Http\Controllers\DataKategoriTukangController::class);

	Route::get('databahanmaterial/{id}/ubahstatus', [\App\Http\Controllers\DataBahanMaterialController::class, 'ubahstatus']);

	// Ubah Harga Jarak - dengan hyphen (new URL)
	Route::get('ubah-harga-jarak', function (Request $request) {
		$hargajarak = \App\HargaJarak::find("1");
		if (!$hargajarak) {
			$hargajarak = new \App\HargaJarak;
			$hargajarak->id_hargajarak = 1;
			$hargajarak->hargajarak = 5000;
			$hargajarak->save();
		}
		return view('ubahhargajarak', compact('hargajarak'));
	});

	Route::post('ubah-harga-jarak', function (Request $request) {
		$hargajarak = \App\HargaJarak::find("1");
		if (!$hargajarak) {
			$hargajarak = new \App\HargaJarak;
			$hargajarak->id_hargajarak = 1;
		}
		$hargajarak->hargajarak = $request->input('hargajarak');
		$hargajarak->save();
		return redirect()->to('ubah-harga-jarak')->with('message_success', 'Harga Jarak Berhasil Diubah!!');
	});

	// Backward compatibility - redirect old URL to new
	Route::get('ubahhargajarak', function () {
		return redirect()->to('ubah-harga-jarak');
	});
	Route::post('ubahhargajarak', function (Request $request) {
		return redirect()->to('ubah-harga-jarak');
	});
	Route::get('konfirmasi-update-saldo', function (Request $request) {
		// Get pending top-up transactions with user info
		$updatesaldo = \App\RiwayatTransaksi::where('statustransaksi', '=', '0')
			->where('jenistransaksi', '=', 'Pengisian Saldo')
			->get()
			->map(function ($item) {
				$user = \App\User::find($item->id);
				$pelanggan = \App\Pelanggan::where('id', $item->id)->first();
				$item->nomorrekening = $user->nomorrekening ?? '-';
				$item->namarekening = $user->namarekening ?? '-';
				$item->namapelanggan = $pelanggan->namapelanggan ?? ($user->namaLengkap ?? 'User');
				return $item;
			});
		return view('adminkonfirmasiupdatesaldo', compact('updatesaldo'));
	});
	Route::get('konfirmasiupdatesaldo', function () {
		return redirect()->to('konfirmasi-update-saldo');
	});

	Route::post('konfirmasi-update-saldo/terima', function (Request $request) {
		$terima = \App\RiwayatTransaksi::find($request->input('idriwayat'));
		$terima->statustransaksi = "1";
		$user = \App\User::find($terima->id);
		$user->saldo += $terima->jumlahsaldo;
		$user->save();
		$terima->save();
		$notifikasi = new \App\Notifikasi;
		$notifikasi->kepada = $terima->id;
		$notifikasi->isinotifikasi = "berhasil melakukan pengupdatean saldo dengan nominal Rp. " . number_format($terima->jumlahsaldo, 2) . " pada tanggal " . date("Y-m-d H:i:s");
		$notifikasi->statusnotifikasi = '0';
		$notifikasi->dari = '1';
		$notifikasi->jenisnotifikasi = "riwayattransaksi";
		$notifikasi->save();
		return redirect()->to('konfirmasi-update-saldo')->with('message_success', 'Update Saldo Berhasil Dilakukan!!');
	});
	Route::post('konfirmasi-update-saldo/tolak', function (Request $request) {
		$terima = \App\RiwayatTransaksi::find($request->input('idriwayat'));
		$terima->statustransaksi = "2";
		$terima->save();
		$notifikasi = new \App\Notifikasi;
		$notifikasi->kepada = $terima->id;
		$notifikasi->isinotifikasi = "telah melakukan penolakan pengisian saldo dengan nominal Rp. " . number_format($terima->jumlahsaldo, 2) . " pada tanggal " . date("Y-m-d H:i:s");
		$notifikasi->statusnotifikasi = '0';
		$notifikasi->dari = '1';
		$notifikasi->jenisnotifikasi = "riwayattransaksi";
		$notifikasi->save();
		return redirect()->to('konfirmasi-update-saldo')->with('message_failed', 'Penolakan Update Saldo Berhasil Dilakukan!!');
	});

	Route::get('konfirmasi-tarik-saldo', function (Request $request) {
		// Get pending withdrawal transactions
		$tariksaldo = \App\RiwayatTransaksi::where('statustransaksi', '=', '0')
			->where('jenistransaksi', '=', 'Penarikan Saldo')
			->get()
			->map(function ($item) {
				// Get tukang data for this user
				$tukang = \App\Tukang::where('id', $item->id)->first();
				$item->namatukang = $tukang ? $tukang->namatukang : 'Unknown';
				$item->nomorrekening = $item->rekening;
				return $item;
			});
		return view('adminkonfirmasitariksaldo', compact('tariksaldo'));
	});
	Route::get('konfirmasitariksaldo', function () {
		return redirect()->to('konfirmasi-tarik-saldo');
	});

	Route::post('konfirmasi-tarik-saldo/terima', function (Request $request) {
		$terima = \App\RiwayatTransaksi::find($request->input('idriwayat'));
		$terima->statustransaksi = "1";
		$terima->save();
		// Kurangi saldo user saat admin approve
		$user = \App\User::find($terima->id);
		// Hitung jumlah asli sebelum potongan (jumlahsaldo = asli - 5%)
		$jumlahAsli = $terima->jumlahsaldo / 0.95;
		$user->saldo -= $jumlahAsli;
		$user->save();
		$notifikasi = new \App\Notifikasi;
		$notifikasi->kepada = $terima->id;
		$notifikasi->isinotifikasi = "telah mengkonfirmasi penarikan saldo dengan nominal Rp. " . number_format($terima->jumlahsaldo, 2) . " pada tanggal " . date("Y-m-d H:i:s");
		$notifikasi->statusnotifikasi = '0';
		$notifikasi->dari = '1';
		$notifikasi->jenisnotifikasi = "riwayattransaksi";
		$notifikasi->save();
		return redirect()->to('konfirmasi-tarik-saldo')->with('message_success', 'Penarikan Saldo Berhasil Dikonfirmasikan!!');
	});
	Route::post('konfirmasi-tarik-saldo/tolak', function (Request $request) {
		$terima = \App\RiwayatTransaksi::find($request->input('idriwayat'));
		$terima->statustransaksi = "2";
		$terima->save();
		// Tidak perlu mengembalikan saldo karena saldo belum dikurangi (dikurangi hanya saat approve)
		$notifikasi = new \App\Notifikasi;
		$notifikasi->kepada = $terima->id;
		$notifikasi->isinotifikasi = "telah melakukan penolakan penarikan saldo dengan nominal Rp. " . number_format($terima->jumlahsaldo, 2) . " pada tanggal " . date("Y-m-d H:i:s");
		$notifikasi->statusnotifikasi = '0';
		$notifikasi->dari = '1';
		$notifikasi->jenisnotifikasi = "riwayattransaksi";
		$notifikasi->save();
		return redirect()->to('konfirmasi-tarik-saldo')->with('message_failed', 'Penolakan Penarikan Saldo Berhasil Dilakukan!!');
	});


	Route::get('riwayat-pemesanan/{id}/lihat-peta', function ($id, Request $request) {
		function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
		{
			$latFrom = deg2rad($latitudeFrom);
			$lonFrom = deg2rad($longitudeFrom);
			$latTo = deg2rad($latitudeTo);
			$lonTo = deg2rad($longitudeTo);
			$latDelta = $latTo - $latFrom;
			$lonDelta = $lonTo - $lonFrom;
			$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
			return $angle * $earthRadius;
		}
		$alamat = \App\Pemesanan::find($id);
		$jarak = haversineGreatCircleDistance(Auth::user()->latitude, Auth::user()->longtitude, $alamat->latitudepemesanan, $alamat->longtitudepemesanan) / 1000;
		return view('map', compact('alamat', 'jarak'));
	});



	// Verifikasi Tukang - Dedicated Page
	Route::get('verifikasi-tukang', function (Request $request) {
		$verifikasitukang = \App\User::join('tukang', 'tukang.id', '=', 'users.id')
			->where('statusverifikasi', '=', '0')
			->get();
		return view('adminverifikasitukang', compact('verifikasitukang'));
	});

	Route::post('verifikasi-tukang/terima', function (Request $request) {
		$terima = \App\User::find($request->input('iduser'));
		$terima->statusverifikasi = "1";
		$terima->save();
		return redirect()->to('verifikasi-tukang')->with('message_success', 'Penyedia Jasa Renovasi Berhasil Diverifikasi');
	});
	Route::post('verifikasi-tukang/tolak', function (Request $request) {
		$terima = \App\User::find($request->input('iduser'));
		$terima->statusverifikasi = "2";
		$terima->save();
		return redirect()->to('verifikasi-tukang')->with('message_failed', 'Verifikasi Penyedia Jasa Renovasi Ditolak');
	});

	// Legacy routes - redirect to new verifikasi-tukang page
	Route::post('home/terima', function (Request $request) {
		$terima = \App\User::find($request->input('iduser'));
		$terima->statusverifikasi = "1";
		$terima->save();
		return redirect()->to('verifikasi-tukang')->with('message_success', 'Penyedia Jasa Renovasi Berhasil Diverifikasi');
	});
	Route::post('home/tolak', function (Request $request) {
		$terima = \App\User::find($request->input('iduser'));
		$terima->statusverifikasi = "2";
		$terima->save();
		return redirect()->to('verifikasi-tukang')->with('message_failed', 'Verifikasi Penyedia Jasa Renovasi Ditolak');
	});
	Route::get('pengaturan-jasa-keahlian', function (Request $request) {
		$jenispemesanan = \App\JenisPemesanan::where('id_kategoritukang', '=', Auth::user()->tukang->id_kategoritukang ?? 1)->get();
		$jasatersediaharian = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', Auth::user()->tukang->id_tukang ?? Auth::user()->id)->where('jenisjasatersedia', '=', '0')->get();
		$jasatersediaborongan = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', Auth::user()->tukang->id_tukang ?? Auth::user()->id)->where('jenisjasatersedia', '=', '1')->get();
		return view('pengaturanjasadankeahlian')->with(['jenispemesanan' => $jenispemesanan, 'jasatersediaharian' => $jasatersediaharian, 'jasatersediaborongan' => $jasatersediaborongan]);
	});
	Route::get('pengaturanjasakeahlian', function () {
		return redirect()->to('pengaturan-jasa-keahlian');
	});
	Route::get('notifikasi/{id}/markasread', function ($id, Request $request) {
		$notifikasi = \App\Notifikasi::find($id);
		$notifikasi->statusnotifikasi = '1';
		$notifikasi->save();
		return redirect()->to('notifikasi')->with('message_success', 'Notifikasi berhasil dipindahkan');
	});
	Route::post('pengaturan-jasa-keahlian', function (Request $request) {
		// Allow save if at least one service category has items OR if just updating experience/description
		if (
			($request->input('kurikulum') != "" && is_array($request->input('kurikulum'))) ||
			($request->input('kurikulum2') != "" && is_array($request->input('kurikulum2')))
		) {
			// Find or create tukang record
			$simpan = \App\Tukang::where('id', Auth::user()->id)->first();
			if (!$simpan) {
				// Create tukang if not exists
				$simpan = new \App\Tukang;
				$simpan->id = Auth::user()->id;
				$simpan->namatukang = Auth::user()->namaLengkap ?? 'Tukang';
				$simpan->id_kategoritukang = 1; // default category
				$simpan->lamapengalamanbekerja = '0';
				$simpan->pengalamanbekerja = '';
				$simpan->deskripsikeahlian = '';
				$simpan->rating = 0;
				$simpan->jumlahvote = 0;
				$simpan->totalvote = 0;
				$simpan->statuseditprofil = '0';
				$simpan->statusjasakeahlian = '0';
				$simpan->fotoktp = '';
				$simpan->fotosim = '';
				$simpan->fotohasilkerja = '';
				$simpan->save();
			}

			$tukangId = $simpan->id_tukang ?? $simpan->id;
			$hapusjt = \App\JasaTersedia::where('id_tukang', '=', $tukangId)->get();
			for ($i = 0; $i < count($hapusjt); $i++) {
				$hapusagain = \App\JasaTersedia::findOrFail($hapusjt[$i]['id_jasatersedia']);
				$hapusagain->delete();
			}
			$kurikulum3 = "";

			// Save Harian services if exists
			if ($request->input('kurikulum') && is_array($request->input('kurikulum'))) {
				for ($i = 0; $i < count($request->input('kurikulum')); $i++) {
					$jasatersedia = new \App\JasaTersedia;
					$jasatersedia->id_jenispemesanan = $request->input('kurikulumjp')[$i];
					$jasatersedia->biayajasatersedia = $request->input('kurikulum')[$i];
					$jasatersedia->jenisjasatersedia = '0';
					$jasatersedia->id_tukang = $tukangId;
					$jasatersedia->save();
				}
			}

			// Save Borongan services if exists
			if ($request->input('kurikulum2') && is_array($request->input('kurikulum2'))) {
				for ($i = 0; $i < count($request->input('kurikulum2')); $i++) {
					$jasatersedia = new \App\JasaTersedia;
					$jasatersedia->id_jenispemesanan = $request->input('kurikulumjp2')[$i];
					$jasatersedia->biayajasatersedia = $request->input('kurikulum2')[$i];
					$jasatersedia->jenisjasatersedia = '1';
					$jasatersedia->id_tukang = $tukangId;
					$jasatersedia->save();
				}
			}

			// Save experience if exists
			if ($request->input('kurikulum3') && is_array($request->input('kurikulum3'))) {
				for ($i = 0; $i < count($request->input('kurikulum3')); $i++) {
					if ($kurikulum3 == "") {
						$kurikulum3 = $request->input('kurikulum3')[$i];
					} else {
						$kurikulum3 = $kurikulum3 . "~" . $request->input('kurikulum3')[$i];
					}
				}
			}

			$simpan->pengalamanbekerja = $kurikulum3;
			$simpan->lamapengalamanbekerja = $request->input('pengalaman');
			$simpan->deskripsikeahlian = $request->input('deskripsi');
			$simpan->statusjasakeahlian = "1";
			$simpan->save();
			return redirect()->to('pengaturan-jasa-keahlian')->with('message_success', 'Pengaturan Jasa dan Keahlian Berhasil Diubah');
		} else
			return redirect()->to('pengaturan-jasa-keahlian')->with('message_failed', 'Pengaturan Jasa dan Keahlian Tidak Dapat Dilakukan Karena Ada Form Yang Belum Diisi');
	});
	Route::get('pengaturan-akun', function (Request $request) {

		return view('pengaturanakun');
	});
	Route::get('pengaturanakun', function () {
		return redirect()->to('pengaturan-akun');
	});
Route::post('pengaturan-akun', function (Request $request) {
	
    // ✅ VALIDASI NOMOR HP & REKENING (yang sudah ada)
    $request->validate([
        'nomorhandphone' => 'required|regex:/^[0-9+]+$/|min:10|max:15',
        'nomorrekening' => 'nullable|regex:/^[0-9]+$/|min:8|max:20',
		'fotoprofil' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
    ], [
        'nomorhandphone.required' => 'Nomor handphone wajib diisi',
        'nomorhandphone.regex' => 'Nomor handphone hanya boleh berisi angka',
        'nomorhandphone.min' => 'Nomor handphone minimal 10 digit',
        'nomorhandphone.max' => 'Nomor handphone maksimal 15 digit',
        'nomorrekening.regex' => 'Nomor rekening hanya boleh berisi angka',
        'nomorrekening.min' => 'Nomor rekening minimal 8 digit',
        'nomorrekening.max' => 'Nomor rekening maksimal 20 digit',
    ]);
    
    // ✅ TAMBAHKAN INI - VALIDASI FOTO PROFIL
    if ($request->hasFile('fotoprofil')) {
        $request->validate([
            'fotoprofil' => 'required|image|mimes:jpeg,jpg,png|max:2048'
        ], [
            'fotoprofil.image' => 'File harus berupa gambar',
            'fotoprofil.mimes' => 'Format file harus JPG atau PNG',
            'fotoprofil.max' => 'Ukuran file maksimal 2MB'
        ]);
    }
    // ====================================================================
    
    $users = \App\User::find(Auth::user()->id);
		if (Auth::user()->statuspengguna == '2') {
			$tukang = \App\Tukang::where('id', Auth::user()->id)->first();
			if (!$tukang) {
				// Create tukang if not exists with all required defaults
				$tukang = new \App\Tukang;
				$tukang->id = Auth::user()->id;
				$tukang->namatukang = $request->input('name');
				$tukang->id_kategoritukang = 1; // default category
				$tukang->lamapengalamanbekerja = '0';
				$tukang->pengalamanbekerja = '';
				$tukang->deskripsikeahlian = '';
				$tukang->rating = 0;
				$tukang->jumlahvote = 0;
				$tukang->totalvote = 0;
				$tukang->statuseditprofil = '0';
				$tukang->statusjasakeahlian = '0';
				$tukang->fotoktp = '';
				$tukang->fotosim = '';
				$tukang->fotohasilkerja = '';
				$tukang->save();
			} else {
				$tukang->namatukang = $request->input('name');
			}

			$tukang->statuseditprofil = '1';
			        if ($request->hasFile('fotoprofil')) {
            // Hapus foto lama jika bukan default
            if ($users->fotoprofil && $users->fotoprofil !== 'nopicture.jpg') {
                $oldFile = public_path('images/fotoprofil/' . $users->fotoprofil);
                if (file_exists($oldFile)) {
                    @unlink($oldFile);
                }
            }
            
            // Upload dengan nama konsisten: fotoprofil{userId}.jpg
            $fotoprofil = 'fotoprofil' . Auth::user()->id . '.jpg';
            $request->file('fotoprofil')->move('images/fotoprofil', $fotoprofil);
            $users->fotoprofil = $fotoprofil;
        }
        
        $tukang->save();
		} else if (Auth::user()->statuspengguna == '1') {
			$pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
			if ($pelanggan) {
				$pelanggan->namapelanggan = $request->input('name');
				if ($request->hasFile('fotoprofil')) {
					$fotoprofil = 'fotoprofil' . Auth::user()->id . '.jpg';
					$request->file('fotoprofil')->move('images/fotoprofil', $fotoprofil);
					$users->fotoprofil = $fotoprofil;
				}
				$pelanggan->save();
			} else {
				// Create pelanggan if not exists
				$pelanggan = new \App\Pelanggan;
				$pelanggan->id = Auth::user()->id;
				$pelanggan->namapelanggan = $request->input('name');
				$pelanggan->save();

				if ($request->hasFile('fotoprofil')) {
					$fotoprofil = 'fotoprofil' . Auth::user()->id . '.jpg';
					$request->file('fotoprofil')->move('images/fotoprofil', $fotoprofil);
					$users->fotoprofil = $fotoprofil;
				}
			}
		} else {
			// Admin - just update photo if exists
			if ($request->hasFile('fotoprofil')) {
				$fotoprofil = 'fotoprofil' . Auth::user()->id . '.jpg';
				$request->file('fotoprofil')->move('images/fotoprofil', $fotoprofil);
				$users->fotoprofil = $fotoprofil;
			}
		}

		if ($request->input('password') != "") {
			$users->password = bcrypt($request->input('password'));
		}
		$users->email = $request->input('email');
		$users->alamat = $request->input('alamat');
		$users->nomorhandphone = $request->input('nomorhandphone');
		$users->nomorrekening = $request->input('nomorrekening');
		$users->namarekening = $request->input('namarekening');
		$users->namaLengkap = $request->input('name');

		// Only update location if provided
		if ($request->input('latitude') != "") {
			$users->latitude = $request->input('latitude');
			$users->longtitude = $request->input('longtitude');
		}

		$users->save();
		return redirect()->to('pengaturan-akun')->with('message_success', 'Informasi akun dan profil berhasil diperbaharui');
	});

	Route::get('cari-tukang', function (Request $request) {

		// ===============================
		// VALIDASI KOORDINAT USER
		// ===============================
		if (Auth::user()->latitude == "" || Auth::user()->longtitude == "") {
			return redirect()->back()
				->with('message_failed', 'Silahkan isi koordinat lokasi Anda terlebih dahulu di halaman Edit Profil');
		}

		// ===============================
		// HAVERSINE FUNCTION (METER)
		// ===============================
		function haversineGreatCircleDistance(
			$latitudeFrom,
			$longitudeFrom,
			$latitudeTo,
			$longitudeTo,
			$earthRadius = 6371000
		) {
			$latFrom = deg2rad($latitudeFrom);
			$lonFrom = deg2rad($longitudeFrom);
			$latTo = deg2rad($latitudeTo);
			$lonTo = deg2rad($longitudeTo);

			$latDelta = $latTo - $latFrom;
			$lonDelta = $lonTo - $lonFrom;

			$angle = 2 * asin(sqrt(
				pow(sin($latDelta / 2), 2) +
				cos($latFrom) * cos($latTo) *
				pow(sin($lonDelta / 2), 2)
			));

			return $angle * $earthRadius;
		}

		// ===============================
		// DATA USER
		// ===============================
		$lat = Auth::user()->latitude;
		$lng = Auth::user()->longtitude;

		// ===============================
		// INPUT FILTER
		// ===============================
		$kategori = $request->input('kategori'); // id atau 'all'
		$radius = $request->input('jarak') ? $request->input('jarak') * 1000 : 5000;
		$nama = $request->input('nama');

		$radiusnya = [];
		$i = 0;

		// ===============================
		// QUERY TUKANG
		// ===============================
		$query = \App\Tukang::select('tukang.*', 'users.latitude', 'users.longtitude', 'users.email', 'users.alamat', 'users.fotoprofil', 'kategoritukang.kategoritukang as namakategori')
			->join('users', 'users.id', '=', 'tukang.id')
			->join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'tukang.id_kategoritukang')
			->where('statuseditprofil', '1')
			->where('statusjasakeahlian', '1')
			->where('users.statusverifikasi', '1'); // ✅ TAMBAHKAN INI UTK VERIFIKASI TUKANG AKTIF

		// FILTER KATEGORI
		if ($kategori != '' && $kategori != 'all') {
			$query->where('tukang.id_kategoritukang', '=', $kategori);
		}

		// FILTER NAMA
		if ($nama != '') {
			$query->where('namatukang', 'LIKE', '%' . $nama . '%');
		}

		$tukang = $query->get();
		$tukang = $tukang->keyBy('id_tukang');

		// ===============================
		// FILTER RADIUS (HAVERSINE)
		// ===============================
		foreach ($tukang as $tuka) {

			$jarak = haversineGreatCircleDistance(
				$lat,
				$lng,
				$tuka->latitude,
				$tuka->longtitude
			);

			if ($jarak > $radius) {
				$tukang->forget($tuka->id_tukang);
			} else {
				$radiusnya[$i] = $jarak;
				$i++;
			}
		}

		// ===============================
		// KATEGORI TUKANG
		// ===============================
		$kategoritukang = \App\KategoriTukang::get();

		// ===============================
		// RETURN VIEW
		// ===============================
		return view('caritukang', compact(
			'tukang',
			'lat',
			'lng',
			'radius',
			'radiusnya',
			'kategoritukang'
		));
	});
	Route::get('caritukang', function (Request $request) {
		return redirect()->to('cari-tukang' . ($request->getQueryString() ? '?' . $request->getQueryString() : ''));
	});

	// Detailtukang route - redirect to cari-tukang rincian-biaya
	Route::get('detailtukang/{idtukang}', function ($idtukang) {
		return redirect()->to('cari-tukang/' . $idtukang . '/rincian-biaya');
	});

	Route::get('cari-tukang/{idtukang}/rincian-biaya', function ($idtukang, Request $request) {
		$tukang = \App\Tukang::join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'tukang.id_kategoritukang')->join('users', 'users.id', '=', 'tukang.id')->findOrFail($idtukang);
		$jasatersediaharian = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', $idtukang)->where('jenisjasatersedia', '=', '0')->get();
		$jasatersediaborongan = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', $idtukang)->where('jenisjasatersedia', '=', '1')->get();
		$pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
		$alamatpelanggan = $pelanggan ? \App\AlamatPelanggan::where('id_pelanggan', '=', $pelanggan->id_pelanggan)->get() : collect([]);
		return view('detailtukangrincianbiaya')->with(['idtukang' => $idtukang, 'tukang' => $tukang, 'jasatersediaharian' => $jasatersediaharian, 'jasatersediaborongan' => $jasatersediaborongan, 'alamatpelanggan' => $alamatpelanggan]);
	});
	Route::get('cari-tukang/{idtukang}/pengalaman-bekerja', function ($idtukang, Request $request) {
		$tukang = \App\Tukang::join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'tukang.id_kategoritukang')->join('users', 'users.id', '=', 'tukang.id')->findOrFail($idtukang);
		$jasatersediaharian = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', $idtukang)->where('jenisjasatersedia', '=', '0')->get();
		$jasatersediaborongan = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', $idtukang)->where('jenisjasatersedia', '=', '1')->get();
		$pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
		$alamatpelanggan = $pelanggan ? \App\AlamatPelanggan::where('id_pelanggan', '=', $pelanggan->id_pelanggan)->get() : collect([]);
		return view('detailtukangpengalamanbekerja')->with(['idtukang' => $idtukang, 'tukang' => $tukang, 'jasatersediaharian' => $jasatersediaharian, 'jasatersediaborongan' => $jasatersediaborongan, 'alamatpelanggan' => $alamatpelanggan]);
	});
	Route::get('cari-tukang/{idtukang}/deskripsi-keahlian', function ($idtukang, Request $request) {
		$tukang = \App\Tukang::join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'tukang.id_kategoritukang')->join('users', 'users.id', '=', 'tukang.id')->findOrFail($idtukang);
		$jasatersediaharian = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', $idtukang)->where('jenisjasatersedia', '=', '0')->get();
		$jasatersediaborongan = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', $idtukang)->where('jenisjasatersedia', '=', '1')->get();
		$pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
		$alamatpelanggan = $pelanggan ? \App\AlamatPelanggan::where('id_pelanggan', '=', $pelanggan->id_pelanggan)->get() : collect([]);
		// Calculate completed projects (statuspemesanan 4 = selesai, 5 = selesai + reviewed)
		$jumlahProyekSelesai = \App\Pemesanan::where('id_tukang', '=', $idtukang)->whereIn('statuspemesanan', ['4', '5'])->count();
		return view('detailtukangdeskripsikeahlian')->with(['idtukang' => $idtukang, 'tukang' => $tukang, 'jasatersediaharian' => $jasatersediaharian, 'jasatersediaborongan' => $jasatersediaborongan, 'alamatpelanggan' => $alamatpelanggan, 'jumlahProyekSelesai' => $jumlahProyekSelesai]);
	});
	Route::get('cari-tukang/{idtukang}/komentar-pelanggan', function ($idtukang, Request $request) {
		$tukang = \App\Tukang::join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'tukang.id_kategoritukang')->join('users', 'users.id', '=', 'tukang.id')->findOrFail($idtukang);
		$jasatersediaharian = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', $idtukang)->where('jenisjasatersedia', '=', '0')->get();
		$jasatersediaborongan = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', $idtukang)->where('jenisjasatersedia', '=', '1')->get();
		$pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
		$alamatpelanggan = $pelanggan ? \App\AlamatPelanggan::where('id_pelanggan', '=', $pelanggan->id_pelanggan)->get() : collect([]);
		$id_pelanggan = $pelanggan ? $pelanggan->id_pelanggan : null;
		$jumlahkomentar = \App\Pemesanan::where('pemesanan.id_tukang', '=', $idtukang)->where('pemesanan.id_pelanggan', '=', $id_pelanggan)->where('statuspemesanan', '=', '4')->get();
		$ulasan = \App\Ulasan::select('ulasan.created_at as tanggalulasan', 'pelanggan.*', 'ulasan.*', 'users.*')->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'ulasan.id_pelanggan')->join('users', 'users.id', '=', 'pelanggan.id')->where('ulasan.id_tukang', '=', $idtukang)->orderby('id_ulasan', 'DESC')->get();

		return view('detailtukangkomentarpelanggan')->with(['idtukang' => $idtukang, 'tukang' => $tukang, 'jasatersediaharian' => $jasatersediaharian, 'jasatersediaborongan' => $jasatersediaborongan, 'alamatpelanggan' => $alamatpelanggan, 'jumlahkomentar' => $jumlahkomentar, 'ulasan' => $ulasan]);
	});
	Route::post('cari-tukang/{idtukang}/komentar-pelanggan', function ($idtukang, Request $request) {
		$rating = new \App\Ulasan;
		$tukang = \App\Tukang::find($idtukang);
		$pemesanan = \App\Pemesanan::find($request->input('idpemesanan'));
		$pemesanan->statuspemesanan = "5";
		$pemesanan->save();
		$notifikasi = new \App\Notifikasi;
		$tukang->rating = ($tukang->totalvote + $request->input('nilairating')) / ($tukang->jumlahvote + 1);
		$tukang->jumlahvote += 1;
		$tukang->totalvote += $request->input('nilairating');
		$tukang->save();

		// Get pelanggan id properly
		$pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
		$id_pelanggan = $pelanggan ? $pelanggan->id_pelanggan : null;

		$rating->id_tukang = $idtukang;
		$rating->id_pelanggan = $id_pelanggan;
		$rating->nilairating = $request->input('nilairating');
		$rating->isiulasan = $request->input('isiulasan');
		$rating->save();
		$notifikasi->isinotifikasi = "telah memberikan ulasan terhadap jasa anda dengan nilai rating " . $request->input('nilairating');
		$notifikasi->dari = Auth::user()->id;
		$notifikasi->kepada = $tukang->id;
		$notifikasi->jenisnotifikasi = "caritukang/" . $idtukang . "/komentarpelanggan";
		$notifikasi->statusnotifikasi = "0";
		$notifikasi->save();
		return redirect()->to('cari-tukang' . '/' . $idtukang . '/komentar-pelanggan')->with('message_success', 'Terima Kasih Telah Memberikan Ulasan Terhadap Penggunaan Jasa Penyedia Jasa Renovasi Yang Bersangkutan');
	});

	// Backward compatibility redirects for old caritukang sub-URLs
	Route::get('caritukang/{idtukang}/rincianbiaya', function ($idtukang) {
		return redirect()->to('cari-tukang/' . $idtukang . '/rincian-biaya');
	});
	Route::get('caritukang/{idtukang}/pengalamanbekerja', function ($idtukang) {
		return redirect()->to('cari-tukang/' . $idtukang . '/pengalaman-bekerja');
	});
	Route::get('caritukang/{idtukang}/deskripsikeahlian', function ($idtukang) {
		return redirect()->to('cari-tukang/' . $idtukang . '/deskripsi-keahlian');
	});
	Route::get('caritukang/{idtukang}/komentarpelanggan', function ($idtukang) {
		return redirect()->to('cari-tukang/' . $idtukang . '/komentar-pelanggan');
	});
	Route::get('caritukang/{idtukang}/lokasi', function ($idtukang) {
		return redirect()->to('cari-tukang/' . $idtukang . '/lokasi');
	});

	Route::get('cari-tukang/{idtukang}/lokasi', function ($idtukang, Request $request) {
		$tukang = \App\Tukang::join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'tukang.id_kategoritukang')->join('users', 'users.id', '=', 'tukang.id')->findOrFail($idtukang);
		$jasatersediaharian = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', $idtukang)->where('jenisjasatersedia', '=', '0')->get();
		$jasatersediaborongan = \App\JasaTersedia::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'jasatersedia.id_jenispemesanan')->where('id_tukang', '=', $idtukang)->where('jenisjasatersedia', '=', '1')->get();
		$alamatpelanggan = \App\AlamatPelanggan::where('id_pelanggan', '=', Auth::user()->id_pelanggan)->get();
		return view('detailtukanglokasi')->with(['idtukang' => $idtukang, 'tukang' => $tukang, 'jasatersediaharian' => $jasatersediaharian, 'jasatersediaborongan' => $jasatersediaborongan, 'alamatpelanggan' => $alamatpelanggan]);
	});

Route::post('cari-tukang/{idtukang}/pesan', function ($idtukang, Request $request) {
    function quickRandom($length) {
        $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
    }
    
    // Fungsi haversine untuk hitung jarak
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
    
    if ($request->input('jenis') == "0") {
        $inputJasa = $request->input('jenispemesanan');
    } else {
        $inputJasa = $request->input('jenispemesanan2');
    }

    if (empty($inputJasa) || !str_contains($inputJasa, ',')) {
        return redirect()->to('cari-tukang/' . $idtukang . '/rincian-biaya')
            ->with('message_failed', 'Tukang ini belum menyediakan jasa. Silakan pilih tukang lain.');
    }

    $hasilpotonganjp = explode(",", $inputJasa);

    if (!isset($hasilpotonganjp[0]) || !isset($hasilpotonganjp[1])) {
        return redirect()->to('cari-tukang/' . $idtukang . '/rincian-biaya')
            ->with('message_failed', 'Data jasa tidak valid. Silakan pilih jasa yang tersedia.');
    }

    if (Auth::user()->saldo < $hasilpotonganjp[1])
        return redirect()->to('cari-tukang/' . $idtukang . '/rincian-biaya')
            ->with('message_failed', 'Saldo Tidak Mencukupi');
    else {
        $pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
        if (!$pelanggan) {
            $pelanggan = new \App\Pelanggan;
            $pelanggan->id = Auth::user()->id;
            $pelanggan->namapelanggan = Auth::user()->namaLengkap ?? 'User';
            $pelanggan->save();

            $userUpdate = \App\User::find(Auth::user()->id);
            $userUpdate->id_pelanggan = $pelanggan->id_pelanggan;
            $userUpdate->save();
        }

        $pesan = new \App\Pemesanan;
        $tukang = \App\Tukang::find($idtukang);
        $pesan->id_tukang = $idtukang;
        $pesan->id_pelanggan = $pelanggan->id_pelanggan;
        $pesan->id_kategoritukang = $tukang->id_kategoritukang;
        $pesan->id_jenispemesanan = $hasilpotonganjp[0];
        $pesan->biayajasa = $hasilpotonganjp[1];
        $pesan->nomorpemesanan = 'NP' . quickRandom(8);
        $pesan->tanggalbekerja = $request->input('tanggalbekerja');
        if ($request->input('jenis') != "0")
            $pesan->tanggalselesai = $request->input('tanggalselesai');
        else
            $pesan->tanggalselesai = $request->input('tanggalbekerja');
        $pesan->catatan = $request->input('catatan');
        $pesan->kategoripemesanan = $request->input('jenis');
        
        if ($request->hasFile('foto1')) {
            $fotoproduk1 = 'fotopesan1' . date('YmdHis') . '.jpg';
            $request->file('foto1')->move('images/fotoproduk', $fotoproduk1);
            $pesan->fotopemesanan1 = $fotoproduk1;
        }
        if ($request->hasFile('foto2')) {
            $fotoproduk2 = 'fotopesan2' . date('YmdHis') . '.jpg';
            $request->file('foto2')->move('images/fotoproduk', $fotoproduk2);
            $pesan->fotopemesanan2 = $fotoproduk2;
        }
        
        $hasilpotongan = explode(",", $request->input('alamatpemesanan'));
        if (count($hasilpotongan) < 3 || empty($hasilpotongan[0]) || empty($hasilpotongan[1]) || empty($hasilpotongan[2])) {
            return redirect()->to('cari-tukang/' . $idtukang . '/rincian-biaya')
                ->with('message_failed', 'Silakan pilih alamat pengerjaan terlebih dahulu. Jika belum ada, tambahkan alamat di menu Tambah Alamat.');
        }
        $pesan->alamatpemesanan = $hasilpotongan[0];
        $pesan->latitudepemesanan = $hasilpotongan[1];
        $pesan->longtitudepemesanan = $hasilpotongan[2];
        
        // ✅ TAMBAHAN: SIMPAN SNAPSHOT JARAK & HARGA
        $hargaJarakRecord = \App\HargaJarak::find("1");
        $hargaPerKmSaatIni = $hargaJarakRecord ? $hargaJarakRecord->hargajarak : 5000;
        
        $jarakMeter = haversineGreatCircleDistance(
            3.587971813394123, 
            98.69062542915344, 
            $pesan->latitudepemesanan, 
            $pesan->longtitudepemesanan
        );
        $jarakKm = $jarakMeter / 1000;
        
        $pesan->jarak_km = $jarakKm;
        $pesan->harga_per_km = $hargaPerKmSaatIni;
        $pesan->biaya_jarak = round($jarakKm * $hargaPerKmSaatIni);
        // ✅ END TAMBAHAN
        
        $pesan->statuspemesanan = "0";
        $pesan->statusubahharga = "0";
        $pesan->save();
        
        $users = \App\User::find(Auth::user()->id);
        $users->saldo -= $hasilpotonganjp[1];
        $users->save();

        $riwayat = new \App\RiwayatTransaksi;
        $riwayat->kode = 'PJ' . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
        $riwayat->id = Auth::user()->id;
        $riwayat->jumlahsaldo = $hasilpotonganjp[1];
        $riwayat->jenistransaksi = "Pembayaran Jasa";
        $riwayat->statustransaksi = "1";
        $riwayat->rekening = $pesan->nomorpemesanan;
        $riwayat->namarekening = $tukang->namatukang ?? 'Tukang';
        $riwayat->save();

        $notifikasi = new \App\Notifikasi;
        $notifikasi->kepada = $tukang->id;
        $notifikasi->isinotifikasi = "telah melakukan pemesanan terhadap jasa anda";
        $notifikasi->statusnotifikasi = '0';
        $notifikasi->dari = Auth::user()->id;
        $notifikasi->jenisnotifikasi = "permintaanpesanan";
        $notifikasi->save();
        
        return redirect()->to('cari-tukang/' . $idtukang . '/rincian-biaya')
            ->with('message_success', 'Pemesanan Penyedia Jasa Renovasi Berhasil');
    }
});

	Route::get('tambah-alamat', function (Request $request) {
		// Find pelanggan via the 'id' column (which links to users.id)
		$pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
		$alamatpelanggan = $pelanggan
			? \App\AlamatPelanggan::where('id_pelanggan', '=', $pelanggan->id_pelanggan)->get()
			: collect([]);
		return view('tambahalamatpelanggan')->with(['alamatpelanggan' => $alamatpelanggan]);
	});
	Route::get('tambahalamat', function () {
		return redirect()->to('tambah-alamat');
	});
	Route::post('tambah-alamat', function (Request $request) {
		if ($request->input('latitude') == Auth::user()->latitude) {
			$redirect = $request->input('redirect', 'tambah-alamat');
			return redirect()->to($redirect)->with('message_failed', 'Koordinat Peta Belum Diubah');
		} else {
			// Find or create pelanggan via the 'id' column (which links to users.id)
			$pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
			if (!$pelanggan) {
				// Create new pelanggan record linked to this user
				$pelanggan = new \App\Pelanggan;
				$pelanggan->id = Auth::user()->id;
				$pelanggan->namapelanggan = Auth::user()->namaLengkap ?? 'User';
				$pelanggan->save();
			}

			$alamatpelanggan = new \App\AlamatPelanggan;
			$alamatpelanggan->alamatpelanggan = $request->input('alamat');
			$alamatpelanggan->latitudealamat = $request->input('latitude');
			$alamatpelanggan->longtitudealamat = $request->input('longtitude');
			$alamatpelanggan->id_pelanggan = $pelanggan->id_pelanggan;
			$alamatpelanggan->save();

			// Check if there's a redirect parameter
			$redirect = $request->input('redirect');
			if ($redirect) {
				return redirect()->to($redirect)->with('message_success', 'Alamat pelanggan berhasil ditambahkan');
			}
			return redirect()->to('tambah-alamat')->with('message_success', 'Alamat pelanggan berhasil ditambahkan');
		}
	});
	Route::post('tambah-alamat/{idalamat}', function ($idalamat, Request $request) {
		$alamatpelanggan = \App\AlamatPelanggan::findOrFail($idalamat);
		$alamatpelanggan->delete();
		return redirect()->to('tambah-alamat')->with('message_success', 'Data Alamat Berhasil Dihapus');
	});
	Route::get('isi-saldo', function (Request $request) {
		$riwayatTopup = \App\RiwayatTransaksi::where('id', '=', Auth::user()->id)
			->where('jenistransaksi', '=', 'Pengisian Saldo')
			->orderBy('created_at', 'DESC')
			->get();
		return view('isisaldoelektronik')->with(['riwayatTopup' => $riwayatTopup]);
	});
	Route::get('isisaldo', function () {
		return redirect()->to('isi-saldo');
	});
	Route::post('isi-saldo', function (Request $request) {
		function quickRandom($length)
		{
			$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
		}
		$saldo = new \App\RiwayatTransaksi;
		if ($request->input('jumlahsaldouser') >= 10000) {
			$kode = "KT" . quickRandom(3);
			$saldo->kode = $kode;
			$saldo->id = Auth::user()->id;
			$jumlahsaldo = $request->input('jumlahsaldouser');
			$saldo->jumlahsaldo = $jumlahsaldo;
			$saldo->rekening = $request->input('nomorrekeninganda');
			$saldo->namarekening = $request->input('namapemilik');
			$saldo->rekeningtujuan = $request->input('nomorrekening');
			$saldo->jenistransaksi = "Pengisian Saldo";
			$saldo->statustransaksi = "0";
			$buktitransfer = 'buktitransfer' . $kode . '.jpg';
			$request->file('buktitransfer')->move('images/buktitransfer', $buktitransfer);
			$saldo->buktitransaksi = $buktitransfer;
			$saldo->save();
			return redirect()->to('isi-saldo')->with('message_success', 'Silahkan Menunggu Beberapa Saat, Admin Akan Melakukan Konfirmasi Terhadap Transaksi Anda');
		} else
			return redirect()->to('isi-saldo')->with('message_failed', 'Saldo Yang di Top Up Kurang dari Rp. 10,000.00');
	});
	Route::get('riwayat-transaksi', function (Request $request) {
		if (Auth::user()->statuspengguna == "0")
			$riwayattransaksi = \App\RiwayatTransaksi::get();
		else
			$riwayattransaksi = \App\RiwayatTransaksi::where('id', '=', Auth::user()->id)->get();
		return view('riwayattransaksi')->with(['riwayattransaksi' => $riwayattransaksi]);
	});
	Route::get('riwayattransaksi', function () {
		return redirect()->to('riwayat-transaksi');
	});
	Route::get('notifikasi', function (Request $request) {
		$user = Auth::user();

		// For admin, show pending items as notifications
		if ($user->statuspengguna == '0') {
			$adminNotifications = collect();

			// Pending Tukang Verifications
			$pendingTukangs = \App\User::join('tukang', 'tukang.id', '=', 'users.id')
				->where('users.statusverifikasi', '=', '0')
				->select('users.*', 'tukang.namatukang')
				->get();
			foreach ($pendingTukangs as $tukang) {
				$adminNotifications->push((object) [
					'id_notifikasi' => 'ver_' . $tukang->id,
					'isinotifikasi' => 'menunggu verifikasi akun tukang',
					'kodeuser' => $tukang->kodeuser ?? $tukang->namatukang,
					'jenisnotifikasi' => 'verifikasi-tukang',
					'tanggalnotifikasi' => $tukang->created_at,
					'statusnotifikasi' => '0',
					'type' => 'verification'
				]);
			}

			// Pending Top-ups
			$pendingTopups = \App\RiwayatTransaksi::where('statustransaksi', '=', '0')
				->where('jenistransaksi', '=', 'Pengisian Saldo')
				->get();
			foreach ($pendingTopups as $topup) {
				$userTopup = \App\User::find($topup->id);
				$adminNotifications->push((object) [
					'id_notifikasi' => 'topup_' . $topup->id_riwayattransaksi,
					'isinotifikasi' => 'mengajukan top-up saldo Rp ' . number_format($topup->jumlahsaldo, 0, ',', '.'),
					'kodeuser' => $userTopup->kodeuser ?? 'User',
					'jenisnotifikasi' => 'konfirmasi-update-saldo',
					'tanggalnotifikasi' => $topup->created_at,
					'statusnotifikasi' => '0',
					'type' => 'topup'
				]);
			}

			// Pending Withdrawals
			$pendingWithdraws = \App\RiwayatTransaksi::where('statustransaksi', '=', '0')
				->where('jenistransaksi', '=', 'Penarikan Saldo')
				->get();
			foreach ($pendingWithdraws as $withdraw) {
				$userWithdraw = \App\User::find($withdraw->id);
				$adminNotifications->push((object) [
					'id_notifikasi' => 'withdraw_' . $withdraw->id_riwayattransaksi,
					'isinotifikasi' => 'mengajukan penarikan saldo Rp ' . number_format($withdraw->jumlahsaldo, 0, ',', '.'),
					'kodeuser' => $userWithdraw->kodeuser ?? 'User',
					'jenisnotifikasi' => 'konfirmasi-tarik-saldo',
					'tanggalnotifikasi' => $withdraw->created_at,
					'statusnotifikasi' => '0',
					'type' => 'withdraw'
				]);
			}

			// Sort by date descending and paginate
			$sortedNotifications = $adminNotifications->sortByDesc('tanggalnotifikasi');

			// Create custom paginator for unread (all pending items)
			$page = \Illuminate\Pagination\LengthAwarePaginator::resolveCurrentPage();
			$perPage = 10;
			$notifunread = new \Illuminate\Pagination\LengthAwarePaginator(
				$sortedNotifications->forPage($page, $perPage),
				$sortedNotifications->count(),
				$perPage,
				$page,
				['path' => url('/notifikasi')]
			);

			// Admin read notifications (empty for now - could track which items were handled)
			$notifread = new \Illuminate\Pagination\LengthAwarePaginator([], 0, 10, 1, ['path' => url('/notifikasi')]);

			return view('notifikasi')->with(['notifread' => $notifread, 'notifunread' => $notifunread, 'isAdmin' => true]);
		}

		// Regular user notifications
		$notifread = \App\Notifikasi::select(
			'notifikasi.*',
			'notifikasi.created_at as tanggalnotifikasi',
			'users.kodeuser',
			'users.email'
		)
			->join('users', 'users.id', '=', 'notifikasi.dari')
			->where('notifikasi.kepada', '=', Auth::user()->id)
			->where('notifikasi.statusnotifikasi', '=', '1')
			->orderBy('notifikasi.id_notifikasi', 'DESC')
			->paginate(6);

		$notifunread = \App\Notifikasi::select(
			'notifikasi.*',
			'notifikasi.created_at as tanggalnotifikasi',
			'users.kodeuser',
			'users.email'
		)
			->join('users', 'users.id', '=', 'notifikasi.dari')
			->where('notifikasi.kepada', '=', Auth::user()->id)
			->where('notifikasi.statusnotifikasi', '=', '0')
			->orderBy('notifikasi.id_notifikasi', 'DESC')
			->paginate(6);

		return view('notifikasi')->with(['notifread' => $notifread, 'notifunread' => $notifunread, 'isAdmin' => false]);
	});
	Route::get('permintaan-pesanan', function (Request $request) {
		// Get id_tukang from tukang relationship
		$tukang = \App\Tukang::where('id', Auth::user()->id)->first();
		$id_tukang = $tukang ? $tukang->id_tukang : null;

		$pesanan = \App\Pemesanan::where('id_tukang', '=', $id_tukang)->where('statuspemesanan', '=', '1')->get();
		$permintaan = \App\Pemesanan::join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'pemesanan.id_kategoritukang')->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'pemesanan.id_pelanggan')->join('users', 'users.id', '=', 'pelanggan.id')->join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'pemesanan.id_jenispemesanan')->where('pemesanan.id_tukang', '=', $id_tukang)->where('pemesanan.statuspemesanan', '=', '0')->orderby('pemesanan.id_pemesanan', 'DESC')->get();
		return view('permintaanpesanan')->with(['pesanan' => $pesanan, 'permintaan' => $permintaan]);
	});
	Route::get('permintaanpesanan', function () {
		return redirect()->to('permintaan-pesanan');
	});
	Route::post('permintaan-pesanan/{idpemesanan}/tolak', function ($idpemesanan, Request $request) {
		function quickRandom($length)
		{
			$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
		}
		$tolak = \App\Pemesanan::find($idpemesanan);
		$tolak->statuspemesanan = "2";
		$tolak->alasanpenolakanpemesanan = $request->input('alasanpenolakan');
		$tolak->save();
		$pelanggan = \App\Pelanggan::find($tolak->id_pelanggan);
		$users = \App\User::find($pelanggan->id);
		$users->saldo += $tolak->biayajasa;
		$users->save();
		$notifikasi = new \App\Notifikasi;
		$notifikasi->kepada = $pelanggan->id;
		$notifikasi->isinotifikasi = "telah menolak permintaan pesanan anda";
		$notifikasi->statusnotifikasi = '0';
		$notifikasi->dari = Auth::user()->id;
		$notifikasi->jenisnotifikasi = "riwayatpemesanan/" . $tolak->id_pemesanan . "?kategori=' . $tolak->id_kategoritukang . '&katakunci=";
		$notifikasi->save();
		return redirect()->to('permintaan-pesanan')->with('message_success', 'Permintaan Pesanan Berhasil Ditolak');
	});
	Route::post('permintaan-pesanan/{idpemesanan}/terima', function ($idpemesanan, Request $request) {
		function quickRandom($length)
		{
			$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
		}
		$terima = \App\Pemesanan::find($idpemesanan);
		$terima->statuspemesanan = "1";
		$terima->save();
		$pelanggan = \App\Pelanggan::find($terima->id_pelanggan);
		$notifikasi = new \App\Notifikasi;
		$notifikasi->kepada = $pelanggan->id;
		$notifikasi->isinotifikasi = "telah menerima permintaan pesanan anda dengan nomor pemesanan " . $terima->nomorpemesanan;
		$notifikasi->statusnotifikasi = '0';
		$notifikasi->dari = Auth::user()->id;
		$notifikasi->jenisnotifikasi = "riwayatpemesanan/" . $terima->id_pemesanan . "?kategori=" . $terima->id_kategoritukang . "&katakunci=";
		$notifikasi->save();
		return redirect()->to('permintaan-pesanan')->with('message_success', 'Permintaan Pesanan Berhasil Diterima');
	});
	Route::get('penarikan-saldo', function (Request $request) {
		return view('penarikansaldoelektronik');
	});
	Route::get('penarikansaldo', function () {
		return redirect()->to('penarikan-saldo');
	});
	Route::post('penarikan-saldo', function (Request $request) {
		function quickRandom($length)
		{
			$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
		}
		if ($request->input('jumlahsaldouser') <= Auth::user()->saldo) {
			$kode = "KT" . quickRandom(8);
			$saldo = new \App\RiwayatTransaksi;
			$users = \App\User::find(Auth::user()->id);
			$saldo->kode = $kode;
			$saldo->id = Auth::user()->id;
			$jumlahsaldo = $request->input('jumlahsaldouser') - ($request->input('jumlahsaldouser') * 5 / 100);
			$saldo->jumlahsaldo = $jumlahsaldo;
			$saldo->rekening = Auth::user()->nomorrekening;
			$saldo->namarekening = Auth::user()->namatukang;
			$saldo->jenistransaksi = "Penarikan Saldo";
			$saldo->statustransaksi = "0";
			$saldo->save();
			// Saldo dikurangi HANYA saat admin approve, bukan di sini
			return redirect()->to('penarikan-saldo')->with('message_success', 'Penarikan Saldo Berhasil Dilakukan, Silahkan Tunggu Konfirmasi Admin');
		} else
			return redirect()->to('penarikan-saldo')->with('message_failed', 'Jumlah Saldo Yang Ingin Ditarik Melebihi Saldo Anda');
	});
	Route::get('riwayatpemesanan', function (Request $request) {
		if (Auth::user()->statuspengguna == '2') {
			// Get id_tukang from tukang relationship (consistent with permintaan-pesanan route)
			$tukang = \App\Tukang::where('id', Auth::user()->id)->first();
			$id_tukang = $tukang ? $tukang->id_tukang : null;

			$riwayatpemesanan = \App\Pemesanan::join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'pemesanan.id_kategoritukang')->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'pemesanan.id_pelanggan')->join('users', 'users.id', '=', 'pelanggan.id')->where('id_tukang', '=', $id_tukang)->orderby('id_pemesanan', 'DESC')->get();

			// Get active orders (statuspemesanan = 1) for Pesanan Aktif section
			$pesananAktif = \App\Pemesanan::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'pemesanan.id_jenispemesanan')
				->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'pemesanan.id_pelanggan')
				->join('users', 'users.id', '=', 'pelanggan.id')
				->where('pemesanan.id_tukang', '=', $id_tukang)
				->where('statuspemesanan', '=', '1')
				->orderby('id_pemesanan', 'DESC')
				->get();

			return view('riwayatpemesanan')->with(['riwayatpemesanan' => $riwayatpemesanan, 'pesananAktif' => $pesananAktif]);
		} elseif (Auth::user()->statuspengguna == '1') {
			// Find pelanggan via user id instead of relying on id_pelanggan which may be null
			$pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
			$id_pelanggan = $pelanggan ? $pelanggan->id_pelanggan : null;
			$riwayatpemesanan = \App\Pemesanan::join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'pemesanan.id_kategoritukang')->join('tukang', 'tukang.id_tukang', '=', 'pemesanan.id_tukang')->join('users', 'users.id', '=', 'tukang.id')->where('pemesanan.id_pelanggan', '=', $id_pelanggan)->orderby('id_pemesanan', 'DESC')->get();
			return view('riwayatpemesanan')->with(['riwayatpemesanan' => $riwayatpemesanan]);
		} elseif (Auth::user()->statuspengguna == '0') {
			$riwayatpemesanan = \App\Pemesanan::join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'pemesanan.id_kategoritukang')->join('tukang', 'tukang.id_tukang', '=', 'pemesanan.id_tukang')->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'pemesanan.id_pelanggan')->join('users', 'users.id', '=', 'tukang.id')->orderby('id_pemesanan', 'DESC')->get();
			return view('adminriwayatpemesanan')->with(['riwayatpemesanan' => $riwayatpemesanan]);
		}
	});

	Route::get('riwayatpemesanan/{idpemesanan}', function ($idpemesanan, Request $request) {
		$hasilpencarian = "";
		$pemesananbahan = "";
		$totalkeranjang = "0";
		$statuspemesanan = "";
		$laporanprogress = \App\LaporanProgress::join(
			'tukang',
			'tukang.id_tukang',
			'=',
			'laporanprogress.id_tukang'
		)
			->join(
				'users',
				'users.id',
				'=',
				'tukang.id'
			)
			->where('laporanprogress.id_pemesanan', '=', $idpemesanan)
			->orderBy('laporanprogress.tanggal_progress', 'desc')
			->select(
				'laporanprogress.*',
				'tukang.*'
			)
			->get();

		function haversineGreatCircleDistance($latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
		{
			$latFrom = deg2rad($latitudeFrom);
			$lonFrom = deg2rad($longitudeFrom);
			$latTo = deg2rad($latitudeTo);
			$lonTo = deg2rad($longitudeTo);
			$latDelta = $latTo - $latFrom;
			$lonDelta = $lonTo - $lonFrom;
			$angle = 2 * asin(sqrt(pow(sin($latDelta / 2), 2) + cos($latFrom) * cos($latTo) * pow(sin($lonDelta / 2), 2)));
			return $angle * $earthRadius;
		}
		if (Auth::user()->statuspengguna == '2') {
			// Get id_tukang from tukang relationship
			$tukang = \App\Tukang::where('id', Auth::user()->id)->first();
			$id_tukang = $tukang ? $tukang->id_tukang : null;

			$pemesananbahan = \App\PemesananBahanMaterial::join('bahanmaterial', 'bahanmaterial.id_bahanmaterial', '=', 'pemesananbahanmaterial.id_bahanmaterial')->where('id_pemesanan', '=', $idpemesanan)->get();
			$value = \App\Pemesanan::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'pemesanan.id_jenispemesanan')->join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'pemesanan.id_kategoritukang')->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'pemesanan.id_pelanggan')->join('users', 'users.id', '=', 'pelanggan.id')->where('id_tukang', '=', $id_tukang)->find($idpemesanan);

			if (!$value) {
				return redirect()->to('riwayatpemesanan')->with('message_failed', 'Pesanan tidak ditemukan');
			}

			$jarak = haversineGreatCircleDistance(3.587971813394123, 98.69062542915344, $value->latitudepemesanan, $value->longtitudepemesanan) / 1000;
			$hargajarak = \App\HargaJarak::find("1");
			$statuspemesanan = $value->statuspemesanan;
			$kategoritukang = \App\KategoriTukang::get();
			return view('detailriwayatpemesanan')->with(['value' => $value, 'jarak' => $jarak, 'hasilpencarian' => $hasilpencarian, 'pemesananbahan' => $pemesananbahan, 'idpemesanan' => $idpemesanan, 'totalkeranjang' => $totalkeranjang, 'statuspemesanan' => $statuspemesanan, 'hargajarak' => $hargajarak, 'laporanprogress' => $laporanprogress, 'kategoritukang' => $kategoritukang]);
		} elseif (Auth::user()->statuspengguna == '1') {

			$hargajarak = \App\HargaJarak::find(1);

			// Ambil bahan material untuk pesanan
			$pemesananbahan = \App\PemesananBahanMaterial::join('bahanmaterial', 'bahanmaterial.id_bahanmaterial', '=', 'pemesananbahanmaterial.id_bahanmaterial')
				->where('id_pemesanan', '=', $idpemesanan)
				->get();

			// Hitung total keranjang
			$totalkeranjang = 0;
			foreach ($pemesananbahan as $bahan) {
				if ($bahan->statuspembelian != "1") {
					$totalkeranjang += $bahan->hargapemesananbahanmaterial * $bahan->qtypembelian;
				}
			}

			// Find pelanggan via user id
			$pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
			$id_pelanggan = $pelanggan ? $pelanggan->id_pelanggan : null;

			// Ambil detail pesanan
			$value = \App\Pemesanan::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'pemesanan.id_jenispemesanan')
				->join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'pemesanan.id_kategoritukang')
				->join('tukang', 'tukang.id_tukang', '=', 'pemesanan.id_tukang')
				->join('users', 'users.id', '=', 'tukang.id')
				->where('id_pelanggan', '=', $id_pelanggan)
				->find($idpemesanan);

			$statuspemesanan = $value->statuspemesanan;

			// Hitung jarak (dalam km)
			$jarak = haversineGreatCircleDistance(
				3.587971813394123,
				98.69062542915344,
				$value->latitudepemesanan,
				$value->longtitudepemesanan
			) / 1000;

			// Ambil kategori dan kata kunci dari input
			$kategori = $request->input('kategori');
			$kataKunci = $request->input('katakunci');

			// Query bahan material
			$query = \App\BahanMaterial::where('statusbahanmaterial', '=', '1');

			if ($kategori != "all") { // jika bukan All, filter kategori
				$query->where('id_kategoritukang', '=', $kategori);
			}

			if ($kataKunci != "") { // jika ada kata kunci
				$query->where('bahanmaterial', 'LIKE', '%' . $kataKunci . '%');
			}

			$hasilpencarian = $query->get();

			// Get kategori tukang for dropdown
			$kategoritukang = \App\KategoriTukang::get();

			// Kirim data ke view
			return view('detailriwayatpemesanan')->with([
				'value' => $value,
				'jarak' => $jarak,
				'hasilpencarian' => $hasilpencarian,
				'pemesananbahan' => $pemesananbahan,
				'idpemesanan' => $idpemesanan,
				'totalkeranjang' => $totalkeranjang,
				'statuspemesanan' => $statuspemesanan,
				'hargajarak' => $hargajarak,
				'laporanprogress' => $laporanprogress,
				'kategoritukang' => $kategoritukang
			]);

		} elseif (Auth::user()->statuspengguna == '0') {
    $hargajarak = \App\HargaJarak::find("1");
    
    $value = \App\Pemesanan::join('jenispemesanan', 'jenispemesanan.id_jenispemesanan', '=', 'pemesanan.id_jenispemesanan')
        ->join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'pemesanan.id_kategoritukang')
        ->join('pelanggan', 'pelanggan.id_pelanggan', '=', 'pemesanan.id_pelanggan')
        ->join('users', 'users.id', '=', 'pelanggan.id')
        ->find($idpemesanan);
    
    $pemesananbahan = \App\PemesananBahanMaterial::join('bahanmaterial', 'bahanmaterial.id_bahanmaterial', '=', 'pemesananbahanmaterial.id_bahanmaterial')
        ->where('id_pemesanan', '=', $idpemesanan)
        ->get();
    
    // Gunakan data snapshot dari pemesanan
    if (!empty($value->jarak_km) && !empty($value->harga_per_km)) {
        // Pemesanan baru dengan snapshot
        $jarak = $value->jarak_km;
        $hargaPerKm = $value->harga_per_km;
        $biayaJarak = $value->biaya_jarak;
    } else {
        // Pemesanan lama tanpa snapshot
        $jarak = haversineGreatCircleDistance(
            3.587971813394123, 
            98.69062542915344, 
            $value->latitudepemesanan, 
            $value->longtitudepemesanan
        ) / 1000;
        $hargaPerKm = $hargajarak->hargajarak;
        $biayaJarak = round($jarak * $hargaPerKm);
    }
    
    $tukang = \App\Tukang::join('users', 'users.id', '=', 'tukang.id')
        ->join('kategoritukang', 'kategoritukang.id_kategoritukang', '=', 'tukang.id_kategoritukang')
        ->find($value->id_tukang);
    
    return view('admindetailriwayatpemesanan')->with([
        'value' => $value, 
        'jarak' => $jarak, 
        'hargaPerKm' => $hargaPerKm,
        'biayaJarak' => $biayaJarak,
        'pemesananbahan' => $pemesananbahan, 
        'idpemesanan' => $idpemesanan, 
        'totalkeranjang' => $totalkeranjang, 
        'statuspemesanan' => $statuspemesanan, 
        'tukang' => $tukang, 
        'hargajarak' => $hargajarak, 
        'laporanprogress' => $laporanprogress
    ]);
}
	});
	Route::post('riwayatpemesanan/{idpemesanan}/{idbahanmaterial}/masukkeranjang', function ($idpemesanan, $idbahanmaterial, Request $request) {
		$pemesanan = \App\Pemesanan::find($idpemesanan);
		$pemesananbahan = new \App\PemesananBahanMaterial;
		$pemesananbahan->id_bahanmaterial = $idbahanmaterial;
		$pemesananbahan->id_pemesanan = $idpemesanan;
		$pemesananbahan->qtypembelian = $request->input('qty');
		$pemesananbahan->hargapemesananbahanmaterial = $request->input('hargapemesanan');
		$pemesananbahan->statuspembelian = "0";
		$pemesananbahan->save();
		return redirect()->to('riwayatpemesanan' . '/' . $idpemesanan . '?kategori=all' . '&katakunci=')->with('message_success', 'Bahan Material Berhasil Ditambahkan Ke Keranjang');
	});
	Route::get('riwayatpemesanan/{idpemesanan}/{idpemesananbahanmaterial}/hapus', function ($idpemesanan, $idpemesananbahanmaterial, Request $request) {
		$pemesanan = \App\Pemesanan::find($idpemesanan);
		$pemesananbahan = \App\PemesananBahanMaterial::find($idpemesananbahanmaterial);
		$pemesananbahan->delete();
		return redirect()->to('riwayatpemesanan' . '/' . $idpemesanan . '?kategori=all' . '&katakunci=')->with('message_success', 'Item Bahan Material Berhasil Dihapus Dari Keranjang');
	});
Route::post('riwayatpemesanan/{idpemesanan}/prosespembelian', function ($idpemesanan, Request $request) {
    $pemesanan = \App\Pemesanan::find($idpemesanan);
    
    // Hitung total belanja (material + ongkir)
    $totalBelanja = $request->input('totalkeranjang') + $request->input('biayajarak');
    
    // ✅ CEK SALDO (penting!)
    if (Auth::user()->saldo < $totalBelanja) {
        return redirect()->to('riwayatpemesanan/' . $idpemesanan . '?kategori=' . $pemesanan->id_kategoritukang . '&katakunci=')
            ->with('message_failed', 'Saldo Tidak Mencukupi Untuk Melakukan Pembelian Bahan Material');
    } else {
        // Update status bahan material menjadi dibeli
        $pemesananbahan = \App\PemesananBahanMaterial::where('id_pemesanan', '=', $idpemesanan)->get();
        foreach ($pemesananbahan as $item) {
            $pemesananfind = \App\PemesananBahanMaterial::find($item->id_pemesananbahanmaterial);
            $pemesananfind->statuspembelian = "1";
            $pemesananfind->save();
        }
        
        $tukang = \App\Tukang::find($pemesanan->id_tukang);
        
        // Ubah status pemesanan ke "Dikerjakan"
        $pemesanan->statuspemesanan = '3';
        $pemesanan->save();
        
        $pelanggan = \App\Pelanggan::find($pemesanan->id_pelanggan);
        $users = \App\User::find($pelanggan->id);
        
        // ✅ KURANGI SALDO (Material + Ongkir)
        $users->saldo -= $totalBelanja;
        $users->save();
        
        // ✅ CATAT RIWAYAT TRANSAKSI
        if ($request->input('totalkeranjang') > 0) {
            $riwayat = new \App\RiwayatTransaksi;
            $riwayat->kode = 'BM' . substr(str_shuffle('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ'), 0, 6);
            $riwayat->id = Auth::user()->id;
            $riwayat->jumlahsaldo = $totalBelanja; // Total bahan + ongkir
            $riwayat->jenistransaksi = "Pembelian Bahan Material";
            $riwayat->statustransaksi = "1"; // Auto-approved
            $riwayat->rekening = $pemesanan->nomorpemesanan;
            $riwayat->namarekening = "Material + Ongkir (Rp " . number_format($request->input('biayajarak'), 0, ',', '.') . ")";
            $riwayat->save();
        }
        
        // Kirim notifikasi ke tukang
        if ($pemesanan->statuspemesanan == "1") {
            $notifikasi = new \App\Notifikasi;
            $notifikasi->kepada = $tukang->id;
            $notifikasi->isinotifikasi = "telah menyelesaikan pembelian bahan material dengan nomor pemesanan " . $pemesanan->nomorpemesanan . ". Silahkan Selesaikan Pekerjaan Anda";
            $notifikasi->statusnotifikasi = '0';
            $notifikasi->dari = Auth::user()->id;
            $notifikasi->jenisnotifikasi = "riwayatpemesanan/" . $pemesanan->id_pemesanan;
            $notifikasi->save();
        }
        
        if ($request->input('totalkeranjang') == '0') {
            return redirect()->to('riwayatpemesanan/' . $idpemesanan . '?kategori=' . $pemesanan->id_kategoritukang . '&katakunci=')
                ->with('message_success', 'Status Penyewaan Telah Berubah Tanpa Pembelian Bahan Material');
        } else {
            return redirect()->to('riwayatpemesanan/' . $idpemesanan . '?kategori=all&katakunci=')
                ->with('message_success', 'Pembelian Bahan Material Berhasil Dilakukan, Tim Kami Akan Segera Mengirimkannya Ke Alamat Pengerjaan');
        }
    }
});
	Route::post('riwayatpemesanan/{idpemesanan}/selesaidikerjakan', function ($idpemesanan, Request $request) {
		function quickRandom($length)
		{
			$pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
		}
		$pemesanan = \App\Pemesanan::find($idpemesanan);
		$pemesanan->statuspemesanan = '4';
		$pemesanan->save();
		$tukang = \App\Tukang::find($pemesanan->id_tukang);
		$users = \App\User::find($tukang->id);
		$users->saldo += $request->input('biayajasa');
		$users->save();
		$notifikasi = new \App\Notifikasi;
		$notifikasi->kepada = $tukang->id;
		$notifikasi->isinotifikasi = "telah mengkonfirmasi bahwa pekerjaan anda dengan nomor pemesanan" . $pemesanan->nomorpemesanan . " telah selesai, silahkan cek saldo anda akan secara otomatis bertambah";
		$notifikasi->statusnotifikasi = '0';
		$notifikasi->dari = Auth::user()->id;
		$notifikasi->jenisnotifikasi = "riwayatpemesanan/" . $pemesanan->id_pemesanan;
		$notifikasi->save();
		$saldo = new \App\RiwayatTransaksi;
		$kode = "KTABC" . quickRandom(5);
		$saldo->kode = $kode;
		$saldo->id = $tukang->id;
		$jumlahsaldo = $request->input('biayajasa');
		$saldo->jumlahsaldo = $jumlahsaldo;
		$saldo->jenistransaksi = "Pembayaran Biaya Jasa";
		$saldo->statustransaksi = "1";
		$saldo->save();
		return redirect()->to('riwayatpemesanan' . '/' . $idpemesanan . '?kategori=' . $pemesanan->id_kategoritukang . '&katakunci=')->with('message_success', 'Status Pemesanan Berhasil Diubah.. Silahkan Lakukan Pemberian Rating');
	});

	// Route untuk memberikan rating dari halaman detail pemesanan
	Route::post('riwayatpemesanan/{idpemesanan}/berikan-rating', function ($idpemesanan, Request $request) {
		// Validasi bahwa user adalah pemilik pesanan
		$pelanggan = \App\Pelanggan::where('id', Auth::user()->id)->first();
		$id_pelanggan = $pelanggan ? $pelanggan->id_pelanggan : null;

		$pemesanan = \App\Pemesanan::where('id_pelanggan', '=', $id_pelanggan)
			->where('statuspemesanan', '=', '4')
			->find($idpemesanan);

		if (!$pemesanan) {
			return redirect()->back()->with('message_failed', 'Anda tidak memiliki akses untuk memberikan rating pada pesanan ini');
		}

		// Update pemesanan status ke 5 (dinilai)
		$pemesanan->statuspemesanan = "5";
		$pemesanan->save();

		// Update rating tukang
		$tukang = \App\Tukang::find($pemesanan->id_tukang);
		$nilairating = $request->input('nilairating');
		$tukang->rating = ($tukang->totalvote + $nilairating) / ($tukang->jumlahvote + 1);
		$tukang->jumlahvote += 1;
		$tukang->totalvote += $nilairating;
		$tukang->save();

		// Simpan ulasan
		$ulasan = new \App\Ulasan;
		$ulasan->id_tukang = $pemesanan->id_tukang;
		$ulasan->id_pelanggan = $id_pelanggan;
		$ulasan->rating = $nilairating;
		$ulasan->isiulasan = $request->input('isiulasan');
		$ulasan->save();

		// Kirim notifikasi ke tukang
		$notifikasi = new \App\Notifikasi;
		$notifikasi->kepada = $tukang->id;
		$notifikasi->isinotifikasi = "telah memberikan ulasan terhadap jasa anda dengan nilai rating " . $nilairating;
		$notifikasi->statusnotifikasi = '0';
		$notifikasi->dari = Auth::user()->id;
		$notifikasi->jenisnotifikasi = "riwayatpemesanan/" . $idpemesanan;
		$notifikasi->save();

		return redirect()->to('riwayatpemesanan/' . $idpemesanan . '?kategori=' . $pemesanan->id_kategoritukang . '&katakunci=')->with('message_success', 'Terima kasih! Rating dan ulasan Anda telah berhasil dikirim.');
	});

	Route::post('riwayatpemesanan/{idpemesanan}/ubahbiaya', function ($idpemesanan, Request $request) {
		$pemesanan = \App\Pemesanan::find($idpemesanan);
		$pelanggan = \App\Pelanggan::find($pemesanan->id_pelanggan);
		$user = \App\User::find($pelanggan->id);
		$biaya = $request->input('biayajasaubah') - $pemesanan->biayajasa;
		$user->saldo -= $biaya;
		$user->save();
		$pemesanan->biayajasa = $request->input('biayajasaubah');
		$pemesanan->statusubahharga = "0";
		$pemesanan->save();
		return redirect()->to('riwayatpemesanan' . '/' . $idpemesanan . '?kategori=' . $pemesanan->id_kategoritukang . '&katakunci=')->with('message_success', 'Biaya Jasa Berhasil Diubah');
	});
	Route::post('riwayatpemesanan/{idpemesanan}/izinkan', function ($idpemesanan, Request $request) {
		$pemesanan = \App\Pemesanan::find($idpemesanan);
		$pemesanan->statusubahharga = "1";
		$pemesanan->save();
		return redirect()->to('riwayatpemesanan' . '/' . $idpemesanan . '?kategori=' . $pemesanan->id_kategoritukang . '&katakunci=')->with('message_success', 'Anda Mengizinkan Untuk Perubahan Biaya Jasa');
	});
	Route::get('admindrp', function (Request $request) {
		return view('admindetailriwayatpemesanan');
	});

	// Informasi User - dengan hyphen (new URL)
	Route::get('informasi-user', function (Request $request) {
		$user = \App\User::where('id', '!=', Auth::user()->id)->where('statusverifikasi', '>', '0')->get();
		return view('informasiuser', compact('user'));
	});

	Route::post('informasi-user/blokir', function (Request $request) {
		$terima = \App\User::find($request->input('iduser'));
		$terima->statusverifikasi = "2";
		$terima->save();
		return redirect()->to('informasi-user')->with('message_success', 'User Yang Dipilih Berhasil Diblokir');
	});
	Route::post('informasi-user/buka', function (Request $request) {
		$terima = \App\User::find($request->input('iduser'));
		$terima->statusverifikasi = "1";
		$terima->save();
		return redirect()->to('informasi-user')->with('message_success', 'User Yang Dipilih Berhasil Dibuka Blokirnya');
	});

	// Backward compatibility for old URL
	Route::get('informasiuser', function () {
		return redirect()->to('informasi-user');
	});
	Route::get('detailriwayatpemesanan', function (Request $request) {
		return view('detailriwayatpemesanan');
	});

	Route::post('riwayatpemesanan/{idpemesanan}/store', function (Request $request, $idpemesanan) {

		// VALIDASI
		$validator = Validator::make($request->all(), [
			'tanggal_progress' => 'required',
			'informasi_pekerjaan' => 'required',
			'fotoprogress1' => 'required|image|mimes:jpg,jpeg,png|max:2048',
			'fotoprogress2' => 'image|mimes:jpg,jpeg,png|max:2048',
			'fotoprogress3' => 'image|mimes:jpg,jpeg,png|max:2048',
			'fotoprogress4' => 'image|mimes:jpg,jpeg,png|max:2048',
			'fotoprogress5' => 'image|mimes:jpg,jpeg,png|max:2048',
		]);

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput()
				->with('open_tracking_modal', true);
		}

		$path = 'progress_pekerjaan';

		// Get id_tukang from tukang table via users.id
		$tukangData = \App\Tukang::where('id', Auth::user()->id)->first();
		$id_tukang = $tukangData ? $tukangData->id_tukang : null;

		// ====== PAKAI ELOQUENT SAVE ======
		$progress = new \App\LaporanProgress();
		$progress->id_pemesanan = $idpemesanan;
		$progress->id_tukang = $id_tukang;
		$progress->tanggal_progress = $request->tanggal_progress;
		$progress->informasi_pekerjaan = $request->informasi_pekerjaan;

		// UPLOAD FOTO
		for ($i = 1; $i <= 5; $i++) {
			if ($request->hasFile('fotoprogress' . $i)) {

				$file = $request->file('fotoprogress' . $i);
				$filename = 'progress_' . $idpemesanan . '_' . $i . '_' . time() . '.' . $file->getClientOriginalExtension();

				$file->move(public_path('storage/' . $path), $filename);

				$field = 'fotoprogress' . $i;
				$progress->$field = $path . '/' . $filename;
			}
		}

		// SIMPAN
		$progress->save();

		return redirect()->back()
			->with('open_tracking_modal', true)
			->with('success', 'Progress pekerjaan berhasil ditambahkan');

	});

	Route::post('progress/{id}/delete', function (Request $request, $id) {

		if (!Auth::check()) {
			return redirect('login');
		}

		// Ambil data progress
		$progress = \App\LaporanProgress::findOrFail($id);

		// Hapus semua foto yang ada
		for ($i = 1; $i <= 5; $i++) {
			$field = 'fotoprogress' . $i;
			if (!empty($progress->$field)) {
				$filePath = public_path('storage/' . $progress->$field);
				if (file_exists($filePath)) {
					@unlink($filePath);
				}
			}
		}

		// Hapus record dari database
		$progress->delete();

		return redirect()->back()
			->with('success', 'Progress pekerjaan berhasil dihapus')
			->with('open_tracking_modal', true); // supaya modal tracking tetap terbuka
	});

	Route::post('riwayatpemesanan/{idpemesanan}/update', function (Request $request, $idpemesanan) {

		if (!Auth::check()) {
			return redirect('login');
		}

		// Ambil progress berdasarkan id_progress
		$progress = \App\LaporanProgress::findOrFail($request->id_progress);

		// VALIDASI
		$validator = Validator::make($request->all(), [
			'tanggal_progress' => 'required',
			'informasi_pekerjaan' => 'required',
			'fotoprogress1' => 'image|mimes:jpg,jpeg,png|max:2048',
			'fotoprogress2' => 'image|mimes:jpg,jpeg,png|max:2048',
			'fotoprogress3' => 'image|mimes:jpg,jpeg,png|max:2048',
			'fotoprogress4' => 'image|mimes:jpg,jpeg,png|max:2048',
			'fotoprogress5' => 'image|mimes:jpg,jpeg,png|max:2048',
		]);

		if ($validator->fails()) {
			return redirect()->back()
				->withErrors($validator)
				->withInput()
				->with('open_tracking_modal', true);
		}

		$path = 'progress_pekerjaan';

		// UPDATE DATA
		$progress->tanggal_progress = $request->tanggal_progress;
		$progress->informasi_pekerjaan = $request->informasi_pekerjaan;

		// CEK FOTO BARU / HAPUS FOTO
		for ($i = 1; $i <= 5; $i++) {
			$hapusField = 'hapus_foto' . $i;

			// HAPUS FOTO LAMA JIKA DITANDI
			if ($request->$hapusField == 1 && !empty($progress->{'fotoprogress' . $i})) {
				if (file_exists(public_path('storage/' . $progress->{'fotoprogress' . $i}))) {
					unlink(public_path('storage/' . $progress->{'fotoprogress' . $i}));
				}
				$progress->{'fotoprogress' . $i} = null;
			}

			// UPLOAD FOTO BARU
			if ($request->hasFile('fotoprogress' . $i)) {
				$file = $request->file('fotoprogress' . $i);
				$filename = 'progress_' . $idpemesanan . '_' . $i . '_' . time() . '.' . $file->getClientOriginalExtension();
				$file->move(public_path('storage/' . $path), $filename);
				$progress->{'fotoprogress' . $i} = $path . '/' . $filename;
			}
		}

		// SIMPAN PERUBAHAN
		$progress->save();

		return redirect()->back()
			->with('open_tracking_modal', true)
			->with('success', 'Progress pekerjaan berhasil diperbarui');
	});


});


Route::get('/', [\App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('auth/registertukang', function (Request $request) {
	return view('auth/registertukang');
});

// ===============================
// TEMPORARY: Create Test Users Route
// Visit: /create-test-users to create test accounts
// REMOVE THIS IN PRODUCTION!
// ===============================
Route::get('create-test-users', function () {
	$results = [];

	try {
		// 1. CREATE ADMIN
		$adminEmail = 'admin@nukang.com';
		$admin = \App\User::where('email', $adminEmail)->first();
		if (!$admin) {
			$admin = \App\User::create([
				'email' => $adminEmail,
				'password' => bcrypt('password123'),
				'kodeuser' => 'ADMIN001',
				'statuspengguna' => '0',
				'saldo' => 0,
				'statusverifikasi' => '1',
				'fotoprofil' => 'nopicture.jpg',
			]);
			$results[] = "✅ Admin created: $adminEmail";
		} else {
			$results[] = "⚠️ Admin already exists: $adminEmail";
		}
	} catch (\Exception $e) {
		$results[] = "❌ Error creating Admin: " . $e->getMessage();
	}

	try {
		// 2. CREATE PELANGGAN
		$pelangganEmail = 'pelanggan@nukang.com';
		$pelangganUser = \App\User::where('email', $pelangganEmail)->first();
		if (!$pelangganUser) {
			$lastId = \App\User::orderBy('id', 'DESC')->first();
			$newId = $lastId ? $lastId->id + 1 : 1;

			// Create pelanggan record first
			$pelangganData = new \App\Pelanggan;
			$pelangganData->id = $newId;
			$pelangganData->namapelanggan = 'Test Pelanggan';
			$pelangganData->save();

			$pelangganUser = \App\User::create([
				'email' => $pelangganEmail,
				'password' => bcrypt('password123'),
				'kodeuser' => 'NIP001',
				'statuspengguna' => '1',
				'saldo' => 100000,
				'statusverifikasi' => '1',
				'fotoprofil' => 'nopicture.jpg',
				'latitude' => '3.5952',
				'longtitude' => '98.6722',
				'alamat' => 'Medan, Indonesia',
			]);
			$results[] = "✅ Pelanggan created: $pelangganEmail";
		} else {
			$results[] = "⚠️ Pelanggan already exists: $pelangganEmail";
		}
	} catch (\Exception $e) {
		$results[] = "❌ Error creating Pelanggan: " . $e->getMessage();
	}

	try {
		// 3. CREATE TUKANG
		$tukangEmail = 'tukang@nukang.com';
		$tukangUser = \App\User::where('email', $tukangEmail)->first();
		if (!$tukangUser) {
			$lastId = \App\User::orderBy('id', 'DESC')->first();
			$newId = $lastId ? $lastId->id + 1 : 1;

			// Get first kategori tukang
			$kategori = \App\KategoriTukang::first();
			$kategoriId = $kategori ? $kategori->id_kategoritukang : 1;

			// Create tukang record first
			\App\Tukang::create([
				'id' => $newId,
				'namatukang' => 'Test Tukang Profesional',
				'id_kategoritukang' => $kategoriId,
				'deskripsikeahlian' => 'Tukang profesional berpengalaman.',
				'lamapengalamanbekerja' => 5,
				'fotoktp' => 'nopicture.jpg',
				'fotosim' => 'nopicture.jpg',
				'fotohasilkerja' => 'nopicture.jpg',
				'statuseditprofil' => '1',
				'statusjasakeahlian' => '1',
			]);

			$tukangUser = \App\User::create([
				'email' => $tukangEmail,
				'password' => bcrypt('password123'),
				'kodeuser' => 'TAC001',
				'statuspengguna' => '2',
				'saldo' => 50000,
				'statusverifikasi' => '1',
				'fotoprofil' => 'nopicture.jpg',
				'latitude' => '3.5952',
				'longtitude' => '98.6722',
				'alamat' => 'Medan, Indonesia',
				'nomorhandphone' => '081234567890',
			]);
			$results[] = "✅ Tukang created: $tukangEmail";
		} else {
			$results[] = "⚠️ Tukang already exists: $tukangEmail";
		}
	} catch (\Exception $e) {
		$results[] = "❌ Error creating Tukang: " . $e->getMessage();
	}

	// Return nice HTML response
	$html = '<!DOCTYPE html><html><head><title>Create Test Users</title>';
	$html .= '<meta charset="UTF-8">';
	$html .= '<style>body{font-family:Inter,sans-serif;background:#0a0a0f;color:#fff;padding:40px;}</style></head>';
	$html .= '<body><h1 style="color:#10b981;">🛠️ Nukang - Test Users</h1>';
	$html .= '<div style="background:#1a1a25;padding:20px;border-radius:12px;margin:20px 0;">';
	foreach ($results as $result) {
		$html .= '<p style="margin:10px 0;font-size:14px;word-break:break-all;">' . htmlspecialchars($result) . '</p>';
	}
	$html .= '</div>';
	$html .= '<h2 style="color:#10b981;">📋 Test Accounts</h2>';
	$html .= '<table style="width:100%;border-collapse:collapse;background:#1a1a25;border-radius:12px;">';
	$html .= '<tr style="background:#12121a;"><th style="padding:15px;text-align:left;border-bottom:1px solid #333;">Role</th><th style="padding:15px;text-align:left;border-bottom:1px solid #333;">Email</th><th style="padding:15px;text-align:left;border-bottom:1px solid #333;">Password</th></tr>';
	$html .= '<tr><td style="padding:15px;border-bottom:1px solid #333;">👔 Admin</td><td style="padding:15px;border-bottom:1px solid #333;color:#10b981;">admin@nukang.com</td><td style="padding:15px;border-bottom:1px solid #333;">password123</td></tr>';
	$html .= '<tr><td style="padding:15px;border-bottom:1px solid #333;">👤 Pelanggan</td><td style="padding:15px;border-bottom:1px solid #333;color:#10b981;">pelanggan@nukang.com</td><td style="padding:15px;border-bottom:1px solid #333;">password123</td></tr>';
	$html .= '<tr><td style="padding:15px;">🔧 Tukang</td><td style="padding:15px;color:#10b981;">tukang@nukang.com</td><td style="padding:15px;">password123</td></tr>';
	$html .= '</table>';
	$html .= '<p style="margin-top:20px;"><a href="/auth/login" style="background:#10b981;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;font-weight:600;">🔐 Go to Login Page</a></p>';
	$html .= '</body></html>';

	return $html;
});

// Temporary route to create test saldo requests (REMOVE IN PRODUCTION)
Route::get('create-test-saldo', function () {
	$html = '<html><body style="background:#1a1a2e;color:#fff;font-family:Arial;padding:40px;">';
	$html .= '<h1>🧪 Create Test Saldo Requests</h1>';

	try {
		// Get pelanggan users (statuspengguna = 1)
		$users = \App\User::where('statuspengguna', '1')->take(3)->get();

		foreach ($users as $user) {
			$saldo = new \App\RiwayatTransaksi;
			$saldo->kode = 'KT' . strtoupper(substr(md5(time() . rand()), 0, 5));
			$saldo->id = $user->id;
			$saldo->jumlahsaldo = rand(50000, 200000);
			$saldo->rekening = '1234567890';
			$saldo->namarekening = 'Test User';
			$saldo->rekeningtujuan = 'BCA - 0987654321';
			$saldo->jenistransaksi = 'Pengisian Saldo';
			$saldo->statustransaksi = '0';
			$saldo->buktitransaksi = 'default.jpg';
			$saldo->save();
			$html .= "<p>✅ Created saldo request for user {$user->id} with id_riwayattransaksi: {$saldo->id_riwayattransaksi}</p>";
		}
	} catch (\Exception $e) {
		$html .= "<p>❌ Error: " . $e->getMessage() . "</p>";
	}

	$html .= '<p><a href="/konfirmasi-update-saldo" style="background:#10b981;color:#fff;padding:12px 24px;border-radius:8px;text-decoration:none;">Go to Konfirmasi Update Saldo</a></p>';
	$html .= '</body></html>';
	return $html;
});

// Auth routes - handled by Laravel's auth system
require __DIR__ . '/auth.php';

