<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <style>
        #tbl1 {
            font-size: 50%;
        }

        br {
            content: "";
            margin: 0.5em;
            display: block;
            font-size: 1%;
        }

        #tbl1 td {
            padding: 0px;
        }
    </style>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Cetak Validasi</title>
</head>

<body>
    <div class="container">
        <button onClick="window.print()"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z" />
                <path
                    d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z" />
            </svg></button>
            <a href="{{route('setoranangsuran',['kode_transkredit'=>$request->kode_transkredit])}}" class="btn btn-md btn-normal">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-check"
                viewBox="0 0 16 16">
                <path
                    d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207l-5 5V13.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 1 0 1h-4A1.5 1.5 0 0 1 2 13.5V8.207l-.646.647a.5.5 0 1 1-.708-.708L7.293 1.5Z" />
                <path
                    d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm1.679-4.493-1.335 2.226a.75.75 0 0 1-1.174.144l-.774-.773a.5.5 0 0 1 .708-.707l.547.547 1.17-1.951a.5.5 0 1 1 .858.514Z" />
            </svg>
        </a>
        {{-- @php(dd($lembaga[0]->Value)) --}}
        <div class="container" style="margin-left: 150px;font-size:12pt">
            <div class="row" style="padding: 0px;margin-bottom: -8px;">
                @php(date_default_timezone_set('Asia/Jakarta'))
                {{$request->tgl_trans}}
                {{date('H:i:s')}}
                {{Auth::user()->username}}
                {{$request->kuitansi}}
            </div>
            <div class="row" style="padding: 0px;margin-bottom: -8px;">
                Setoran OB dari tab : 
                {{$request->no_rekening}}
                {{$request->nama_nasabah}}
            </div>
            <div class="row" style="padding: 0px;margin-bottom: -8px;">
                pokok :
                {{$request->pokok_pembayaran}}
                bng : 
                {{$request->bunga_pembayaran}}
                denda : 
                {{$request->denda_pembayaran}}
            </div>
            <div class="row" style="padding: 0px;margin-bottom: -8px;">
                @php($pokok=(int)preg_replace("/[^0-9]/", "", $request->pokok_pembayaran))
                @php($bunga=(int)preg_replace("/[^0-9]/", "", $request->bunga_pembayaran))
                @php($denda=(int)preg_replace("/[^0-9]/", "", $request->denda_pembayaran))
                @php($sldak=(int)preg_replace("/[^0-9]/", "", $request->baki_debet_pokok))
                @php($total=$pokok+$bunga+$denda)
                Total : {{number_format($total,2,",",".")}} 
                Saldo : {{number_format(($sldak-$total),2,",",".")}}
            </div>
        </div>
</body>

</html>