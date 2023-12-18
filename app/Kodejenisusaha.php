<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeJenisUsaha extends Model
{
    public $timestamp=false;
    protected $table='kodejenisusaha';
    protected $primaryKey='KODE_JENIS_USAHA';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_JENIS_USAHA',  
    'KODE_BI',
	'DESKRIPSI_JENIS_USAHA'];

}
