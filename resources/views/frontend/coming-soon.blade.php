@extends('frontend.layouts.master')

@section('title', __('Starting Soon'))

@section('content')

<!--========== PAGE CONTENT ==========-->
<div class="g-bg-position--center g-fullheight--xs" style="background: url({{ asset('assets/img/1920x1080/cs5.jpg')}});">
    <div class="container js__ver-center-aligned">
        <div class="g-text-center--xs">
            <div class="g-margin-t-40--xs g-margin-b-60--xs g-margin-b-80--sm">
                <div class="container-fluid g-padding-y-80--xs g-padding-y-125--sm">
                    <div class="g-margin-b-60--xs">
                        <h2 class="text-uppercase g-font-size-32--xs g-font-size-36--md g-letter-spacing--1 g-color--white">starting soon</h2>
                        <p class="text-uppercase g-font-size-16--xs g-font-weight--700 g-color--white-opacity g-letter-spacing--2 g-margin-b-25--xs">online ticket purchase</p>
                    </div>
               </div>
                <!-- <h1 class="g-font-size-32--xs g-font-size-50--sm g-font-size-60--md g-color-white g-margin-b-30--xs">Online Ticket Purchase</h1> -->
                <!-- <p class="text-uppercase g-font-size-20--md g-font-weight--300 g-color-white">Buy Ticket From Anywhere</p> -->
            </div>
                <div class="row g-margin-b-80--xs">
                    <div class="col-sm-4 col-sm-offset-2 col-xs-6 g-full-width--xs g-margin-b-30--xs g-margin-b-0--md">
                        <div>

                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-6 g-full-width--xs">
                        <div class="input-group">

                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>




@endsection
