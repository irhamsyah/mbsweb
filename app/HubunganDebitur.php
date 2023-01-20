<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class HubunganDebitur extends Model
{
  protected $table ='kodehubungandebitur';
  protected $guarded = ['KODE_HUBUNGAN'];


  Public $timestamps = false; //created_at dan update_at digunakan
}