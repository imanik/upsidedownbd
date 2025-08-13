<!DOCTYPE html>
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!-->
<html lang="{{ config('app.locale') }}">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    @include ('frontend.layouts.meta-content')


    <!-- Web Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i|Montserrat:400,700" rel="stylesheet">

    <!-- Vendor Styles -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendor/themify/themify.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendor/scrollbar/scrollbar.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendor/cubeportfolio/css/cubeportfolio.min.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('vendor/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css"/>


    @yield('page_style_plugin')



    <!-- Theme Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('css/global/global.css') }}" rel="stylesheet" type="text/css"/>

    <link href="{{ asset('css/theme/gold.css') }}" rel="stylesheet" type="text/css"/>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('assets/img/apple-touch-icon.png') }}">

    @yield('page_style')

    <!-- <script data-ad-client="ca-pub-7124075191587333" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script> -->
    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7124075191587333" crossorigin="anonymous"></script> -->
    <!-- <script async custom-element="amp-auto-ads" src="https://cdn.ampproject.org/v0/amp-auto-ads-0.1.js"></script> -->
    <!-- <script async custom-element="amp-ad" src="https://cdn.ampproject.org/v0/amp-ad-0.1.js"></script> -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->

<body>
    <!-- <amp-auto-ads type="adsense" data-ad-client="ca-pub-7124075191587333"></amp-auto-ads> -->

    <!-- BEGIN: HEADER -->


    <!--========== HEADER V2 ==========-->
    <header class="navbar-fixed-top s-header-v2 js__header-sticky">
        <!-- Navbar -->
        <nav class="s-header-v2__navbar">
            <div class="container g-display-table--lg">
                <!-- Navbar Row -->
                <div class="s-header-v2__navbar-row">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="s-header-v2__navbar-col">
                        <button type="button" class="collapsed s-header-v2__toggle" data-toggle="collapse" data-target="#nav-collapse" aria-expanded="false">
                            <span class="s-header-v2__toggle-icon-bar"></span>
                        </button>
                    </div>

                    <div class="s-header-v2__navbar-col s-header-v2__navbar-col-width--180">
                        <!-- Logo -->
                        <div class="s-header-v2__logo">
                            <a href="{{ url('home')}}" class="s-header-v2__logo-link">
                                <img class="s-header-v2__logo-img s-header-v2__logo-img--default" src="{{ asset('img/logo.png') }}" alt="Dublin Logo">
                                <img class="s-header-v2__logo-img s-header-v2__logo-img--shrink" src="{{ asset('img/logo.png') }}" alt="Dublin Logo">
                            </a>
                        </div>
                        <!-- End Logo -->
                    </div>
                    <?php
                        $due_payment = App\Helpers::duePayment();
                    ?>

                    <div class="s-header-v2__navbar-col s-header-v2__navbar-col--right">
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse s-header-v2__navbar-collapse" id="nav-collapse">
                            <ul class="s-header-v2__nav">
                                <!-- Home -->
                                <li class="s-header-v2__nav-item s-header-v2__dropdown-on-hover"><a href="{{url('/')}}" class=" s-header-v2__nav-link  ">Home</a></li>
                                <li class="s-header-v2__nav-item s-header-v2__dropdown-on-hover"><a href="{{ route('ticket.create') }}" class=" s-header-v2__nav-link  ">Buy Ticket</a></li>
                                <li class="s-header-v2__nav-item s-header-v2__dropdown-on-hover"><a href="{{url('/about-us')}}" class="s-header-v2__nav-link ">About</a></li>
                                <li class="s-header-v2__nav-item s-header-v2__dropdown-on-hover"><a href="{{url('/promotions')}}" class="s-header-v2__nav-link">Promotion</a></li>
                                <li class="s-header-v2__nav-item s-header-v2__dropdown-on-hover"><a href="{{url('/franchise')}}" class="s-header-v2__nav-link">Franchise</a></li>
                                <li class="s-header-v2__nav-item s-header-v2__dropdown-on-hover"><a href="{{url('/menu')}}" class="s-header-v2__nav-link">Pizza In Law</a></li>
                                    <li class="dropdown s-header-v2__nav-item s-header-v2__dropdown-on-hover">
                                    <a href="#" class="dropdown-toggle s-header-v2__nav-link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Gallery <span class="g-font-size-10--xs g-margin-l-5--xs ti-angle-down"></span></a>
                                    <ul class="dropdown-menu s-header-v2__dropdown-menu">
                                        <li><a href="{{url('/gallery')}}" class="s-header-v2__dropdown-menu-link">Lalmatia</a></li>
                                        <li><a href="{{url('/gallery-uttara')}}" class="s-header-v2__dropdown-menu-link">Uttara</a></li>
                                    </ul>
                                </li>
                                <li class="s-header-v2__nav-item s-header-v2__dropdown-on-hover"><a href="{{url('/contacts')}}" class="s-header-v2__nav-link s-header-v2__nav-link--dark">Contacts</a></li>
                                @if(Auth::check())
                                <li class="dropdown s-header-v2__nav-item s-header-v2__dropdown-on-hover">
                                    <a href="#" class="dropdown-toggle s-header-v2__nav-link -is-active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} <span class="g-font-size-10--xs g-margin-l-5--xs ti-angle-down"></span></a>
                                    <ul class="dropdown-menu s-header-v2__dropdown-menu">
                                        <li><a href="/dashboard" class="s-header-v2__dropdown-menu-link">Dashboard</a></li>
                                        @if($due_payment['status'])
                                        <li><a href="/dashboard" class="s-header-v2__dropdown-menu-link">{{ $due_payment['message'] }}</a></li>
                                        @endif
                                    </ul>
                                </li>
                                @else
                                <li class="s-header-v2__nav-item s-header-v2__dropdown-on-hover"><a href="{{ route('login') }}" class="s-header-v2__nav-link s-header-v2__nav-link--dark">Login</a></li>
                                @endif
                            </ul>
                        </div>
                        <!-- End Nav Menu -->
                    </div>
                </div>
                <!-- End Navbar Row -->
            </div>
        </nav>
        <!-- End Navbar -->
    </header>
    <!--========== END HEADER V2 ==========-->

    <div class="c-layout-page">
        @yield('content')
    </div>
    <!-- <amp-ad width="100vw" height="320"
         type="adsense"
         data-ad-client="ca-pub-7124075191587333"
         data-ad-slot="4373347631"
         data-auto-format="rspv"
         data-full-width="">
      <div overflow=""></div>
    </amp-ad> -->

    @include ('frontend.layouts.footer')

    <script type="text/javascript" src="{{ asset('vendor/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery.migrate.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery.smooth-scroll.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/jquery.back-to-top.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('vendor/scrollbar/jquery.scrollbar.min.js') }}"></script>

    @yield('page_script_plugin')


    <script type="text/javascript" src="{{ asset('js/global.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/components/header-sticky.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/components/scrollbar.min.js') }}"></script>
    @yield('page_script_component')

    <!-- <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-7124075191587333"
     crossorigin="anonymous"></script> -->
</body>
<!-- END: PAGE CONTAINER -->

</html>
