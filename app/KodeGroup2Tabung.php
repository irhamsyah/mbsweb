<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class KodeGroup2Tabung extends Model
{
    public $timestamp=false;
    protected $table='kodegroup2tabung';
    protected $primaryKey='kode_group2';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['kode_group2','deskripsi_group2','rekening_debet','jenis_rekening'];

}
