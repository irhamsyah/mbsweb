<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kodetranskredit extends Model
{
    protected $table='kodetranskredit';
    public $timestamp=false;
    protected $keyType='string';
    protected $primaryKey='KODE_TRANS';
    public $incrementing=false;
    protected $fillable=['KODE_TRANS','DESKRIPSI_TRANS'];
}
