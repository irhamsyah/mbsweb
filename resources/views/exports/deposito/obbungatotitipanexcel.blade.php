<table>
    <thead>
    <tr>
        <th>no_rekening</th>
        <th>nama_nasabah</th>
        <th>tgl_trans</th>
        <th>kode_trans</th>
        <th>ob_bunga</th>
        <th>ob_pajak</th>
        <th>kuitansi</th>
        <th>no_teller</th>
        <th>userid</th>
        <th>my_kode_trans</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->no_rekening}}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->TGL_TRANS }}</td>
            <td>{{ $key->kode_trans }}</td>
            <td>{{ $key->ob_bunga }}</td>
            <td>{{ $key->ob_pajak }}</td>
            <td>{{ $key->kuitansi }}</td>
            <td>{{ $key->no_teller }}</td>
            <td>{{ Auth::user()->id }}</td>
            <td>{{ $key->my_kode_trans }}</td>
        </tr>
    @endforeach
    </tbody>
</table>