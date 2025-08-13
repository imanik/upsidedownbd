@extends('frontend.layouts.master')

@section('title', __('Contact'))

@section('content')

<!--========== PAGE CONTENT ==========-->
<!-- Feedback Form -->
<div class="g-position--relative g-bg-color--primary">
    <div class="g-container--md  g-padding-y-125--xs">
        <div class="g-text-center--xs g-margin-t-50--xs g-margin-b-80--xs">
            <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--white-opacity g-letter-spacing--2 g-margin-b-25--xs">Contact Us</p>
            <h2 class="g-font-size-32--xs g-font-size-36--sm g-color--white">Get in Touch</h2>
        </div>
        <div class="row g-row-col--5 ">
            <div class="col-xs-4 g-full-width--xs g-margin-b-50--xs g-margin-b-0--sm">
                <div class="g-text-center--xs">
                    <i class="g-display-block--xs g-font-size-40--xs g-color--white-opacity g-margin-b-30--xs ti-email"></i>
                    <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Email</h4>
                    <p class="g-color--white-opacity">info@upsidedownbd.com</p>
                </div>
            </div>
            <div class="col-xs-4 g-full-width--xs g-margin-b-50--xs g-margin-b-0--sm">
                <div class="g-text-center--xs">
                    <i class="g-display-block--xs g-font-size-40--xs g-color--white-opacity g-margin-b-30--xs ti-map-alt"></i>
                    <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Address</h4>
                    <p class="g-color--white-opacity">Lalmatia Branch: House 2/6, Block #C, Lalmatia, Dhaka</p>
                    <p class="g-color--white-opacity">Uttara Branch: House 29, Garib E Newaj Ave, Sector-13, Uttara, Dhaka</p>
                </div>
            </div>
            <div class="col-xs-4 g-full-width--xs">
                <div class="g-text-center--xs">
                    <i class="g-display-block--xs g-font-size-40--xs g-color--white-opacity g-margin-b-30--xs ti-headphone-alt"></i>
                    <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Call at</h4>
                    <p class="g-color--white-opacity"> +88 01615 710 070 (Lalmatia Branch)</p>
                    <p class="g-color--white-opacity"> +88 01881 288 281 (Uttara Branch)</p>
                </div>
            </div>
        </div>

    </div>

    <div class="g-container--md ">
        <div class="g-text-center--xs g-margin-t-50--xs g-margin-b-80--xs">
            <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--white-opacity g-letter-spacing--2 g-margin-b-25--xs">Check Our</p>
            <h2 class="g-font-size-32--xs g-font-size-36--sm g-color--white">Social Media Page</h2>
        </div>
        <div class="row g-row-col--5 g-margin-b-80--xs">
            <div class="col-xs-3 g-full-width--xs g-margin-b-50--xs g-margin-b-0--sm">
                <div class="g-text-center--xs">
                    <i class="g-display-block--xs g-font-size-40--xs g-color--white-opacity g-margin-b-30--xs ti-facebook"></i>
                    <a class="g-font-size-18--xs g-color--white-opacity" href="https://www.facebook.com/upsidedownbd">Upside Down BD</a>
                </div>
            </div>
            <div class="col-xs-3 g-full-width--xs g-margin-b-50--xs g-margin-b-0--sm">
                <div class="g-text-center--xs">
                    <i class="g-display-block--xs g-font-size-40--xs g-color--white-opacity g-margin-b-30--xs ti-instagram"></i>
                    <a class="g-font-size-18--xs g-color--white-opacity" href="https://www.instagram.com/upsidedownbd">Upside Down BD</a>
                </div>
            </div>
            <div class="col-xs-3 g-full-width--xs">
                <div class="g-text-center--xs">
                    <i class="g-display-block--xs g-font-size-40--xs g-color--white-opacity g-margin-b-30--xs ti-facebook"></i>
                <a class="g-font-size-18--xs g-color--white-opacity" href="https://www.facebook.com/upsidedownuttara">Upside Down Uttara</a>
                </div>
            </div>
            <div class="col-xs-3 g-full-width--xs">
                <div class="g-text-center--xs">
                    <i class="g-display-block--xs g-font-size-40--xs g-color--white-opacity g-margin-b-30--xs ti-instagram"></i>
                    <a class="g-font-size-18--xs g-color--white-opacity" href="https://www.instagram.com/upsidedownuttara">Upside Down Uttara</a>
                </div>
            </div>
        </div>

    </div>
    <img class="s-mockup-v2" src="assets/img/mockups/pencil-01.png" alt="Mockup Image">
</div>


@endsection
