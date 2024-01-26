<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Nominatif</title>
</head>
<body>
    <table id="tbl1" class="table table-responsive" style="border-style:none">
        <thead>
            <tr>
                <th>No.rekening</th>
                <th>Nama Nasabah</th>
                <th>Alamat</th>
                <th>Tgl Mulai</th>
                <th>JKW</th>
                <th>Tgl_JT</th>
            </tr>
        </thead>
        <tbody>

        @foreach($nominatif as $values)
            <tr>
                <td>{{$values->NO_REKENING}}</td>
                <td>{{$values->nama_nasabah}}</td>
                <td>{{$values->alamat}}</td>
                <td>{{$values->TGL_REGISTRASI}}</td>
                <td>{{$values->JKW}}</td>
                <td>{{$values->TGL_JT}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

</body>
</html>