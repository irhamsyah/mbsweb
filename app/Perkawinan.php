<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Perkawinan extends Model
{
  protected $table ='scr_perkawinan';
  protected $guarded = ['kode_perkawinan'];


  Public $timestamps = false; //created_at dan update_at digunakan
}