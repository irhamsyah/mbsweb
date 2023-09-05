<table>
    <thead>
    <tr>
        <th>no_rekening</th>
        <th>nama_nasabah</th>
        <th>jenis_tabungan</th>
        <th>kode_group1</th>
        <th>kode_group2</th>
        <th>kode_group3</th>
        <th>saldo_blokir</th>
        <th>tgl_blokir</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->no_rekening }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->jenis_tabungan }}</td>
            <td>{{ $key->kode_group1 }}</td>
            <td>{{ $key->kode_group2 }}</td>
            <td>{{ $key->kode_group3 }}</td>
            <td>{{ $key->saldo_blokir }}</td>
            <td>{{ $key->tgl_blokir }}</td>
        </tr>
    @endforeach
    </tbody>
</table>