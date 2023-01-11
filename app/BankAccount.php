<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class BankAccount extends Model
{
  protected $table ='bank_account';
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  Public $timestamps = true; //created_at dan update_at digunakan

  //relation with Agent table
  public function Agent() {
    return $this->belongsTo('App\Agent');
  }
}
