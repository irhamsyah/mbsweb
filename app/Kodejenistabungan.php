<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kodejenistabungan extends Model
{
    public $timestamp=false;
    protected $table='kodejenistabungan';
    protected $primaryKey='kode_jens_tabungan';
    protected $keyType='string';
    public $incrementing=false;

}
