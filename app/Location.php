<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Location extends Model
{
  protected $table ='location';
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  Public $timestamps = true; //created_at dan update_at digunakan
}
