<html>
<head>
  @php $actualLinktag = str_replace('/', '', "$_SERVER[REQUEST_URI]"); @endphp
  @if ($actualLinktag!='home') 
    @php 
      $pecahLink = explode('_', $actualLinktag);
      $mainmenu=$pecahLink[0];
      $menu=$pecahLink[1];
      $submenu=$pecahLink[2];
      $page=$pecahLink[3];
    @endphp
  @else 
    @php 
      $mainmenu='home';
      $menu='home';
      $submenu='home';
      $page='home';
    @endphp
  @endif

  @foreach($logos as $logo)
    @php ($logo=$logo->logo_name)
  @endforeach
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MBS Web</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('plugins/sweetalert2/sweetalert2.min.css') }}">
  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Logo Icon -->
  <link rel="shortcut icon" href="{{ asset('img/logo/'.$logo) }}" type="image/x-icon">
  {{-- Data Table --}}
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.3/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.3/css/jquery.dataTables.min.css">
  {{-- --------- --}}

  <!-- SweetAlert2 -->
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
  {{-- @php($nilaites) --}}
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link"></a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user-circle fa-2x"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item">
            <!-- Message Start -->
            <div class="media">
              <img src="{{ asset('dist/img/user2-160x160.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  @if(isset(Auth::user()['name']))
                  {{ Auth::user()->name }}
                  @endif
                </h3>
                <p class="text-sm">{{ 'Call me whenever you can...' }}</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> {{ '4 Hours Ago' }}</p>
              </div>
            </div>
            <!-- Message End -->
          </a>
          <div class="dropdown-divider"></div>
            <a href="/password/reset" class="dropdown-item dropdown-footer">Change Password</a>
          <div class="dropdown-divider"></div>
            <a href="{{ route('logout') }}" class="dropdown-item dropdown-footer" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();">Logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="{{ asset('img/logo/'.$logo) }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">MBS Web</span>
    </a>


    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-header">MAIN MENU BPR</li>
            <li class="nav-item has-treeview <?php if($mainmenu=='bo'){echo 'menu-open';}?>">
              <a href="#" class="nav-link <?php if($mainmenu=='bo'){echo 'active';}?>">
                <i class="right fas fa-angle-left"></i>
                <p class="pl-0">MENU BACK OFFICE</p>
              </a>
              <ul class="nav nav-treeview">
              <li class="nav-item has-treeview <?php if($menu=='cs'){echo 'menu-open';}?>">
                <a href="#" class="nav-link <?php if($menu=='cs'){echo 'active';}?>">
                  <i class="right fas fa-angle-left"></i>
                  <p class="pl-1">CUSTOMER SERVICE</p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item has-treeview <?php if($submenu=='de'){echo 'menu-open';}?>">
                  <a href="#" class="nav-link <?php if($submenu=='de'){echo 'active';}?>">
                    <i class="right fas fa-angle-left"></i>
                    <p class="pl-2">DATA ENTRY</p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/bo_cs_de_nasabah" class="nav-link <?php if($page=='nasabah' or $page=='nasabahcari'){echo 'active';}?>">
                      <p class="pl-4">Data Nasabah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/bo_cs_de_profil" class="nav-link <?php if($page=='profil' or $page=='profilcari'){echo 'active';}?>">
                      <p class="pl-4">Profil Data Nasabah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/bo_cs_de_simulasi" class="nav-link <?php if($page=='simulasi' or $page=='simulasicari'){echo 'active';}?>">
                      <p class="pl-4">Simulasi Pembiayaan</p>
                    </a>
                  </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview  <?php if($submenu=='ad'){echo 'menu-open';}?>">
                  <a href="#" class="nav-link <?php if($submenu=='ad'){echo 'active';}?>">
                    <i class="right fas fa-angle-left"></i>
                    <p class="pl-2">ADMINISTRATOR</p>
                  </a>
                  <ul class="nav nav-treeview">
                  <!-- <li class="nav-item">
                    <a href="/bo_cs_ad_konfnasabah" class="nav-link <?php if($page=='konfnasabah'){echo 'active';}?>">
                      <p class="pl-4">Konfigurasi Nasabah</p>
                    </a>
                  </li> -->
                  <li class="nav-item">
                    <a href="/bo_cs_ad_agama" class="nav-link <?php if($page=='agama'){echo 'active';}?>">
                      <p class="pl-4">Data Agama</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/bo_cs_ad_golongan" class="nav-link <?php if($page=='golongan'){echo 'active';}?>">
                      <p class="pl-4">Data Golongan</p>
                    </a>
                  </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview menu-close">
                  <a href="#" class="nav-link">
                    <i class="right fas fa-angle-left"></i>
                    <p class="pl-2">PENCETAKAN LAPORAN</p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/bo_cs_rp_nasabah" class="nav-link">
                      <p class="pl-4">Dokumen Nasabah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/bo_cs_rp_tabungan" class="nav-link">
                      <p class="pl-4">Dokumen Tabungan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/bo_cs_rp_deposito" class="nav-link">
                      <p class="pl-4">Dokumen Deposito</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/bo_cs_rp_kredit" class="nav-link">
                      <p class="pl-4">Dokumen Kredit</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/bo_cs_rp_umum" class="nav-link">
                      <p class="pl-4">Dokumen Umum & Inv</p>
                    </a>
                  </li>
                  </ul>
                </li>
                </ul>
              </li>
              <li class="nav-item has-treeview menu-close">
                <a href="/adm_transaction" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p class="pl-1">TELLER</p>
                </a>
              </li>
              <li class="nav-item has-treeview menu-close <?php if($menu=='tb'){echo 'menu-open';}?>">
                <a href="#" class="nav-link <?php if($menu=='tb'){echo 'active';}?>">
                  <i class="right fas fa-angle-left"></i>
                  <p class="pl-1">TABUNGAN</p>
                </a>
                {{-- Menu Tree Tabungan --}}
                <ul class="nav nav-treeview"> 

                <li class="nav-item has-treeview <?php if($submenu=='de'){echo 'menu-open';}?>">
                  <a href="#" class="nav-link <?php if($submenu=='de'){echo 'active';}?>">
                    <i class="right fas fa-angle-left"></i>
                    <p class="pl-2">DATA ENTRY</p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/bo_tb_de_tabungan" class="nav-link <?php if($page=='tabungan' or $page=='tabungancari'){echo 'active';}?>">
                      <p class="pl-3">Rekening Tabungan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Hapus Transaksi</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Validasi Transaksi</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <p class="pl-3">Saldo Awal</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <p class="pl-3">Perhitungan Bunga</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <p class="pl-3">Browse Bunga & Pajak</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <p class="pl-3">Overbook Bunga</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <p class="pl-3">Blokir/UnBlokir Tabungan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <p class="pl-3">Konsolidasi Saldo</p>
                    </a>
                  </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview menu-close">
                  <a href="/adm_transaction" class="nav-link">
                    <i class="right fas fa-angle-left"></i>
                    <p class="pl-2">ADMINISTRATOR</p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Konfigurasi Nasabah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Data Agama</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Data Golongan</p>
                    </a>
                  </li>
                  </ul>
                </li>
                <li class="nav-item has-treeview menu-close">
                  <a href="/adm_transaction" class="nav-link">
                    <i class="right fas fa-angle-left"></i>
                    <p class="pl-2">PENCETAKAN LAPORAN</p>
                  </a>
                  <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Dokumen Nasabah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Dokumen Tabungan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Dokumen Deposito</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Dokumen Kredit</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Dokumen Umum & Inv</p>
                    </a>
                  </li>
                  </ul>
                </li>
                </ul>
                {{-- batas menu tree tabungan --}}
              </li>
              <li class="nav-item has-treeview menu-close">
                <a href="/adm_transaction" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p class="pl-1">DEPOSITO</p>
                </a>
              </li>
              <li class="nav-item has-treeview menu-close">
                <a href="/adm_transaction" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p class="pl-1">KREDIT</p>
                </a>
              </li>
              <li class="nav-item has-treeview menu-close">
                <a href="/adm_transaction" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p class="pl-1">AKUNTANSI</p>
                </a>
              </li>
              <li class="nav-item has-treeview menu-close">
                <a href="/adm_transaction" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p class="pl-1">INVENTARIS</p>
                </a>
              </li>
              <li class="nav-item has-treeview menu-close">
                <a href="/adm_transaction" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p class="pl-1">STANDING INSTRUCTION</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview menu-open">
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();">
              <i class="nav-icon fa fa-arrow-circle-left"></i>
              <p>{{ __('Logout') }}</p>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  @yield('content')

  <footer class="main-footer">
    <strong>Copyright &copy; 2023 <a href="#">MBS Web</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('plugins/jQuery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- DataTables -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Ckeditor -->
<script src="{{ asset('plugins/ckeditor/ckeditor.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<script>
  // fungsi ambil value text No_rekening disamakan ke No_alternatif
$(document).ready(function(){
		$("#norekadd").change(
    		function(){
        	document.getElementById("noaltadd").value =document.getElementById("norekadd").value;
        }
    );
});
// Fungsi untuk menampilkan Data Nasabah dari Modal yg akan diinput ke Tabungan
$(document).ready(function(){
// code to read selected table row cell data (values).
$("#nasabahdata").on('click','#tes1',function(){
     // get the current row
     var currentRow=$(this).closest("tr"); 
     
     var col1=currentRow.find("td:eq(0)").text(); // get current row 1st TD value
     var col2=currentRow.find("td:eq(1)").text(); // get current row 2nd TD
     var col3=currentRow.find("td:eq(2)").text(); // get current row 3rd TD
    //  var data=col1+"\n"+col2+"\n"+col3;
     document.getElementById("inputNasabahIdadd").value=col1;
     document.getElementById("inputNamaNasabahadd").value=col2;
     document.getElementById("inputalamatadd").value=col3;
    //  alert(data);
    document.getElementById("editidnasabah").value=col1;
     document.getElementById("editnamanasabah").value=col2;
     document.getElementById("editalamatnasabah").value=col3;

});
});
// Menampilkan data nasabah di input text nasabah_id dengan DATATABEL
$(document).ready(function () {
    $('#nasabahdata').DataTable();
});
// ------------------------------------
  $(function () {
    $("#example1").DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "responsive": true,
      "autoWidth": false,
      "lengthMenu": [ 25, 50, 100 ],
      "pageLength":50
    });
    $("#example2").DataTable({
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "autoWidth": false,
      "lengthMenu": [ 25, 50, 100 ],
      "pageLength":50
    });

    //Initialize Select2 Elements
    $('.select2').select2()

    // //Date picker
    // $('#inputDate1').datetimepicker({
    //     format: 'Y-MM-DD'
    // });
    // $('#inputDate2').datetimepicker({
    //     format: 'Y-MM-DD'
    // });
    // $('#inputDate3').datetimepicker({
    //     format: 'Y-MM-DD'
    // }); 
    // $('#inputDate4').datetimepicker({
    //     format: 'Y-MM-DD'
    // });
    // $('#inputDate5').datetimepicker({
    //     format: 'Y-MM-DD'
    // });
    // $('#inputDate6').datetimepicker({
    //     format: 'Y-MM-DD'
    // });
    $('.dateYMD').datetimepicker({
        format: 'Y-MM-DD'
    });
    //Date picker tgl-jam
    $('#inputDate11').datetimepicker({
        format: 'Y-MM-DD hh:mm:ss'
    });
    $('#inputDate12').datetimepicker({
        format: 'Y-MM-DD hh:mm:ss'
    });
    $('#inputDate5').datetimepicker({
        format: 'Y-MM-DD'
    });



    //set value otomatis
    $("#inputnasabahid").on('change', function(){
      var nasabahidinput = this.value;
      var idcabanginput = $("#inputcab").val();
      $("#inputnocif").val(idcabanginput+nasabahidinput);
    });
    $(".inputnasabahidedit").on('change', function(){
      var nasabahidinput = this.value;
      var idcabanginput = $(".inputcabedit").val();
      $(".inputnocifedit").val(idcabanginput+nasabahidinput);
    });
    // $("#inputnamanasabah").on('change', function(){
    //   var namanasabahinput = this.value;
    //   Swal.fire(
    //       'Attentiton!',
    //       'name of nasabah : '+namanasabahinput,
    //       'warning'
    //     )
    // });

    //set ckeditor
    CKEDITOR.replace( 'inputText1' );
    CKEDITOR.replace( 'inputTitle1' );
    CKEDITOR.replace( 'inputText2' );
    CKEDITOR.replace( 'inputTitle2' );
  });
    //Generate Account Name from Company & Entity
    $('#inputEntity_edit').on('change', function() {
      var valueCompany = $("#inputCostumerName_edit").val();
      var valueEntity = $("#inputEntity_edit option:selected").text();
      if(valueEntity=='PERORANGAN'){valueEntity='';}else{valueEntity=', '+valueEntity;}
      $("#inputAccountName_edit").val(valueCompany+valueEntity);
    });
    $('#inputCostumerName_edit').on('change', function() {
      var valueCompany = $("#inputCostumerName_edit").val();
      var valueEntity = $("#inputEntity_edit option:selected").text();
      if(valueEntity=='PERORANGAN'){valueEntity='';}else{valueEntity=', '+valueEntity;}
      $("#inputAccountName_edit").val(valueCompany+valueEntity);
    });
    $('#inputEntity_add').on('change', function() {
      var valueCompany = $("#inputCostumerName_add").val();
      var valueEntity = $("#inputEntity_add option:selected").text();
      if(valueEntity=='PERORANGAN'){valueEntity='';}else{valueEntity=', '+valueEntity;}
      $("#inputAccountName_add").val(valueCompany+valueEntity);
    });
    $('#inputCostumerName_add').on('change', function() {
      var valueCompany = $("#inputCostumerName_add").val();
      var valueEntity = $("#inputEntity_add option:selected").text();
      if(valueEntity=='PERORANGAN'){valueEntity='';}else{valueEntity=', '+valueEntity;}
      $("#inputAccountName_add").val(valueCompany+valueEntity);
    });

    //Set data to Modals
    $('#modal-edit-newscategory').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      var category = $(e.relatedTarget).data('category');
      $(e.currentTarget).find('input[name="inputNewsCategory"]').val(category);
      $(e.currentTarget).find('input[name="inputIdCategory"]').val(id);
    });


    $('#modal-edit-slider').on('show.bs.modal', function(e) {
      var SliderId = $(e.relatedTarget).data('id');
      var img_title = $(e.relatedTarget).data('img_title');

      $(e.currentTarget).find('input[name="inputImgOld"]').val(img_title);
      $(e.currentTarget).find('input[name="inputIdSlider"]').val(SliderId);
    });

    $('#modal-edit-service').on('show.bs.modal', function(e) {
      var ServiceId = $(e.relatedTarget).data('id');
      var img_title = $(e.relatedTarget).data('img_title');
      var title = $(e.relatedTarget).data('title');
      var detailid = $(e.relatedTarget).data('detailid');
      var detailen = $(e.relatedTarget).data('detailen');

      CKEDITOR.instances['inputText1'].setData(detailid);
      CKEDITOR.instances['inputTitle1'].setData(detailen);
      $(e.currentTarget).find('input[name="inputTitle"]').val(title);
      $(e.currentTarget).find('input[name="inputImgOld"]').val(img_title);
      $(e.currentTarget).find('input[name="inputIdService"]').val(ServiceId);
    });

    $('#modal-edit-logonew').on('show.bs.modal', function(e) {
      var LogoId = $(e.relatedTarget).data('id');
      var logoName = $(e.relatedTarget).data('name');

      $(e.currentTarget).find('input[name="inputLogoOld"]').val(logoName);
      $(e.currentTarget).find('input[name="inputIdLogo"]').val(LogoId);
    });

    $('#modal-edit-content').on('show.bs.modal', function(e) {
      var ContentId = $(e.relatedTarget).data('id');
      var TitleID = $(e.relatedTarget).data('titleid');
      var TitleEN = $(e.relatedTarget).data('titleen');
      var DescriptionID = $(e.relatedTarget).data('descriptionid');
      var DescriptionEN = $(e.relatedTarget).data('descriptionen');
      var Image = $(e.relatedTarget).data('image');

      CKEDITOR.instances['inputText1'].setData(DescriptionID);
      CKEDITOR.instances['inputTitle1'].setData(DescriptionEN);
      $(e.currentTarget).find('input[name="inputTitleID"]').val(TitleID);
      $(e.currentTarget).find('input[name="inputTitleEN"]').val(TitleEN);
      if(ContentId=='8'){
        $(e.currentTarget).find('input[name="inputImage"]').val(Image);
      }else{
        $(e.currentTarget).find('input[name="inputImage"]').val('');
      }
      $(e.currentTarget).find('input[name="inputIdContent"]').val(ContentId);
    });

    $('#modal-edit-contentfooter').on('change', function(e) {
      var ContentFooterId = $(e.relatedTarget).data('id');
      var Title = $(e.relatedTarget).data('title');
      var Description = $(e.relatedTarget).data('description');

      CKEDITOR.instances['inputText1'].setData(Description);
      $(e.currentTarget).find('input[name="inputTitle"]').val(Title);
      $(e.currentTarget).find('input[name="inputIdContentFooter"]').val(ContentFooterId);
    });

    // Fungsi untuk menampilkan Data Tabungan yang akan d EDIT
    $('#modal-edit-tabungan').on('show.bs.modal', function(e) {
      var No_rekening = $(e.relatedTarget).data('no_rekening');
      var Jenis_tabungan = $(e.relatedTarget).data('jenis_tabungan');
      var Hidden_jenis_tabungan = $(e.relatedTarget).data('hidden_jenis_tabungan');
      var No_alternatif = $(e.relatedTarget).data('no_alternatif');
      var Cab = $(e.relatedTarget).data('cab');
      var Nasabah_id = $(e.relatedTarget).data('nasabah_id');
      var Nama_nasabah = $(e.relatedTarget).data('nama_nasabah');
      var Alamat = $(e.relatedTarget).data('alamat');
      var Type_tabungan = $(e.relatedTarget).data('type_tabungan');
      var Suku_bunga = $(e.relatedTarget).data('suku_bunga');
      var Persen_pph = $(e.relatedTarget).data('persen_pph');
      var Tgl_bunga = $(e.relatedTarget).data('tgl_bunga');
      var Blokir = $(e.relatedTarget).data('blokir');
      var Saldo_blokir = $(e.relatedTarget).data('saldo_blokir');
      var Kode_group1 = $(e.relatedTarget).data('kode_group1');
      var Desc_group1 = $(e.relatedTarget).data('desc_group1');
      var Kode_group2 = $(e.relatedTarget).data('kode_group2');
      var Desc_group2 = $(e.relatedTarget).data('desc_group2');
      var Kode_group3 = $(e.relatedTarget).data('kode_group3');
      var Desc_group3 = $(e.relatedTarget).data('desc_group3');
      var Status_aktif = $(e.relatedTarget).data('status_aktif');
      var Kode_bi_pemilik = $(e.relatedTarget).data('kode_bi_pemilik');
      var Deskripsi_golongan = $(e.relatedTarget).data('deskripsi_golongan');
      var Kode_bi_metoda = $(e.relatedTarget).data('kode_bi_metoda');
      var Deskripsi_metoda = $(e.relatedTarget).data('deskripsi_metoda');
      var Kode_bi_hubungan = $(e.relatedTarget).data('kode_bi_hubungan');
      var Deskripsi_sandi = $(e.relatedTarget).data('deskripsi_sandi');
      var Flag_restricted = $(e.relatedTarget).data('flag_restricted');
      var Minimum = $(e.relatedTarget).data('minimum');
      var Setoran_minimum = $(e.relatedTarget).data('setoran_minimum');
      var Setoran_per_bln = $(e.relatedTarget).data('setoran_per_bln');
      var Abp = $(e.relatedTarget).data('abp');
      var Adm_per_bln = $(e.relatedTarget).data('adm_per_bln');

      // BAGIAN MENAMPILKAN DI FORM MODAL----------------------
      $(e.currentTarget).find('input[name="no_rekening"]').val(No_rekening);
      // Cara Menampilkan Selected option dari DATABASE pada DROPDOWN LIST
      $('#idSelect').text(Jenis_tabungan);
      $('#idSelect').val(Hidden_jenis_tabungan);
      // -------------------------------------------
      // Cara Menampilkan Selected option dari DATABASE pada DROPDOWN LIST dengan kondisi tertentu
      // demgan cara id pada OPTION
      switch(Type_tabungan)
      {
        case 1:
        $('#idSelect2').text("Normal");
        $('#idSelect2').val(1);
        break;
        case 2:
        $('#idSelect2').text("Kepala Instansi");
        $('#idSelect2').val(2);
        break;
        case 3:
        $('#idSelect2').text("Juru Bayar");
        $('#idSelect2').val(3);
      }
        //Selected Kode Group 1
        $('#idkodegroup1').val(Kode_group1)
        $('#idkodegroup1').text(Desc_group1)
        //Selected Kode Group 2
        $('#idkodegroup2').val(Kode_group2)
        $('#idkodegroup2').text(Desc_group2)
        //Selected Kode Group 3
        $('#idkodegroup3').val(Kode_group3)
        $('#idkodegroup3').text(Desc_group3)
        // ------------------
        $('#idkodebi').val(Kode_bi_pemilik)
        $('#idkodebi').text(Kode_bi_pemilik +'-'+Deskripsi_golongan)
        $('#idmetoda').val(Kode_bi_metoda);
        $('#idmetoda').text(Deskripsi_metoda);
        $('#idbihubungan').val(Kode_bi_hubungan);
        $('#idbihubungan').text(Deskripsi_sandi);
        $('#idrestricted').val(Flag_restricted);
        $('#idrestricted').text(Flag_restricted);
        //Selected Type Tabugan dengan id pada Select element
        switch(Abp)
        {
          case 1:
            $("select#idabp option:checked").val(Abp);
            $("select#idabp option:checked").text("TABUNGAN");
            break;
          case 2:
            $("select#idabp option:checked").val(Abp);
            $("select#idabp option:checked").text("AB-PASIVA");
            break;
          case 3:
            $("select#idabp option:checked").val(Abp);
            $("select#idabp option:checked").text("AB-AKTIVA");
            break;
          case 4:
            $("select#idabp option:checked").val(Abp);
            $("select#idabp option:checked").text("MODAL");
            break;
          case 5:
            $("select#idabp option:checked").val(Abp);
            $("select#idabp option:checked").text("KEWAJIBAN");

        }
      // ----------------------------------
      // Menampilkan nilai pada input TEXT dari DATABASE
$(e.currentTarget).find('input[name="hidden_jenis_tabungan"]').val(Hidden_jenis_tabungan);                 $(e.currentTarget).find('input[name="no_alternatif"]').val(No_alternatif);
        $(e.currentTarget).find('input[name="cab"]').val(Cab);
        $(e.currentTarget).find('input[name="nasabah_id"]').val(Nasabah_id);
        $(e.currentTarget).find('input[name="nama_nasabah"]').val(Nama_nasabah);
        $(e.currentTarget).find('input[name="alamat"]').val(Alamat);
        $(e.currentTarget).find('input[name="suku_bunga"]').val(Suku_bunga);
        $(e.currentTarget).find('input[name="persen_pph"]').val(Persen_pph);
        $(e.currentTarget).find('input[name="tgl_bunga"]').val(Tgl_bunga);
        $(e.currentTarget).find('input[name="minimum"]').val(Minimum);
        $(e.currentTarget).find('input[name="setoran_minimum"]').val(Setoran_minimum);
        $(e.currentTarget).find('input[name="setoran_per_bln"]').val(Setoran_per_bln);
        $(e.currentTarget).find('input[name="adm_per_bln"]').val(Adm_per_bln);
        $(e.currentTarget).find('input[name="saldo_blokir"]').val(Saldo_blokir);

      // Menampilkan CheckBox Tercentang option dari DATABASE dengan kondisi tertentu
      if(Blokir=='1')
      {
          $("input[name='blokir']").prop('checked',true);
      }
      if(Status_aktif==1){
        $("input[name='baru']").prop('checked', true);
      }else if(Status_aktif==2){
        $("input[name='aktif']").prop('checked', true);
      }else{
        $("input[name='tutup']").prop('checked', true);
      }

    } );
</script>
</body>
</html>
