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
Route::get('auth/login', function() {
    return view('auth.login');
})->name('login');

Route::post('auth/login', function(Request $request) {
    $credentials = [
        'email' => $request->input('email'),
        'password' => $request->input('password')
    ];
    
    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();
        return redirect()->intended('/home');
    }
    
    return redirect()->back()
        ->withInput($request->only('email', 'remember'))
        ->withErrors(['email' => 'These credentials do not match our records.']);
})->name('login.post');

// Register Routes
Route::get('auth/register', function() {
    return view('auth.register');
})->name('register');

Route::post('auth/register', function(Request $request) {
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
    
    // Create pelanggan first
    $pelanggan = new \App\Pelanggan;
    $pelanggan->namapelanggan = $request->input('name');
    $pelanggan->save();
    
    // Create user
    $user = new \App\User;
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->id_pelanggan = $pelanggan->id_pelanggan;
    $user->statuspengguna = '1'; // pelanggan
    $user->saldo = 0;
    $user->save();
    
    Auth::login($user);
    
    return redirect('/home')->with('message_success', 'Registrasi berhasil!');
})->name('register.post');

// Register Tukang Routes
Route::get('auth/registertukang', function() {
    $kategoritukang = \App\KategoriTukang::all();
    return view('auth.registertukang', compact('kategoritukang'));
})->name('register.tukang');

Route::post('auth/registertukang', function(Request $request) {
    $validator = Validator::make($request->all(), [
        'name' => 'required|max:255',
        'email' => 'required|email|max:255|unique:users',
        'password' => 'required|confirmed|min:6',
        'kategori' => 'required',
    ]);
    
    if ($validator->fails()) {
        return redirect()->back()
            ->withErrors($validator)
            ->withInput();
    }
    
    // Create tukang first
    $tukang = new \App\Tukang;
    $tukang->namatukang = $request->input('name');
    $tukang->id_kategoritukang = $request->input('kategori');
    $tukang->rating = 0;
    $tukang->totalvote = 0;
    $tukang->jumlahvote = 0;
    $tukang->statusjasakeahlian = '0';
    $tukang->statuseditprofil = '0';
    $tukang->save();
    
    // Create user
    $user = new \App\User;
    $user->email = $request->input('email');
    $user->password = Hash::make($request->input('password'));
    $user->id_tukang = $tukang->id_tukang;
    $user->statuspengguna = '2'; // tukang
    $user->statusverifikasi = '0';
    $user->saldo = 0;
    $user->save();
    
    Auth::login($user);
    
    return redirect('/home')->with('message_success', 'Registrasi Tukang berhasil! Silahkan tunggu verifikasi admin.');
})->name('register.tukang.post');

// Logout Route
Route::post('auth/logout', function(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout');

// Also support GET logout for backward compatibility
Route::get('auth/logout', function(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
})->name('logout.get');

// Password Reset Routes (basic placeholder - can add full functionality later)
Route::get('password/email', function() {
    return view('auth.password');
})->name('password.email');

Route::post('password/email', function(Request $request) {
    // Placeholder for password reset functionality
    return redirect()->back()->with('status', 'Password reset link sent!');
})->name('password.email.post');
