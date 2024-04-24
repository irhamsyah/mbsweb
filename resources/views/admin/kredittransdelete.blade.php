@extends('layouts.admin_main')

@section('content')

@if($msgstatus!=''){
@if($msgstatus=='1'){
@php $statusmsg='success'; $titlemsg='Successfully'; $msgview='Proses Berhasil' @endphp;
}
@else{
@php $statusmsg='error'; $titlemsg='Error!'; $msgview='Proses Gagal!' @endphp;
}
@endif

<script>
  Swal.fire(
    '{{ $titlemsg }}',
    '{{ $msgview }}',
    '{{ $statusmsg }}'
  )
</script>

}
@endif

<style>
.labeljudulright {
    height: 50%;
    display: flex;
    justify-content: right;
    align-items: right;
    font-size: small;
    margin-top: 10px;
}
.labeljudulleft {
    height: 50%;
    display: flex;
    justify-content: left;
    align-items: left;
    font-size: small;
    margin-top: 10px;
}
</style>
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px; max-height:800px !important;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <h2>Hapus Transaksi Kredit</h2>
        <div class="card card-warning card-outline">        
          <!-- form start -->
          <form method="POST" action="/bo_kr_de_kredittransdelete" role="search">
            @csrf
            <div class="card-body">
              <div class="row form-group">
                <div class="col-lg-1 col-sm-12">
                  <label for="tanggaltransaksi"  class="labeljudulright">Tanggal</label>
                </div>
                <div class="col-lg-2 col-sm-12">
                  <input readonly type="text" class="form-control" value='{{ $tanggaltransaksi }}' name="tanggaltransaksi" placeholder="Tanggal Transaksi">
                </div>
                <!-- <div class="col-3">
                  <button type="submit" class="btn btn-warning"><i class="fa fa-search" style="color:white"></i></button>
                </div> -->
                <div class="col-3"></div>
              </div>                            
            </div>
            <!-- /.card-body -->
          </form>
        </div>
        <div class="card">
          <div class="card-header">
            <div class="col-lg-3 col-sm-3" style="float:right;">
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-add-kredit" style="float: right;">
                <i class="fa fa-plus"></i>
              </button>
            </div>
            <h3 class="card-title">Data Transaksi Kredit yang tercatat</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id='kreditTable' width='100%' class="table table-bordered table-hover">
              <thead>
                <tr>
                  <td>ID</td>
                  <td>Tgl Transaksi</td>
                  <td>No Rekening</td>
                  <td>Nama Nasabah</td>
                  <td>Type</td>
                  <td>Pokok</td>
                  <td>Bunga</td>
                  <td>Denda</td>
                  <!-- <td>Amortisasi Provisi</td> -->
                  <td>MyKodeTrans</td>
                  <td>Kuitansi</td>
                  <!-- <td>Validasi</td>
                  <td>User</td> -->
                  <td>Action</td>
                </tr>
              </thead>
            </table>

            <!-- Script -->
            <script type="text/javascript">
            $(document).ready(function(){

              // DataTable
              $('#kreditTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{route('GetKreditTransaction')}}",
                columns: [                    
                    { data: 'KRETRANS_ID' },
                    { data: 'TGL_TRANS' },                   
                    { data: 'NO_REKENING' },
                    { data: 'nama_nasabah' }, 
                    { data: 'DESKRIPSI_MY_KODE_TRANS' },
                    { data: 'POKOK_TRANS' },
                    { data: 'BUNGA_TRANS' },
                    { data: 'DENDA_TRANS' },
                    { data: 'MY_KODE_TRANS' },
                    { data: 'KUITANSI' },
                    { title: "Action", 
                      "render": function(data, type, row, meta) {
                        console.log( 'in render function' );
                        return '<a class="dropdown-toggle btn btn-block bg-gradient-primary btn-sm" data-toggle="dropdown" href="#">' +
                                'Action <span class="caret"></span>' +
                                '</a>' +
                                '<div class="dropdown-menu">' +
                                  '<form  onsubmit="return confirm(\'Yakin hapus transaksi kredit '+row['KRETRANS_ID']+' ?\');" method="post" action="/bo_kr_de_kredittransdelete">' +
                                    '@csrf' +
                                    '<input type="hidden" name="kretransid" value="'+row['KRETRANS_ID']+'" class="form-control">' +                                    
                                    '<button type="submit" tabindex="-1" class="dropdown-item">' +
                                    ' Delete Transaksi' +
                                    '</button>' +
                                  '</form>' +
                                '</div>';
                      }
                    },
                ]
              });

            });
            </script>
            
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>

  

</div>
<!-- /.content -->

@endsection