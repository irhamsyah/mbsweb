<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidKodeSifatKredit extends Model
{
    public $timestamp=false;
    protected $table='sidkodesifat_kredit';
    protected $primaryKey='KODE_DESC';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_DESC',  
	'DESKRIPSI_DESC'];

}
