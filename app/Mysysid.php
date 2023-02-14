<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mysysid extends Model
{
    //
    public $timestamp=false;
    protected $table='mysysid';
    protected $keyType='string';
    public $incrementing=false;
}
