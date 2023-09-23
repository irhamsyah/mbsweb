<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class KodeJenisDeposito extends Model
{
  protected $table ='kodejenisdeposito';
  protected $guarded = ['KODE_JENIS_DEPOSITO'];


  Public $timestamps = false; //created_at dan update_at digunakan
}