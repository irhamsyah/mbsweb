<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class KodeTransDeposito extends Model
{
  protected $table ='kodetransdeposito';
  protected $guarded = ['KODE_TRANS'];


  Public $timestamps = false; //created_at dan update_at digunakan
}