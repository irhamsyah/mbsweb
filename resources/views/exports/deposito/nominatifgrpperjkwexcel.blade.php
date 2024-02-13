<table>
    <thead>
    <tr>
        <th>kode</th>
        <th>deskripsi</th>
        <th>rekening</th>
        <th>nama_nasabah</th>
        <th>alamat</th>
        <th>jml_deposito</th>
        <th>tgl_mulai</th>
        <th>tgl_registrasi</th>
        <th>jkw</th>
        <th>tgl_jt</th>
        <th>jenis_deposito</th>
        <th>kode_bi_pemilik</th>
        <th>kode_group1</th>
        <th>kode_group2</th>
        <th>kode_group3</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->JKW }}</td>
            <td>{{ 'Jangka Watu '.$key->JKW.' bulan' }}</td>
            <td>{{ $key->NO_REKENING }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{ $key->NOMINAL }}</td>
            <td>{{ $key->TGL_MULAI }}</td>
            <td>{{ $key->TGL_REGISTRASI }}</td>
            <td>{{ $key->JKW}}</td>
            <td>{{ $key->TGL_JT}}</td>
            <td>{{ $key->JENIS_DEPOSITO }}</td>
            <td>{{ $key->KODE_BI_PEMILIK }}</td>
            <td>{{ $key->KODE_GROUP1 }}</td>
            <td>{{ $key->KODE_GROUP2 }}</td>
            <td>{{ $key->KODE_GROUP3}}</td>
        </tr>
    @endforeach
    </tbody>
</table>