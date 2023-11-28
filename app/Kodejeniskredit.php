<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kodejeniskredit extends Model
{
    public $timestamp=false;
    protected $table='kodejeniskredit';
    protected $primaryKey='KODE_JENIS_KREDIT';
    protected $keyType='string';
    public $incrementing=false;
    protected $fillable=['KODE_JENIS_KREDIT', 
	'DESKRIPSI_JENIS_KREDIT', 
	'TYPE_PINJAMAN_DEFAULT', 
	'KODE_PERK_KREDIT', 
	'KODE_PERK_BUNGA', 
	'FLAG_HITUNG_SHU', 
	'FLAG_ANGGOTA', 
	'PROSEN_PRODUK_SHU', 
	'BOBOT_PRODUK_SHU', 
	'SALDO_MINIMUM_SHU', 
	'AKUM_SALDO_PRODUK', 
	'EKIVALEN_SHU', 
	'KODE_BIAYA_SHU'];

}
