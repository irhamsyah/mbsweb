<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidKodeGolKredit extends Model
{
    public $timestamp=false;
    protected $table='sidkodegol_kredit';
    protected $primaryKey='KODE_DESC';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_DESC',  
	'DESKRIPSI_DESC'];

}
