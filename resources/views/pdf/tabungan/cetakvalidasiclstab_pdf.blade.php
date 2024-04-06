<!DOCTYPE html>
<html lang="en">
{{-- Fungsi Terbilang --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <style>
        td {
            font-family: Arial, Helvetica, sans-serif;
            font-size: 11pt;
        }
    </style>
    <title>Cetak Validasi</title>
</head>

<body>
    <div style="font-size: 9pt;line-height:20px">
        @php(date_default_timezone_set('Asia/Jakarta')
        )
        {{date('d/m/Y H:i:s',strtotime($request->tgl_trans))}}
        @if(is_null(Auth::id()==false))
        {{Auth::id()->username}}
        {{$request->kuitansi}}
        @endif
    </div>
    <div style="font-size: 9pt;line-height:10px">
        {{$request->no_rekening}}
        {{$request->nama_nasabah}}

    </div>
    <div style="font-size: 9pt;line-height:15px">
        saldo:{{number_format($request->saldo,2,".",",")}}
    </div>
    <div style="font-size: 9pt;line-height:10px">
        Admin:{{number_format($request->byadmin,2,".",",")}}
    </div>

</body>

</html>