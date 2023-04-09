<table>
    <thead>
    <tr>
        <th>no_nasabah</th>
        <th>nama_nasabah</th>
        <th>alamat</th>
        <th>kota</th>
        <th>telp</th>
        <th>tgllahir</th>   
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->nasabah_id }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{ $key->Deskripsi_Kota }}</td>
            <td>{{ $key->telpon }}</td>
            <td>{{ $key->tgllahir }}</td>
        </tr>
    @endforeach
    </tbody>
</table>