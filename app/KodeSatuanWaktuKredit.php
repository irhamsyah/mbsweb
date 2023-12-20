<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeSatuanWaktuKredit extends Model
{
    protected $table='kodesatuanwaktukredit';
    public $timestamp=false;
    protected $keyType='string';
    protected $primaryKey='KODE_SATUAN_WAKTU';
    public $incrementing=false;
    protected $fillable=['KODE_SATUAN_WAKTU','DESKRIPSI_SATUAN_WAKTU'];
}
