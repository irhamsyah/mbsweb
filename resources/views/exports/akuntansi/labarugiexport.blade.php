<table id="tbl1" class="table table-responsive" style="border-style:none">
    <thead>
    <tr>
        <th>kode_perk</th>
        <th>kode_alt</th>
        <th>nama_perk</th>
        <th>kode_induk</th>
        <th>mut_awal</th>
        <th>mut_akhir</th>
        <th>level</th>
        <th>type</th>
    </tr>
    </thead>
    <tbody>
        @foreach($result as $values)
        <tr>
            <td>{{strval($values->kode_perk)}}</td>
            <td>{{strval($values->kode_alt)}}</td>
            <td>{{$values->nama_perk}}</td>
            <td>{{strval($values->kode_induk)}}</td>
            <td>{{$values->saldo_awal}}</td>
            <td>{{$values->saldo_akhir}}</td>
            <td>{{$values->level}}</td>
            <td>{{$values->type}}</td>
        </tr>
        @endforeach
    </tbody>

</table>
