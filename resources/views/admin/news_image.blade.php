@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List News Image</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary"  data-toggle="modal" data-target="#modal-add-newsimage">New</button>
              </div>
            </div>
            <table id="example1" class="table table-bordered table-hover">
              <thead>
              <tr>
                <th>No</th>
                <th>Image</th>
                <th>Title News</th>
                <th>User</th>
                <th>Action</th>
              </tr>
              </thead>
              <tbody>
              @foreach($news_images as $index => $news_image)
              <tr>
                <td>{{ $index+1 }}</td>
                <td><img src="{{ asset('/img/news/'.$news_image->img) }}" style="max-width:100px;max-height:100px;"/></td>
                <td>{!! $news_image->title !!}</td>
                <td>{{ $news_image->user_name }}</td>
                <td>
                  <div class="row">
                    <div class="col-6">
                      <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                          data-toggle="modal" data-target="#modal-edit-newsimage"
                          data-id="{{ $news_image->id_image }}"
                          data-img="{{ $news_image->img }}"
                          data-id_news="{{ $news_image->news_id }}">
                        <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                      </a>
                    </div>
                    <div class="col-6">
                      <form action="/adm_news_img" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                         <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                            <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                         </button>
                         <input type="hidden" name="inputIdNewsImg" value="{{ $news_image->id_image }}" class="form-control">
                         <input type="hidden" name="inputImgOld" value="{{ $news_image->img }}" class="form-control">
                         <input type="hidden" name="_method" value="DELETE"/>
                         @csrf
                      </form>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
              </tbody>
              <tfoot>
              <tr>
                <th>No</th>
                <th>Image</th>
                <th>Title News</th>
                <th>User</th>
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
  <div class="modal fade" id="modal-add-newsimage">
    <div class="modal-dialog modal-md">
      <form action="/adm_news_img" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add News Image</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="inputTitleNews">Select Title News</label>
              <select class="form-control" name="inputTitleNews">
                <option value="#" selected="true" disabled="disabled">--- Select Title News ---</option>
                @foreach($newss as $news)
                <option value="{{ $news->news_id }}">{!! $news->title !!}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="inputImage">Upload Image</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="inputImage" id="inputImage">
                <label class="custom-file-label" for="inputImage">Choose Image</label>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputIdUser" value="{{ Auth::user()->id }}" class="form-control">
            </div>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save</button>
          </div>
        </div>
        <!-- /.modal-content -->
      @csrf
    </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade" id="modal-edit-newsimage">
    <div class="modal-dialog modal-md">
      <form action="/adm_news_img" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Update News Image</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="inputTitleNews">Select Title News</label>
              <select class="form-control" name="inputTitleNews">
                @foreach($newss as $news)
                <option value="{{ $news->news_id }}">{!! $news->title !!}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="inputImage">Upload Image</label>
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="inputImage" id="inputImage">
                <label class="custom-file-label" for="inputImage">Choose Image</label>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputImgOld" class="form-control">
              <input type="hidden" name="inputIdNewsImg" class="form-control">
              <input type="hidden" name="inputIdUser" value="{{ Auth::user()->id }}" class="form-control">
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
