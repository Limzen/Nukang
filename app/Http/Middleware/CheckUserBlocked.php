<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserBlocked
{
    /**
     * Handle an incoming request.
     *
     * This middleware checks if the currently logged in user has been blocked.
     * If blocked, it logs them out and redirects to login with an error message.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();

            // Check if user is blocked (statusverifikasi = '2')
            if ($user->statusverifikasi == '2') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/auth/login')
                    ->withErrors(['email' => 'Akun Anda telah diblokir oleh Admin. Silakan hubungi admin untuk informasi lebih lanjut.']);
            }

            // For pelanggan (statuspengguna = '1'), check if statusverifikasi != '1'
            if ($user->statuspengguna == '1' && $user->statusverifikasi != '1') {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect('/auth/login')
                    ->withErrors(['email' => 'Akun Anda telah diblokir oleh Admin. Silakan hubungi admin untuk informasi lebih lanjut.']);
            }
        }

        return $next($request);
    }
}
