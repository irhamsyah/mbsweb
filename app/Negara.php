<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Negara extends Model
{
  protected $table ='kodenegara';
  protected $guarded = ['KODE_NEGARA'];


  Public $timestamps = false; //created_at dan update_at digunakan
}