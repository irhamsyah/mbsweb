<table>
    <thead>
        <tr>
            <th>No_rekening</th>
            <th>Nama_nasabah</th>
            <th>Alamat</th>
            <th>Kota</th>
            <th>Tgl_registrasi</th>
            <th>Jkw</th>
            <th>Tgl_jt</th>
            <th>Suku_bunga</th>
            <th>Persen_pph</th>
            <th>Jenis_deposito</th>
            <th>Deskripsi_jenis_deposito</th>
            <th>Kode_bi_pemilik</th>
            <th>Jml_deposito</th>
            <th>Bunga_bln_ini</th>
            <th>Pajak_bln_ini</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksi as $key)
        <tr>
            <td>{{ $key->NO_REKENING}}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{ $key->Deskripsi_Kota }}</td>
            <td>{{ $key->TGL_REGISTRASI }}</td>
            <td>{{ $key->JKW }}</td>
            <td>{{ $key->TGL_JT }}</td>
            <td>{{ $key->SUKU_BUNGA }}</td>
            <td>{{ $key->PERSEN_PPH }}</td>
            <td>{{ $key->JENIS_DEPOSITO }}</td>
            <td>{{ $key->DESKRIPSI_JENIS_DEPOSITO }}</td>
            <td>{{ $key->KODE_BI_PEMILIK }}</td>
            <td>{{ number_format($key->nominal,2,".",",") }}</td>
            <td>{{ number_format($key->BUNGA_BLN_INI,2,".",",") }}</td>
            <td>{{ number_format($key->PAJAK_BLN_INI,2,".",",") }}</td>

        </tr>
        @endforeach
    </tbody>
</table>