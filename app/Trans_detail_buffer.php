<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trans_detail_buffer extends Model
{
    protected $primaryKey='trans_id';
    public $timestamps=false;
    protected $table = 'trans_detail_buffer';

    public function transmasterbuffer()
    {
        return $this->belongsToMany('App\Trans_master_buffer','master_id','trans_id');
    }
    public function perkiraan()
    {
        return $this->belongsTo('App\Perkiraan','kode_perk','kode_perk');
    }

    protected $fillable = [
        'trans_id',
        'master_id',
        'URAIAN',
        'kode_perk',
        'debet',
        'kredit',
        'saldo_akhir'
    ];

}
