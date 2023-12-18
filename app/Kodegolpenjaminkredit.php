<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeGolPenjaminKredit extends Model
{
    public $timestamp=false;
    protected $table='kodegolpenjaminkredit';
    protected $primaryKey='KODE_GOL_PENJAMIN';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_GOL_PENJAMIN', 
    'KODE_BI', 
	'DESKRIPSI_GOL_PENJAMIN'];

}
