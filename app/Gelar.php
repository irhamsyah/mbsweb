<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Gelar extends Model
{
  protected $table ='jenis_gelar';
  protected $guarded = ['Gelar_ID'];


  Public $timestamps = false; //created_at dan update_at digunakan
}