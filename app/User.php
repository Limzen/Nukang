<?php
namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['email', 'password', 'kodeuser', 'alamat', 'id_kabupaten', 'nomorhandphone', 'saldo', 'nomorrekening', 'namarekening', 'fotoprofil', 'latitude', 'longtitude', 'statuspengguna', 'statusverifikasi', 'namaLengkap'];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token'];

	/**
	 * Get the pelanggan record associated with the user.
	 */
	public function pelanggan()
	{
		return $this->hasOne('App\Pelanggan', 'id', 'id');
	}

	/**
	 * Get the tukang record associated with the user.
	 */
	public function tukang()
	{
		return $this->hasOne('App\Tukang', 'id', 'id');
	}

	/**
	 * Get the full name based on user role.
	 */
	public function getNamaLengkapAttribute()
	{
		// First check if namaLengkap column has a value
		$namaLengkap = $this->attributes['namaLengkap'] ?? null;
		if (!empty($namaLengkap)) {
			return $namaLengkap;
		}

		// Fallback to related models
		if ($this->statuspengguna == '1' && $this->pelanggan) {
			return $this->pelanggan->namapelanggan;
		} elseif ($this->statuspengguna == '2' && $this->tukang) {
			return $this->tukang->namatukang;
		}
		return $this->name ?? '';
	}

}
