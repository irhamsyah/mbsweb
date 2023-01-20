<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class BidangUsaha extends Model
{
  protected $table ='kodebidangusaha';
  protected $guarded = ['KODE_BIDANG_USAHA'];


  Public $timestamps = false; //created_at dan update_at digunakan
}