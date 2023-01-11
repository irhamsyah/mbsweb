<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class TransactionDetail extends Model
{
  protected $table ='transaction_detail';
  protected $guarded = ['id'];

  Public $timestamps = false; //created_at dan update_at digunakan
}
