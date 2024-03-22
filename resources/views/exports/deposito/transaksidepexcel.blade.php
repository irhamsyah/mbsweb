<table>
    <thead>
    <tr>
        <th>no_rekening</th>
        <th>nama_nasabah</th>
        <th>jml_deposito</th>
        <th>suku_bunga</th>
        <th>tgl_trans</th>
        <th>kode_trans</th>
        <th>terima_pokok</th>
        <th>ambil_bunga</th>
        <th>ambil_titipan</th>
        <th>ambil_pajak</th>
        <th>ambil_pokok</th>
        <th>kuitansi</th>
        <th>no_teller</th>
        <th>userid</th>
        <th>my_kode_trans</th>
        <th>kode_group1</th>
        <th>Kode_group2</th>
        <th>kode_group3</th>
        <th>tob</th>
        <th>no_rek_ob</th>
        <th>keterangan</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->no_rekening }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->jml_deposito }}</td>
            <td>{{ $key->suku_bunga }}</td>
            <td>{{ $key->TGL_TRANS }}</td>
            <td>{{ $key->kode_trans }}</td>
            <td>{{ $key->terima_pokok }}</td>
            <td>{{ $key->ambil_bunga }}</td>
            <td>{{ $key->ambil_titipan}}</td>
            <td>{{ $key->ambil_pajak}}</td>
            <td>{{ $key->ambil_pokok }}</td>
            <td>{{ $key->kuitansi }}</td>
            <td>{{ $key->no_teller }}</td>
            <td>{{ $key->userid }}</td>
            <td>{{ $key->my_kode_trans}}</td>
            <td>{{ $key->KODE_GROUP1 }}</td>
            <td>{{ $key->KODE_GROUP2}}</td>
            <td>{{ $key->KODE_GROUP3 }}</td>
            <td>{{ $key->tob}}</td>
            <td>{{ $key->no_rek_ob }}</td>
            @if(is_null($key->no_rek_ob)==false)
            <td colspan="3">{{'OB ke Tab :'.$key->no_rek_ob}}</td>
        @elseif(($key->MASUK_TITIPAN==1||$key->MASUK_TITIPAN==0)&&($key->BUNGA_BERBUNGA==1))
            <td colspan="3">{{'OB ke Pokok'}}</td>
        @elseif(($key->MASUK_TITIPAN==1)&&($key->BUNGA_BERBUNGA==0))
            <td colspan="3">{{'OB ke Titpan'}}</td>
        @endif

        </tr>
    @endforeach
    </tbody>
</table>