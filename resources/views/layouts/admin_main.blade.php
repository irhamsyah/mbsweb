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
  <!-- SweetAlert2 -->
  <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
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
                  {{ Auth::user()->name }}
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
              <li class="nav-item has-treeview menu-close">
                <a href="/adm_transaction" class="nav-link">
                  <i class="right fas fa-angle-left"></i>
                  <p class="pl-1">TABUNGAN</p>
                </a>
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

    //Date picker
    $('#inputDate1').datetimepicker({
        format: 'Y-MM-DD'
    });
    $('#inputDate2').datetimepicker({
        format: 'Y-MM-DD'
    });
    $('#inputDate3').datetimepicker({
        format: 'Y-MM-DD'
    });
    $('#inputDate4').datetimepicker({
        format: 'Y-MM-DD'
    });
    $('#inputDate5').datetimepicker({
        format: 'Y-MM-DD'
    });
    $('#inputDate6').datetimepicker({
        format: 'Y-MM-DD'
    });
    //Date picker tgl-jam
    $('#inputDate11').datetimepicker({
        format: 'Y-MM-DD hh:mm:ss'
    });
    $('#inputDate12').datetimepicker({
        format: 'Y-MM-DD hh:mm:ss'
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


</script>
</body>
</html>
