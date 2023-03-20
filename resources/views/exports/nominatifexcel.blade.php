<table>
    <thead>
    <tr>
        <th>NO_REKENING</th>
        <th>nasabah_id</th>
        <th>no_id</th>
        <th>nama_nasabah</th>
        <th>alamat</th>
        <th>tempatlahir</th>
        <th>tgllahir</th>
        <th>npwp</th>
        <th>suku_bunga</th>
        <th>saldo_bln_lalu</th>
        <th>saldo_eff_bln_ini</th>
        <th>mutasi_debet</th>
        <th>mutasi_kredit</th>
        <th>saldo_sbl_bunga</th>
        <th>bunga_bln_ini</th>
        <th>pajak_bln_ini</th>
        <th>admin_bln_ini</th>
        <th>saldo_stl_bunga</th>
        <th>kupon</th>
        <th>saldo_nominatif</th>
        <th>SALDO_BLOKIR</th>
        <th>KODE_BI_PEMILIK</th>
        <th>KODE_GROUP1</th>
        <th>KODE_GROUP2</th>
        <th>KODE_GROUP3</th>
        <th>CAB</th>
        <th>TGL_REGISTRASI</th>
        <th>JENIS_TABUNGAN</th>
        <th>DESKRIPSI_JENIS_TABUNGAN</th>
        <th>SETORAN_PER_BLN</th>
        <th>TGL_MULAI</th>
        <th>JKW</th>
        <th>TGL_JT</th>
        <th>NISBAH</th>
        <th>KODE_BI_HUBUNGAN</th>    
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->NO_REKENING }}</td>
            <td>{{ $key->nasabah_id }}</td>
            <td>{{ $key->no_id }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{ $key->tempatlahir }}</td>
            <td>{{ $key->tgllahir }}</td>
            <td>{{ $key->npwp }}</td>
            <td>{{ $key->suku_bunga }}</td>
            <td>{{ $key->saldo_bln_lalu }}</td>
            <td>{{ $key->saldo_eff_bln_ini }}</td>
            <td>{{ $key->mutasi_debet }}</td>
            <td>{{ $key->mutasi_kredit }}</td>
            <td>{{ $key->saldo_sbl_bunga }}</td>
            <td>{{ $key->bunga_bln_ini }}</td>
            <td>{{ $key->pajak_bln_ini }}</td>
            <td>{{ $key->admin_bln_ini }}</td>
            <td>{{ $key->saldo_stl_bunga }}</td>
            <td>{{ $key->kupon }}</td>
            <td>{{ $key->saldo_nominatif }}</td>
            <td>{{ $key->SALDO_BLOKIR }}</td>
            <td>{{ $key->KODE_BI_PEMILIK }}</td>
            <td>{{ $key->KODE_GROUP1 }}</td>
            <td>{{ $key->KODE_GROUP2 }}</td>
            <td>{{ $key->KODE_GROUP3 }}</td>
            <td>{{ $key->kode_cab }}</td>
            <td>{{ $key->TGL_REGISTRASI }}</td>
            <td>{{ $key->JENIS_TABUNGAN }}</td>
            <td>{{ $key->DESKRIPSI_JENIS_TABUNGAN }}</td>
            <td>{{ $key->SETORAN_PER_BLN }}</td>
            <td>{{ $key->TGL_MULAI }}</td>
            <td>{{ $key->JKW }}</td>
            <td>{{ $key->TGL_JT }}</td>
            <td>{{ $key->NISBAH }}</td>
            <td>{{ $key->KODE_BI_HUBUNGAN }}</td>
        </tr>
    @endforeach
    </tbody>
</table>