@extends('layouts.page_detail')

@section('content')
<section class="services2 cid-s9mwWFLG0H" id="services2">
  <!--Container-->
  <div class="container">
    @foreach($newss as $index => $news)
      <div class="col-md-12">
          <div class="media-container-row">
              <div class="mbr-figure">
                  <img src="../img/news/{{ $news->img_title }}" alt="img_news" style="max-width: 600px;">
              </div>
          </div>
          <div class="media-container-row">
              <div class="align-left aside-content">
                  <h5 class="mbr-title pt-2 mbr-fonts-style display-2">{!! $news->title !!}</h5>
                  <div class="mbr-section-text">
                      <p class="mbr-text text1 pt-2 mbr-light mbr-fonts-style display-7">{!! $news->text !!}</p>
                  </div>
                  <p class="mbr-text text1 pt-2 mbr-light mbr-fonts-style display-7">{{  'Kategori : '.$news->category_name.' | Redaksi : '.$news->user_name }}</p>
              </div>
          </div>
      </div>
      @endforeach
  </div>
</section>
@endsection
