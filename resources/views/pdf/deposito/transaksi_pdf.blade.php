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
            text-align: center
        }
    </style>
</head>
<body> 
    @foreach($lembaga as $values)
    <br>{{$values->Value}}<br>
    @endforeach
    <p>Transaksi Deposito : {{date('d-m-Y',strtotime($tgltrs1))}} s/d {{date('d-m-Y',strtotime($tgltrs2))}}</p>
    <table id="tbl1" class="table table-bordered" >
        <thead>
            <tr>
                <th rowspan="2">No</th>
                <th rowspan="2">No Rek</th>
                <th rowspan="2">Nama Nasabah</th>
                <th rowspan="2">Tgl Trans</th>
                <th rowspan="2">Kuitansi</th>
                <th rowspan="2">Setoran Deposito</th>
                <th colspan="5">Pengambilan</th>
                <th rowspan="2" colspan="3">Keterangan</th>
                <th rowspan="2">TOB</th>
            </tr>
            <tr>
                <th>Bunga</th>
                <th>Pajak</th>
                <th>Netto</th>
                <th>Titipan</th>
                <th>Pokok</th>
            </tr>
        </thead>
        <tbody>
            @php($totjmltrmpokok=0)
            @php($totjmlbunga=0)
            @php($totjmlpajak=0)
            @php($totnetto=0)
            @php($totjmlambpokok=0)
            @php($totjmlambtitipan=0)

        @foreach($transaksi as $index => $values)
            <tr>
                <td>{{++$index}}</td>
                <td>{{$values->no_rekening}}</td>
                <td>{{$values->nama_nasabah}}</td>
                <td>{{$values->TGL_TRANS}}</td>
                <td>{{$values->kuitansi}}</td>
                <td>{{number_format($values->terima_pokok,2,".",",")}}</td>
                <td>{{number_format($values->ambil_bunga,2,".",",")}}</td>
                <td>{{number_format($values->ambil_pajak,2,".",",")}}</td>
                <td>{{number_format(($values->ambil_bunga-$values->ambil_pajak),2,'.',',')}}</td>
                <td>{{number_format($values->ambil_titipan,2,'.',',')}}</td>
                <td>{{number_format($values->ambil_pokok,2,'.',',')}}</td>
                @if(is_null($values->no_rek_ob)==false)
                    <td colspan="3">{{'OB ke Tab :'.$values->no_rek_ob}}</td>
                @elseif(($values->MASUK_TITIPAN==1||$values->MASUK_TITIPAN==0)&&($values->BUNGA_BERBUNGA==1))
                    <td colspan="3">{{'OB ke Pokok'}}</td>
                @elseif(($values->MASUK_TITIPAN==1)&&($values->BUNGA_BERBUNGA==0))
                    <td colspan="3">{{'OB ke Titpan'}}</td>
                @endif
                <td style="text-align: center">{{$values->tob}}</td>
            </tr>
            @php($totjmltrmpokok=$totjmltrmpokok+$values->terima_pokok)
            @php($totjmlbunga=$totjmlbunga+$values->ambil_bunga)
            @php($totjmlpajak=$totjmlpajak+$values->ambil_pajak)
            @php($totnetto=$totnetto+($values->ambil_bunga-$values->ambil_pajak))
            @php($totjmlambtitipan=$totjmlambtitipan+$values->ambil_titipan)
            @php($totjmlambpokok=$totjmlambpokok+$values->ambil_pokok)
        @endforeach
            <tr id="y" style="border: 1px solid">
                <td colspan="5"></td>
                <td>{{number_format($totjmltrmpokok,2,".",",")}}</td>
                <td>{{number_format($totjmlbunga,2,".",",")}}</td>
                <td>{{number_format($totjmlpajak,2,".",",")}}</td>
                <td>{{number_format($totnetto,2,".",",")}}</td>
                <td>{{number_format($totjmlambtitipan,2,".",",")}}</td>
                <td>{{number_format($totjmlambpokok,2,".",",")}}</td>
                <td colspan="4"></td>
            </tr>
        </tbody>
    </table>
    <div class="row" style="margin-left:750px;margin-top:10px;font-size:9pt">{{$kota[0]->Value.','.date('d F Y')}}</div>
    <table style="margin-left:100px">
        <tr>
            <td style="width: 330px;padding-left:15px;border-style:none">
                Mengetahui
            </td>
            <td style="width: 330px;padding-left:10px;border-style:none">
                Menyetujui
            </td>
            <td style="width: 330px;padding-left:25px;border-style:none">
                Dibuat
            </td>
        </tr>
        <tr>
            <td style="width: 330px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 330px;border-style:none">
                &nbsp;
            </td>
            <td style="width: 3300px;border-style:none">
                &nbsp;
            </td>
        </tr>
        <tr>
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_DEP_L_NAMA')
                <td style="width: 330px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @elseif($ttd1->KeyName=='TTD_DEP_C_NAMA')
                <td style="width: 330px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @elseif($ttd1->KeyName=='TTD_DEP_R_NAMA')
                <td style="width: 330px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @endif
            @endforeach
        </tr>
        <tr>
            @foreach($ttd as $ttd1)
            @if($ttd1->KeyName=='TTD_DEP_L_NIP')
                <td style="width: 330px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @elseif($ttd1->KeyName=='TTD_DEP_C_NIP')
                <td style="width: 330px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @elseif($ttd1->KeyName=='TTD_DEP_R_NIP')
                <td style="width: 330px;border-style:none">
                    {{$ttd1->Value}}
                </td>
            @endif
            @endforeach
        </tr>
    </table>

</body>
</html>