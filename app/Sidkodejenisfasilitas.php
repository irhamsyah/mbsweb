<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidKodeJenisFasilitas extends Model
{
    public $timestamp=false;
    protected $table='sidkodejenis_fasilitas';
    protected $primaryKey='KODE_DESC';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_DESC',  
	'DESKRIPSI_DESC'];

}
