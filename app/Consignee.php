<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Consignee extends Model
{
  protected $table ='consignee';
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  Public $timestamps = true; //created_at dan update_at digunakan
}
