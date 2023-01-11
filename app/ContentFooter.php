<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentFooter extends Model
{
  protected $table ='content_footer';
  protected $guarded = ['id'];

  Public $timestamps = false; //created_at dan update_at digunakan
}
