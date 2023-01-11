@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Content Footer Text</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
              </thead>
              <tbody>
                @foreach($contentfooters as $index => $contentfooter)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ $contentfooter->title }}</td>
                  <td>{!! $contentfooter->description !!}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-contentfooter"
                            data-id="{{ $contentfooter->id }}"
                            data-title="{{ $contentfooter->title }}"
                            data-description="{{ $contentfooter->description }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Title</th>
                <th>Description</th>
                <th>Action</th>
              </tr>
              </tfoot>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <div class="modal fade" id="modal-edit-contentfooter">
    <div class="modal-dialog modal-xl">
      <form action="/adm_contentfooter" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Content Footer Text</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <label for="inputTitle">Title</label>
                  <input type="text" name="inputTitle" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputText1">Description</label>
              <textarea id="inputText1" name="inputText1"></textarea>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputIdContentFooter" class="form-control">
              <input type="hidden" name="_method" value="PUT"/>
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
        </div>
        <!-- /.modal-content -->
      @csrf
    </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
</div>
<!-- /.content -->
@endsection
