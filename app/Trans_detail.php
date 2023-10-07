<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trans_detail extends Model
{
    public $timestamps = false;
    protected $table = 'trans_detail';
    protected $primaryKey = 'trans_id';

    public function transmaster()
    {
        return $this->belongsToMany('App\Trans_master','master_id','trans_id');
    }
    public function perkiraan()
    {
        return $this->belongsTo('App\Perkiraan','kode_perk','kode_perk');
    }

    protected $fillable =[
        'trans_id',
        'master_id',
        'URAIAN',
        'kode_perk',
        'debet',
        'kredit',
        'saldo_akhir',
        'modul',
        'no_rek',
        'SYNC',
        'CAB',
        'cMaster_Id',
        'cTrans_Id',
        'Kons_Perk',
        'KonsCab',
        'OUTLET'
    ];
}
