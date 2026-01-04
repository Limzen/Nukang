<?php namespace App\Http\Controllers;

class WelcomeController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		// Middleware moved to routes in Laravel 11
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
		//$tukang = \App\Tukang::orderByRaw("RAND()")->join('users','users.id','=','tukang.id')->join('kategoritukang','kategoritukang.id_kategoritukang','=','tukang.id_kategoritukang')->where('statusjasakeahlian','=','1')->where('statuseditprofil','=','1')->where('statusverifikasi','=','1')->limit(6)->get();
		$tukang = \App\Tukang::join('users','users.id','=','tukang.id')->join('kategoritukang','kategoritukang.id_kategoritukang','=','tukang.id_kategoritukang')->where('statusjasakeahlian','=','1')->where('statuseditprofil','=','1')->where('statusverifikasi','=','1')->orderby('rating','DESC')->limit(6)->get();
		return view('welcome',compact('tukang'));
	}

}
