<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class KodeGroup3Deposito extends Model
{
  protected $table ='kodegroup3deposito';
  protected $guarded = ['KODE_GROUP3'];


  Public $timestamps = false; //created_at dan update_at digunakan
}