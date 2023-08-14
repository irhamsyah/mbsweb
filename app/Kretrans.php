<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Kretrans extends Model
{
    // relasi Many to One , NamaTabel,LokalKey(Tabung),ForeignKey(Nasabah)
    public function kredit()
    {
        return $this->belongsTo('App\Kredit','NO_REKENING','NO_REKENING');
    }
    // Relasi HasManyThrough untuk akses dari App\Kretrans->App\Nasabah melalui App\Kredit
    // return $this->HasManyThrough(
    //     Nasabah::class,
    //     Kredit::class,
    //     'NO_REKENING',->punya Kredit
    //     'nasabah_id', -> punya Nasabah
    //     'NO_REKENING', -> punya Kretrans
    //     'NASABAH_ID' -> punya Tabungan

    public function nasabah() : HasManyThrough
    {
        return $this->HasManyThrough(
            Nasabah::class,
            Kredit::class,
            'NO_REKENING',
            'nasabah_id',
            'NO_REKENING',
            'NASABAH_ID'
        );
    }
    public $timestamps=false;
    protected $table = 'kretrans';
    protected $primaryKey = 'KRETRANS_ID';
}
