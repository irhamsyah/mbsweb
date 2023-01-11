<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class TruckingType extends Model
{
  protected $table ='trucking_type';
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  Public $timestamps = true; //created_at dan update_at digunakan
}
