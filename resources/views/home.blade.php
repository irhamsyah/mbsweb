<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

  @foreach($logos as $logo)
    @php ($logo=$logo->logo_name)
  @endforeach
  <!-- Site made with Mobirise Website Builder v4.12.4, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.12.4, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="{{ asset('img/logo/'.$logo) }}" type="image/x-icon">
  <meta name="description" content="">


  <title>BAHTERA SETIA</title>
  <link rel="stylesheet" href="{{'assets/web/assets/mobirise-icons/mobirise-icons.css'}}">
  <link rel="stylesheet" href="{{'assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css'}}">
  <link rel="stylesheet" href="{{'assets/bootstrap/css/bootstrap.min.css'}}">
  <link rel="stylesheet" href="{{'assets/bootstrap/css/bootstrap-grid.min.css'}}">
  <link rel="stylesheet" href="{{'assets/bootstrap/css/bootstrap-reboot.min.css'}}">
  <link rel="stylesheet" href="{{'assets/facebook-plugin/style.css'}}">
  <link rel="stylesheet" href="{{'assets/dropdown/css/style.css'}}">
  <link rel="stylesheet" href="{{'assets/tether/tether.min.css'}}">
  <link rel="stylesheet" href="{{'assets/socicon/css/styles.css'}}">
  <link rel="stylesheet" href="{{'assets/theme/css/style.css'}}">
  <link rel="preload" as="style" href="{{'assets/mobirise/css/mbr-additional.css'}}">
  <link rel="stylesheet" href="{{'assets/mobirise/css/mbr-additional.css'}}" type="text/css">



</head>
<body>
  <section class="menu cid-s4m48Yx6UN" once="menu" id="menu2-3">
    <nav class="navbar navbar-expand beta-menu navbar-dropdown align-items-center navbar-fixed-top navbar-toggleable-sm">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
                <span></span>
            </div>
        </button>
        <div class="menu-logo">
            <div class="navbar-brand">
                <span class="navbar-logo">
                    <a href="/">
                        <img src="{{ asset('img/logo/'.$logo) }}" alt="Mobirise" title="" style="height: 3.8rem;">
                    </a>
                </span>
                <span class="navbar-caption-wrap"><a class="navbar-caption text-black display-5" href="/">
                        BAHTERA SETIA</a></span>
            </div>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav nav-dropdown" data-app-modern-menu="true">
              <li class="nav-item">
                <a class="nav-link link text-black display-4" href="/#header7-1u"><span class="mbrib-extension mbr-iconfont mbr-iconfont-btn"></span>{{ __('home.menu_tentang') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link link text-black display-4" href="/service"><span class="mbrib-delivery mbr-iconfont mbr-iconfont-btn"></span>{{ __('home.menu_layanan') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link link text-black display-4" href="/tracking"><span class="mbrib-search mbr-iconfont mbr-iconfont-btn"></span>{{ __('home.menu_lacak') }}</a>
              </li>
              <li class="nav-item">
                <a class="nav-link link text-black display-4" href="/news"><span class="mbri-paper-plane mbr-iconfont mbr-iconfont-btn"></span>{{ __('home.menu_berita') }}</a>
              </li>
              <li class="nav-item">
                <div class="nav-link link display-4" style="display: inline-flex;">
                  <a class="{{ app()->getLocale() == 'en' ? 'active' : '' }}" href="{{ route('localization.switch', 'en') }}">EN</a>
                  <a class="{{ app()->getLocale() == 'id' ? 'active' : '' }}" href="{{ route('localization.switch', 'id') }}">ID</a>
                </div>
              </li>
            </ul>
            @foreach($footertops as $index => $footertop)
                @php ($whatsapp=$footertop->description)
            @endforeach
            <div class="navbar-buttons mbr-section-btn"><a class="btn btn-sm btn-primary display-4" href="https://wa.me/{{ $whatsapp }}"><span class="socicon socicon-whatsapp mbr-iconfont mbr-iconfont-btn"></span>Live Chat</a></div>
        </div>
    </nav>
</section>

<section class="carousel slide cid-s4m4lPuCAG" data-interval="false" id="slider1-5">
    <div class="full-screen">
      <div class="mbr-slider slide carousel" data-keyboard="false" data-ride="carousel" data-interval="3000" data-pause="true">
        <div class="carousel-inner" role="listbox">
            <?php
                $index=0;
            ?>
          @foreach($sliders as $index => $slider)
          <div class="carousel-item slider-fullscreen-image {{$index == 0 ? 'active' : '' }}" data-bg-video-slide="false" style="background-image: url({{ asset('img/slider/'.$slider->img_title) }});">
            <div class="container container-slide">
              <div class="image_wrapper">
                <img src="{{ asset('img/slider/'.$slider->img_title) }}" alt="" title="">
                <div class="carousel-caption justify-content-center">
                  <div class="col-10 align-right"></div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        <ol class="carousel-indicators">
          @for ($i = 0; $i<=$index; $i++)
              <li data-app-prevent-settings="" data-target="#slider1-5" data-slide-to="{{ $i }}"></li>
          @endfor
        </ol>
        <a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev" href="#slider1-5">
          <span aria-hidden="true" class="mbri-left mbr-iconfont"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next" href="#slider1-5">
          <span aria-hidden="true" class="mbri-right mbr-iconfont"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div>

</section>
  <!--Get Localization-->
  @php($loc=app()->getLocale())

    @foreach($abouts as $index => $about)
      @if($loc=='en')
        @php($title_about='title_en')
        @php($description_about='description_en')
      @else
        @php($title_about='title_id')
        @php($description_about='description_id')
      @endif
    @endforeach
<section class="header7 cid-s9lWkXbnx3" id="header7-1u">
<div class="container">
        <div class="media-container-row">

            <div class="media-content align-right">
                <h1 class="mbr-section-title mbr-white pb-3 mbr-fonts-style display-1">
                    {{ $about->$title_about }}</h1>
                <div class="mbr-section-text mbr-white pb-3">
                    <p class="mbr-text mbr-fonts-style display-5">
                      {!! strip_tags($about->$description_about) !!}</p>
                </div>

            </div>

            <div class="mbr-figure" style="width: 100%;"><iframe class="mbr-embedded-video" src="{{ $about->image }}" width="1280" height="720" frameborder="0" allowfullscreen></iframe></div>

        </div>
    </div>
</section>

<section class="features2 cid-s9lXoGMl5l" id="features2-1v">
    <div class="container">
        <div class="media-container-row">
          <!--Initialitation Lang-->
            @if($loc=='en')
              @php($newss=$newss_en)
            @else
              @php($newss=$newss_id)
            @endif

          @foreach($newss as $index => $news)
            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper">
                    <div class="card-img">
                        <img src="{{ asset('img/news/'.$news->img_title) }}" alt="Mobirise" title="">
                    </div>
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7">{!! $news->title !!}</h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                            {!! substr($news->text,0,250) !!}
                            <a href="news_detail/{{ $news->news_id }}"><br>{{ __('home.selengkapnya') }}</a>
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</section>

<section class="mbr-section article content9 cid-s9lXT37Lf2" id="content9-1x">
    <div class="container">
        <div class="inner-container" style="width: 100%;">
            <hr class="line" style="width: 25%;">
            <div class="section-text align-center mbr-fonts-style display-5">
              <a href="news">View All News</a>
            </div>
            <hr class="line" style="width: 25%;">
        </div>
        </div>
</section>

<section class="features15 cid-s9lXIX2lfZ" id="features15-1w">
  @foreach($slogans as $index => $slogan)
    @if($loc=='en')
      @php($title_slogan='title_en')
      @php($description_slogan='description_en')
    @else
      @php($title_slogan='title_id')
      @php($description_slogan='description_id')
    @endif
  @endforeach
    <div class="container">
        <h2 class="mbr-section-title pb-3 align-center mbr-fonts-style display-2">{{ $slogan->$title_slogan }}</h2>
        <h3 class="mbr-section-subtitle display-5 align-center mbr-fonts-style">
            {!! $slogan->$description_slogan !!}
        </h3>

        <div class="media-container-row container pt-5 mt-2">
          @foreach($servicedetails as $index => $servicedetail)
            @if($loc=='en')
              @php($title_sdetail='title_en')
              @php($description_sdetail='description_en')
            @else
              @php($title_sdetail='title_id')
              @php($description_sdetail='description_id')
            @endif
            <div class="col-12 col-md-6 mb-4 col-lg-3">
                <div class="card flip-card p-5 align-center">
                    <div class="card-front card_cont">
                        <img src="{{ asset('assets/images/'.$servicedetail->image) }}" alt="Mobirise" title="">
                    </div>
                    <div class="card_back card_cont">
                        <h4 class="card-title display-5 py-2 mbr-fonts-style">
                          {{ $servicedetail->$title_sdetail }}</h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                          {!! $servicedetail->$description_sdetail !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
  </div>
</section>

<section class="carousel slide testimonials-slider cid-s4moDU74iK" data-interval="false" id="testimonials-slider1-k">
    <div class="container text-center">
        <div class="carousel slide" role="listbox" data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="5000">
            <div class="carousel-inner">
              @foreach($testimonis as $index => $testimoni)
              <div class="carousel-item">
                <div class="user col-md-8">
                  <div class="user_image">
                      <img src="{{ asset('img/testimoni/'.$testimoni->img_testimoni) }}" alt="" title="">
                  </div>
                  <div class="user_text pb-3">
                      <p class="mbr-fonts-style display-7">{!! $testimoni->testimoni !!}</p>
                  </div>
                  <div class="user_name mbr-bold pb-2 mbr-fonts-style display-7">
                      {{ $testimoni->name }}</div>
                  <div class="user_desk mbr-light mbr-fonts-style display-7">
                      {{ $testimoni->position }}</div>
                  </div>
                </div>
                @endforeach
              </div>

            <div class="carousel-controls">
                <a class="carousel-control-prev" role="button" data-slide="prev">
                  <span aria-hidden="true" class="mbri-arrow-prev mbr-iconfont"></span>
                  <span class="sr-only">Previous</span>
                </a>

                <a class="carousel-control-next" role="button" data-slide="next">
                  <span aria-hidden="true" class="mbri-arrow-next mbr-iconfont"></span>
                  <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="clients cid-s4m6BDZgye mbr-parallax-background" data-interval="false" id="clients-9">
  @foreach($ourclients as $index => $ourclient)
    @if($loc=='en')
      @php($title_ourclient='title_en')
      @php($description_ourclient='description_en')
    @else
      @php($title_ourclient='title_id')
      @php($description_ourclient='description_id')
    @endif
  @endforeach
    <div class="mbr-overlay" style="opacity: 0.7; background-color: rgb(255, 255, 255);">
    </div>
        <div class="container mb-5">
            <div class="media-container-row">
                <div class="col-12 align-center">
                    <h2 class="mbr-section-title pb-3 mbr-fonts-style display-2">
                        {{ $ourclient->$title_ourclient }}</h2>
                    <h3 class="mbr-section-subtitle mbr-light mbr-fonts-style display-5">{!! $ourclient->$description_ourclient !!}</h3>
                </div>
            </div>
        </div>

    <div class="container">
        <div class="carousel slide" role="listbox" data-pause="true" data-keyboard="false" data-ride="carousel" data-interval="3000">
            <div class="carousel-inner" data-visible="6">
              @foreach($contentimages as $index => $contentimage)
              <div class="carousel-item ">
                  <div class="media-container-row">
                      <div class="col-md-12">
                          <div class="wrap-img ">
                              <img src="{{ asset('img/content/'.$contentimage->image) }}" class="img-responsive clients-img" alt="" title="">
                          </div>
                      </div>
                  </div>
              </div>
              @endforeach
            </div>
            <div class="carousel-controls">
                <a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev">
                    <span aria-hidden="true" class="mbri-left mbr-iconfont"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next">
                    <span aria-hidden="true" class="mbri-right mbr-iconfont"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>

<section class="cid-s4mgVxxJsb" id="footer2-h">
    <div class="container">
        <div class="media-container-row content mbr-white">
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
                <div class="row">
                  @foreach($footerlefts as $index => $footerleft)
                  <div class="col-lg-12">
                    <strong>{{ $footerleft->title }}</strong>
                    <p class="mbr-text">
                      {!! $footerleft->description !!}
                    </p>
                  </div>
                  @endforeach
                </div>
            </div>
            <div class="col-12 col-md-3 mbr-fonts-style display-7">
              <div class="row">
                @foreach($footerrights as $index => $footerright)
                <div class="col-lg-12">
                  <strong>{{ $footerright->title }}</strong>
                  <p class="mbr-text">
                    {!! $footerright->description !!}
                  </p>
                </div>
                @endforeach
              </div>
            </div>
            <div class="col-12 col-md-6">
              @foreach($footermaps as $index => $footermap)
                <div class="google-map"><iframe frameborder="0" style="border:0" src="{{ $footermap->description }}" allowfullscreen=""></iframe></div>
              @endforeach
            </div>
        </div>

    </div>
</section>

<section once="footers" class="cid-s4mg6Rh7O6" id="footer7-g">
    <div class="container">
        <div class="media-container-row align-center mbr-white">
            <div class="row row-links">
                <ul class="foot-menu">
                  <li class="foot-menu-item mbr-fonts-style display-7">
                    <a class="nav-link link text-white display-4" href="/#header7-1u">{{ __('home.menu_tentang') }}</a>
                  </li>
                  <li class="foot-menu-item mbr-fonts-style display-7">
                    <a class="nav-link link text-white display-4" href="/service">{{ __('home.menu_layanan') }}</a>
                  </li>
                  <li class="foot-menu-item mbr-fonts-style display-7">
                    <a class="nav-link link text-white display-4" href="/tracking">{{ __('home.menu_lacak') }}</a>
                  </li>
                  <li class="foot-menu-item mbr-fonts-style display-7">
                    <a class="nav-link link text-white display-4" href="/news">{{ __('home.menu_berita') }}</a>
                  </li>
                </ul>
            </div>
            <div class="row social-row">
                <div class="social-list align-right pb-2">
                <div class="soc-item">

                            <span class="mbr-iconfont mbr-iconfont-social socicon-twitter socicon"></span>

                    </div><div class="soc-item">

                            <span class="mbr-iconfont mbr-iconfont-social socicon-instagram socicon"></span>

                    </div><div class="soc-item">

                            <a href="https://www.youtube.com/watch?v=LGjgD_AC-yE" target="_blank"><span class="mbr-iconfont mbr-iconfont-social socicon-youtube socicon"></span></a>

                    </div><div class="soc-item">

                            <span class="mbr-iconfont mbr-iconfont-social socicon-facebook socicon"></span>

                    </div></div>
            </div>
            <div class="row row-copirayt">
                <p class="mbr-text mb-0 mbr-fonts-style mbr-white align-center display-7">
                    © Copyright 2020 PT. BAHTERA SETIA - All Rights Reserved
                </p>
            </div>
        </div>
    </div>
</section>


  <script src="{{'assets/popper/popper.min.js'}}"></script>
  <script src="{{'assets/web/assets/jquery/jquery.min.js'}}"></script>
  <script src="{{'assets/bootstrap/js/bootstrap.min.js'}}"></script>
  <script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5"></script>
  <script src="https://apis.google.com/js/plusone.js"></script>
  <script src="{{'assets/facebook-plugin/facebook-script.js'}}"></script>
  <script src="{{'assets/smoothscroll/smooth-scroll.js'}}"></script>
  <script src="{{'assets/touchswipe/jquery.touch-swipe.min.js'}}"></script>
  <script src="{{'assets/ytplayer/jquery.mb.ytplayer.min.js'}}"></script>
  <script src="{{'assets/vimeoplayer/jquery.mb.vimeo_player.js'}}"></script>
  <script src="{{'assets/dropdown/js/nav-dropdown.js'}}"></script>
  <script src="{{'assets/dropdown/js/navbar-dropdown.js'}}"></script>
  <script src="{{'assets/mbr-flip-card/mbr-flip-card.js'}}"></script>
  <script src="{{'assets/bootstrapcarouselswipe/bootstrap-carousel-swipe.js'}}"></script>
  <script src="{{'assets/mbr-testimonials-slider/mbr-testimonials-slider.js'}}"></script>
  <script src="{{'assets/mbr-clients-slider/mbr-clients-slider.js'}}"></script>
  <script src="{{'assets/parallax/jarallax.min.js'}}"></script>
  <script src="{{'assets/tether/tether.min.j'}}s"></script>
  <script src="{{'assets/theme/js/script.js'}}"></script>
  <script src="{{'assets/slidervideo/script.js'}}"></script>



</body>
</html>
