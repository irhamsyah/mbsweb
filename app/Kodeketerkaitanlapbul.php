<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kodeketerkaitanlapbul extends Model
{
    public $timestamp=false;
    protected $table='kode_keterkaitan_lapbul';
    protected $primaryKey='SANDI';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['SANDI','DESKRIPSI_SANDI'];

}
