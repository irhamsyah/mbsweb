<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeJenisPenggunaanKredit extends Model
{
    public $timestamp=false;
    protected $table='kodejenispenggunaankredit';
    protected $primaryKey='KODE_JENIS_PENGGUNAAN';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_JENIS_PENGGUNAAN',  
    'KODE_BI',
	'DESKRIPSI_JENIS_PENGGUNAAN'];

}
