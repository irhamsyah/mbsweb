<table>
    <thead>
    <tr>
        <th>no_rekening</th>
        <th>nama_nasabah</th>
        <th>jenis_tabungan</th>
        <th>bunga_bln_ini</th>
        <th>adm_bln_ini</th>
        <th>pajak_bln_ini</th>
        <th>saldo_efektif_bln_ini</th>
        <th>saldo_hitung_pajak</th>
        <th>saldo_nominatif</th>
        <th>saldo_akhir</th>
    </tr>
    </thead>
    <tbody>
    @foreach($nomin as $key)
        <tr>
            <td>{{ $key->no_rekening }}</td>
            <td>{{ $key->nama_nasabah }}</td>
            <td>{{ $key->jenis_tabungan }}</td>
            <td>{{ $key->bunga_bln_ini }}</td>
            <td>{{ $key->adm_bln_ini }}</td>
            <td>{{ $key->pajak_bln_ini }}</td>
            <td>{{ $key->saldo_efektif_bln_ini }}</td>
            <td>{{ $key->saldo_hitung_pajak }}</td>
            <td>{{ $key->saldo_nominatif }}</td>
            <td>{{ $key->saldo_akhir }}</td>
        </tr>
    @endforeach
    </tbody>
</table>