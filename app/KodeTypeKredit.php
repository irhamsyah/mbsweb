<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeTypeKredit extends Model
{
    protected $table='kodetypekredit';
    public $timestamp=false;
    protected $keyType='string';
    protected $primaryKey='KODE_TYPE_KREDIT';
    public $incrementing=false;
    protected $fillable=['KODE_TYPE_KREDIT','DESKRIPSI_TYPE_KREDIT'];
}
