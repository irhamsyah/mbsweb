<table>
    <thead>
        <tr>
            <th>no_rekening</th>
            <th>nama_nasabah</th>
            <th>bunga_bln_ini</th>
            <th>pajak_bln_ini</th>
            <th>titipan_akhir</th>
            <th>jml_deposito</th>
            <th>tgl_valuta</th>
            <th>no_rek_tabungan</th>
            <th>tgl_bayar</th>
            <th>tgl_registrasi</th>
            <th>tgl_jt</th>
            <th>jkw</th>
            <th>suku_bunga</th>
            <th>nasabah_id</th>
            <th>kode_group1</th>
            <th>kode_bi_pemilik</th>
            <th>alamat</th>
            <th>ob</th>
            <th>status_bunga</th>
            <th>masuk_titipan</th>
            <th>keterangan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($transaksi as $key)
        <tr>
            <td>{{ $key->NO_REKENING}}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->BUNGA_BLN_INI }}</td>
            <td>{{ $key->PAJAK_BLN_INI }}</td>
            <td>{{ $key->saldo_titipan }}</td>
            <td>{{ $key->nominal }}</td>
            <td>{{ $key->TGL_VALUTA }}</td>
            <td>{{ $key->NO_REK_TABUNGAN }}</td>
            <td>{{ date('Y-m-d',
                strtotime(date('Y',strtotime($tgltrs1))."-".date('m',strtotime($tgltrs1))."-".$key->TGL_VALUTA)) }}
            </td>
            <td>{{ $key->TGL_REGISTRASI }}</td>
            <td>{{ $key->TGL_JT }}</td>
            <td>{{ $key->JKW }}</td>
            <td>{{ $key->SUKU_BUNGA }}</td>
            <td>{{ $key->NASABAH_ID }}</td>
            <td>{{ $key->KODE_GROUP1 }}</td>
            <td>{{ $key->KODE_BI_PEMILIK }}</td>
            <td>{{ $key->alamat }}</td>
            <td>{{'C'}}</td>
            <td>{{''}}</td>
            <td>{{ $key->MASUK_TITIPAN }}</td>
            <td>{{'' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>