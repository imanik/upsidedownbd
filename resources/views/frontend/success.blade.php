@extends('frontend.layouts.master')

@section('title', __('Form Submit Success'))

@yield('page_style_plugin')

<!-- Theme Skins -->
<link href="css/theme/gold.css" rel="stylesheet" type="text/css" />

@yield('page_style')

@section('content')
<!--========== About ==========-->
<div class="g-position--relative g-bg-color--primary-to-blueviolet-ltr">
    <div class="container g-padding-y-80--xs g-padding-y-125--sm g-margin-b-25--xs">

        <div id="js__scroll-to-section" class="g-position--relative ">
            <div class="row g-hor-centered-row--md">
                <div class="col-md-8 g-hor-centered-row__col g-margin-b-60--xs g-margin-b-0--md">
                    <div class="g-width-100-percent--xs g-width-400--md g-margin-b-40--xs">
                    <h2 class="g-font-size-32--xs g-font-size-36--md g-font-family--playfair g-margin-b-20--xs g-color--white">Thanks For Your Interest!</h2>
                        <p class="g-font-size-18--sm  g-color--white">Our official team will contact you soon.</p>
                        <p class="g-font-size-18--sm  g-color--white">Phone: 01911964279, 01676624347</p>
                        <p class="g-font-size-18--sm  g-color--white">Thanks for your patience.</p> </div>
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".5s">
                        <div class="g-position--overlay g-text-left--xs g-text-right--md g-margin-t-o-50--lg">
                            <span class="g-font-size-60--xs g-font-size-80--sm g-font-size-105--lg g-font-family--playfair g-color--white g-line-height--xs">1</span>
                            <span class="text-uppercase g-display-block--xs g-font-size-34--xs g-font-size-40--sm g-font-size-50--lg g-font-weight--700 g-font-family--playfair  g-color--white-opacity-light g-line-height--xs">Number</span>
                            <p class="g-font-size-18--xs g-font-size-20--lg g-color--white-opacity-light">of Entertainment</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-xs-6 col-xs-offset-3 g-full-width--xs g-full-width-offset-0--xs g-hor-centered-row__col">
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".1s">
                        <img class="img-responsive" src="assets/img/450x700/02.jpg" alt="Image">
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
<!-- End About -->


<!--========== PAGE CONTENT ==========-->





@endsection





@section('page_script_component')
<!-- BEGIN: LAYOUT PLUGINS -->
<!-- Back To Top -->



<!-- <script type="text/javascript" src="vendor/cubeportfolio/js/jquery.cubeportfolio.min.js"></script>
<script type="text/javascript" src="js/components/tab.min.js"></script> -->


<!--========== END JAVASCRIPTS ==========-->
@endsection
