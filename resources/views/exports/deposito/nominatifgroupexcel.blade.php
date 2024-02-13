<table>
    <thead>
    <tr>
        <th>nasabah_id</th>
        <th>jenis_deposito</th>
        <th>deskripsi_jenis_deposito</th>
        <th>no_rekening</th>
        <th>nama_nasabah</th>
        <th>alamat</th>
        <th>tempatlahir</th>
        <th>tgllahir</th>
        <th>no_id</th>
        <th>npwp</th>
        <th>suku_bunga</th>
        <th>tgl_mulai</th>
        <th>tgl_registrasi</th>
        <th>jkw</th>
        <th>tgl_jt</th>
        <th>kode_group1</th>
        <th>kode_group2</th>
        <th>kode_group3</th>
        <th>jml_deposito</th>
        <th>kode_bi_pemilik</th>
        <th>bunga_bln_ini</th>
        <th>pajak_bln_ini</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->nasabah_id }}</td>
            <td>{{ $key->JENIS_DEPOSITO }}</td>
            <td>{{ $key->DESKRIPSI_JENIS_DEPOSITO }}</td>
            <td>{{ $key->NO_REKENING }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{ $key->tempatlahir }}</td>
            <td>{{ $key->tgllahir}}</td>
            <td>{{ $key->no_id}}</td>
            <td>{{ $key->npwp}}</td>
            <td>{{ $key->SUKU_BUNGA}}</td>
            <td>{{ $key->TGL_MULAI}}</td>
            <td>{{ $key->TGL_REGISTRASI}}</td>
            <td>{{ $key->JKW }}</td>
            <td>{{ $key->TGL_JT }}</td>
            <td>{{ $key->KODE_GROUP1 }}</td>
            <td>{{ $key->KODE_GROUP2 }}</td>
            <td>{{ $key->KODE_GROUP3}}</td>
            <td>{{ $key->JML_DEPOSITO}}</td>
            <td>{{ $key->KODE_BI_PEMILIK }}</td>
            <td>{{ $key->JML_BUNGA }}</td>
            <td>{{ $key->JML_PAJAK }}</td>
        </tr>
    @endforeach
    </tbody>
</table>