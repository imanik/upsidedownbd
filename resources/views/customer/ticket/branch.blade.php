@extends('layouts.front')

@section('header')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
    <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
        <div class="flex-1 flex items-center min-w-0 h-10">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-4">
                    <li>
                        <div>
                            <a href="/" class="text-gray-400 hover:text-gray-500">
                                <!-- Heroicon name: solid/home -->
                                <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
                                <span class="sr-only">{{ __('Home') }}</span>
                            </a>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                            <a href="{{ route('ticket.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Tickets') }}</a>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">{{ __('Create Page') }}</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">

    @include('partials.alert')

    <section class="text-gray-800 body-font">
        <div class="my-6">
            <h2 class="text-2xl text-center text-gray-700 font-medium title-font mb-2"> {{ __('Select branch You want to visit') }} </h2>
        </div>

        <div class="max-w-4xl mx-auto grid sm:grid-cols-2 gap-5 mb-4">
            @foreach ($branches as $branch)
            @if (empty($branch->photo))
            <a @if ($branch->status == "active") href="{{ route('ticket.create', ['branch' => $branch->name]) }}" @endif @if($branch->photo) style="background-image: url('{{ Storage::url($branch->photo) }}');" @endif class="flex items-center flex-wrap w-full @if ($branch->status == "active") border-yellow-200 @endif bg-yellow-100 hover:bg-yellow-200 border-2 border-dashed rounded-md sm:px-10 px-6 relative h-56">
                <div class="text-center relative z-10 w-full">
                    <h2 class="text-xl text-gray-900 font-medium title-font mb-2"> {{ $branch->name }} </h2>
                    @if(!empty($branch->address))
                    <p class="flex justify-center items-start leading-relaxed mb-3 font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $branch->address }}
                    </p>
                    @endif
                    @if ($branch->status != "active")
                    <p class="flex justify-center items-start tracking-wider">{{ App\Helpers::asText($branch->status) }}</p>
                    @endif
                </div>
            </a>
            @else
            <div class="relative">
                <a href="{{ route('ticket.create', ['branch' => $branch->name]) }}" class="absolute inset-0 z-10 bg-yellow-100 hover:bg-yellow-200 border-2 border-dashed border-yellow-200 rounded-md text-center flex flex-col items-center justify-center bg-opacity-40 hover:opacity-10 duration-300">
                    <h2 class="text-xl text-gray-900 font-medium title-font mb-2"> {{ $branch->name }} </h2>
                    @if(!empty($branch->address))
                    <p class="flex justify-center items-start leading-relaxed mb-3 px-10 font-bold">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        {{ $branch->address }}
                    </p>
                    @endif
                    @if ($branch->status != "active")
                    <p class="flex justify-center items-start tracking-wider">{{ App\Helpers::asText($branch->status) }}</p>
                    @endif
                </a>
                <a class="relative">
                    <div class="h-full flex flex-wrap content-center">
                        <img class="object-fill h-56 w-full rounded-md" src="{{ Storage::url($branch->photo) }}">
                    </div>
                </a>
            </div>
            @endif
            @endforeach
        </div>


        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 hidden">
            <!-- We've used 3xl here, but feel free to try other max-widths based on your needs -->
            <div class="max-w-4xl mx-auto my-12 ">
                <!-- Content goes here -->
                <img src="{{ asset('assets/img/1920x500/eid.png') }}" alt="" class="object-cover hidden md:block">
                 </div>
        </div>
        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- We've used 3xl here, but feel free to try other max-widths based on your needs -->
            <div class="max-w-4xl mx-auto my-12">
                <!-- Content goes here -->
                <img src="{{ asset('assets/img/ssl-commerz-new.png') }}" alt="" class="object-cover hidden md:block">
                <img src="{{ asset('assets/img/ssl-commerz-new.png') }}" alt="" class="object-cover md:hidden">
            </div>
        </div>
    </section>
</div>

<!-- Messenger Chat Plugin Code -->
<div id="fb-root"></div>

    <!-- Your Chat Plugin code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>


@endsection

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