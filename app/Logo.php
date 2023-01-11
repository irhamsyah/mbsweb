<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logo extends Model
{
  protected $table ='logo';
  protected $guarded = ['id'];

  Public $timestamps = false; //created_at dan update_at digunakan
}
