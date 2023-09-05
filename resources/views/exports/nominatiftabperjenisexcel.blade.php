<table>
    <thead>
    <tr>
        <th>no_rekening</th>
        <th>nama_nasabah</th>
        <th>alamat</th>
        <th>tgl_registrasi</th>
        <th>suku_bunga</th>
        <th>saldo_akhir</th>
        <th>tgl_akhir_trans</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->no_rekening }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{ $key->TGL_REGISTRASI }}</td>
            <td>{{ $key->SUKU_BUNGA }}</td>
            <td>{{ $key->SALDO_AKHIR }}</td>
            <td>{{ $key->tgl_terakhir_trans }}</td>
        </tr>
    @endforeach
    </tbody>
</table>