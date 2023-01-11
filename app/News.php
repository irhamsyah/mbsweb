<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class News extends Model
{
  protected $table ='news';
  protected $fillable = [
      'title', 'text', 'img_title', 'id_category', 'location', 'id_user', 'created_at', 'updated_at', 'deleted_at'
  ];
  protected $dates = ['deleted_at'];
  protected $softCascade = ['News'];

  //relation with News Category table
  public function NewsCategory() {
    return $this->belongsTo('App\NewsCategory');
  }

  public function NewsImage()
  {
      return $this->hasMany('App\NewsImage');
  }
  protected static function boot() {
    parent::boot();

    static::deleting(function($newsimage) {
        $newsimage->NewsImage()->delete();
    });
  }

  Public $timestamps = true; //created_at dan update_at digunakan
}
