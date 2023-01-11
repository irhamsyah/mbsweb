<?php

namespace App;

use Askedio\SoftCascade\Traits\SoftCascadeTrait;
use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class NewsImage extends Model
{
  protected $table ='news_image';
  // protected $fillable = [
  //     'title', 'text', 'img_title', 'id_category', 'id_user'
  // ]
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  Public $timestamps = true; //created_at dan update_at digunakan

  public function news() {
    return $this->belongsTo('App\News');
  }
}
