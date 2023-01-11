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
  <link rel="shortcut icon" href="{{ asset('../img/logo/'.$logo) }}" type="image/x-icon">
  <meta name="description" content="">


  <title>BAHTERA SETIA</title>
  <link rel="stylesheet" href="{{'../assets/web/assets/mobirise-icons/mobirise-icons.css'}}">
  <link rel="stylesheet" href="{{'../assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css'}}">
  <link rel="stylesheet" href="{{'../assets/bootstrap/css/bootstrap.min.css'}}">
  <link rel="stylesheet" href="{{'../assets/bootstrap/css/bootstrap-grid.min.css'}}">
  <link rel="stylesheet" href="{{'../assets/bootstrap/css/bootstrap-reboot.min.css'}}">
  <link rel="stylesheet" href="{{'../assets/facebook-plugin/style.css'}}">
  <link rel="stylesheet" href="{{'../assets/dropdown/css/style.css'}}">
  <link rel="stylesheet" href="{{'../assets/tether/tether.min.css'}}">
  <link rel="stylesheet" href="{{'../assets/socicon/css/styles.css'}}">
  <link rel="stylesheet" href="{{'../assets/theme/css/style.css'}}">
  <link rel="preload" as="style" href="{{'../assets/mobirise/css/mbr-additional.css'}}">
  <link rel="stylesheet" href="{{'../assets/mobirise/css/mbr-additional.css'}}" type="text/css">



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
                        <img src="{{ asset('../img/logo/'.$logo) }}" alt="Mobirise" title="" style="height: 3.8rem;">
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

  @yield('content')

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


<script src="{{'../assets/popper/popper.min.js'}}"></script>
<script src="{{'../assets/web/assets/jquery/jquery.min.js'}}"></script>
<script src="{{'../assets/bootstrap/js/bootstrap.min.js'}}"></script>
<script src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5"></script>
<script src="https://apis.google.com/js/plusone.js"></script>
<script src="{{'../assets/facebook-plugin/facebook-script.js'}}"></script>
<script src="{{'../assets/smoothscroll/smooth-scroll.js'}}"></script>
<script src="{{'../assets/touchswipe/jquery.touch-swipe.min.js'}}"></script>
<script src="{{'../assets/ytplayer/jquery.mb.ytplayer.min.js'}}"></script>
<script src="{{'../assets/vimeoplayer/jquery.mb.vimeo_player.js'}}"></script>
<script src="{{'../assets/dropdown/js/nav-dropdown.js'}}"></script>
<script src="{{'../assets/dropdown/js/navbar-dropdown.js'}}"></script>
<script src="{{'../assets/mbr-flip-card/mbr-flip-card.js'}}"></script>
<script src="{{'../assets/bootstrapcarouselswipe/bootstrap-carousel-swipe.js'}}"></script>
<script src="{{'../assets/mbr-testimonials-slider/mbr-testimonials-slider.js'}}"></script>
<script src="{{'../assets/mbr-clients-slider/mbr-clients-slider.js'}}"></script>
<script src="{{'../assets/parallax/jarallax.min.js'}}"></script>
<script src="{{'../assets/tether/tether.min.j'}}s"></script>
<script src="{{'../assets/theme/js/script.js'}}"></script>
<script src="{{'../assets/slidervideo/script.js'}}"></script>


</body>
</html>
