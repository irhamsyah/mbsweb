<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kredit extends Model
{
  // relasi Many to One , NamaTabel,LokalKey(Kredit),ForeignKey(Nasabah)
  public function nasabah()
  {
      return $this->belongsTo('App\Nasabah','NASABAH_ID','nasabah_id');
  }
  // return $this->hasMany('App\Comment', 'foreign_key', 'local_key');
  public function kretrans()
  {
      return $this->belongsToMany('App\Kretrans','NO_REKENING','NO_REKENING');
  }
  public $timestamps=false;
  protected $table = 'kredit';
  protected $primaryKey = 'NO_REKENING';
  //Define primary key not integer is Important because laravel assume your primarykey is Integer
  protected $keyType = 'string';
}
