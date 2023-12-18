<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeSektorEkonomiKredit extends Model
{
    public $timestamp=false;
    protected $table='kodesektorekonomikredit';
    protected $primaryKey='KODE_SEKTOR_EKONOMI';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_SEKTOR_EKONOMI',  
    'KODE_BI',
    'KODE_SLIK',
	'DESKRIPSI_SEKTOR_EKONOMI'];

}
