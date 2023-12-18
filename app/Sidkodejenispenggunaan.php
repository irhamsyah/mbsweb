<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidKodeJenisPenggunaan extends Model
{
    public $timestamp=false;
    protected $table='sidkodejenis_penggunaan';
    protected $primaryKey='KODE_DESC';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_DESC',  
	'DESKRIPSI_DESC'];

}
