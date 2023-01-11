<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Testimoni extends Model
{
  protected $table ='testimoni';
  protected $fillable = [
      'name', 'position', 'img_testimoni', 'testimoni', 'id_user', 'created_at', 'updated_at', 'deleted_at'
  ];
  protected $dates = ['deleted_at'];
  protected $softCascade = ['Testimoni'];

  Public $timestamps = true; //created_at dan update_at digunakan
}
