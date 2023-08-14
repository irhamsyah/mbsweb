<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use SoftDeletes;

class Nasabah extends Model
{
  public function tabungans(){
    return $this->hasMany('App\Tabungan', trim('NASABAH_ID'),trim('nasabah_id'));
  }

  protected $table ='nasabah';
  protected $primaryKey='nasabah_id';
  protected $dates = ['tgllahir'];
  //Define primary key not integer is Important because laravel assume your primarykey is Integer
  protected $keyType = 'string';
  Public $timestamps = false; //created_at dan update_at digunakan
  protected $fillable=[
      'nasabah_id',
      'jenis_nasabah',
      'nama_nasabah',
      'nama_alias',
      'alamat',
      'kelurahan',
      'kecamatan',
      'kode_pos',
      'kota_id',
      'telpon',
      'jenis_kelamin',
      'pekerjaan',
      'kode_area',
      'pekerjaan_id',
      'tempatlahir',
      'tgllahir',
      'gelar_id',
      'jenis_id',
      'no_id',
      'npwp',
      'KOTA',
      'AKUM_JASA_PINJ',
      'INDEX_SHU_PINJ',
      'SHU_PINJ',
      'AKUM_SIMP',
      'INDEX_SHU_SIMP',
      'SHU_SIMP',
      'IBU_KANDUNG',
      'KET_GELAR',
      'NO_DIN',
      'kode_golongan_debitur',
      'Tempat_Kerja',
      'Kode_Bidang_Usaha',
      'Kode_Negara',
      'Kode_Hubungan_Debitur',
      'NO_AKTE_AKHIR',
      'TGL_AKTE_AKHIR',
      'NASABAH_GROUP1',
      'NASABAH_GROUP2',
      'NASABAH_GROUP3',
      'NASABAH_GROUP4',
      'NO_REK_SHU',
      'ANGGOTA',
      'PATH_FOTO',
      'PATH_TTANGAN',
      'tglid',
      'Black_List',
      'TUJUAN_PEMBUKAAN_KYC',
      'SUMBER_DANA_KYC',
      'PENGGUNAAN_DANA_KYC',
      'KET_PEKERJAAN',
      'NO_NIP',
      'TGL_BUKA',
      'PENDAPATAN_KYC',
      'ALAMAT_DOMISILI',
      'NO_HP',
      'TANGGAL_ULANGTAHUN',
      'BULAN_ULANGTAHUN',
      'NAMA_KUASA',
      'ALAMAT_KUASA',
      'STATUS_PROSES',
      'STATUS_APPROVAL',
      'USER_APPROVAL',
      'kota_idSID',
      'NO_PASSPORT',
      'Status_Marital',
      'TGL_MULAI_PASSPORT',
      'TGL_AKHIR_PASSPORT',
      'bentuk_perusahaan',
      'alamat_email',
      'mata_uang',
      'akte_perusahaan',
      'nama_pengurus1',
      'jabatan_pengurus1',
      'alamat_pengurus1',
      'jnskelamin_pengurus1',
      'tmp_lahir_pengurus1',
      'tgl_lahir_pengurus1',
      'status_pengurus1',
      'KODE_PJTKI',
      'pendidikan_pengurus1',
      'CAB',
      'OUTLET',
      'id_template',
      'alamat_kantor',
      'cif',
      'status_kawin',
      'id_pasangan',
      'nama_pendamping',
      'tgllhr_pasangan',
      'penghasilan_setahun',
      'jml_tanggungan',
      'kode_sumber_penghasilan'

];

}