<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Tarif extends Model
{
  protected $table ='tarif';
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  Public $timestamps = true; //created_at dan update_at digunakan

  //relation with Pelayaran table
  public function Pelayaran() {
    return $this->belongsTo('App\Pelayaran');
  }
}
