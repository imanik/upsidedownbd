@php
    $settings = App\Models\Setting::pluck('value', 'name')->toArray();
@endphp
<footer class="w-full text-gray-700 body-font border-t">
    {{-- <div class="bg-brand px-4">
        <div class="max-w-7xl mx-auto">
            <div class="py-8 sm:py-12 mx-auto text-center sm:text-left flex flex-wrap flex-col sm:flex-row md:flex-no-wrap lg:items-start">
                <div class="w-full md:w-1/3 text-center md:text-left">
                    <h2 class="title-font font-semibold text-gray-900 tracking-widest text-base mb-3">{{ __('Here with us') }}</h2>
                    <nav class="list-none">
                        @if (Route::has('about'))
                        <li>
                            <a class="text-gray-800 hover:text-gray-900 text-sm" href="{{ route('about') }}"> {{ __('About') }} </a>
                        </li>
                        @endif
                        @if (Route::has('our-service'))
                        <li>
                            <a class="text-gray-800 hover:text-gray-900 text-sm" href="{{ route('our-service') }}"> {{ __('Our Service') }} </a>
                        </li>
                        @endif
                        @if (Route::has('terms-conditions'))
                        <li>
                            <a class="text-gray-800 hover:text-gray-900 text-sm" href="{{ route('terms-conditions') }}"> {{ __('Terms & Condition') }} </a>
                        </li>
                        @endif
                        @if (Route::has('career'))
                        <li>
                            <a class="text-gray-800 hover:text-gray-900 text-sm" href="{{ route('career') }}"> {{ __('Careers') }} </a>
                        </li>
                        @endif
                        @if (Route::has('contact'))
                        <li>
                            <a class="text-gray-800 hover:text-gray-900 text-sm" href="{{ route('contact') }}"> {{ __('Contact Us') }} </a>
                        </li>
                        @endif
                    </nav>
                </div>
                <div class="w-full md:w-1/3 text-center md:text-left mt-6 md:mt-0 py-4 sm:py-0 lg:pl-28">
                    <h2 class="title-font font-semibold text-gray-900 tracking-widest text-base mb-3">{{ __('Hotline') }}</h2>
                    <nav class="list-none">
                        <li>
                            <a href="#" class="text-gray-800 hover:text-gray-900 text-sm tracking-widest">{{ App\Helpers::trans('+880-XXXX-XXXXXX') }}</a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-800 hover:text-gray-900 text-sm tracking-widest">{{ App\Helpers::trans('+880-XXXX-XXXXXX') }}</a>
                        </li>
                    </nav>
                </div>
                <div class="w-full md:w-1/3 mt-6 md:mt-0">
                    <a class="flex title-font font-semibold items-center md:justify-end justify-center text-gray-900">
                        <img class="h-20 md:h-28 w-auto px-4 py-3" src="{{ asset('/img/logo-alt.png') }}" alt="Color logo" />
                    </a>
                    <!-- <p class="mt-2 text-sm text-gray-500">Air plant banjo lyft occupy retro adaptogen indego</p> -->
                </div>
            </div>
        </div>
    </div> --}}
    <div class="bg-brand-deep border-brand-deep border-t px-4">
        <div class="max-w-7xl mx-auto py-4 flex flex-wrap flex-col sm:flex-row">
            <p class="text-gray-900 py-3 text-center rounded-full text-sm sm:text-left">&copy;{{ date('Y ').config('app.name', 'Laravel')}}</p>
            <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                <a class="mx-2 text-gray-500 py-3 text-center inline-flex items-center justify-center w-10 h-10 shadow-lg rounded-full bg-white cursor-pointer" href="{{ $settings['facebook_link'] ?? '#' }}" target="_blank">
                    <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                        <path class="text-blue-600" d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                    </svg>
                </a>
                <!-- Don't Delete Bellow Section-->
                <!-- <a class="ml-3 mx-2 text-gray-500 p-3 text-center inline-flex items-center justify-center w-10 h-10 shadow-lg rounded-full bg-white cursor-pointer"><svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24"><path class="text-blue-300" d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z"></path></svg></a> -->
                <!-- <a class="ml-3 mx-2 text-gray-500 p-3 text-center inline-flex items-center justify-center w-10 h-10 shadow-lg rounded-full bg-white cursor-pointer"><svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24"><rect class="text-red-300" width="20" height="20" x="2" y="2" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path></svg></a> -->
                <!-- <a class="ml-3 mx-2 text-gray-500 p-3 text-center inline-flex items-center justify-center w-10 h-10 shadow-lg rounded-full bg-white cursor-pointer"><svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24"><path class="text-blue-400" stroke="none" d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path><circle cx="4" cy="4" r="2" stroke="none"></circle></svg></a>  -->
            </span>
        </div>

    </div>
</footer>
