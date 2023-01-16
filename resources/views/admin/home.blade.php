@extends('layouts.admin_main')

@section('content')
@foreach($users as $index => $user)
    @php 
        ($username=$user->name);
        ($useremail=$user->email);
    @endphp
@endforeach
<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Beranda</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="alert alert-primary alert-dismissible">
                <i class="fa fa-user" aria-hidden="true" style="padding-right:10px"></i>
                Selamat Datang, {{ $username.' ( '.$useremail.' )' }}. 
            </div>
            <div class="alert alert-danger alert-dismissible">
                <i class="fa fa-key" aria-hidden="true" style="padding-right:10px"></i>
                Mohon Jaga Kerahasiaan Password Anda, selalu Ubah Password Anda Secara Berkala <a href="#">di sini</a>. 
            </div>
            <div class="alert alert-success alert-dismissible">
                <i class="fa fa-book" aria-hidden="true" style="padding-right:10px"></i>
                Download User Manual MBS Web <a href="#">disini</a> dan Video Tutorial MBS Web pada link <a href="#">berikut</a>.  
            </div>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.modal -->
</div>
<!-- /.content -->
@endsection
