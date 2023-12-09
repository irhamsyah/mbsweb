<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeSumberPelunasan extends Model
{
    public $timestamp=false;
    protected $table='kodesumberpelunasan';
    protected $primaryKey='KODE_SUMBER_PELUNASAN';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_SUMBER_PELUNASAN',
    'KODE_BI',  
	'DESKRIPSI_SUMBER_PELUNASAN'];

}
