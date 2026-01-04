<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Login Routes
Route::get('auth/login', function () {
    return view('auth.login');
})->name('login');

Route::post('auth/login', function (Request $request) {
    $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('password')
    ];

    if (Auth::attempt($credentials, $request->filled('remember'))) {
        // Check if user is blocked
        $user = Auth::user();

        // statusverifikasi: '1' = aktif, '0' = pending (tukang baru), '2' = diblokir
        // Pelanggan yang diblokir memiliki statusverifikasi != '1'
        // Tukang baru dengan statusverifikasi = '0' masih boleh login (pending verification)
        // User dengan statusverifikasi = '2' adalah user yang diblokir admin
        if ($user->statusverifikasi == '2') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Akun Anda telah diblokir oleh Admin. Silakan hubungi admin untuk informasi lebih lanjut.']);
        }

        // Pelanggan dengan status != '1' juga diblokir (kecuali tukang pending)
        if ($user->statuspengguna == '1' && $user->statusverifikasi != '1') {
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['email' => 'Akun Anda telah diblokir oleh Admin. Silakan hubungi admin untuk informasi lebih lanjut.']);
        }

        $request->session()->regenerate();
        return redirect()->intended('/home');
    }

    return redirect()->back()
        ->withInput($request->only('email', 'remember'))
        ->withErrors(['email' => 'These credentials do not match our records.']);
})->name('login.post');

// Register Routes
Route::get('auth/register', function () {
    return view('auth.register');
})->name('register');

Route::post('auth/register', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|confirmed|min:6',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }


    // Generate kodeuser for pelanggan
    $kodeuser = 'NIP' . str_pad((\App\User::where('statuspengguna', '1')->count() + 1), 3, '0', STR_PAD_LEFT);

    // Create user first
    $user = new \App\User;
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->kodeuser = $kodeuser;
    $user->statuspengguna = '1'; // pelanggan
    $user->statusverifikasi = '1'; // pelanggan auto-verified
    $user->saldo = 0;
    $user->fotoprofil = 'nopicture.jpg';
    $user->namaLengkap = $request->input('name');
    $user->save();

    // Create pelanggan with user's ID
    $pelanggan = new \App\Pelanggan;
    $pelanggan->id = $user->id;  // Set ID to match user ID
    $pelanggan->namapelanggan = $request->input('name');
    $pelanggan->save();

    Auth::login($user);

    return redirect('/home')->with('message_success', 'Registrasi berhasil!');
})->name('register.post');

// Register Tukang Routes
Route::get('auth/registertukang', function () {
    $kategoritukang = \App\KategoriTukang::all();
    return view('auth.registertukang', compact('kategoritukang'));
})->name('register.tukang');

Route::post('auth/registertukang', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|confirmed|min:6',
        'kategori' => 'required',
        'pengalaman' => 'required',
        'deskripsi' => 'required',
        'fotoktp' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        'fotoprofil' => 'required|file|mimes:jpg,jpeg,png|max:2048',
        'fotohasilkerja' => 'required|file|mimes:zip|max:10240',
    ]);

    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Handle file uploads
    $fotoktpName = '';
    $fotosimName = '';
    $fotoprofilName = '';
    $fotohasilkerjaName = '';

    if ($request->hasFile('fotoktp')) {
        $file = $request->file('fotoktp');
        $fotoktpName = time() . '_ktp_' . $file->getClientOriginalName();
        $file->move(public_path('images/dokumen'), $fotoktpName);
    }

    if ($request->hasFile('fotosim')) {
        $file = $request->file('fotosim');
        $fotosimName = time() . '_sim_' . $file->getClientOriginalName();
        $file->move(public_path('images/dokumen'), $fotosimName);
    }

    if ($request->hasFile('fotoprofil')) {
        $file = $request->file('fotoprofil');
        $fotoprofilName = time() . '_profil_' . $file->getClientOriginalName();
        $file->move(public_path('images/profil'), $fotoprofilName);
    }

    if ($request->hasFile('fotohasilkerja')) {
        $file = $request->file('fotohasilkerja');
        $fotohasilkerjaName = time() . '_hasil_' . $file->getClientOriginalName();
        $file->move(public_path('images/hasilkerja'), $fotohasilkerjaName);
    }

    // Generate kodeuser for tukang
    $kodeuser = 'TAC' . str_pad((\App\User::where('statuspengguna', '2')->count() + 1), 3, '0', STR_PAD_LEFT);

    // Create user first
    $user = new \App\User;
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->kodeuser = $kodeuser;
    $user->statuspengguna = '2'; // tukang
    $user->statusverifikasi = '0'; // tukang needs admin verification
    $user->saldo = 0;
    $user->fotoprofil = $fotoprofilName ?: 'nopicture.jpg';
    $user->namaLengkap = $request->input('name');
    $user->save();

    // Create tukang with user's ID
    $tukang = new \App\Tukang;
    $tukang->id = $user->id;  // Set ID to match user ID
    $tukang->namatukang = $request->input('name');
    $tukang->id_kategoritukang = $request->input('kategori');
    $tukang->rating = 0;
    $tukang->totalvote = 0;
    $tukang->jumlahvote = 0;
    $tukang->statusjasakeahlian = '0';
    $tukang->statuseditprofil = '0';
    $tukang->lamapengalamanbekerja = $request->input('pengalaman');
    $tukang->pengalamanbekerja = '';
    $tukang->deskripsikeahlian = $request->input('deskripsi');
    $tukang->fotoktp = $fotoktpName;
    $tukang->fotosim = $fotosimName;
    $tukang->fotohasilkerja = $fotohasilkerjaName;
    $tukang->save();

    Auth::login($user);

    return redirect('/home')->with('message_success', 'Registrasi Tukang berhasil! Silahkan tunggu verifikasi admin.');
})->name('register.tukang.post');


// Logout Route
Route::post('auth/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Also support GET logout for backward compatibility
Route::get('auth/logout', function (Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout.get');

// Password Reset Routes (basic placeholder - can add full functionality later)
Route::get('password/email', function () {
    return view('auth.password');
})->name('password.email');

Route::post('password/email', function (Request $request) {
    // Placeholder for password reset functionality
    return redirect()->back()->with('status', 'Password reset link sent!');
})->name('password.email.post');
