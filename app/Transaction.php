<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Transaction extends Model
{
  protected $table ='transaction';
  protected $guarded = ['id'];
  protected $dates = ['loading_date'];


  Public $timestamps = false; //created_at dan update_at digunakan
}
