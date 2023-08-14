<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use PhpParser\Node\Expr\FuncCall;

class Tabtran extends Model
{
    // relasi Many to One , NamaTabel,LokalKey(Tabung),ForeignKey(Nasabah)
    public function tabungan()
    {
        return $this->belongsTo('App\Tabungan','NO_REKENING','NO_REKENING');
    }
    // Relasi HasManyThrough untuk akses dari App\Tabtran->App\Nasabah melalui App\Tabungan
    // return $this->HasManyThrough(
    //     Nasabah::class,
    //     Tabungan::class,
    //     'NO_REKENING',->punya Tabungan
    //     'nasabah_id', -> punya Nasabah
    //     'NO_REKENING', -> punya Tabtran
    //     'NASABAH_ID' -> punya Tabungan

    public function nasabah() : HasManyThrough
    {
        return $this->HasManyThrough(
            Nasabah::class,
            Tabungan::class,
            trim('NO_REKENING'),
            trim('nasabah_id'),
            trim('NO_REKENING'),
            trim('NASABAH_ID')
        );
    }
    public function kodetranstab() 
    {
        return $this->hasMany('App\Kodetranstabungan','KODE_TRANS','KODE_TRANS');
    }
    public $timestamps=false;
    protected $table = 'tabtrans';
    protected $primaryKey = 'TABTRANS_ID';
    protected $fillable =[
    'TABTRANS_ID',
    'TGL_TRANS',
    'NO_REKENING',
    'KODE_TRANS',
    'SALDO_TRANS',
    'MY_KODE_TRANS',
    'KUITANSI',
    'NO_TELLER',
    'USERID',
    'TOB',
    'POSTED',
    'VALIDATED',
    'KETERANGAN',
    'NO_REK_OB',
    'SALDO_AWAL_HARI',
    'FLAG_CETAK',
    'TGL_INPUT',
    'KODE_PERK_TABUNGAN',
    'NO_REK_TABUNGAN',
    'KODE_PERK_GL',
    'CAB',
    'LINK_MODUL',
    'LINK_ID',
    'LINK_REKENING',
    'CAB_ONLINE',
    'BONUS_TRANS',
    'P_FEE',
    'JML_ANGSURAN',
    'USERAPP',
    'tob_RAK',
    'GL_DEBET',
    'GL_PENDAPATAN',
    'GL_BIAYA',
    'BIAYA_TRANS',
    'PENDAPATAN_TRANS',
    'TGL_AUTODEBET_KREDIT',
    'TGL_AUTODEBET_TABUNGAN',
    'TGL_AUTOKREDIT_TABUNGAN'];
}
