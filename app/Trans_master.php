<?php

namespace App;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

use Illuminate\Database\Eloquent\Model;

class Trans_master extends Model
{
    protected $primaryKey='trans_id';
    public $timestamps=false;
    protected $table = 'trans_master';

    public function transdetail()
    {
        return $this->belongsTo('App\Trans_detail','trans_id','master_id');
    }
        // Relasi HasManyThrough untuk akses dari App\Tabtran->App\Nasabah melalui App\Tabungan
    // return $this->HasManyThrough(
    //     Nasabah::class,
    //     Tabungan::class,
    //     'NO_REKENING',->punya Tabungan
    //     'nasabah_id', -> punya Nasabah
    //     'NO_REKENING', -> punya Tabtran
    //     'NASABAH_ID' -> punya Tabungan

    public function perkiraan() : HasManyThrough
    {
        return $this->HasManyThrough(
            Perkiraan::class,
            Trans_detail::class,
            trim('master_id'),
            trim('kode_perk'),
            trim('trans_id'),
            trim('kode_perk')
        );
    }

    protected $fillable=[
        'trans_id',
        'tgl_trans',
        'kode_jurnal',
        'no_bukti',
        'src',
        'NOMINAL',
        'KETERANGAN',
        'SYNC',
        'CAB',
        'cTrans_Id',
        'KonsCab'
    ];
}
