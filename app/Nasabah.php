<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Nasabah extends Model
{
  protected $table ='nasabah';
  protected $guarded = ['nasabah_id'];
  protected $dates = ['tgllahir'];


  Public $timestamps = false; //created_at dan update_at digunakan
}