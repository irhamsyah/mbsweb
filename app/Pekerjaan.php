<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Pekerjaan extends Model
{
  protected $table ='jenis_pekerjaan';
  protected $guarded = ['Pekerjaan_id'];


  Public $timestamps = false; //created_at dan update_at digunakan
}