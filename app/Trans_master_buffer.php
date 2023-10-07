<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Trans_master_buffer extends Model
{
    protected $primaryKey='trans_id';
    public $timestamps=false;
    protected $table = 'trans_master_buffer';

    public function transdetailbuffer()
    {
        return $this->belongsTo('App\Trans_detail_buffer','trans_id','master_id');
    }

        // Relasi HasManyThrough untuk akses dari App\Tabtran->App\Nasabah melalui App\Tabungan
    // return $this->HasManyThrough(
    //     Perkiraan::class,
    //     Trans_detail_buffer::class,
    //     'NO_REKENING',->punya Tabungan
    //     'nasabah_id', -> punya Nasabah
    //     'NO_REKENING', -> punya Tabtran
    //     'NASABAH_ID' -> punya Tabungan

    public function perkiraan() : HasManyThrough
    {
        return $this->HasManyThrough(
            Perkiraan::class,
            Trans_detail_buffer::class,
            trim('master_id'),
            trim('kode_perk'),
            trim('trans_id'),
            trim('kode_perk')
        );
    }

    protected $fillable = [
        'trans_id',
        'tgl_trans',
        'kode_jurnal',
        'no_bukti',
        'nominal',
        'keterangan'
    ];

}
