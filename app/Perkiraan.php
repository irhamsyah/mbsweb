<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Perkiraan extends Model
{
  protected $table ='perkiraan';
  protected $guarded = ['kode_perk'];
  Public $timestamps = false; //created_at dan update_at digunakan

  protected $fillable =[
    'kode_perk',
    'kode_alt',
    'nama_perk',
    'kode_induk',
    'level',
    'type',
    'dk',
    'saldo_awal',
    'saldo_debet',
    'saldo_kredit',
    'saldo_akhir',
    'saldo_tahun_lalu',
    'mut_awal',
    'mut_debet',
    'mut_kredit',
    'mut_akhir',
    'bi_sandi_bank',
    'bi_jenis',
    'bi_jkw_thn',
    'bi_jkw_bln',
    'bi_jkw_hari',
    'bi_kolek',
    'bi_suku_bunga',
    'RENCANA',
    'SYNC',
    'KODE_LAMA',
    'CAB',
    'Kons_Perk',
    'KonsCab',
    'BI_TERKAIT',
    'BI_PPAP',
    'BI_PROSEN_PPAP',
    'SANDI_SUMBER_DANA',
    'BI_BULAN_MULAI',
    'BI_TAHUN_MULAI',
    'BI_BULAN_JT',
    'BI_TAHUN_JT',
    'BI_HUBUNGAN',
    'bi_jenis_bank',
    'bi_lokasi_bank',
    'bi_jt_thn',
    'bi_jt_bln',
    'bi_jenis_pinjaman',
    'bi_gol_kreditur',
    'bi_periode_bayar',
    'bi_cara_hitung',
    'bi_plafond',
    'bi_mulai_tgl',
    'bi_mulai_bln',
    'bi_mulai_thn',
    'bi_jt_tgl'
  ];
}