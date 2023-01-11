@extends('layouts.admin_main')

@section('content')

<!-- Main content -->
<div class="content-wrapper" style="margin-top:10px;">
  <div class="container-fluid">
    <div class="row">
      @for ($i = 0; $i < 4; $i++)
      <div class="col-lg-3">
        <div class="card">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>

            <img class="img-fluid pad" src="../dist/img/photo2.png" alt="Photo">

            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div>

        <div class="card card-primary card-outline">
          <div class="card-header">
            <h5 class="card-title m-0">Featured</h5>
          </div>
          <div class="card-body">
            <h6 class="card-title">Special title treatment</h6>

            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      </div>

      <!-- /.col-md-3 -->
      <div class="col-lg-3">
        <div class="card">
          <div class="card-header">
            <h5 class="card-title m-0">Featured</h5>
          </div>
          <div class="card-body">
            <h6 class="card-title">Special title treatment</h6>

            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
        <div class="card card-primary card-outline">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>

            <p class="card-text">
              Some quick example text to build on the card title and make up the bulk of the card's
              content.
            </p>
            <a href="#" class="card-link">Card link</a>
            <a href="#" class="card-link">Another link</a>
          </div>
        </div><!-- /.card -->
      </div>
      <!-- /.col-md-3 -->
      @endfor
    </div>

    <div class="row">
      <div class="col-md-6">
        <!-- Box Comment -->
        <div class="card card-widget">
          <div class="card-header">
            <div class="user-block">
              <img class="img-circle" src="../dist/img/user1-128x128.jpg" alt="User Image">
              <span class="username"><a href="#">Jonathan Burke Jr.</a></span>
              <span class="description">Shared publicly - 7:30 PM Today</span>
            </div>
            <!-- /.user-block -->
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-toggle="tooltip" title="Mark as read">
                <i class="far fa-circle"></i></button>
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove"><i class="fas fa-times"></i>
              </button>
            </div>
            <!-- /.card-tools -->
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <img class="img-fluid pad" src="../dist/img/photo2.png" alt="Photo">

            <p>I took this photo this morning. What do you guys think?</p>
            <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button>
            <button type="button" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
            <span class="float-right text-muted">127 likes - 3 comments</span>
          </div>
          <!-- /.card-body -->
          <div class="card-footer card-comments">
            <div class="card-comment">
              <!-- User image -->
              <img class="img-circle img-sm" src="../dist/img/user3-128x128.jpg" alt="User Image">

              <div class="comment-text">
                <span class="username">
                  Maria Gonzales
                  <span class="text-muted float-right">8:03 PM Today</span>
                </span><!-- /.username -->
                It is a long established fact that a reader will be distracted
                by the readable content of a page when looking at its layout.
              </div>
              <!-- /.comment-text -->
            </div>
            <!-- /.card-comment -->
            <div class="card-comment">
              <!-- User image -->
              <img class="img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="User Image">

              <div class="comment-text">
                <span class="username">
                  Luna Stark
                  <span class="text-muted float-right">8:03 PM Today</span>
                </span><!-- /.username -->
                It is a long established fact that a reader will be distracted
                by the readable content of a page when looking at its layout.
              </div>
              <!-- /.comment-text -->
            </div>
            <!-- /.card-comment -->
          </div>
          <!-- /.card-footer -->
          <div class="card-footer">
            <form action="#" method="post">
              <img class="img-fluid img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="Alt Text">
              <!-- .img-push is used to add margin to elements next to floating images -->
              <div class="img-push">
                <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
              </div>
            </form>
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->
@endsection
