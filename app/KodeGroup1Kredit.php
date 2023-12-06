<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeGroup1Kredit extends Model
{
    protected $table='kodegroup1kredit';
    public $timestamp=false;
    protected $keyType='string';
    protected $primaryKey='KODE_GROUP1';
    public $incrementing=false;
    protected $fillable=['KODE_GROUP1','DESKRIPSI_GROUP1'];
}
