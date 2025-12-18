<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class LaporanProgress extends Model
{
    protected $table = 'laporanprogress';
    protected $primaryKey = 'id_progress';

    public $timestamps = true;

    protected $fillable = [
        'id_tukang',
        'id_pemesanan',
        'tanggal_progress',
        'informasi_pekerjaan',
        'fotoprogress1',
        'fotoprogress2',
        'fotoprogress3',
        'fotoprogress4',
        'fotoprogress5',
    ];
}
