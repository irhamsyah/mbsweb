<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class GolonganDebitur extends Model
{
  protected $table ='kodegoldebitur';
  protected $guarded = ['KODE_GOL_DEBITUR'];


  Public $timestamps = false; //created_at dan update_at digunakan
}