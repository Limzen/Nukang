<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share global variables with all views
        View::composer('*', function ($view) {
            $totalnotifikasi = 0;
            $totalpermintaan = 0;

            if (Auth::check()) {
                $user = Auth::user();

                // Count unread notifications for all users
                try {
                    if ($user->statuspengguna == '0') {
                        // Admin notifications: count pending verifications, top-ups, withdrawals
                        $pendingTukang = \App\User::join('tukang', 'tukang.id', '=', 'users.id')
                            ->where('statusverifikasi', '=', '0')->count();
                        $pendingTopUp = \App\RiwayatTransaksi::where('statustransaksi', '=', '0')
                            ->where('jenistransaksi', '=', 'Pengisian Saldo')->count();
                        $pendingWithdraw = \App\RiwayatTransaksi::where('statustransaksi', '=', '0')
                            ->where('jenistransaksi', '=', 'Penarikan Saldo')->count();
                        // Also count any direct notifications to admin
                        $directNotif = \App\Notifikasi::where('kepada', $user->id)
                            ->where('statusnotifikasi', '0')->count();
                        $totalnotifikasi = $pendingTukang + $pendingTopUp + $pendingWithdraw + $directNotif;
                    } else {
                        // Regular user notifications
                        $totalnotifikasi = \App\Notifikasi::where('kepada', $user->id)
                            ->where('statusnotifikasi', '0') // Unread notifications
                            ->count();
                    }
                } catch (\Exception $e) {
                    $totalnotifikasi = 0;
                }

                // Count pending orders for tukang
                if ($user->statuspengguna == '2') {
                    try {
                        $tukang = \App\Tukang::where('id', $user->id)->first();
                        if ($tukang) {
                            $totalpermintaan = \App\Pemesanan::where('id_tukang', $tukang->id_tukang)
                                ->where('statuspemesanan', '0') // Pending orders
                                ->count();
                        }
                    } catch (\Exception $e) {
                        $totalpermintaan = 0;
                    }
                }
            }

            $view->with('totalnotifikasi', $totalnotifikasi);
            $view->with('totalpermintaan', $totalpermintaan);
        });
    }
}
