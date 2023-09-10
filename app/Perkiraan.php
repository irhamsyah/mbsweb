<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Perkiraan extends Model
{
  protected $table ='perkiraan';
  protected $guarded = ['kode_perk'];


  Public $timestamps = false; //created_at dan update_at digunakan
}