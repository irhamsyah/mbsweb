<table>
    <thead>
    <tr>
        <th>kode</th>
        <th>deskripsi</th>
        <th>nama_nasabah</th>
        <th>saldo_nominatif</th>
        <th>kode_bi_pemilik</th>
        <th>kode_group1</th>
        <th>kode_group2</th>
        <th>kode_group3</th>
        <th>tgl_registrasi</th>
        <th>jenis_tabungan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->kode }}</td>
            <td>{{ $key->deskripsi }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->saldo_nominatif }}</td>
            <td>{{ $key->kode_bi_pemilik }}</td>
            <td>{{ $key->KODE_GROUP1 }}</td>
            <td>{{ $key->KODE_GROUP2 }}</td>
            <td>{{ $key->KODE_GROUP3 }}</td>
            <td>{{ $key->tgl_registrasi }}</td>
            <td>{{ $key->jenis_tabungan }}</td>
            <td>{{ $key->suku_bunga }}</td>
        </tr>
    @endforeach
    </tbody>
</table>