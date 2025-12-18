<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tukang extends Model {

	protected $table = 'tukang';
	protected $primaryKey = 'id_tukang';

	 protected $fillable = [
	 	'id',
        'namatukang',
        'id_kategoritukang',
        'deskripsikeahlian',
        'lamapengalamanbekerja',
        'fotoktp',
        'fotosim',
        'fotohasilkerja',
    ];
}
