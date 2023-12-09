<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeAsuransiKredit extends Model
{
    public $timestamp=false;
    protected $table='kodeasuransikredit';
    protected $primaryKey='KODE_ASURANSI';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_ASURANSI', 
    'PERSENTASE', 
	'DESKRIPSI_ASURANSI'];

}
