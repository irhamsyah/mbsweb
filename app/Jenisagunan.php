<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JenisAgunan extends Model
{
    public $timestamp=false;
    protected $table='jenis_agunan';
    protected $primaryKey='KODE_AGUNAN';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_AGUNAN',  
	'DESKRIPSI_AGUNAN'];

}
