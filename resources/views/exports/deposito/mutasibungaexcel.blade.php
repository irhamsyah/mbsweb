<table>
    <thead>
    <tr>
        <th>tgl_trans</th>
        <th>my_kode_trans</th>
        <th>keterangan</th>
        <th>titipan_awal</th>
        <th>saldo_trans</th>
        <th>setor</th>
        <th>ambil</th>
        <th>saldo_bunga</th>
        <th>kuitansi</th>
        <th>no_rek_ob</th>
    </tr>
    </thead>
    <tbody>
        @php($saldotot=0)
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->TGL_TRANS }}</td>
            <td>{{ $key->my_kode_trans }}</td>
            {{-- KETERANGAN --}}
        @if(is_null($key->no_rek_ob)==false)
            @if($key->my_kode_trans==250||$key->my_kode_trans==200)
            <td>{{'OB ke Tab :'.$key->no_rek_ob}}</td>
            @elseif($key->my_kode_trans==450||$key->my_kode_trans==400)
            <td>{{'Pajak Bunga-'.$key->KUITANSI}}</td>
            @endif
        @elseif(($key->MASUK_TITIPAN==1 OR $key->MASUK_TITIPAN==0) AND ($key->BUNGA_BERBUNGA==1))
            <td>{{'OB ke Pokok'}}</td>
        @elseif(($key->MASUK_TITIPAN==1)&&($key->BUNGA_BERBUNGA==0))
            <td>{{'OB ke Titpan'}}</td>
        @endif
            <td>{{ $key->TITIPAN_AWAL }}</td>
            <td>{{ $key->SALDO_TRANS }}</td>
            <td>{{ $key->setor }}</td>
            <td>{{ $key->ambil }}</td>
            <td>{{ $saldotot}}</td>
            <td>{{ $key->KUITANSI}}</td>
            <td>{{ $key->no_rek_ob }}</td>

        </tr>
    @endforeach
    </tbody>
</table>