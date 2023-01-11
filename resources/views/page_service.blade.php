@extends('layouts.page_main')

@section('content')
<section class="features18 popup-btn-cards popUpBgBast hideMeBast" id="features18-1z">
    <div class="container">
      <div class="flash-message">
        @if (\Session::has('failed'))
            <p class="alert alert-failed popUpFailBast">{!! \Session::get('failed') !!} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
        @endif
      </div>
    </div>
</section>

<!--Get Localization-->
@php($loc=app()->getLocale())

<section class="features18 popup-btn-cards cid-s9mp3oMIIm" id="features18-2z">
  @foreach($servicetexts as $index => $servicetext)
    @if($loc=='en')
      @php($title_service='title_en')
      @php($description_service='description_en')
    @else
      @php($title_service='title_id')
      @php($description_service='description_id')
    @endif
  @endforeach
    <div class="container">
      <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">
          {{ $servicetext->$title_service }}</h2>
      <h3 class="mbr-section-subtitle display-5 align-center mbr-fonts-style mbr-light"><p>
          {{ $servicetext->$description_service }}</p></h3>
    </div>
</section>
<?php
  $index=0;
?>
<section class="features18 popup-btn-cards cid-s9mp3oMIIm" id="features18-3z">
    <div class="container">
      <div class="row">
        @foreach($services as $index => $service)
        <div class="card p-3 col-sm-12 col-md-6">
            <div class="card-wrapper ">
                <div class="card-img">
                    <div class="mbr-overlay"></div>
                    <div class="mbr-section-btn text-center">
                      <button type="button" class="btn btn-primary btn-form display-4" data-toggle="modal" data-target="#modal-add-customer">{{ __('service.pesan') }}</button>
                    </div>
                    <img src="{{ asset('img/service/'.$service->img_title) }}" alt="Mobirise">
                </div>
                <div class="card-box">
                    <h4 class="card-title mbr-fonts-style display-7">{{ $service->title }}</h4>
                    <p class="mbr-text mbr-fonts-style align-left display-7">
                      <!--Initialitation Lang-->
                        @if($loc=='en')
                          @php($detail='detail_en')
                        @else
                          @php($detail='detail_id')
                        @endif

                        {!! $service->$detail !!}
                    </p>
                </div>
            </div>
        </div>
        @endforeach
      </div>
    </div>
</section>

<div class="modal fade" id="modal-add-customer">
  <div class="modal-dialog modal-md">
    <form action="/trans_new" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Login</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <div class="row">
              <div class="col-md-12  form-group" data-for="email">
                  <label for="username-form1-27" class="form-control-label mbr-fonts-style display-7">Username</label>
                  <input type="text" name="username" data-form-field="Username" required="required" class="form-control display-7" id="username-form1-27">
              </div>
              <div data-for="password" class="col-md-12  form-group">
                  <label for="password-form1-27" class="form-control-label mbr-fonts-style display-7">Password</label>
                  <input type="password" name="password" data-form-field="Password" class="form-control display-7" id="password-form1-27">
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="submit" class="btn btn-primary btn-form display-4">Login</button>
          <a href="/contact" class="btn btn-primary btn-form display-4">Sign Up</a>
        </div>
      </div>
      <!-- /.modal-content -->
    @csrf
  </form>
  </div>
  <!-- /.modal-dialog -->
</div>
@endsection
