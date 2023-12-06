<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeSumberDanaKredit extends Model
{
    protected $table='kodesumberdanakredit';
    public $timestamp=false;
    protected $keyType='string';
    protected $primaryKey='KODE_SUMBER_DANA';
    public $incrementing=false;
    protected $fillable=['KODE_SUMBER_DANA','DESKRIPSI_SUMBER_DANA'];
}
