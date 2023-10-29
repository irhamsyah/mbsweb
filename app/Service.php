<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Service extends Model
{
  protected $table ='service';
  protected $fillable = [
      'title', 'detail_id', 'detail_en', 'img_title', 'id_user', 'created_at', 'updated_at', 'deleted_at'
  ];
  protected $dates = ['deleted_at'];
  protected $softCascade = ['Service'];

  Public $timestamps = true; //created_at dan update_at digunakan
}
