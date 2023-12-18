<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidKodeGolonganPenjamin extends Model
{
    public $timestamp=false;
    protected $table='sidkodegolongan_penjamin';
    protected $primaryKey='KODE_GOL_PENJAMIN';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_GOL_PENJAMIN',  
	'DESKRIPSI_GOL_PENJAMIN'];

}
