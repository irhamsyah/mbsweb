<table>
    <thead>
    <tr>
        <th>no_rekening</th>
        <th>nama_nasabah</th>
        <th>nasabah_id</th>
        <th>bunga_bln_ini</th>
        <th>pajak_bln_ini</th>
        <th>titipan_awal</th>
        <th>titipan_tambah</th>
        <th>titipan_ambil</th>
        <th>titipan_akhir</th>
        <th>suku_bunga</th>
        <th>persen_pph</th>
        <th>saldo_awal</th>
        <th>saldo_setoran</th>
        <th>saldo_penarikan</th>
        <th>saldo_akhir</th>
        <th>no_rek_tabungan</th>
        <th>tgl_bayar</th>
        <th>tgl_registrasi</th>
        <th>jkw</th>
        <th>tgl_jt</th>
        <th>no_bilyet</th>
        <th>qq</th>
        <th>kode_bi_pemilik</th>
        <th>kode_bi_hubungan</th>
        <th>kode_bi_metoda</th>
        <th>jenis_deposito</th>
        <th>jml_deposito</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->NO_REKENING }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->NASABAH_ID }}</td>
            <td>{{ $key->BUNGA_BLN_INI }}</td>
            <td>{{ $key->PAJAK_BLN_INI }}</td>
            <td>{{ $key->TITIPAN_AWAL }}</td>
            <td>{{ $key->TITIPAN_TAMBAH }}</td>
            <td>{{ $key->TITIPAN_AMBIL }}</td>
            <td>{{ $key->TITIPAN_AKHIR }}</td>
            <td>{{ $key->SUKU_BUNGA }}</td>
            <td>{{ $key->PERSEN_PPH }}</td>
            <td>{{ $key->SALDO_AWAL }}</td>
            <td>{{ $key->SALDO_SETORAN }}</td>
            <td>{{ $key->SALDO_PENARIKAN }}</td>
            <td>{{ $key->SALDO_AKHIR }}</td>
            <td>{{ $key->NO_REK_TABUNGAN }}</td>
            <td>{{ $key->TGL_VALUTA }}</td>
            <td>{{ $key->TGL_REGISTRASI }}</td>
            <td>{{ $key->JKW }}</td>
            <td>{{ $key->TGL_JT }}</td>
            <td>{{ $key->NO_ALTERNATIF }}</td>
            <td>{{ $key->QQ }}</td>
            <td>{{ $key->KODE_BI_PEMILIK }}</td>
            <td>{{ $key->KODE_BI_HUBUNGAN }}</td>
            <td>{{ $key->KODE_BI_METODA }}</td>
            <td>{{ $key->JENIS_DEPOSITO }}</td>
            <td>{{ $key->JML_DEPOSITO }}</td>
        </tr>
    @endforeach
    </tbody>
</table>