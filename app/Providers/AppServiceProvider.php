<?php namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
class AppServiceProvider extends ServiceProvider {

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$totalnotifikasi = "";
		$totalpermintaan = "";
		$kategoritukang = \App\KategoriTukang::get();
		view()->composer('*', function($view) use($kategoritukang,$totalnotifikasi,$totalpermintaan){
        	if(Auth::check())
        	{
        		$totalnotifikasi = \App\Notifikasi::where('kepada','=',Auth::user()->id)->where('statusnotifikasi','=','0')->count();
        		$totalpermintaan = \App\Pemesanan::where('id_tukang','=',Auth::user()->id_tukang)->where('statuspemesanan','=','0')->count();
        	}
        	$view->with(['kategoritukang'=>$kategoritukang,'totalnotifikasi'=>$totalnotifikasi,'totalpermintaan'=>$totalpermintaan]);
    	});
	}

	/**
	 * Register any application services.
	 *
	 * This service provider is a great spot to register your various container
	 * bindings with the application. As you can see, we are registering our
	 * "Registrar" implementation here. You can add your own bindings too!
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bind(
			'Illuminate\Contracts\Auth\Registrar',
			'App\Services\Registrar'
		);
	}

}
