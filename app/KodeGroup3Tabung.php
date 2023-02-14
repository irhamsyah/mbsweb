<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeGroup3Tabung extends Model
{
    public $timestamp=false;
    protected $table='kodegroup3tabung';
    protected $primaryKey='kode_group3';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['kode_group3','deskripsi_group3','rekening_debet','jenis_rekening'];

}
