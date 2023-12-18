<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodePeriodePembayaran extends Model
{
    public $timestamp=false;
    protected $table='kodeperiodepembayaran';
    protected $primaryKey='kode_periode_pembayaran';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['kode_periode_pembayaran', 
    'KODE_BI', 
	'deskripsi_periode_pembayaran'];

}
