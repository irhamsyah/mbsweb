<?php

namespace App;

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
