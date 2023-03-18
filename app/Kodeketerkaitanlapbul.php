<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kodeketerkaitanlapbul extends Model
{
    public $timestamp=false;
    protected $table='kode_keterkaitan_lapbul';
    protected $primaryKey='sandi';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['sandi','deskripsi_sandi'];

}
