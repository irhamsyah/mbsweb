@extends('layouts.page_main')

@section('content')

<section class="mbr-section form3 cid-s4Vir2tRb1 mbr-parallax-background" id="form3-15">

  <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(239, 239, 239);">
  </div>

  <div class="container">
      <div class="row justify-content-center">
          <div class="title col-12 col-lg-8">
              <h2 class="align-center pb-2 mbr-fonts-style display-2">
                  {{ __('tracking.tracking_title') }}</h2>
              <h3 class="mbr-section-subtitle align-center pb-5 mbr-light mbr-fonts-style display-5">
                  {{ __('tracking.tracking_desc') }}</h3>
          </div>
      </div>

      <div class="row py-2 justify-content-center">
          <div class="col-12 col-lg-6  col-md-8 " data-form-type="formoid">
              <!---Formbuilder Form--->
              <form action="/tracking" method="POST" class="mbr-form form-with-styler" data-form-title="Mobirise Form"><input type="hidden" name="email" data-form-email="true" value="Nv1fkQ6x2Pwh8s5TNa3no9uaA2JXsyKVF+U4MlmDH7ivYoP6SA4YD6pi6q0HTFyeykpx/ZBPwNxtQ+1QNhJT08RsJU96IlTka7nBqVQ/jfA9+7QTofoHzlrXr5Fvf16J">
                  <div class="dragArea row">
                      <div class="form-group col" data-for="resi">
                          <input type="resi" name="resi" placeholder="{{ __('tracking.tracking_kolom') }}" data-form-field="resi" required="required" class="form-control display-7" id="resi-form3-15">
                      </div>
                      <div class="col-auto input-group-btn"><button type="submit" class="btn btn-primary display-4" href="page1.html#timeline1-16"><span class="mbri-search mbr-iconfont mbr-iconfont-btn"></span>{{ __('tracking.tracking_tombol') }}</button></div>
                  </div>
                  @csrf
              </form><!---Formbuilder Form--->
          </div>
      </div>
  </div>
</section>

<section class="timeline1 cid-s4Vjj0y4kE" id="timeline1-16">
  <div class="container align-center">
      <h2 class="mbr-section-title pb-3 mbr-fonts-style display-2">Tracking ID</h2>
      <?php $resi_no='';?>
      @foreach($trackings as $index => $tracking)
        @php($resi_no=$tracking->resi_no)
      @endforeach
          <h3 class="mbr-section-subtitle pb-5 mbr-fonts-style display-5">{{ $resi_no }}</h3>
      @foreach($trackings as $index => $tracking)
      <div class="container timelines-container" mbri-timelines="">
        <div class="row timeline-element reverse separline">
         <div class="timeline-date-panel col-xs-12 col-md-6  align-left">
            <div class="time-line-date-content">
            <p class="mbr-timeline-date mbr-fonts-style display-5">{{ $tracking->description }}</p>
            </div>
          </div>
          <span class="iconBackground"></span>
          <div class="col-xs-12 col-md-6 align-right">
            <div class="timeline-text-content">
              <h4 class="mbr-timeline-title pb-3 mbr-fonts-style display-7">{!! $tracking->date->format('d M Y H:i:s') !!}</h4>
              <p class="mbr-timeline-text mbr-fonts-style display-7"><a href="http://maps.google.com/maps?q={{ $tracking->latitude.','.$tracking->longitude }}" target="_blank">{{ '['.$tracking->latitude.','.$tracking->longitude.']' }}</a></p>
           </div>
          </div>
        </div>
      </div>
      @endforeach
  </div>
</section>

@endsection
