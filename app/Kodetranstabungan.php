<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kodetranstabungan extends Model
{
    public $timestamp=false;    
    protected $table='kodetranstabungan';
    protected $primaryKey='KODE_TRANS';
    protected $keyType='string';
    protected $fillable=['KODE_TRANS','DESKRIPSI_TRANS','TYPE_TRANS','GL_TRANS','TOB'];

    public function tabtrans()
    {
        return $this->belongsToMany('App\Tabtran','KODE_TRANS','KODE_TRANS');
    }

}
