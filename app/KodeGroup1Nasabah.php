<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class KodeGroup1Nasabah extends Model
{
  protected $table ='kodegroup1_nasabah';
  protected $guarded = ['nasabah_group1'];


  Public $timestamps = false; //created_at dan update_at digunakan
}