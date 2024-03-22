<table id="tbl1" class="table table-responsive" style="border-style:none">
    <thead>
    <tr>
        <th>No Rek </th>
        <th>D/K</th>
        <th>Nama Perkiraan</th>
        <th>KAS_DEBET</th>
        <th>KAS_KREDIT</th>
        <th>NOKAS_DEBET</th>
        <th>NONKAS_KREDIT</th>
        <th>TOTAL_KAS_NON KAS_DEBET</th>
        <th>TOTAL_KAS_NON KAS_KREDIT</th>
    </tr>
    </thead>
    <tbody>
    @php($totkasdebet=0)
    @php($totkaskredit=0)
    @php($totnonkasdebet=0)
    @php($totnonkaskredit=0)
    @php($totkasnondebet=0)
    @php($totkasnonkredit=0)

    @foreach($result as $values)
    <tr>
        <td>{{$values->kode_perk}}</td>
        <td>{{$values->dk}}</td>
        <td>{{$values->nama_perk}}</td>
        <td>{{$values->KAS_DEBET}}</td>
        <td>{{$values->KAS_KREDIT}}</td>
        <td>{{$values->NONKAS_DEBET}}</td>
        <td>{{$values->NONKAS_KREDIT}}</td>
        <td>{{($values->KAS_DEBET+$values->NONKAS_DEBET)}}</td>
        <td>{{($values->KAS_KREDIT+$values->NONKAS_KREDIT)}}</td>
    </tr>
    @endforeach
    </tbody>
</table>
