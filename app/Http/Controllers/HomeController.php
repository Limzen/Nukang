<?php namespace App\Http\Controllers;
use Auth;
class HomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Middleware moved to routes in Laravel 11d to routes in Laravel 11
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		if(Auth::user()->statuspengguna == "1")
		{
			// Pelanggan Dashboard
			$tukang = \App\Tukang::orderByRaw("RAND()")->join('users','users.id','=','tukang.id')->join('kategoritukang','kategoritukang.id_kategoritukang','=','tukang.id_kategoritukang')->where('statusjasakeahlian','=','1')->where('statuseditprofil','=','1')->where('statusverifikasi','=','1')->orderby('totalvote','DESC')->limit(6)->get();
			$activeOrders = \App\Pemesanan::where('id_pelanggan','=',Auth::user()->id_pelanggan)->whereIn('statuspemesanan',['0','1','3'])->count();
			$kategoritukang = \App\KategoriTukang::get();
			return view('dashboards.pelanggan',compact('tukang','activeOrders','kategoritukang'));
		}
		elseif(Auth::user()->statuspengguna == "2")
		{
			// Tukang Dashboard
			$ps = \App\Pemesanan::where('statuspemesanan','=','5')->where('id_tukang','=',Auth::user()->id_tukang)->count();
			$pbs = \App\Pemesanan::where('statuspemesanan','=','3')->where('id_tukang','=',Auth::user()->id_tukang)->count();
			$pendingOrders = \App\Pemesanan::where('id_tukang','=',Auth::user()->id_tukang)->where('statuspemesanan','=','0')->count();
			$totalEarnings = \App\Pemesanan::where('id_tukang','=',Auth::user()->id_tukang)->where('statuspemesanan','=','5')->sum('biayajasa');
			$tukangData = \App\Tukang::find(Auth::user()->id_tukang);
			return view('dashboards.tukang',compact('ps','pbs','pendingOrders','totalEarnings','tukangData'));
		}
		elseif(Auth::user()->statuspengguna == '0')
		{
			// Admin Dashboard
			$verifikasitukang = \App\User::join('tukang','tukang.id','=','users.id')->where('statusverifikasi','=','0')->get();
			$totalUsers = \App\User::count();
			$totalPelanggan = \App\User::where('statuspengguna','=','1')->count();
			$totalTukang = \App\User::where('statuspengguna','=','2')->count();
			$pendingTransactions = \App\RiwayatTransaksi::where('statustransaksi','=','0')->count();
			$totalOrders = \App\Pemesanan::count();
			return view('dashboards.admin',compact('verifikasitukang','totalUsers','totalPelanggan','totalTukang','pendingTransactions','totalOrders'));
		}
	}

}
