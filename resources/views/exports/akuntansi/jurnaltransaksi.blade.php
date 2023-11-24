<table>
    <thead>
    <tr>
        <th>trans_id</th>
        <th>tgl_trans</th>
        <th>kode_jurnal</th>
        <th>no_bukti</th>
        <th>src</th>
        <th>kode_alt</th>
        <th>nama_perk</th>
        <th>uraian</th>
        <th>debet</th>
        <th>kredit</th>
    </tr>
    </thead>
    <tbody>
    @foreach($listperk as $values)
        <tr>
            <td>{{ $values->trans_id }}</td>
            <td>{{ $values->tgl_trans }}</td>
            <td>{{ $values->kode_jurnal }}</td>
            <td>{{ $values->no_bukti }}</td>
            <td>{{ $values->src }}</td>
            <td>{{ $values->kode_alt }}</td>
            <td>{{ $values->nama_perk }}</td>
            <td>{{ $values->URAIAN }}</td>
            <td>{{ $values->debet }}</td>
            <td>{{ $values->kredit }}</td>
        </tr>
    @endforeach
    </tbody>
</table>