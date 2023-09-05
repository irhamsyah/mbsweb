<table>
    <thead>
    <tr>
        <th>no_rekening</th>
        <th>nama_nasabah</th>
        <th>jenis_tabungan</th>
        <th>kode_group1</th>
        <th>kode_group2</th>
        <th>kode_group3</th>
        <th>tabtrans_id</th>
        <th>tgl_trans</th>
        <th>saldo_trans</th>
        <th>kode_trans</th>
        <th>my_kode_trans</th>
        <th>Kuitansi</th>
        <th>tob</th>
        <th>posted</th>
        <th>validated</th>
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
            <td>{{ $key->tabtrans_id }}</td>
            <td>{{ $key->tgl_trans }}</td>
            <td>{{ $key->saldo_trans }}</td>
            <td>{{ $key->kode_trans }}</td>
            <td>{{ $key->my_kode_trans }}</td>
            <td>{{ $key->kuitansi }}</td>
            <td>{{ $key->tob }}</td>
            <td>{{ $key->posted }}</td>
            <td>{{ $key->validated }}</td>
        </tr>
    @endforeach
    </tbody>
</table>