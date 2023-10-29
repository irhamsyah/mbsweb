<table>
    <thead>
    <tr>
        <th>kode_perk</th>
        <th>kode_alt</th>
        <th>nama_perk</th>
        <th>kode_induk</th>
        <th>level</th>
        <th>type</th>
        <th>dk</th>
        <th>saldo_awal</th>
        <th>saldo_debet</th>
        <th>saldo_kredit</th>
        <th>saldo_akhir</th>
        <th>saldo_tahun_lalu</th>
        <th>mut_awal</th>
        <th>mut_debet</th>
        <th>mut_kredit</th>
        <th>mut_akhir</th>
        <th>bi_sandi_bank</th>
        <th>bi_jenis</th>
        <th>bi_jkw_thn</th>
        <th>bi_jkw_bln</th>
        <th>bi_jkw_hari</th>
        <th>bi_kolek</th>
        <th>bi_suku_bunga</th>
        <th>RENCANA</th>
        <th>SYNC</th>
        <th>KODE_LAMA</th>
        <th>CAB</th>
        <th>Kons_Perk</th>
        <th>KonsCab</th>
        <th>BI_TERKAIT</th>
        <th>BI_PPAP</th>
        <th>BI_PROSEN_PPAP</th>
        <th>SANDI_SUMBER_DANA</th>
        <th>BI_BULAN_MULAI</th>
        <th>BI_TAHUN_MULAI</th>
        <th>BI_BULAN_JT</th>
        <th>BI_TAHUN_JT</th>
        <th>BI_HUBUNGAN</th>
        <th>bi_jenis_bank</th>
        <th>bi_lokasi_bank</th>
        <th>bi_jt_thn</th>
        <th>bi_jt_bln</th>
        <th>bi_jenis_pinjaman</th>
        <th>bi_gol_kreditur</th>
        <th>bi_periode_bayar</th>
        <th>bi_cara_hitung</th>
        <th>bi_plafond</th>
        <th>bi_mulai_tgl</th>
        <th>bi_mulai_bln</th>
        <th>bi_mulai_thn</th>
        <th>bi_jt_tgl</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listperk as $key)
        <tr>
            <td>{{ $key->kode_perk }}</td>
            <td>{{ $key->kode_alt }}</td>
            <td>{{ $key->nama_perk }}</td>
            <td>{{ $key->kode_induk }}</td>
            <td>{{ $key->level }}</td>
            <td>{{ $key->type }}</td>
            <td>{{ $key->dk }}</td>
            <td>{{ $key->saldo_awal }}</td>
            <td>{{ $key->saldo_debet }}</td>
            <td>{{ $key->saldo_kredit }}</td>
            <td>{{ $key->saldo_akhir }}</td>
            <td>{{ $key->saldo_tahun_lalu }}</td>
            <td>{{ $key->mut_awal }}</td>
            <td>{{ $key->mut_debet }}</td>
            <td>{{ $key->mut_kredit }}</td>
            <td>{{ $key->mut_akhir }}</td>
            <td>{{ $key->bi_sandi_bank }}</td>
            <td>{{ $key->bi_jenis }}</td>
            <td>{{ $key->bi_jkw_thn }}</td>
            <td>{{ $key->bi_jkw_bln }}</td>
            <td>{{ $key->bi_jkw_hari }}</td>
            <td>{{ $key->bi_kolek }}</td>
            <td>{{ $key->bi_suku_bunga }}</td>
            <td>{{ $key->RENCANA }}</td>
            <td>{{ $key->SYNC }}</td>
            <td>{{ $key->KODE_LAMA }}</td>
            <td>{{ $key->CAB }}</td>
            <td>{{ $key->Kons_Perk }}</td>
            <td>{{ $key->KonsCab }}</td>
            <td>{{ $key->BI_TERKAIT }}</td>
            <td>{{ $key->BI_PPAP }}</td>
            <td>{{ $key->BI_PROSEN_PPAP }}</td>
            <td>{{ $key->SANDI_SUMBER_DANA }}</td>
            <td>{{ $key->BI_BULAN_MULAI }}</td>
            <td>{{ $key->BI_TAHUN_MULAI }}</td>
            <td>{{ $key->BI_BULAN_JT }}</td>
            <td>{{ $key->BI_TAHUN_JT }}</td>
            <td>{{ $key->BI_HUBUNGAN }}</td>
            <td>{{ $key->bi_jenis_bank }}</td>
            <td>{{ $key->bi_lokasi_bank }}</td>
            <td>{{ $key->bi_jt_thn }}</td>
            <td>{{ $key->bi_jt_bln }}</td>
            <td>{{ $key->bi_jenis_pinjaman }}</td>
            <td>{{ $key->bi_gol_kreditur }}</td>
            <td>{{ $key->bi_periode_bayar }}</td>
            <td>{{ $key->bi_cara_hitung }}</td>
            <td>{{ $key->bi_plafond }}</td>
            <td>{{ $key->bi_mulai_tgl }}</td>
            <td>{{ $key->bi_mulai_bln }}</td>
            <td>{{ $key->bi_mulai_thn }}</td>
            <td>{{ $key->bi_jt_tgl }}</td>
        </tr>
    @endforeach
    </tbody>
</table>