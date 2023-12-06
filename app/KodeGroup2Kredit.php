<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeGroup2Kredit extends Model
{
    protected $table='kodegroup2kredit';
    public $timestamp=false;
    protected $keyType='string';
    protected $primaryKey='KODE_GROUP2';
    public $incrementing=false;
    protected $fillable=['KODE_GROUP2','DESKRIPSI_GROUP2'];
}
