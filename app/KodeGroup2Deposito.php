<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class KodeGroup2Deposito extends Model
{
  protected $table ='kodegroup2deposito';
  protected $guarded = ['KODE_GROUP2'];


  Public $timestamps = false; //created_at dan update_at digunakan
}