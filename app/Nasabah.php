<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Nasabah extends Model
{
  public function tabungans(){
    return $this->hasMany('App\Tabungan', 'NASABAH_ID','nasabah_id');
  }

  public function tabtrans(){
    return $this->belongsToMany('App\Tabtran', 'tabung','NO_REKENING','NO_REKENING');
  }
  protected $table ='nasabah';
  protected $primaryKey='nasabah_id';
  protected $dates = ['tgllahir'];
  //Define primary key not integer is Important because laravel assume your primarykey is Integer
  protected $keyType = 'string';


  Public $timestamps = false; //created_at dan update_at digunakan


}