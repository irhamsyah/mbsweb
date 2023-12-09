<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SidKodeBidangUsaha extends Model
{
    public $timestamp=false;
    protected $table='sidkodebidangusaha';
    protected $primaryKey='KODE_BIDANG_USAHA';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_BIDANG_USAHA',  
	'DESKRIPSI_BIDANG_USAHA'];

}
