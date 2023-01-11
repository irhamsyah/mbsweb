@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List Content Text</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <thead>
                <th>No</th>
                <th>Title ID</th>
                <th>Title EN</th>
                <th>Description ID</th>
                <th>Description EN</th>
                <th>URL</th>
                <th>Action</th>
              </thead>
              <tbody>
                @foreach($contents as $index => $content)
                <!--set value image for about only-->
                @if($content->type=='about')
                  @php($image=$content->image)
                @else
                  @php($image='')
                @endif
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{{ $content->title_id }}</td>
                  <td>{!! $content->description_id !!}</td>
                  <td>{{ $content->title_en }}</td>
                  <td>{!! $content->description_en !!}</td>
                  <td>{{ $image }}</td>

                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-content"
                            data-id="{{ $content->id }}"
                            data-titleid="{{ $content->title_id }}"
                            data-titleen="{{ $content->title_en }}"
                            data-descriptionid="{{ $content->description_id }}"
                            data-descriptionen="{{ $content->description_en }}"
                            data-image="{{ $content->image }}">
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
                <th>Title ID</th>
                <th>Title EN</th>
                <th>Detail ID</th>
                <th>Detail EN</th>
                <th>URL</th>
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
  <div class="modal fade" id="modal-edit-content">
    <div class="modal-dialog modal-xl">
      <form action="/adm_content" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit Content Text</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <div class="row">
                <div class="col-lg-4 col-sm-12">
                  <label for="inputTitleID">Title ID</label>
                  <input type="text" name="inputTitleID" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputTitleEN">Title EN</label>
                  <input type="text" name="inputTitleEN" class="form-control">
                </div>
                <div class="col-lg-4 col-sm-12">
                  <label for="inputImage">URL Youtube</label>
                  <input type="text" name="inputImage" class="form-control">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="inputText1">Description ID</label>
              <textarea id="inputText1" name="inputText1"></textarea>
            </div>
            <div class="form-group">
              <label for="inputTitle1">Description EN</label>
              <textarea id="inputTitle1" name="inputTitle1"></textarea>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputIdContent" class="form-control">
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
