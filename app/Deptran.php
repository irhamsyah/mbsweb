<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use PhpParser\Node\Expr\FuncCall;

class Deptran extends Model
{
    // relasi Many to One , NamaTabel,LokalKey(Tabung),ForeignKey(Nasabah)
    public function deposito()
    {
        return $this->belongsTo('App\Deposito','NO_REKENING','NO_REKENING');
    }

    public function nasabah() : HasManyThrough
    {
        return $this->HasManyThrough(
            Nasabah::class,
            Deposito::class,
            trim('NO_REKENING'),
            trim('nasabah_id'),
            trim('NO_REKENING'),
            trim('NASABAH_ID')
        );
    }
    // Relasi ke kodetransdeposito
    public function kodetransdep() 
    {
        return $this->hasMany('App\kodetransdeposito','KODE_TRANS','KODE_TRANS');
    }

    public $timestamps=false;
    protected $table = 'deptrans';
    protected $primaryKey = 'DEPTRANS_ID';
    protected $fillable =[
    'DEPTRANS_ID',
    'TGL_TRANS',
    'NO_REKENING',
    'KODE_TRANS',
    'SALDO_SEBELUM',
    'SALDO_TRANS',
    'SALDO_SETELAH',
    'MY_KODE_TRANS',
    'KUITANSI',
    'NO_TELLER',
    'USERID',
    'TOB',
    'POSTED',
    'VALIDATED',
    'TGL_INPUT',
    'KODE_PERK_TABUNGAN',
    'KODE_PERK_GL',
    'CAB',
    'USERAPP',
    'FLAG_PAJAK',
    'tob_RAK',
    'ACR_TRANS'];
}
