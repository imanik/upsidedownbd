@extends('frontend.layouts.master')

@section('title', __('Home'))

@section('css')
<!-- Theme Skins -->

@stop






@section('content')

<!--========== PROMO BLOCK ==========-->
<div class="s-promo-block-v3 g-bg-position--center g-fullheight--sm" style="background: url({{ asset('assets/img/1920x1080/a34.jpg')}})">
    <div class="container g-ver-center--sm g-padding-y-125--xs g-padding-y-0--sm">
        <div class="g-margin-t-30--xs g-margin-t-0--sm g-margin-b-30--xs g-margin-b-70--md">
            <h1 class="g-font-size-35--xs g-font-size-45--sm g-font-size-50--lg g-color--white">Experience <br> A New View</h1>
        </div>
        <div class="row">
            <div class="col-sm-8 col-sm-push-4 g-margin-b-50--xs g-margin-b-0--md">
                <div class="s-promo-block-v3__divider g-display-none--xs g-display-block--md"></div>
                <div class="row">
                    <div class="col-sm-6 g-margin-b-30--xs g-margin-b-0--md">
                        <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".4s">
                            <p class="g-font-size-18--xs g-color--white">Deceive your eyes and entertain your mind! You will not believe what you see and feel. Experience the impossible and visit the most extraordinary museum in Dhaka 365 days a year. </p>
                        </div>
                    </div>
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="clearfix">
                            <div class="pull-left">
                                <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".3s">
                                    <span class="s-promo-block-v3__date g-font-size-100--xs g-font-size-135--lg g-font-weight--300 g-color--white">1</span>
                                </div>
                            </div>
                            <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".1s">
                                <span class="s-promo-block-v3__month g-font-size-18--xs g-font-size-22--lg g-font-weight--300 g-color--white">Number</span>
                                <span class="s-promo-block-v3__year g-font-size-18--xs g-font-size-22--lg g-font-weight--300 g-color--white">Entertainment</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-sm-pull-8">
                <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".5s">
                    <a class="js__popup__youtube" href="https://www.youtube.com/watch?v=KFo25qqQWPA" title="Intro Video">
                        <i class="s-icon s-icon--lg s-icon--white-bg g-radius--circle ti-control-play"></i>
                        <span class="text-uppercase g-font-size-13--xs g-color--white g-padding-x-15--xs">Watch the Overview</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--========== END PROMO BLOCK ==========-->

<!--========== PAGE CONTENT ==========-->


<!-- Counter -->

<!-- End Counter -->

<!-- About -->
<div class="container g-padding-y-40--xs g-padding-y-80--sm">
    <div class="row g-hor-centered-row--md g-row-col--5 g-margin-b-60--xs g-margin-b-100--md">
        <div class="col-sm-3 col-xs-6 g-hor-centered-row__col">
            <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".1s">
                <img class="img-responsive" src="{{ asset('assets/img/400x500/2.jpg')}}" alt="Image">
            </div>
        </div>
        <div class="col-sm-3 col-xs-6 g-hor-centered-row__col g-margin-b-60--xs g-margin-b-0--md">
            <div class="wow fadeInLeft" data-wow-duration=".3" data-wow-delay=".2s">
                <img class="img-responsive" src="{{ asset('assets/img/400x550/1.jpg')}}" alt="Image">
            </div>
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-5 g-hor-centered-row__col">
            <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">About Gallery</p>
            <h2 class="g-font-size-32--xs g-font-size-36--sm g-margin-b-25--xs">Experience A New View</h2>
            <p class="g-font-size-18--sm">Dhaka- Have you ever wondered what the world would look like upside down? A relatively new museum in Dhaka gives Bangladeshis a glimpse.</p>
            <a href="{{ route('aboutUs') }}" class="text-uppercase s-btn s-btn--md s-btn--dark-brd g-radius--50 g-padding-x-50--xs g-margin-b-20--xs">Know More</a>
        </div>

    </div>


</div>



<div class="g-container center-block g-margin-b-125--xs hide">
<div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".1s">
    <img class="img-responsive" src="{{ asset('assets/img/1920x500/eid.png')}}" alt="Mockup Image">
</div>
</div>

<!-- Process -->
<div class="g-bg-color--white">
    <div class="container g-padding-y-80--xs g-padding-y-125--sm">
        <div class="g-text-center--xs g-margin-b-100--xs">
            <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--dark-opacity g-letter-spacing--2 g-margin-b-25--xs">Process</p>
            <h2 class="g-font-size-32--xs g-font-size-36--sm g-color--dark">Buy Online Ticket</h2>
        </div>
        <ul class="list-inline row g-margin-b-100--xs">
            <!-- Process -->
            <li class="col-sm-3 col-xs-6 g-full-width--xs s-process-v1 g-margin-b-60--xs g-margin-b-0--md">
                <div class="center-block g-text-center--xs">
                    <div class="g-margin-b-30--xs">
                        <span class="g-display-inline-block--xs g-width-100--xs g-height-100--xs g-font-size-38--xs g-color--primary g-bg-color--dark g-box-shadow__dark-lightest-v4 g-padding-x-20--xs g-padding-y-20--xs g-radius--circle">01</span>
                    </div>
                    <div class="g-padding-x-20--xs">
                        <h3 class="g-font-size-18--xs g-color--dark">Choose Your Day</h3>
                        <p class="g-color--dark-opacity"></p>
                    </div>
                </div>
            </li>
            <!-- End Process -->

            <!-- Process -->
            <li class="col-sm-3 col-xs-6 g-full-width--xs s-process-v1 g-margin-b-60--xs g-margin-b-0--md">
                <div class="center-block g-text-center--xs">
                    <div class="g-margin-b-30--xs">
                        <span class="g-display-inline-block--xs g-width-100--xs g-height-100--xs g-font-size-38--xs g-color--primary g-bg-color--dark g-box-shadow__dark-lightest-v4 g-padding-x-20--xs g-padding-y-20--xs g-radius--circle">02</span>
                    </div>
                    <div class="g-padding-x-20--xs">
                        <h3 class="g-font-size-18--xs g-color--dark">Choose Your Time</h3>
                        <p class="g-color--dark-opacity"></p>
                    </div>
                </div>
            </li>
            <!-- End Process -->

            <!-- Process -->
            <li class="col-sm-3 col-xs-6 g-full-width--xs s-process-v1 g-margin-b-60--xs g-margin-b-0--sm">
                <div class="center-block g-text-center--xs">
                    <div class="g-margin-b-30--xs">
                        <span class="g-display-inline-block--xs g-width-100--xs g-height-100--xs g-font-size-38--xs g-color--primary g-bg-color--dark g-box-shadow__dark-lightest-v4 g-padding-x-20--xs g-padding-y-20--xs g-radius--circle">03</span>
                    </div>
                    <div class="g-padding-x-20--xs">
                        <h3 class="g-font-size-18--xs g-color--dark">Pay Online</h3>
                        <p class="g-color--dark-opacity"></p>
                    </div>
                </div>
            </li>
            <!-- End Process -->

            <!-- Process -->
            <li class="col-sm-3 col-xs-6 g-full-width--xs s-process-v1">
                <div class="center-block g-text-center--xs">
                    <div class="g-margin-b-30--xs">
                        <span class="g-display-inline-block--xs g-width-100--xs g-height-100--xs g-font-size-38--xs g-color--primary g-bg-color--dark g-box-shadow__dark-lightest-v4 g-padding-x-20--xs g-padding-y-20--xs g-radius--circle">04</span>
                    </div>
                    <div class="g-padding-x-20--xs">
                        <h3 class="g-font-size-18--xs g-color--dark">Get Your Ticket</h3>
                        <p class="g-color--dark-opacity"></p>
                    </div>
                </div>
            </li>
            <!-- End Process -->
        </ul>

        <div class="g-text-center--xs">
            <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".1s">
                <a href="{{route('ticket.create')}}" class="text-uppercase s-btn s-btn--md s-btn--dark-bg g-radius--50">Buy Ticket</a>
            </div>
        </div>
    </div>
</div>
<!-- End Process -->



<div class=" g-bg-fixed g-overlay" style="background: url({{ asset('assets/img/1920x300/3.gif')}}) 100% 0 no-repeat;">
    <div class="g-container--sm g-text-center--xs g-padding-y-80--xs g-padding-y-125--xsm">
        <div class="g-margin-b-60--xs">
            <p class="text-uppercase g-font-size-16--xs g-font-weight--700 g-color--white-opacity g-letter-spacing--2 g-margin-b-25--xs">Inviting Franchise</p>
            <h2 class="g-font-size-32--xs g-font-size-36--md g-letter-spacing--1 g-color--white-opacity">Start your own business</h2>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="g-text-center--xs ">
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".1s">
                        <a href="{{url('/franchise')}}" class="text-uppercase s-btn s-btn--xs s-btn--dark-brd s-btn--white-bg g-radius--50">Apply Now</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Branches -->
<div class="g-hor-divider__dashed--sky-light">
    <div class="container g-padding-y-80--xs g-padding-y-125--sm">
        <div class="g-text-center--xs g-margin-b-80--xs">
            <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Gallery</p>
            <h2 class="g-font-size-32--xs g-font-size-36--sm">Visit Our Gallery</h2>
        </div>
        <div class="row g-overflow--hidden">
            <div class="col-xs-6 g-full-width--xs g-margin-b-30--xs g-margin-b-0--lg">
                <!-- Branch 1 -->
                <div class="center-block g-box-shadow__dark-lightest-v1 g-width-100-percent--xs g-width-400--lg">
                    <img class="img-responsive g-width-100-percent--xs" src="{{ asset('assets/img/400x400/6.jpg')}}" alt="Image">
                    <div class="g-position--overlay g-padding-x-30--xs g-padding-y-30--xs g-margin-t-o-60--xs">
                        <div class="g-bg-color--orange g-padding-x-15--xs g-padding-y-10--xs g-margin-b-20--xs">
                            <h4 class="g-font-size-22--xs g-font-size-26--sm g-color--white g-margin-b-0--xs">Uttara Gallery</h4>
                        </div>

                        <div class="g-hor-divider__dashed--sky-light g-padding-x-15--xs g-padding-y-10--xs g-margin-b-20--xs">
                            <p class="g-font-weight--700">Address</p>
                            <p>House 29, Lutfa Garden, Garib E Newaz Avenue, Sector-13, Uttara, Dhaka</p>
                            <p>Phone: 01881288281</p>
                        </div>


                        <div class="g-text-center--xs">
                            <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".1s">

                                    <a href="{{url('/gallery-uttara')}}" class="text-uppercase s-btn s-btn--xs s-btn--dark-brd g-radius--50">Photos</a>
                                    <a href="{{route('ticket.create')}}" class="text-uppercase s-btn s-btn--xs s-btn--dark-brd g-radius--50">Buy Ticket</a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Branch -->
            </div>
            <div class="col-xs-6 g-full-width--xs t">
                <!-- Branch 2 -->
                <div class="center-block g-box-shadow__dark-lightest-v1 g-width-100-percent--xs g-width-400--lg">
                    <img class="img-responsive g-width-100-percent--xs" src="{{ asset('assets/img/400x400/1.jpg')}}" alt="Image">
                    <div class="g-position--overlay g-padding-x-30--xs g-padding-y-30--xs g-margin-t-o-60--xs  ">
                        <div class="g-bg-color--orange g-padding-x-15--xs g-padding-y-10--xs g-margin-b-20--xs">
                            <h4 class="g-font-size-22--xs g-font-size-26--sm g-color--white g-margin-b-0--xs">Lalmatia Gallery</h4>
                        </div>


                        <div class="g-hor-divider__dashed--sky-light g-padding-x-15--xs g-padding-y-10--xs g-margin-b-20--xs">
                            <p class="g-font-weight--700">Address</p>
                            <p>House 2/6, Block #C, Lalmatia, (Adajacent to Dhanmondi 27), Dhaka</p>
                            <p>Phone: 01615710070</p>
                        </div>
                        <div class="g-text-center--xs ">
                            <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".1s">
                                <a href="{{url('/gallery')}}" class="text-uppercase s-btn s-btn--xs s-btn--dark-brd g-radius--50">Photos</a>
                                <a href="{{route('ticket.create')}}" class="text-uppercase s-btn s-btn--xs s-btn--dark-brd g-radius--50">Buy Ticket</a>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- End Branch 2 -->
            </div>
        </div>
    </div>
</div>
<!-- End Branches -->



<div class=" g-bg-fixed g-overlay" style="background: url({{ asset('assets/img/1920x300/2.jpg')}}) 100% 0 no-repeat;">
    <div class="g-container--sm g-text-center--xs g-padding-y-80--xs g-padding-y-125--xsm">
        <div class="g-margin-b-60--xs">
            <p class="text-uppercase g-font-size-16--xs g-font-weight--700 g-color--white-opacity g-letter-spacing--2 g-margin-b-25--xs">Vaccination Brings Us Closer, Together.</p>
            <h2 class="g-font-size-32--xs g-font-size-36--md g-letter-spacing--1 g-color--white-opacity">Are You Vaccinated?</h2>
        </div>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="g-text-center--xs ">
                    <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".1s">
                        <a id="buy-ticket-btn" href="{{route('ticket.create')}}" class=" hidden text-uppercase s-btn s-btn--xs  s-btn--white-bg g-radius--50">BUY TICEKT</a>
                        <a  id="yes-btn" class=" text-uppercase s-btn s-btn--xs s-btn--white-bg g-radius--50">YES</a>
                        <a id="no-btn"  class="swap-btn text-uppercase s-btn s-btn--xs s-btn--white-bg g-radius--50">NO </a>
                        <a id="vaccine-reg-btn" href="https://surokkha.gov.bd/" target="_blank" class="hidden  text-uppercase s-btn s-btn--xs s-btn--white-bg g-radius--50">Register at SUROKKHA Web </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Offer & Promotion -->
<div class="container-fluid g-padding-y-80--xs g-padding-y-125--sm hide">
    <div class="g-text-center--xs g-margin-b-80--xs">
        <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Save Money, Enoy More</p>
        <h2 class="g-font-size-32--xs g-font-size-36--sm">OFFER & PROMOTION</h2>
    </div>
    <!-- Swiper -->
    <div class="s-swiper js__swiper-news">
        <!-- Wrapper -->
        <div class="swiper-wrapper g-margin-b-60--xs">
            @foreach ($bundles as $bundle)
            <article class="s-promo-block-v4 g-bg-position--center swiper-slide" style="background: url({{ !empty($bundle->photo) && Storage::disk('public')->exists($bundle->photo) ? Storage::disk('public')->url($bundle->photo) : 'https://via.placeholder.com/400x500.png/ddd/333' }})">
                <div class="g-text-center--xs g-padding-x-15--xs g-padding-x-30--lg g-padding-y-50--xs g-margin-t-120--xs">
                    <div class="g-margin-b-25--xs">
                        <h3 class="g-font-size-16--xs g-color--white g-margin-b-5--xs">{{ $bundle->title }} - {{ $bundle->branch->name }}</h3>
                        <p class="g-color--white">{{ $bundle->subtitle }}</p>
                    </div>
                    <a href="{{ route('ticket.create', ['bundle' => $bundle->title, 'branch' => $bundle->branch->name]) }}" class="text-uppercase s-btn s-btn--xs s-btn--white-brd g-radius--50">Get</a>
                </div>
            </article>
            @endforeach
        </div>
        <!-- End Wrapper -->
    </div>
        <!-- Pagination -->
        <div class="s-swiper__pagination-v1 s-swiper__pagination-v1--dark g-text-center--xs js__swiper-pagination">

        </div>
    
    <!-- End Swiper -->
</div>
<!-- End Offer & Promotion -->



<!-- Photo Gallery -->
<div class="container g-text-center--xs g-padding-y-80--xs">
    <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Number One In Entertainment</p>
    <h2 class="g-font-size-32--xs g-font-size-36--sm">Photo Gallery</h2>
</div>
<!-- Gallery -->
<div class="row g-row-col--0">
    <div class="col-md-3 col-xs-6 g-full-width--xs">
        <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".1s">
            <!-- Photo -->
            <div class="s-team-v1">
                <img class="img-responsive g-width-100-percent--xs" src="{{ asset('assets/img/400x400/1.jpg')}}" alt="Image">

            </div>
            <!-- End Photo -->
        </div>
    </div>
    <div class="col-md-3 col-xs-6 g-full-width--xs">
        <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".2s">
            <!-- Photo -->
            <div class="s-team-v1">
                <img class="img-responsive g-width-100-percent--xs" src="{{ asset('assets/img/400x400/2.jpg')}}" alt="Image">

            </div>
            <!-- End Photo -->
        </div>
    </div>
    <div class="col-md-3 col-xs-6 g-full-width--xs">
        <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".3s">
            <!-- Photo -->
            <div class="s-team-v1">
                <img class="img-responsive g-width-100-percent--xs" src="{{ asset('assets/img/400x400/3.jpg')}}" alt="Image">

            </div>
            <!-- End Photo -->
        </div>
    </div>
    <div class="col-md-3 col-xs-6 g-full-width--xs">
        <div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".4s">
            <!-- Photo -->
            <div class="s-team-v1">
                <img class="img-responsive g-width-100-percent--xs" src="{{ asset('assets/img/400x400/4.jpg')}}" alt="Image">

            </div>
            <!-- End Photo -->
        </div>
    </div>

</div>

</div>
<!-- End Photo -->


<!-- Service -->
<div class="clearfix">

    <div class="row g-row-col--0">
        <div class="col-sm-4">
            <div class="g-text-center--xs g-padding-x-30--xs g-padding-x-50--lg g-padding-y-70--xs">
                <i class="g-display-block--xs g-font-size-40--sm g-color--primary g-margin-b-30--xs ti-camera"></i>
                <span class="g-display-block--xs g-font-size-13--sm g-letter-spacing--3 g-margin-b-25--xs">01</span>
                <h2 class="g-font-size-26--xs g-font-family--playfair">Photography</h2>
                <ul class="list-unstyled g-ul-li-tb-3--xs">
                    <li><a href="">DSLR (40-50) Photos</a></li>
                    <li><a href="">300 BDT</a></li>
                    <li><a href="">DSLR (90-100) Photos</a></li>
                    <li><a href="">500 BDT</a></li>
                    <li><a href="">Mobile Photography Free</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="g-bg-color--sky-light g-text-center--xs g-padding-x-30--xs g-padding-x-50--lg g-padding-y-70--xs">
                <i class="g-display-block--xs g-font-size-40--sm g-color--primary g-margin-b-30--xs ti-ticket"></i>
                <span class="g-display-block--xs g-font-size-13--sm g-letter-spacing--3 g-margin-b-25--xs">02</span>
                <h2 class="g-font-size-26--xs g-font-family--playfair">Entry</h2>
                <ul class="list-unstyled g-ul-li-tb-3--xs">
                    <li><a href="">Adult Per Person</a></li>
                    <li><a href=""> 400 BDT </a></li>
                    <li><a href="">Child (4-10) Per Person</a></li>
                    <li><a href=""> 250 BDT</a></li>
                    <li><a href=""> Kids (0-3) Free</a></li>
                </ul>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="g-text-center--xs g-padding-x-30--xs g-padding-x-50--lg g-padding-y-70--xs">
                <i class="g-display-block--xs g-font-size-40--sm g-color--primary g-margin-b-30--xs ti-timer"></i>
                <span class="g-display-block--xs g-font-size-13--sm g-letter-spacing--3 g-margin-b-25--xs">03</span>
                <h2 class="g-font-size-26--xs g-font-family--playfair">Visiting</h2>
                <ul class="list-unstyled g-ul-li-tb-3--xs">
                    <li><a href="">Saturday To Friday</a></li>
                    <li><a href="">Dhanmondi: 12pm To 10pm</a></li>
                    <li><a href="">Uttara: 2pm To 10pm</a></li>
                    <li><a href="">Lalmatia 01615710070</a></li>
                    <li><a href="">Uttara 01881288281</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End Service -->


<!-- Counter -->
<div class="js__parallax-window" style="background: url({{ asset('assets/img/1920x1080/a19.jpg')}}) 50% 0 no-repeat fixed;">
    <div class="container g-padding-y-80--xs g-padding-y-125--sm">
        <div class="g-text-center--xs g-margin-b-80--xs">
            <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--white-opacity-light g-letter-spacing--2 g-margin-b-25--xs g-color--white-opacity">Facts in Numbers</p>
            <h2 class="g-font-size-32--xs g-font-size-36--md g-font-family--playfair g-letter-spacing--1 g-color--white">You Can Make Us Better</h2>
        </div>
        <div class="row">
            <div class="col-md-3 col-xs-6 g-full-width--xs g-margin-b-70--xs g-margin-b-0--lg">
                <div class="g-text-center--xs">
                    <div class="g-margin-b-10--xs">
                        <figure class="g-display-inline-block--xs g-font-size-70--xs g-font-family--playfair g-color--white js__counter">50000</figure>
                        <span class="g-font-size-40--xs g-font-family--playfair g-color--white">+</span>
                    </div>
                    <div class="center-block g-hor-divider__solid--white g-width-40--xs g-margin-b-25--xs"></div>
                    <h4 class="g-font-size-18--xs g-color--white">Visitor</h4>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 g-full-width--xs g-margin-b-70--xs g-margin-b-0--lg">
                <div class="g-text-center--xs">
                    <figure class="g-display-block--xs g-font-size-70--xs g-font-family--playfair g-color--white g-margin-b-10--xs js__counter">32</figure>
                    <div class="center-block g-hor-divider__solid--white g-width-40--xs g-margin-b-25--xs"></div>
                    <h4 class="g-font-size-18--xs g-color--white">Shades Of Colour</h4>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 g-full-width--xs g-margin-b-70--xs g-margin-b-0--sm">
                <div class="g-text-center--xs">
                    <figure class="g-display-block--xs g-font-size-70--xs g-font-family--playfair g-color--white g-margin-b-10--xs js__counter">13</figure>
                    <div class="center-block g-hor-divider__solid--white g-width-40--xs g-margin-b-25--xs"></div>
                    <h4 class="g-font-size-18--xs g-color--white">Exihibition Released</h4>
                </div>
            </div>
            <div class="col-md-3 col-xs-6 g-full-width--xs">
                <div class="g-text-center--xs">
                    <div class="g-margin-b-10--xs">
                        <figure class="g-display-inline-block--xs g-font-size-70--xs g-font-family--playfair g-color--white js__counter">100</figure>
                        <span class="g-font-size-40--xs g-font-family--playfair g-color--white">%</span>
                    </div>
                    <div class="center-block g-hor-divider__solid--white g-width-40--xs g-margin-b-25--xs"></div>
                    <h4 class="g-font-size-18--xs g-color--white">New Experience</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Counter -->


<!-- Portfolio -->
<div class="container g-padding-y-80--xs g-padding-y-125--xsm">
    <div class="row g-margin-b-30--xs">
        <div class="col-sm-4">
            <div class="g-margin-t-20--md g-margin-b-40--xs">
                <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Branding Work</p>
                <h2 class="g-font-size-32--xs g-font-size-36--md">Book For Shoot</h2>
                <p>Are you a vlogger, photorgapher or social media content maker, Upside Down BD is a perfect destination for you to make your content more creative & unique.</p>
                <a href="{{ route('promotions') }}" class="text-uppercase s-btn s-btn--xs s-btn--dark-brd g-radius--50 g-padding-x-20--xs g-margin-b-10--xs">Know More</a>
            </div>
        </div>

        <div class="col-sm-8">
            <!-- Portfolio Gallery -->
            <div id="js__grid-portfolio-gallery" class="s-portfolio__paginations-v1 cbp">
                <!-- Item -->
                <div class="s-portfolio__item cbp-item motion graphic">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('assets/img/media/kornia.jpg')}}" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h3 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Music Video</h3>
                            <p class="g-color--white-opacity">Know More</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('assets/img/media/kornia.jpg')}}" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by Upside Down BD.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('https://www.youtube.com/watch?v=VmBcK8l_bfk')}}" target="blank" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item logos graphic">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('assets/img/media/zaki.jpg')}}" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Music Video</h4>
                            <p class="g-color--white-opacity">Know more</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('assets/img/media/zaki.jpg')}}" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by Upside Down BD.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('https://www.youtube.com/watch?v=a-9gS7wawcc')}}" target="blank" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item logos motion">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('assets/img/media/salman.jpg')}}" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">YouTube</h4>
                            <p class="g-color--white-opacity">Know more</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('assets/img/media/salman.jpg')}}" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by Upside Down BD.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('https://www.youtube.com/watch?v=x8Zr_r55y14')}}" target="blank" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                 <!-- Item -->
                 <div class="s-portfolio__item cbp-item motion graphic">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('assets/img/media/ayesha.jpg')}}" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h3 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Music Video</h3>
                            <p class="g-color--white-opacity">Know More</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('assets/img/media/ayesha.jpg')}}" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by Upside Down BD.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('https://www.youtube.com/watch?v=dvOBAYExM2c')}}" target="blank" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item logos graphic">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('assets/img/media/zaki.jpg')}}" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">Music Video</h4>
                            <p class="g-color--white-opacity">Know more</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('assets/img/media/zaki.jpg')}}" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by Upside Down BD.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('https://www.youtube.com/watch?v=a-9gS7wawcc')}}" target="blank" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Item -->
                <div class="s-portfolio__item cbp-item logos motion">
                    <div class="s-portfolio__img-effect">
                        <img src="{{ asset('assets/img/media/salman.jpg')}}" alt="Portfolio Image">
                    </div>
                    <div class="s-portfolio__caption-hover--cc">
                        <div class="g-margin-b-25--xs">
                            <h4 class="g-font-size-18--xs g-color--white g-margin-b-5--xs">YouTube</h4>
                            <p class="g-color--white-opacity">Know more</p>
                        </div>
                        <ul class="list-inline g-ul-li-lr-5--xs g-margin-b-0--xs">
                            <li>
                                <a href="{{ asset('assets/img/media/salman.jpg')}}" class="cbp-lightbox s-icon s-icon--sm s-icon--white-bg g-radius--circle" data-title="Portfolio Item <br/> by Upside Down BD.">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                            <li>
                                <a href="{{url('https://www.youtube.com/watch?v=x8Zr_r55y14')}}" target="blank" class="s-icon s-icon--sm s-icon s-icon--white-bg g-radius--circle">
                                    <i class="ti-link"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                 <!-- Item -->
            </div>
            <!-- End Portfolio Gallery -->
        </div>
    </div>
</div>


<div class=" g-bg-color--dark-light">
    <div class="container g-padding-y-80--xs g-padding-y-125--xsm ">

        <div class="row g-hor-centered-row--md g-row-col--5 ">
            <div class="col-sm-5 g-hor-centered-row__col">
                <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--light g-letter-spacing--2 g-margin-b-25--xs">Cafe</p>
                <h2 class="g-font-size-32--xs g-font-size-36--sm g-margin-b-25--xs g-color--white">TRY OUR PIZZA & WINGS</h2>
                <p class="g-font-size-18--sm g-color--white">Tasty & Hygenic! We will be offering delicious, mouth watering Pizza items with imported quality Cheese</p>
            </div>
            <div class="col-sm-1"></div>


            <div class="col-sm-5 g-hor-centered-row__col g-box-shadow__blueviolet-v1">
                
                <img class="img-responsive" src="{{ asset('assets/img/970x647/menu.jpg')}}" alt="Mockup Image">
            </div>
        </div>


    </div>
</div>





<!-- Testimonials -->

<div class="g-padding-y-80--xs  g-position--relative g-bg-color--sky-light">
    <div class="container g-text-center--xs g-padding-y-80--xs">
        <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Feedback makes us better</p>
        <h2 class="g-font-size-32--xs g-font-size-36--sm g-color--dark">What People Say About Us</h2>
    </div>
    <div class="container g-text-center--xs">
        <div class="s-swiper js__swiper-testimonials">
            <!-- Swiper Wrapper -->
            <div class="swiper-wrapper g-margin-b-50--xs">
                <div class="swiper-slide g-padding-x-130--sm g-padding-x-150--lg">
                    <div class="g-padding-x-20--xs g-padding-x-50--lg">
                        <img class="g-width-70--xs g-height-70--xs g-hor-border-4__solid--white g-box-shadow__primary-v1 g-radius--circle g-margin-b-30--xs" src="assets/img/400x400/fb.png" alt="Image">
                        <div class="g-margin-b-40--xs">
                            <p class="g-font-size-22--xs g-font-size-28--sm g-font-family--playfair g-color--primary"><i>" Very nice place for capturing a different environment with a very well behaved assistance. Must visit place for friends and families for experiencing a new reverse world. "</i></p>
                        </div>
                        <div class="center-block g-hor-divider__solid--heading-light g-width-100--xs g-margin-b-30--xs"></div>
                        <h4 class="g-font-size-15--xs g-font-size-18--sm g-font-weight--400 g-font-family--primary g-color--primary g-margin-b-5--xs">Farazi Mohammad Mujib / Facebook</h4>
                    </div>
                </div>
                <div class="swiper-slide g-padding-x-130--sm g-padding-x-150--lg">
                    <div class="g-padding-x-20--xs g-padding-x-50--lg">
                        <img class="g-width-70--xs g-height-70--xs g-hor-border-4__solid--white g-box-shadow__primary-v1 g-radius--circle g-margin-b-30--xs" src="assets/img/400x400/google.png" alt="Image">
                        <div class="g-margin-b-40--xs">
                            <p class="g-font-size-22--xs g-font-size-28--sm g-font-family--playfair g-color--primary"><i>" First of all it is a very unique place to gather new experience in your life.It is a reversible earth.I got the pleasure of floating on an inverted earth.This is the first in Bangladesh. Many many thanks and best wishes to founder & all member of gallery.
                                    "</i></p>
                        </div>
                        <div class="center-block g-hor-divider__solid--heading-light g-width-100--xs g-margin-b-30--xs"></div>
                        <h4 class="g-font-size-15--xs g-font-size-18--sm g-font-weight--400 g-font-family--primary g-color--primary g-margin-b-5--xs">Mishal Islam/ Google</h4>
                    </div>
                </div>
                <div class="swiper-slide g-padding-x-130--sm g-padding-x-150--lg">
                    <div class="g-padding-x-20--xs g-padding-x-50--lg">
                        <img class="g-width-70--xs g-height-70--xs g-hor-border-4__solid--white g-box-shadow__primary-v1 g-radius--circle g-margin-b-30--xs" src="assets/img/400x400/fb.png" alt="Image">
                        <div class="g-margin-b-40--xs">
                            <p class="g-font-size-22--xs g-font-size-28--sm g-font-family--playfair g-color--primary"><i>" 10/10 would recommend this place! The environment, ambience, customer service was also so good. Awesome Decorations. A great place for spending memorable time with family & friends. "</i></p>
                        </div>
                        <div class="center-block g-hor-divider__solid--heading-light g-width-100--xs g-margin-b-30--xs"></div>
                        <h4 class="g-font-size-15--xs g-font-size-18--sm g-font-weight--400 g-font-family--primary g-color--primary g-margin-b-5--xs">MH Sanji / Facebook</h4>
                    </div>
                </div>

            </div>
            <!-- End Swipper Wrapper -->

            <!-- Arrows -->
            <div class="g-font-size-22--xs g-color--primary js__swiper-fraction"></div>
            <a href="javascript:void(0);" class="g-display-none--xs g-display-inline-block--sm s-swiper__arrow-v1--right s-icon s-icon--md s-icon--primary-brd g-radius--circle ti-angle-right js__swiper-btn--next"></a>
            <a href="javascript:void(0);" class="g-display-none--xs g-display-inline-block--sm s-swiper__arrow-v1--left s-icon s-icon--md s-icon--primary-brd g-radius--circle ti-angle-left js__swiper-btn--prev"></a>
            <!-- End Arrows -->
        </div>
    </div>
</div>
<!-- End Testimonials -->







<div class="container g-text-center--xs  g-padding-y-40--xs g-padding-y-80--sm">
    <p class="text-uppercase g-font-size-14--xs g-font-weight--700 g-color--primary g-letter-spacing--2 g-margin-b-25--xs">Most Popular In Town</p>
    <h2 class="g-font-size-32--xs g-font-size-36--sm">Media Coverage</h2>
</div>

<!-- Clients -->
<div class="g-padding-y-80--xs g-padding-y-125--sm">

    <div class="g-container--md">
        <!-- Swiper Clients -->
        <div class="s-swiper js__swiper-clients">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".1s">
                        <img class="s-clients-v1" src="{{ asset('assets/img/clients/1.png')}}" alt="Clients Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".2s">
                        <img class="s-clients-v1" src="{{ asset('assets/img/clients/3.png')}}" alt="Clients Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".3s">
                        <img class="s-clients-v1" src="{{ asset('assets/img/clients/4.png')}}" alt="Clients Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".4s">
                        <img class="s-clients-v1" src="{{ asset('assets/img/clients/6.png')}}" alt="Clients Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".5s">
                        <img class="s-clients-v1" src="{{ asset('assets/img/clients/12.png')}}" alt="Clients Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".5s">
                        <img class="s-clients-v1" src="{{ asset('assets/img/clients/13.png')}}" alt="Clients Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".5s">
                        <img class="s-clients-v1" src="{{ asset('assets/img/clients/7.png')}}" alt="Clients Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".5s">
                        <img class="s-clients-v1" src="{{ asset('assets/img/clients/8.png')}}" alt="Clients Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".5s">
                        <img class="s-clients-v1" src="{{ asset('assets/img/clients/9.png')}}" alt="Clients Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".5s">
                        <img class="s-clients-v1" src="{{ asset('assets/img/clients/10.png')}}" alt="Clients Logo">
                    </div>
                </div>
                <div class="swiper-slide">
                    <div class="wow fadeIn" data-wow-duration=".3" data-wow-delay=".5s">
                        <img class="s-clients-v1" src="{{ asset('assets/img/clients/11.png')}}" alt="Clients Logo">
                    </div>
                </div>
            </div>
        </div>
        <!-- End Swiper Clients -->
    </div>
</div>
<!-- End Clients -->

<div class="g-container center-block g-margin-b-125--xs">
<div class="wow fadeInUp" data-wow-duration=".3" data-wow-delay=".1s">
    <img class="img-responsive" src="{{ asset('assets/img/ssl-commerz-new.png')}}" alt="Mockup Image">
</div>
</div>





<!--========== END PAGE CONTENT ==========-->


<!-- Messenger Chat Plugin Code -->
<div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>


@endsection

@section('page_script_plugin')

<!-- Vendor -->

<script type="text/javascript" src="{{ asset('vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('vendor/swiper/swiper.jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('vendor/jquery.parallax.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('vendor/jquery.wow.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('vendor/cubeportfolio/js/jquery.cubeportfolio.min.js')}}"></script>

@endsection

@section('page_script_component')
<!-- General Components and Settings -->

<script type="text/javascript" src="{{ asset('js/components/magnific-popup.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/components/swiper.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/components/parallax.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/components/portfolio-4-col-slider.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/components/wow.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/custom.js')}}"></script>
<!--========== END JAVASCRIPTS ==========-->
<!-- END: LAYOUT PLUGINS -->




    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "271002013836740");
      chatbox.setAttribute("attribution", "biz_inbox");

      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v11.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>

@endsection
