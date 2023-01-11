<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class NewsCategory extends Model
{
  protected $table ='news_category';
  // protected $fillable = [
  //     'title', 'text', 'img_title', 'id_category', 'id_user'
  // ];
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  Public $timestamps = true; //created_at dan update_at digunakan

  public function news() {
    return $this->hasMany('App\News');
  }
  protected static function boot() {
    parent::boot();

    static::deleting(function($newscategory) {
        $newscategory->news()->delete();
    });
  }
}
