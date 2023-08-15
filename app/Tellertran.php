<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tellertran extends Model
{
    protected $primaryKey='trans_id';
    public $timestamps=false;
    protected $table = 'tellertrans';
    protected $fillable=[
        'trans_id',
        'modul',
        'tgl_trans',
        'kode_jurnal',
        'NO_BUKTI',
        'uraian',
        'my_kode_trans',
        'saldo_trans',
        'tob',
        'tob_RAK',
        'modul_trans_id',
        'userid',
        'VALIDATED',
        'POSTED',
        'GL_TRANS',
        'cab',
        'USERAPP',
        'flag'

    ];
 
}
