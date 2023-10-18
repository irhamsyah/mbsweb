<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class KodeJurnal extends Model
{
    public $timestamp=false;    
    protected $table='kodejurnal';
    protected $guarded = ['kode_jurnal','nama_jurnal'];
}
