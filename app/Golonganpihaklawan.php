<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Golonganpihaklawan extends Model
{
    public $timestamp=false;
    protected $table='golongan_pihaklawan';
    protected $keyType='string';
    public $incrementing=false;
    protected $primaryKey='sandi';
    protected $fillable=['sandi','deskripsi_golongan'];

}
