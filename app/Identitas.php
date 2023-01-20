<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Identitas extends Model
{
  protected $table ='jenis_identitas';
  protected $guarded = ['jenis_id'];


  Public $timestamps = false; //created_at dan update_at digunakan
}