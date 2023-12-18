<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Agunan extends Model
{
  protected $table ='agunan';
  protected $guarded = ['NO_AGUNAN'];


  Public $timestamps = false; //created_at dan update_at digunakan
}