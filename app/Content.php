<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
  protected $table ='content';
  protected $guarded = ['id'];

  Public $timestamps = false; //created_at dan update_at digunakan
}
