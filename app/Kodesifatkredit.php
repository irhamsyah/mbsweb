<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeSifatKredit extends Model
{
    public $timestamp=false;
    protected $table='kodesifatkredit';
    protected $primaryKey='KODE_SIFAT';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_SIFAT',  
	'DESKRIPSI_SIFAT'];

}
