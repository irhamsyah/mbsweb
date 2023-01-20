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
                      <p class="pl-3">Data Nasabah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Profil Data Nasabah</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="/adm_transaction" class="nav-link">
                      <p class="pl-3">Simulasi Pembiayaan</p>
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
    //Date picker tgl-jam
    $('#inputDate3').datetimepicker({
        format: 'Y-MM-DD hh:mm:ss'
    });
    $('#inputDate4').datetimepicker({
        format: 'Y-MM-DD hh:mm:ss'
    });

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

    $('#modal-edit-news').on('show.bs.modal', function(e) {
      var NewsId = $(e.relatedTarget).data('id');
      var img_title = $(e.relatedTarget).data('img_title');
      var text = $(e.relatedTarget).data('text');
      var title = $(e.relatedTarget).data('title');
      var id_category = $(e.relatedTarget).data('id_category');
      var location = $(e.relatedTarget).data('location');

      CKEDITOR.instances['inputTitle1'].setData(title);
      CKEDITOR.instances['inputText1'].setData(text);
      $(e.currentTarget).find('select[name="inputIdCategory"]').val(id_category);
      $(e.currentTarget).find('select[name="inputLanguage"]').val(location);
      $(e.currentTarget).find('input[name="inputImgOld"]').val(img_title);
      $(e.currentTarget).find('input[name="inputIdNews"]').val(NewsId);
    });

    $('#modal-edit-newsimage').on('show.bs.modal', function(e) {
      var imageId = $(e.relatedTarget).data('id');
      var img = $(e.relatedTarget).data('img');
      var id_news = $(e.relatedTarget).data('id_news');

      $(e.currentTarget).find('select[name="inputTitleNews"]').val(id_news);
      $(e.currentTarget).find('input[name="inputImgOld"]').val(img);
      $(e.currentTarget).find('input[name="inputIdNewsImg"]').val(imageId);
    });

    $('#modal-edit-customer').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      var codecust = $(e.relatedTarget).data('codecust');
      var namecust = $(e.relatedTarget).data('namecust');
      var addressinv = $(e.relatedTarget).data('addressinv');
      var address = $(e.relatedTarget).data('address');
      var namecust = $(e.relatedTarget).data('namecust');
      var city = $(e.relatedTarget).data('city');
      var province = $(e.relatedTarget).data('province');
      var postal = $(e.relatedTarget).data('postal');
      var telp = $(e.relatedTarget).data('telp');
      var fax = $(e.relatedTarget).data('fax');
      var npwp = $(e.relatedTarget).data('npwp');
      var pkpno = $(e.relatedTarget).data('pkpno');
      var desccustomer = $(e.relatedTarget).data('desccustomer');
      var payment = $(e.relatedTarget).data('payment');
      var nameperson = $(e.relatedTarget).data('nameperson');
      var phoneperson = $(e.relatedTarget).data('phoneperson');
      var emailperson = $(e.relatedTarget).data('emailperson');
      var faxperson = $(e.relatedTarget).data('faxperson');
      var username = $(e.relatedTarget).data('username');
      var password = $(e.relatedTarget).data('password');
      var entity = $(e.relatedTarget).data('entity');
      var entityname = $(e.relatedTarget).data('entityname');
      var status = $(e.relatedTarget).data('status');

      $(e.currentTarget).find('input[name="inputIdCustomer"]').val(id);
      $(e.currentTarget).find('input[name="inputCostumerCode"]').val(codecust);
      $(e.currentTarget).find('input[name="inputCostumerName"]').val(namecust);
      $(e.currentTarget).find('textarea[name="inputAddressInvoice"]').val(addressinv);
      $(e.currentTarget).find('textarea[name="inputAddress"]').val(address);
      $(e.currentTarget).find('input[name="inputCity"]').val(city);
      $(e.currentTarget).find('input[name="inputProvince"]').val(province);
      $(e.currentTarget).find('input[name="inputPostal"]').val(postal);
      $(e.currentTarget).find('input[name="inputTelp"]').val(telp);
      $(e.currentTarget).find('input[name="inputFax"]').val(fax);
      $(e.currentTarget).find('input[name="inputNPWP"]').val(npwp);
      $(e.currentTarget).find('input[name="inputPkp"]').val(pkpno);
      $(e.currentTarget).find('textarea[name="inputCustomerDesc"]').val(desccustomer);
      $(e.currentTarget).find('input[name="inputTOP"]').val(payment);
      $(e.currentTarget).find('input[name="inputPersonName"]').val(nameperson);
      $(e.currentTarget).find('input[name="inputPersonEmail"]').val(phoneperson);
      $(e.currentTarget).find('input[name="inputPersonPhone"]').val(phoneperson);
      $(e.currentTarget).find('input[name="inputPersonFax"]').val(faxperson);
      $(e.currentTarget).find('input[name="inputUsername"]').val(username);
      $(e.currentTarget).find('input[name="inputPasswordOld"]').val(password);
      $(e.currentTarget).find('select[name="inputEntity"]').val(entity);
      $(e.currentTarget).find('input[name="inputAccountName"]').val(namecust+','+entityname);
      $(e.currentTarget).find('select[name="inputStatus"]').val(status);
    });

    $('#modal-edit-agent').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      var codeagent = $(e.relatedTarget).data('codeagent');
      var nameagent = $(e.relatedTarget).data('nameagent');
      var addressinv = $(e.relatedTarget).data('addressinv');
      var address = $(e.relatedTarget).data('address');
      var namecust = $(e.relatedTarget).data('namecust');
      var idcity = $(e.relatedTarget).data('idcity');
      var postal = $(e.relatedTarget).data('postal');
      var telp = $(e.relatedTarget).data('telp');
      var fax = $(e.relatedTarget).data('fax');
      var npwp = $(e.relatedTarget).data('npwp');
      var pkpno = $(e.relatedTarget).data('pkpno');
      var descagent = $(e.relatedTarget).data('descagent');
      var payment = $(e.relatedTarget).data('payment');
      var nameperson = $(e.relatedTarget).data('nameperson');
      var phoneperson = $(e.relatedTarget).data('phoneperson');
      var emailperson = $(e.relatedTarget).data('emailperson');
      var faxperson = $(e.relatedTarget).data('faxperson');

      $(e.currentTarget).find('input[name="inputIdAgent"]').val(id);
      $(e.currentTarget).find('input[name="inputAgentCode"]').val(codeagent);
      $(e.currentTarget).find('input[name="inputAgentName"]').val(nameagent);
      $(e.currentTarget).find('textarea[name="inputAddressInvoice"]').val(addressinv);
      $(e.currentTarget).find('textarea[name="inputAddress"]').val(address);
      $(e.currentTarget).find('select[name="inputIdCity"]').val(idcity);
      $(e.currentTarget).find('input[name="inputPostal"]').val(postal);
      $(e.currentTarget).find('input[name="inputTelp"]').val(telp);
      $(e.currentTarget).find('input[name="inputFax"]').val(fax);
      $(e.currentTarget).find('input[name="inputNPWP"]').val(npwp);
      $(e.currentTarget).find('input[name="inputPkp"]').val(pkpno);
      $(e.currentTarget).find('textarea[name="inputAgentDesc"]').val(descagent);
      $(e.currentTarget).find('input[name="inputTOP"]').val(payment);
      $(e.currentTarget).find('input[name="inputPersonName"]').val(nameperson);
      $(e.currentTarget).find('input[name="inputPersonEmail"]').val(phoneperson);
      $(e.currentTarget).find('input[name="inputPersonPhone"]').val(phoneperson);
      $(e.currentTarget).find('input[name="inputPersonFax"]').val(faxperson);
    });

    $('#modal-edit-bankaccount').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      var bankname = $(e.relatedTarget).data('bankname');
      var bankaccount = $(e.relatedTarget).data('bankaccount');
      var branch = $(e.relatedTarget).data('branch');
      var accountname = $(e.relatedTarget).data('accountname');
      var bankaddress = $(e.relatedTarget).data('bankaddress');
      var agentid = $(e.relatedTarget).data('agentid');

      $(e.currentTarget).find('input[name="inputIdBankAccount"]').val(id);
      $(e.currentTarget).find('input[name="inputBankName"]').val(bankname);
      $(e.currentTarget).find('input[name="inputBankAccount"]').val(bankaccount);
      $(e.currentTarget).find('input[name="inputBranch"]').val(branch);
      $(e.currentTarget).find('input[name="inputAccountName"]').val(accountname);
      $(e.currentTarget).find('textarea[name="inputBankAddress"]').val(bankaddress);
      $(e.currentTarget).find('select[name="inputIdAgent"]').val(agentid);
    });

    $('#modal-edit-pelayaran').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      var codepelayaran = $(e.relatedTarget).data('codepelayaran');
      var namepelayaran = $(e.relatedTarget).data('namepelayaran');
      var alias = $(e.relatedTarget).data('alias');
      var address = $(e.relatedTarget).data('address');
      var city = $(e.relatedTarget).data('city');
      var province = $(e.relatedTarget).data('province');
      var namecust = $(e.relatedTarget).data('namecust');
      var postal = $(e.relatedTarget).data('postal');
      var telp = $(e.relatedTarget).data('telp');
      var fax = $(e.relatedTarget).data('fax');
      var npwp = $(e.relatedTarget).data('npwp');
      var pkpno = $(e.relatedTarget).data('pkpno');
      var descpelayaran = $(e.relatedTarget).data('descpelayaran');
      var payment = $(e.relatedTarget).data('payment');
      var nameperson = $(e.relatedTarget).data('nameperson');
      var phoneperson = $(e.relatedTarget).data('phoneperson');
      var emailperson = $(e.relatedTarget).data('emailperson');
      var faxperson = $(e.relatedTarget).data('faxperson');

      $(e.currentTarget).find('input[name="inputIdPelayaran"]').val(id);
      $(e.currentTarget).find('input[name="inputPelayaranCode"]').val(codepelayaran);
      $(e.currentTarget).find('input[name="inputPelayaranName"]').val(namepelayaran);
      $(e.currentTarget).find('input[name="inputAlias"]').val(alias);
      $(e.currentTarget).find('textarea[name="inputAddress"]').val(address);
      $(e.currentTarget).find('input[name="inputCity"]').val(city);
      $(e.currentTarget).find('input[name="inputProvince"]').val(province);
      $(e.currentTarget).find('input[name="inputPostal"]').val(postal);
      $(e.currentTarget).find('input[name="inputTelp"]').val(telp);
      $(e.currentTarget).find('input[name="inputFax"]').val(fax);
      $(e.currentTarget).find('input[name="inputNPWP"]').val(npwp);
      $(e.currentTarget).find('input[name="inputPkp"]').val(pkpno);
      $(e.currentTarget).find('textarea[name="inputPelayaranDesc"]').val(descpelayaran);
      $(e.currentTarget).find('input[name="inputTOP"]').val(payment);
      $(e.currentTarget).find('input[name="inputPersonName"]').val(nameperson);
      $(e.currentTarget).find('input[name="inputPersonEmail"]').val(phoneperson);
      $(e.currentTarget).find('input[name="inputPersonPhone"]').val(phoneperson);
      $(e.currentTarget).find('input[name="inputPersonFax"]').val(faxperson);
    });

    $('#modal-edit-tarif').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      var pelayaranid = $(e.relatedTarget).data('pelayaranid');
      var city = $(e.relatedTarget).data('city');
      var province = $(e.relatedTarget).data('province');
      var price = $(e.relatedTarget).data('price');
      var date = $(e.relatedTarget).data('date');
      var picpelayaran = $(e.relatedTarget).data('picpelayaran');
      var lastprice1 = $(e.relatedTarget).data('lastprice1');
      var lastprice2 = $(e.relatedTarget).data('lastprice2');
      var lastprice3 = $(e.relatedTarget).data('lastprice3');

      $(e.currentTarget).find('input[name="inputIdTarif"]').val(id);
      $(e.currentTarget).find('select[name="inputIdPelayaran"]').val(pelayaranid);
      $(e.currentTarget).find('input[name="inputCity"]').val(city);
      $(e.currentTarget).find('input[name="inputProvince"]').val(province);
      $(e.currentTarget).find('input[name="inputPrice"]').val(price);
      $(e.currentTarget).find('input[name="inputDate2"]').val(date);
      $(e.currentTarget).find('input[name="inputPIC"]').val(picpelayaran);
      $(e.currentTarget).find('input[name="inputLastPrice1"]').val(lastprice1);
      $(e.currentTarget).find('input[name="inputLastPrice2"]').val(lastprice2);
      $(e.currentTarget).find('input[name="inputLastPrice3"]').val(lastprice3);
      $(e.currentTarget).find('input[name="inputLastPrice1_old"]').val(lastprice1);
      $(e.currentTarget).find('input[name="inputLastPrice2_old"]').val(lastprice2);
      $(e.currentTarget).find('input[name="inputPrice_old"]').val(price);
    });

    $('#modal-edit-consignee').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      var codecons = $(e.relatedTarget).data('codecons');
      var namecons = $(e.relatedTarget).data('namecons');
      var addressinv = $(e.relatedTarget).data('addressinv');
      var address = $(e.relatedTarget).data('address');
      var namecust = $(e.relatedTarget).data('namecust');
      var idcity = $(e.relatedTarget).data('idcity');
      var postal = $(e.relatedTarget).data('postal');
      var telp = $(e.relatedTarget).data('telp');
      var fax = $(e.relatedTarget).data('fax');
      var npwp = $(e.relatedTarget).data('npwp');
      var pkpno = $(e.relatedTarget).data('pkpno');
      var desccons = $(e.relatedTarget).data('desccons');
      var payment = $(e.relatedTarget).data('payment');
      var nameperson = $(e.relatedTarget).data('nameperson');
      var phoneperson = $(e.relatedTarget).data('phoneperson');
      var emailperson = $(e.relatedTarget).data('emailperson');
      var faxperson = $(e.relatedTarget).data('faxperson');

      $(e.currentTarget).find('input[name="inputIdConsignee"]').val(id);
      $(e.currentTarget).find('input[name="inputConsigneeCode"]').val(codecons);
      $(e.currentTarget).find('input[name="inputConsigneeName"]').val(namecons);
      $(e.currentTarget).find('textarea[name="inputAddressInvoice"]').val(addressinv);
      $(e.currentTarget).find('textarea[name="inputAddress"]').val(address);
      $(e.currentTarget).find('select[name="inputIdCity"]').val(idcity);
      $(e.currentTarget).find('input[name="inputPostal"]').val(postal);
      $(e.currentTarget).find('input[name="inputTelp"]').val(telp);
      $(e.currentTarget).find('input[name="inputFax"]').val(fax);
      $(e.currentTarget).find('input[name="inputNPWP"]').val(npwp);
      $(e.currentTarget).find('input[name="inputPkp"]').val(pkpno);
      $(e.currentTarget).find('textarea[name="inputConsigneeDesc"]').val(desccons);
      $(e.currentTarget).find('input[name="inputTOP"]').val(payment);
      $(e.currentTarget).find('input[name="inputPersonName"]').val(nameperson);
      $(e.currentTarget).find('input[name="inputPersonEmail"]').val(phoneperson);
      $(e.currentTarget).find('input[name="inputPersonPhone"]').val(phoneperson);
      $(e.currentTarget).find('input[name="inputPersonFax"]').val(faxperson);
    });

    $('#modal-edit-trucking').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      var nametrucking = $(e.relatedTarget).data('nametrucking');

      $(e.currentTarget).find('input[name="inputIdTrucking"]').val(id);
      $(e.currentTarget).find('input[name="inputTruckingName"]').val(nametrucking);
    });

    $('#modal-edit-vendor').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      var codevendor = $(e.relatedTarget).data('codevendor');
      var namevendor = $(e.relatedTarget).data('namevendor');
      var address = $(e.relatedTarget).data('address');
      var telp = $(e.relatedTarget).data('telp');
      var payment = $(e.relatedTarget).data('payment');
      var truckingtypeid = $(e.relatedTarget).data('truckingtypeid');

      $(e.currentTarget).find('input[name="inputIdVendorTruck"]').val(id);
      $(e.currentTarget).find('input[name="inputVendorCode"]').val(codevendor);
      $(e.currentTarget).find('input[name="inputVendorName"]').val(namevendor);
      $(e.currentTarget).find('textarea[name="inputAddress"]').val(address);
      $(e.currentTarget).find('input[name="inputTelp"]').val(telp);
      $(e.currentTarget).find('input[name="inputTOP"]').val(payment);
      $(e.currentTarget).find('select[name="inputIdTruckingType"]').val(truckingtypeid);
    });

    $('#modal-edit-location').on('show.bs.modal', function(e) {
      var id = $(e.relatedTarget).data('id');
      var codecity = $(e.relatedTarget).data('codecity');
      var namecity = $(e.relatedTarget).data('namecity');
      var provincecity = $(e.relatedTarget).data('provincecity');
      var statusloading = $(e.relatedTarget).data('statusloading');
      var statuspelayaran = $(e.relatedTarget).data('statuspelayaran');

      $(e.currentTarget).find('input[name="inputIdLocation"]').val(id);
      $(e.currentTarget).find('input[name="inputCityCode"]').val(codecity);
      $(e.currentTarget).find('input[name="inputCityName"]').val(namecity);
      $(e.currentTarget).find('input[name="inputProvince"]').val(provincecity);
      $(e.currentTarget).find('select[name="inputStatusLoading"]').val(statusloading);
      $(e.currentTarget).find('select[name="inputStatusPelayaran"]').val(statuspelayaran);
    });

    $('#modal-edit-slider').on('show.bs.modal', function(e) {
      var SliderId = $(e.relatedTarget).data('id');
      var img_title = $(e.relatedTarget).data('img_title');

      $(e.currentTarget).find('input[name="inputImgOld"]').val(img_title);
      $(e.currentTarget).find('input[name="inputIdSlider"]').val(SliderId);
    });

    $('#modal-edit-testimoni').on('show.bs.modal', function(e) {
      var TestimoniId = $(e.relatedTarget).data('id');
      var img_testimoni = $(e.relatedTarget).data('img_testimoni');
      var name = $(e.relatedTarget).data('name');
      var position = $(e.relatedTarget).data('position');
      var testimoni = $(e.relatedTarget).data('testimoni');

      CKEDITOR.instances['inputText1'].setData(testimoni);
      $(e.currentTarget).find('input[name="inputName"]').val(name);
      $(e.currentTarget).find('input[name="inputPosition"]').val(position);
      $(e.currentTarget).find('input[name="inputImgOld"]').val(img_testimoni);
      $(e.currentTarget).find('input[name="inputIdTestimoni"]').val(TestimoniId);
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

    $('#modal-edit-tracking').on('show.bs.modal', function(e) {
      var Id = $(e.relatedTarget).data('id');
      var longitude = $(e.relatedTarget).data('longitude');
      var latitude = $(e.relatedTarget).data('latitude');
      var description = $(e.relatedTarget).data('description');
      var date = $(e.relatedTarget).data('date');
      var customer_id = $(e.relatedTarget).data('customer_id');
      var name_customer = $(e.relatedTarget).data('name_customer');
      var trans_no = $(e.relatedTarget).data('trans_no');
      var transaction_id = $(e.relatedTarget).data('transaction_id');

      $(e.currentTarget).find('input[name="inputTransactionNo"]').val(trans_no);
      $(e.currentTarget).find('input[name="inputCustomerName"]').val(name_customer);
      $(e.currentTarget).find('input[name="inputDate3"]').val(date);
      $(e.currentTarget).find('input[name="inputLatitude"]').val(latitude);
      $(e.currentTarget).find('input[name="inputLongitude"]').val(longitude);
      $(e.currentTarget).find('textarea[name="inputDesc"]').text(description);
      $(e.currentTarget).find('input[name="inputIdTracking"]').val(Id);
      $(e.currentTarget).find('input[name="inputIdTransaction"]').val(transaction_id);
    });

    $('#modal-edit-transaction').on('show.bs.modal', function(e) {
      var Id = $(e.relatedTarget).data('id');
      var trans_no = $(e.relatedTarget).data('trans_no');
      var name_customer = $(e.relatedTarget).data('name_customer');
      var loading_date = $(e.relatedTarget).data('loading_date');
      var pelayaran_id = $(e.relatedTarget).data('pelayaran_id');
      var location_from = $(e.relatedTarget).data('location_from');
      var location_to = $(e.relatedTarget).data('location_to');
      var resi_no = $(e.relatedTarget).data('resi_no');
      var status = $(e.relatedTarget).data('status');

      $(e.currentTarget).find('input[name="inputTransactionNo"]').val(trans_no);
      $(e.currentTarget).find('input[name="inputCustomerName"]').val(name_customer);
      $(e.currentTarget).find('input[name="inputDate3"]').val(loading_date);
      $(e.currentTarget).find('input[name="inputResi"]').val(resi_no);
      $(e.currentTarget).find('select[name="inputPelayaran"]').val(pelayaran_id);
      $(e.currentTarget).find('select[name="inputStatus"]').val(status);
      $(e.currentTarget).find('input[name="inputFromCity"]').val(location_from);
      $(e.currentTarget).find('input[name="inputToCity"]').val(location_to);
      $(e.currentTarget).find('input[name="inputIdTransaction"]').val(Id);
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

    $('#modal-edit-contentfooter').on('show.bs.modal', function(e) {
      var ContentFooterId = $(e.relatedTarget).data('id');
      var Title = $(e.relatedTarget).data('title');
      var Description = $(e.relatedTarget).data('description');

      CKEDITOR.instances['inputText1'].setData(Description);
      $(e.currentTarget).find('input[name="inputTitle"]').val(Title);
      $(e.currentTarget).find('input[name="inputIdContentFooter"]').val(ContentFooterId);
    });

    $('#modal-edit-contentimage').on('show.bs.modal', function(e) {
      var ContentFooterId = $(e.relatedTarget).data('id');
      var Image = $(e.relatedTarget).data('image');

      $(e.currentTarget).find('input[name="inputImgOld"]').val(Image);
      $(e.currentTarget).find('input[name="inputIdContentImage"]').val(ContentFooterId);
    });

</script>
</body>
</html>
