<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class VendorTruck extends Model
{
  protected $table ='vendor_truck';
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  Public $timestamps = true; //created_at dan update_at digunakan
}
