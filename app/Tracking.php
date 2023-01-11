<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Tracking extends Model
{
  protected $table ='tracking';
  protected $guarded = ['id'];
  protected $dates = ['date'];

  Public $timestamps = true; //created_at dan update_at digunakan
}
