<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class HubunganBank extends Model
{
  protected $table ='kodehubungan';
  protected $guarded = ['KODE_HUBUNGAN'];


  Public $timestamps = false; //created_at dan update_at digunakan
}