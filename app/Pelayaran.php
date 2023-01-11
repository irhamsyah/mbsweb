<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Pelayaran extends Model
{
  protected $table ='pelayaran';
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  Public $timestamps = true; //created_at dan update_at digunakan

  public function tarif() {
    return $this->hasMany('App\Tarif');
  }
  protected static function boot() {
    parent::boot();

    static::deleting(function($pelayaran) {
        $pelayaran->tarif()->delete();
    });
  }
}
