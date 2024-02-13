<table>
    <thead>
    <tr>
        <th>nasabah_id</th>
        <th>no_rekening</th>
        <th>nama_nasabah</th>
        <th>alamat</th>
        <th>kota_id</th>
        <th>tgl_mulai</th>
        <th>tgl_registrasi</th>
        <th>jkw</th>
        <th>tgl_jt</th>
        <th>suku_bunga</th>
        <th>tgl_valuta</th>
        <th>jml_deposito</th>
        <th>jenis_deposito</th>
        <th>kode_bi_pemilik</th>
        <th>kode_bi_hubungan</th>
        <th>bunga_bln_ini</th>
        <th>pajak_bln_ini</th>
        <th>kode_group1</th>
        <th>deskripsi_group1</th>
        <th>kode_group2</th>
        <th>deskripsi_group2</th>
        <th>kode_group3</th>
        <th>deskripsi_group3</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->nasabah_id }}</td>
            <td>{{ $key->NO_REKENING }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{ $key->kota_id }}</td>
            <td>{{ $key->TGL_MULAI }}</td>
            <td>{{ $key->TGL_REGISTRASI }}</td>
            <td>{{ $key->JKW}}</td>
            <td>{{ $key->TGL_JT}}</td>
            <td>{{ $key->SUKU_BUNGA}}</td>
            <td>{{ $key->TGL_VALUTA}}</td>
            <td>{{ $key->NOMINAL}}</td>
            <td>{{ $key->JENIS_DEPOSITO }}</td>
            <td>{{ $key->KODE_BI_PEMILIK }}</td>
            <td>{{ $key->KODE_BI_HUBUNGAN }}</td>
            <td>{{ $key->JML_BUNGA }}</td>
            <td>{{ $key->JML_PAJAK }}</td>
            <td>{{ $key->KODE_GROUP1 }}</td>
            <td>{{ $key->DESKRIPSI_GROUP1 }}</td>
            <td>{{ $key->KODE_GROUP2 }}</td>
            <td>{{ $key->DESKRIPSI_GROUP2 }}</td>
            <td>{{ $key->KODE_GROUP3}}</td>
            <td>{{ $key->DESKRIPSI_GROUP3}}</td>
        </tr>
    @endforeach
    </tbody>
</table>