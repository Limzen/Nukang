<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Redirect;
use Auth;
use Illuminate\Http\Request;

class DataBahanMaterialController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$bahanmaterial = \App\BahanMaterial::orderby('id_bahanmaterial','DESC')->get();
		return view('databahanmaterial',compact('bahanmaterial'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('tambahdatabahanmaterial');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		function quickRandom($length)
		{
		    $pool = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		    return substr(str_shuffle(str_repeat($pool, 5)), 0, $length);
		}
		$simpan = new \App\BahanMaterial;
		$simpan->id_kategoritukang = $request->get('kategoritukang');
		$simpan->kodebahanmaterial = "KB" . quickRandom(8);
		$simpan->bahanmaterial = $request->get('namabahan');
		$simpan->informasibahanmaterial = $request->get('informasibahanmaterial');
		$simpan->hargabahanmaterial = $request->get('hargabahanmaterial');
		$fotobahanmaterial = 'fotobahanmaterial' . Auth::user()->id . quickRandom(8) . '.jpg';
		$request->file('fotobahanmaterial')->move('images/fotobahanmaterial',$fotobahanmaterial);
		$simpan->fotobahanmaterial = $fotobahanmaterial;
		$simpan->statusbahanmaterial = "1";
		$simpan->save();
		return Redirect::to('databahanmaterial')->with('message_success', 'Data Bahan Material Berhasil Ditambahkan');
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
		$bahanmaterial = \App\BahanMaterial::find($id);
		return view('editdatabahanmaterial',compact('bahanmaterial'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id,Request $request)
	{
		$simpan = \App\BahanMaterial::find($id);
		$simpan->id_kategoritukang = $request->get('kategoritukang');
		$simpan->bahanmaterial = $request->get('namabahan');
		$simpan->informasibahanmaterial = $request->get('informasibahanmaterial');
		$simpan->hargabahanmaterial = $request->get('hargabahanmaterial');
		if($request->hasFile('fotobahanmaterial'))
		{
			$fotobahanmaterial = $request->get('oldfile');
			$request->file('fotobahanmaterial')->move('images/fotobahanmaterial',$fotobahanmaterial);
			$simpan->fotobahanmaterial = $fotobahanmaterial;
		}
		$simpan->save();
		return Redirect::to('databahanmaterial')->with('message_success', 'Data Bahan Material Berhasil Diubah');
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$doo = \App\BahanMaterial::findOrFail($id);
		unlink(public_path() . '\images\fotobahanmaterial\\' . $doo->fotobahanmaterial);
		$doo->delete();
		return Redirect::to('databahanmaterial')->with('message_success', 'Data Bahan Material Berhasil Dihapus');
	}

	public function ubahstatus($id)
	{
		$doo = \App\BahanMaterial::find($id);
		if($doo->statusbahanmaterial == '0')
			$doo->statusbahanmaterial = '1';
		else
			$doo->statusbahanmaterial = '0';
		$doo->save();
		return Redirect::to('databahanmaterial')->with('message_success', 'Status Bahan Material Berhasil Diubah');
	}
}
