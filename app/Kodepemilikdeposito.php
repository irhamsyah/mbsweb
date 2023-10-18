<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class KodePemilikDeposito extends Model
{
  protected $table ='kodepemilikdeposito';
  protected $guarded = ['KODE_GOL_DEPOSAN'];


  Public $timestamps = false; //created_at dan update_at digunakan
}