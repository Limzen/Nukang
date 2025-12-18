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
		$this->middleware('auth');
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
			$tukang = \App\Tukang::orderByRaw("RAND()")->join('users','users.id','=','tukang.id')->join('kategoritukang','kategoritukang.id_kategoritukang','=','tukang.id_kategoritukang')->where('statusjasakeahlian','=','1')->where('statuseditprofil','=','1')->where('statusverifikasi','=','1')->orderby('totalvote','DESC')->limit(6)->get();
			return view('home',compact('tukang'));
		}
		elseif(Auth::user()->statuspengguna == "2")
		{
			$ps = \App\Pemesanan::where('statuspemesanan','=','5')->where('id_tukang','=',Auth::user()->id_tukang)->count();
			$pbs = \App\Pemesanan::where('statuspemesanan','=','3')->where('id_tukang','=',Auth::user()->id_tukang)->count();
			return view('home',compact('ps','pbs'));
		}
		elseif(Auth::user()->statuspengguna == '0')
		{
			$verifikasitukang = \App\User::join('tukang','tukang.id','=','users.id')->where('statusverifikasi','=','0')->get();
			return view('home',compact('verifikasitukang'));
		}
	}

}
