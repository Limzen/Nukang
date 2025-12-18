<?php namespace App\Services;
use Session;
use Input;
use App\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	public function validator(array $data)
	{
	    $rules = [
	        'name'           => 'required|max:255',
	        'email'          => 'required|email|max:255|unique:users',
	        'password'       => 'required|confirmed|min:6',
	        'statuspengguna' => 'required|in:1,2',
	    ];

	    // ===============================
	    // VALIDASI KHUSUS TUKANG
	    // ===============================
	    if (isset($data['statuspengguna']) && $data['statuspengguna'] == '2') {
	        $rules = array_merge($rules, [
	            'fotoktp'         => 'required|mimes:jpg,jpeg,png|max:2048',
	            'fotoprofil'     => 'required|mimes:jpg,jpeg,png|max:2048',
	            'fotosim'         => 'nullable|mimes:jpg,jpeg,png|max:2048',
	            'fotohasilkerja'  => 'required|mimes:zip|max:10240',
	            'kategori'        => 'required',
	            'deskripsi'       => 'required',
	            'pengalaman'      => 'required|numeric',
	        ]);
	    }

	    return Validator::make($data, $rules);
	}



	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	public function create(array $data)
	{
	    // ===============================
	    // PELANGGAN
	    // ===============================
	    if ($data['statuspengguna'] == '1') {


	        Session::flash('success', 'Pendaftaran Akun Berhasil Dilakukan dan Silahkan Login');
	        $kode = 'NIP' . (\App\User::where('statuspengguna', '1')->count() + 1);
	        $lastrecord = \App\User::orderby('id','DESC')->first();
			$count = $lastrecord->id + 1;
	        $pelanggan = new \App\Pelanggan;
			$pelanggan->id = $count;
			$pelanggan->namapelanggan = $data['name'];
			$pelanggan->save();

	        return User::create([
	            'email'            => $data['email'],
	            'password'         => bcrypt($data['password']),
	            'kodeuser'         => $kode,
	            'statuspengguna'   => '1',
	            'saldo'            => 0,
	            'statusverifikasi' => '1',
	            'fotoprofil'       => 'nopicture.jpg',
	        ]);

	    }
	    else
	    {

		    Session::flash('success', 'Pendaftaran Akun Berhasil Dilakukan dan Silahkan Menunggu Verifikasi Admin');
	    	$kode = 'TAC' . (\App\User::where('statuspengguna', '2')->count() + 1);
			$lastrecord = \App\User::orderby('id','DESC')->first();
			$count = $lastrecord->id + 1;
		    $fotoktp  = 'fotoktp_' . time() . '.jpg';
		    $fotoanda = 'fotoprofil_' . time() . '.jpg';
		    $fotosim  = null;
		    $ziphasil = 'hasil_pekerjaan_' . time() . '.zip';

		    if (Input::hasFile('fotosim')) {
		        $fotosim = 'fotosim_' . time() . '.jpg';
		        Input::file('fotosim')->move(public_path('images/fotosim'), $fotosim);
		    }

		    Input::file('fotoktp')->move(public_path('images/fotoktp'), $fotoktp);
		    Input::file('fotoprofil')->move(public_path('images/fotoprofil'), $fotoanda);
		    Input::file('fotohasilkerja')->move(public_path('files/hasil_pekerjaan'), $ziphasil);
	 
		    \App\Tukang::create([
		    	'id'					=> $count,
		        'namatukang'            => $data['name'],
		        'id_kategoritukang'     => $data['kategori'],
		        'deskripsikeahlian'     => $data['deskripsi'],
		        'lamapengalamanbekerja' => $data['pengalaman'],
		        'fotoktp'               => $fotoktp,
		        'fotosim'               => $fotosim,
		        'fotohasilkerja'         => $ziphasil,
		    ]);

		    return User::create([
		        'email'            => $data['email'],
		        'password'         => bcrypt($data['password']),
		        'kodeuser'         => $kode,
		        'fotoprofil'       => $fotoanda,
		        'saldo'            => 0,
		        'statuspengguna'   => '2',
		        'statusverifikasi' => '0',
		    ]);

		    

	    }

	    

	    
	}



}
