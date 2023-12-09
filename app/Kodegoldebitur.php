<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeGolDebitur extends Model
{
    public $timestamp=false;
    protected $table='kodegoldebitur';
    protected $primaryKey='KODE_GOL_DEBITUR';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_GOL_DEBITUR',
    'KODE_BI',  
	'DESKRIPSI_GOL_DEBITUR'];

}
