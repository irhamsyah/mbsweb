<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Slider extends Model
{
  protected $table ='slider_home';
  protected $fillable = [
      'img_title','created_at', 'updated_at', 'deleted_at'
  ];
  protected $dates = ['deleted_at'];
  protected $softCascade = ['Slider'];

  Public $timestamps = true; //created_at dan update_at digunakan
}
