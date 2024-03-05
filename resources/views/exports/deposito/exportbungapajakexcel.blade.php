<table>
    <thead>
        <tr>
            <th>no_rekening</th>
            <th>nama_nasabah</th>
            <th>alamat</th>
            <th>jml_deposito</th>
            <th>tgl_registrasi</th>
            <th>titipan</th>
            <th>bunga</th>
            <th>pajak</th>
            <th>kode_group1</th>
            <th>kode_group2</th>
            <th>kode_group3</th>
        </tr>
    </thead>
    <tbody>
        @foreach($nomin as $key)
        <tr>
            <td>{{ $key->no_rekening}}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{ $key->jml_deposito }}</td>
            <td>{{ $key->tgl_registrasi }}</td>
            <td>{{ $key->saldo_titipan }}</td>
            <td>{{ $key->bunga }}</td>
            <td>{{ $key->pajak }}</td>
            <td>{{ $key->KODE_GROUP1 }}</td>
            <td>{{ $key->KODE_GROUP2 }}</td>
            <td>{{ $key->KODE_GROUP3 }}</td>
        </tr>
        @endforeach
    </tbody>
</table>