<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kodejenistabungan extends Model
{
    public $timestamp=false;
    protected $table='kodejenistabungan';
    protected $primaryKey='KODE_JENIS_TABUNGAN';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_JENIS_TABUNGAN Utama','DESKRIPSI_JENIS_TABUNGAN','SUKU_BUNGA_DEFAULT','ADM_PER_BLN_DEFAULT','PERIODE_ADM_DEFAULT','SETORAN_MINIMUM_DEFAULT','MINIMUM_DEFAULT','KODE_PERK','PPH_DEFAULT','METODE_BUNGA','TOLERANSI_TANGGAL','SETORAN_PER_BLN_DEFAULT','SALDO_MIN_BUNGA','FORMAT_CETAK_BUKU','FORMAT_CETAK_KARTU','KODE_PERK_BIAYA','GRUP_TABUNGAN','FLAG_HITUNG_SHU','FLAG_ANGGOTA'];

}
