<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Illuminate\Http\Request;

class DataKategoriTukangController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$kategoritukang = \App\KategoriTukang::orderBy('id_kategoritukang','DESC')->get();
		return view('datakategoritukang',compact('kategoritukang'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tambahdatakategoritukang');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$simpan = new \App\KategoriTukang;
		$simpan->kategoritukang = $request->get('kategoritukang');
		$simpan->save();
		return Redirect::to('datakategoritukang')->with('message_success', 'Data Kategori Tukang Berhasil Ditambahkan');
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$kategoritukangte = \App\KategoriTukang::find($id);
		return view('editdatakategoritukang',compact('kategoritukangte'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		$simpan = \App\KategoriTukang::find($id);
		$simpan->kategoritukang = $request->get('kategoritukang');
		$simpan->save();
		return Redirect::to('datakategoritukang')->with('message_success', 'Data Kategori Tukang Berhasil Dihapus');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$del = \App\KategoriTukang::findOrFail($id);
		$del->delete();
		return Redirect::to('datakategoritukang')->with('message_success', 'Data Kategori Tukang Berhasil Dihapus');
	}

}
