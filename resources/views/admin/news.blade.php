@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">List News</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row" style="margin-bottom:10px;">
              <div class="col-lg-1 col-sm-2">
                <button type="button" class="btn btn-block btn-outline-primary" data-toggle="modal" data-target="#modal-add-news">New</button>
              </div>
            </div>
            <table id="example1" class="table table-bordered table-hover">
              <thead>
                <th>No</th>
                <th>Title</th>
                <th>Text</th>
                <th>Image</th>
                <th>Category</th>
                <th>Language</th>
                <th>User</th>
                <th>Action</th>
              </thead>
              <tbody>
                @foreach($newss as $index => $news)
                <tr>
                  <td>{{ $index+1 }}</td>
                  <td>{!! ucwords($news->title) !!}</td>
                  <td>{!! $news->text !!}</td>
                  <td><img src="{{ asset('/img/news/'.$news->img_title) }}" style="max-width:100px;max-height:100px;"/></td>
                  <td>{{ $news->category_name }}</td>
                  <td>{{ $news->location }}</td>
                  <td>{{ $news->user_name }}</td>
                  <td>
                    <div class="row">
                      <div class="col-6">
                        <a href="#" class="btn btn-block bg-gradient-warning btn-sm"
                            data-toggle="modal" data-target="#modal-edit-news"
                            data-id="{{ $news->news_id }}"
                            data-title="{{ $news->title }}"
                            data-text="{{ $news->text }}"
                            data-id_category="{{ $news->news_category_id }}"
                            data-location="{{ $news->location }}"
                            data-img_title="{{ $news->img_title }}">
                          <i class="fas fa-pencil-alt" aria-hidden="true"></i>
                        </a>
                      </div>
                      <div class="col-6">
                        <form action="/adm_news" method="post" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')">
                           <button type="submit" class="btn btn-block bg-gradient-danger btn-sm">
                              <i class="fas fa-trash" aria-hidden="true" style="color:#000;"></i>
                           </button>
                           <input type="hidden" name="inputIdNews" value="{{ $news->news_id }}" class="form-control">
                           <input type="hidden" name="inputImgOld" value="{{ $news->img_title }}" class="form-control">
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
                <th>Title</th>
                <th>Text</th>
                <th>Image</th>
                <th>Category</th>
                <th>Language</th>
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
  <div class="modal fade" id="modal-edit-news">
    <div class="modal-dialog modal-xl">
      <form action="/adm_news" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Edit News</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="inputTitle1">Title</label>
              <textarea id="inputTitle1" name="inputTitle1"></textarea>
            </div>
            <div class="form-group">
              <label for="inputText1">Text</label>
              <textarea id="inputText1" name="inputText1"></textarea>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-4">
                  <label for="inputIdCategory">Select Category</label>
                  <select class="form-control" name="inputIdCategory">
                    @foreach($news_categorys as $news_category)
                    <option value="{{ $news_category->id }}">{{ $news_category->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-4">
                <label for="inputImage">Upload Image</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="inputImage" id="inputImage">
                    <label class="custom-file-label" for="inputImage">Choose Image</label>
                  </div>
                </div>
                <div class="col-4">
                  <label for="inputLanguage">Select Language</label>
                  <select class="form-control" name="inputLanguage">
                    <option value="id">Indonesia</option>
                    <option value="en">Inggris</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-group">
              <input type="hidden" name="inputImgOld" class="form-control">
              <input type="hidden" name="inputIdNews" class="form-control">
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
  <div class="modal fade" id="modal-add-news">
    <div class="modal-dialog modal-xl">
      <form action="/adm_news" method="post" enctype="multipart/form-data">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Add News</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="inputTitle2">Title</label>
              <textarea id="inputTitle2" name="inputTitle2"></textarea>
            </div>
            <div class="form-group">
              <label for="inputText2">Text</label>
              <textarea id="inputText2" name="inputText2"></textarea>
            </div>
            <div class="form-group">
              <div class="row">
                <div class="col-4">
                  <label for="inputIdCategory">Select Category</label>
                  <select class="form-control" name="inputIdCategory">
                    <option value="#" selected="true" disabled="disabled">--- Select Category ---</option>
                    @foreach($news_categorys as $news_category)
                    <option value="{{ $news_category->id }}">{{ $news_category->name }}</option>
                    @endforeach
                  </select>
                </div>
                <div class="col-4">
                  <label for="inputLanguage">Select Language</label>
                  <select class="form-control" name="inputLanguage">
                    <option value="id">Indonesia</option>
                    <option value="en">Inggris</option>
                  </select>
                </div>
                <div class="col-4">
                  <label for="inputImage">Upload Image</label>
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" name="inputImage" id="inputImage">
                    <label class="custom-file-label" for="inputImage">Choose Image</label>
                  </div>
                </div>
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
  <!-- /.modal -->
</div>
<!-- /.content -->
@endsection
