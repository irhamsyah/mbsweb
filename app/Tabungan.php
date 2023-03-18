<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{   
    // relasi Many to One , NamaTabel,LokalKey(Tabung),ForeignKey(Nasabah)
    public function nasabahs()
    {
        return $this->belongsTo('App\Nasabah','NASABAH_ID','nasabah_id');
    }

    public $timestamps=false;
    protected $table = 'tabung';
    // protected $primaryKey = 'no_rekening';
    //Define primary key not integer is Important because laravel assume your primarykey is Integer
    protected $keyType = 'string';

    protected $fillable =['no_rekening',
    'no_alternatif',
    'nasabah_id',
    'qq',
    'jenis_tabungan',
    'kode_bi_pemilik',
    'kode_bi_hubungan',
    'kode_bi_metoda',
    'suku_bunga',
    'persen_pph',
    'tgl_registrasi',
    'saldo_awal',
    'saldo_setoran',
    'saldo_penarikan',
    'saldo_akhir',
    'saldo_efektif_bln_ini',
    'bunga_bln_ini',
    'pajak_bln_ini',
    'adm_bln_ini',
    'tgl_bunga',
    'kode_group1',
    'kode_group2',
    'kode_group3',
    'keterangan',
    'status_aktif',
    'saldo_nominatif',
    'minimum',
    'adm_per_bln',
    'periode_adm',
    'last_tgl_adm',
    'setoran_minimum',
    'tgl_jt',
    'no_rek_kredit',
    'setoran_per_bln',
    'jkw',
    'nama_kuasa',
    'almt_kuasa',
    'tgl_trans_terakhir',
    'kode_cab',
    'abp',
    'pot_simp',
    'shu_thn_ini',
    'saldo_efektif_thn_ini',
    'saldo_awal_hari',
    'flag_restricted',
    'baris_buku',
    'saldo_bln_01',
    'saldo_bln_02',
    'saldo_bln_03',
    'saldo_bln_04',
    'saldo_bln_05',
    'saldo_bln_06',
    'saldo_bln_07',
    'saldo_bln_08',
    'saldo_bln_09',
    'saldo_bln_10',
    'saldo_bln_11',
    'saldo_bln_12',
    'jumlah_undian',
    'awal_undian',
    'akhir_undian',
    'akad',
    'zakat',
    'kode_bi_lokasi',
    'saldo_hitung_pajak',
    'zakat_bln_ini',
    'blokir',
    'prosen_bonus',
    'cab',
    'userid',
    'suku_bunga_estimasi',
    'saldo_akan_datang',
    'type_tabungan',
    'user_blokir',
    'user_unblokir',
    'tgl_blokir',
    'tgl_unblokir',
    'saldo_blokir',
    'nisbah',
    'status_approval',
    'user_approval',
    'tgl_mulai',
    'gol_nasabah',
    'kode_group4',
    'kode_group5',
    'kode_hari',
    'nomor_sae',
    'outlet',
    'lama_pasif',
];
}
