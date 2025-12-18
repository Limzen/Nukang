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
                
                // Count notifications for the user
                try {
                    $totalnotifikasi = \App\Notifikasi::where('id_user', $user->id)
                        ->where('statusbaca', 0) // Unread notifications
                        ->count();
                } catch (\Exception $e) {
                    $totalnotifikasi = 0;
                }
                
                // Count pending orders for tukang
                if ($user->statuspengguna == '2' && $user->id_tukang) {
                    try {
                        $totalpermintaan = \App\Pemesanan::where('id_tukang', $user->id_tukang)
                            ->where('statuspemesanan', 1) // Pending orders
                            ->count();
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
