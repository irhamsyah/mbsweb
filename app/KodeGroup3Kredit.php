<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeGroup3Kredit extends Model
{
    protected $table='kodegroup3kredit';
    public $timestamp=false;
    protected $keyType='string';
    protected $primaryKey='KODE_GROUP3';
    public $incrementing=false;
    protected $fillable=['KODE_GROUP3','DESKRIPSI_GROUP3'];
}
