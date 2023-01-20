<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Kota extends Model
{
  protected $table ='jenis_kota';
  protected $guarded = ['Kota_id'];


  Public $timestamps = false; //created_at dan update_at digunakan
}