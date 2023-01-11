@extends('layouts.page_main')

@section('content')

<section class="services2 cid-s9mwecmIlZ" id="services2">
  <!--Container-->
  <div class="container">
    <?php
      $loc=app()->getLocale();
      //check locatization
      if($loc=='en'){$newss=$newss_en;}else{$newss=$newss_id;}
    ?>

    @foreach($newss as $index => $news)
      <div class="col-md-12" style="margin-bottom:30px;">
          <div class="media-container-row">
              <div class="mbr-figure" style="width: 50%;">
                  <img src="img/news/{{ $news->img_title }}" alt="img_news">
              </div>
              <div class="align-left aside-content">
                  <h2 class="mbr-title pt-2 mbr-fonts-style display-2">{!! $news->title !!}</h2>
                  <div class="mbr-section-text">
                      <p class="mbr-text text1 pt-2 mbr-light mbr-fonts-style display-7">{!! substr($news->text,0,250) !!}</p>
                  </div>
                  <!--Btn-->
                  <div class="mbr-section-btn pt-3 align-left"><a href="news_detail/{{ $news->news_id }}" class="btn btn-warning-outline display-4">
                          {{ __('home.selengkapnya') }}</a></div>
              </div>
          </div>
      </div>
      @endforeach
  </div>
</section>
<!---
<section class="services1 cid-s4VrmuYwz9" id="services1-19">
    <div class="container">
        <div class="row justify-content-center">
            <div class="title pb-5 col-12">
                <h2 class="align-left pb-3 mbr-fonts-style display-1">Berita Corporate</h2>

            </div>
            @foreach($newss2 as $index => $news)
            <div class="card col-12 col-md-6 p-3 col-lg-4">
                <div class="card-wrapper">
                    <div class="card-img">
                        <img src="img/news/{{ $news->img_title }}" alt="Mobirise">
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style display-5">
                            {!! $news->title !!}
                        </h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                            {!! substr($news->text,0,200) !!}
                        </p>
                        <div class="mbr-section-btn align-left">
                          <a href="news_detail.html/{{ $news->id }}" class="btn btn-warning-outline display-4">Selengkapnya</a></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section class="services6 cid-s4Vrww86q1" id="services6-1b">
    <div class="container">
        <div class="row">
            <div class="title col-12">
                <h2 class="align-left mbr-fonts-style m-0 display-1">Kilas berita maritim</h2>
            </div>
            @foreach($newss_id as $index => $news)
            <div class="card col-12 pb-5">
                <div class="card-wrapper media-container-row media-container-row">
                    <div class="card-box">
                        <div class="row">
                            <div class="col-12 col-md-2">
                                <div class="mbr-figure">
                                    <img src="img/news/{{ $news->img_title }}" alt="Img_news">
                                </div>
                            </div>
                            <div class="col-12 col-md-10">
                                <div class="wrapper">
                                    <div class="top-line pb-3">
                                        <h4 class="card-title mbr-fonts-style display-5">&nbsp;{!! $news->title !!}</h4>
                                        <p class="mbr-text cost mbr-fonts-style m-0 display-5">
                                            <a href="news_detail.html/{{ $news->id }}" >Selengkapnya</a>
                                        </p>
                                    </div>
                                    <div class="bottom-line">
                                        <p class="mbr-text mbr-fonts-style display-7">
                                            {!! substr($news->text,0,200) !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
-->

@endsection
