<!DOCTYPE html>
<html lang="en">
{{-- Fungsi Terbilang --}}

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Cetak Validasi</title>
</head>

<body>
    <div style="font-size: 9pt;line-height:20px">
        {{date('d/m/Y H:m:s',strtotime($request->tgl_trans))}}
        {{Auth::user()->username}}
        {{$request->kuitansi}}
    </div>
    <div style="font-size: 9pt;line-height:10px">
        {{$request->kode_trans}}
        @if(isset($request->no_rekening_tab))
        Pencairan Deposito ke Tabungan
        @else
        Pencairan Deposito Tunai
        @endif
    </div>
    <div style="font-size: 9pt;line-height:15px">
        {{$request->no_rekening}} {{$request->nama_nasabah}}
    </div>
    <div style="font-size: 9pt;line-height:10px">
        {{$request->totalditerima}} {{$request->pinalti}}
    </div>

    @if(isset($request->no_rekening_tab))
    <div style="font-size: 9pt;line-height:10px">
        {{$request->no_rekening_tab}} {{$request->nama_nasabah_tab}}
    </div>
    @endif

</body>

</html>