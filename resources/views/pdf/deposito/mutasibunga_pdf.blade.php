<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Transaksi</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <style>
        #tbl1,thead,th,td {
            table-layout: auto;
            font-size: 9pt;
            font-family: 'Times New Roman', Times, serif;
            padding: 2px;
            margin-left: 0px;
            border: 1px solid;
            text-align: left;
            border-collapse: collapse;
        }
        br{
              content: "";
              margin: 0.5em;
              display: block;
              font-size: 24%;
        }
        p{
            padding: 0px;
            margin-top: 0px;
            text-align: left
        }
    </style>
</head>
<body> 
    @foreach($lembaga as $values)
    <br>{{$values->Value}}<br>
    @endforeach
    <p>Daftar Riwayat Bunga Deposito </p>
    <table>
        <tr>
            <td style="border-style: none">Nama : </td>
            <td style="border-style: none">{{$profnas[0]->nama_nasabah}}</td>
            <td style="border-style: none">TglRegistrasi : </td>
            <td style="border-style: none">{{date('d',strtotime($profnas[0]->TGL_REGISTRASI))."/".date('m',strtotime($profnas[0]->TGL_REGISTRASI))."/".date('Y',strtotime($profnas[0]->TGL_REGISTRASI))}}</td>
        </tr>
        <tr>
            <td style="border-style: none">No.Rekening : </td>
            <td style="border-style: none">{{$profnas[0]->NO_REKENING}}</td>
            <td style="border-style: none">Jangka Waktu : </td>
            <td style="border-style: none">{{$profnas[0]->JKW}}</td>
        </tr>
        <tr>
            <td style="border-style: none">Jumlah Deposito : </td>
            <td style="border-style: none">{{number_format($profnas[0]->NOMINAL,2,",",".")}}</td>
            <td style="border-style: none">Tgl Jatuh Tempo : </td>
            <td style="border-style: none">{{date('d',strtotime($profnas[0]->TGL_JT))."/".date('m',strtotime($profnas[0]->TGL_JT))."/".date('Y',strtotime($profnas[0]->TGL_JT))}}</td>
        </tr>

    </table>
    <table id="tbl1" class="table table-bordered" >
        <thead>
            <tr>
                <th>No</th>
                <th>Tgl Transaksi</th>
                <th colspan="4">Keterangan</th>
                <th colspan="4">Setoran</th>
                <th colspan="4">Ambil</th>
                <th colspan="4">Saldo</th>
            </tr>
        </thead>
        <tbody>
            @php($totsaldo=0)
        @foreach($transaksi as $index => $values)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$values->TGL_TRANS}}</td>
            @if(is_null($values->no_rek_ob)==false)
                <td colspan="4">{{'OB Bunga ke tab : '.$values->no_rek_ob}}</td>
            @elseif($values->MASUK_TITIPAN == 1 AND $values->BUNGA_BERBUNGA == 1)
                <td colspan="4">{{'OB Bunga ke titipan : '.$values->no_rek_ob}}</td>
            @elseif($values->MASUK_TITIPAN == 1 AND $values->BUNGA_BERBUNGA == 0)
                <td colspan="4">{{'OB Bunga ke titipan : '.$values->no_rek_ob}}</td>
            @endif
                <td colspan="4">{{number_format($values->setor,2,".",",")}}</td>
                <td colspan="4">{{number_format($values->ambil,2,".",",")}}</td>
                @php($totsaldo=$totsaldo+$values->setor-$values->ambil)
                <td colspan="4">{{number_format($totsaldo,2,".",",")}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row" style="margin-left:750px;margin-top:10px;font-size:9pt">{{$kota[0]->Value.','.date('d F Y')}}</div>
    <table style="margin-left:100px">
        <tr>
            <td style="width: 150px;padding-left:15px;border-style:none">
                Mengetahui
            </td>
            <td style="width: 150px;padding-left:10px;border-style:none">
                Menyetujui
            </td>
            <td style="width: 150px;padding-left:25px;border-style:none">
                Dibuat
            </td>
        </tr>
        <tr>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 150px;border-style:none">
                &nbsp;
            </td>
        </tr>
        <tr>
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_DEP_L_NAMA')
                <td style="width: 150px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @elseif($ttd1->KeyName=='TTD_DEP_C_NAMA')
                <td style="width: 150px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @elseif($ttd1->KeyName=='TTD_DEP_R_NAMA')
                <td style="width: 150px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @endif
            @endforeach
        </tr>
        <tr>
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_DEP_L_NIP')
                <td style="width: 150px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @elseif($ttd1->KeyName=='TTD_DEP_C_NIP')
                <td style="width: 150px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @elseif($ttd1->KeyName=='TTD_DEP_R_NIP')
                <td style="width: 150px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @endif
            @endforeach
        </tr>
    </table>

</body>
</html>