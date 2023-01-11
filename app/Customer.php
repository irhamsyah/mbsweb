<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;
use Illuminate\Foundation\Auth\Customer as Authenticatable;
use Illuminate\Notifications\Notifiable;



class Customer extends Authenticatable
{
  use Notifiable;
  
  protected $table ='customer';
  protected $guarded = ['id'];
  protected $dates = ['deleted_at'];

  protected $hidden = [
    'password',
  ];

/**
 * The attributes that should be cast to native types.
 *
 * @var array
 */

protected $casts = [
    'email_verified_at' => 'datetime',
];

  Public $timestamps = true; //created_at dan update_at digunakan
}
