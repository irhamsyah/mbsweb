<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentImage extends Model
{
  protected $table ='content_image';
  protected $guarded = ['id'];

  Public $timestamps = false; //created_at dan update_at digunakan
}
