<table id="tbl1" class="table table-responsive" style="border-style:none">
    <thead>
        <tr>
            <th>modul</th>
            <th>tgl_trans </th>
            <th>no_bukti</th>
            <th>uraian</th>
            <th>tob</th>
            <th>ob_debet</th>
            <th>ob_kredit</th>
            <th>kas_debet</th>
            <th>kas_kredit</th>
            <th>userid</th>
            <th>kode_jurnal</th>
            <th>trans_id</th>
        </tr>
    </thead>
    <tbody>
        @foreach($array as $values)
        <tr>
            <td>{{$values->modul}}</td>
            <td>{{$values->tgl_trans}}</td>
            <td>{{$values->NO_BUKTI}}</td>
            <td>{{$values->uraian}}</td>
            <td>{{$values->tob}}</td>
            @if($values->my_kode_trans=='200' && $values->tob=='O')
            <td>{{$values->saldo_trans}}</td>
            @else
            <td>0</td>
            @endif
            @if($values->my_kode_trans=='300' && $values->tob=='O')
            <td>{{$values->saldo_trans}}</td>
            @else
            <td>0</td>
            @endif
            @if($values->my_kode_trans=='200' && $values->tob=='T')
            <td>{{$values->saldo_trans}}</td>
            @else
            <td>0</td>
            @endif
            @if($values->my_kode_trans=='300' && $values->tob=='T')
            <td>{{$values->saldo_trans}}</td>
            @else
            <td>0</td>
            @endif
            <td>{{$values->userid}}</td>
            <td>{{$values->kode_jurnal}}</td>
            <td>{{$values->trans_id}}</td>
        </tr>
        @endforeach
    </tbody>

</table>