<table>
    <thead>
        <tr>
            <th>Nasabah_id</th>
            <th>Nama_nasabah</th>
            <th>Alamat</th>
            <th>Kode_group1</th>
            <th>No_rekening</th>
            <th>Tgl_registrasi</th>
            <th>Suku_bunga</th>
            <th>Jenis_deposito</th>
            <th>Jml_deposito</th>
            <th>Jkw</th>
            <th>Tgl_jt</th>
            <th>Kode_bi_pemilik</th>
            <th>Suku_bunga</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksi as $key)
        <tr>
            <td>{{ $key->NASABAH_ID}}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{ $key->KODE_GROUP1 }}</td>
            <td>{{ $key->NO_REKENING }}</td>
            <td>{{ $key->TGL_REGISTRASI }}</td>
            <td>{{ $key->SUKU_BUNGA }}</td>
            <td>{{ $key->JENIS_DEPOSITO }}</td>
            <td>{{ $key->JML_DEPOSITO }}</td>
            <td>{{ $key->JKW }}</td>
            <td>{{ $key->TGL_JT }}</td>
            <td>{{ $key->KODE_BI_PEMILIK }}</td>
            <td>{{ $key->SUKU_BUNGA }}</td>
        </tr>
        @endforeach
    </tbody>
</table>