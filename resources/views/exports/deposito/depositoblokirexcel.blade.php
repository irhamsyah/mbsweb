<table>
    <thead>
    <tr>
        <th>no_rekening</th>
        <th>nama_nasabah</th>
        <th>alamat</th>
        <th>jml_deposito</th>
        <th>jkw</th>
        <th>suku_bunga</th>
        <th>tgl_mulai</th>
        <th>tgl_blokir</th>
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
            <td>{{ $key->NO_REKENING}}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{ $key->jml_deposito }}</td>
            <td>{{ $key->jkw }}</td>
            <td>{{ $key->SUKU_BUNGA }}</td>
            <td>{{ $key->TGL_MULAI }}</td>
            <td>{{ $key->TGL_BLOKIR }}</td>
            <td>{{ $key->KODE_GROUP1 }}</td>
            <td>{{ $key->DESKRIPSI_GROUP1 }}</td>
            <td>{{ $key->KODE_GROUP2 }}</td>
            <td>{{ $key->DESKRIPSI_GROUP2 }}</td>
            <td>{{ $key->KODE_GROUP3 }}</td>
            <td>{{ $key->DESKRIPSI_GROUP3 }}</td>
        </tr>
    @endforeach
    </tbody>
</table>