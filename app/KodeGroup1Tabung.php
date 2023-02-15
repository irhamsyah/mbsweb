<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeGroup1Tabung extends Model
{
    protected $table='kodegroup1tabung';
    public $timestamp=false;
    protected $keyType='string';
    protected $primaryKey='kode_group1';
    public $incrementing=false;
    protected $fillable=['kode_group1','deskripsi_group1','rekening_debet','jenis_rekening'];
}
