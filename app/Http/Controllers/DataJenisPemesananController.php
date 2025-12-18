<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Redirect;
use Illuminate\Http\Request;

class DataJenisPemesananController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$jenispemesanan = \App\JenisPemesanan::join('kategoritukang','kategoritukang.id_kategoritukang','=','jenispemesanan.id_kategoritukang')->orderby('id_jenispemesanan','DESC')->get();
		return view('datajenispemesanan',compact('jenispemesanan'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tambahdatajenispemesanan');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		$simpan = new \App\JenisPemesanan;
		$simpan->id_kategoritukang = $request->get('kategoritukang');
		$simpan->jenispemesanan = $request->get('jenispemesanan');
		$simpan->save();
		return Redirect::to('datajenispemesanan')->with('message_success', 'Data Jenis Pemesanan Berhasil Ditambahkan');
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
		$jenispemesanan = \App\JenisPemesanan::find($id);
		return view('editdatajenispemesanan',compact('jenispemesanan'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		$simpan = \App\JenisPemesanan::find($id);
		$simpan->id_kategoritukang = $request->get('kategoritukang');
		$simpan->jenispemesanan = $request->get('jenispemesanan');
		$simpan->save();
		return Redirect::to('datajenispemesanan')->with('message_success', 'Data Jenis Pemesanan Berhasil Diubah');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$del = \App\JenisPemesanan::findOrFail($id);
		$del->delete();
		return Redirect::to('datajenispemesanan')->with('message_success', 'Data Jenis Pemesanan Berhasil Dihapus');
	}

}
