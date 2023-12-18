<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kodemetoda extends Model
{
    public $timestamp=false;
    protected $table='kodemetoda';
    protected $primaryKey='KODE_METODA';
    protected $keyType='string';
    public $incrementing=false;

}
