<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class KodeGroup1Deposito extends Model
{
  protected $table ='kodegroup1deposito';
  protected $guarded = ['KODE_GROUP1'];


  Public $timestamps = false; //created_at dan update_at digunakan
}