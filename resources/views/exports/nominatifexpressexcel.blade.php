<table>
    <thead>
    <tr>
        <th>nasabah_id</th>
        <th>no_rekening</th>
        <th>nama_nasabah</th>
        <th>alamat</th>
        <th>akad</th>
        <th>nisbah</th>
        <th>saldo_nominatif</th>
        <th>tgl_mulai</th>
        <th>jkw</th>
        <th>tgl_jt</th>
        <th>tgl_akhir_trans</th>
        <th>suku_bunga</th>
        <th>kode_bi_pemilik</th>
        <th>kode_group1</th>
        <th>kode_group2</th>
        <th>kode_group3</th>
        <th>tgl_registrasi</th>
        <th>jenis_tabungan</th>
        <th>kode_bi_hubungan</th>    
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->nasabah_id }}</td>
            <td>{{ $key->NO_REKENING }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{ $key->akad }}</td>
            <td>{{ $key->nisbah }}</td>
            <td>{{ $key->saldo_nominatif }}</td>
            <td>{{ $key->TGL_MULAI }}</td>
            <td>{{ $key->JKW }}</td>
            <td>{{ $key->TGL_JT }}</td>
            <td>{{ $key->tgl_akhir_trans }}</td>
            <td>{{ $key->suku_bunga }}</td>
            <td>{{ $key->KODE_BI_PEMILIK }}</td>
            <td>{{ $key->KODE_GROUP1 }}</td>
            <td>{{ $key->KODE_GROUP2 }}</td>
            <td>{{ $key->KODE_GROUP3 }}</td>
            <td>{{ $key->TGL_REGISTRASI }}</td>
            <td>{{ $key->JENIS_TABUNGAN }}</td>
            <td>{{ $key->KODE_BI_HUBUNGAN }}</td>
        </tr>
    @endforeach
    </tbody>
</table>