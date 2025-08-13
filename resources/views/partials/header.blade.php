<header x-data="{ open: false }" class="w-full bg-brand text-brand-alt relative px-4 border-b">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center lg:justify-start lg:space-x-10">
            <div class="flex justify-start">
                <a class="flex justify-center items-center" href="/">
                    <span class="sr-only"></span>
                    <img class="w-auto h-16 sm:h-20 py-3" src="{{ asset('img/logo.png') }}" alt="">
                    <span class="sr-only ml-3 text-3xl font-bold">{{ config('app.name', 'Laravel') }}</span>
                </a>
            </div>
            <div class="flex lg:hidden">
                @if (Auth::check())
                <!-- Notification dropdown -->

                <!-- Profile dropdown -->
                <div x-on:click.away="open = false" class="relative rounded-md p-2 inline-flex items-center justify-center text-gray-700 hover:text-gray-800 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-black" x-data="{ open: false }">
                    <div>
                        <button x-on:click="open = !open" type="button" class="max-w-xs rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 lg:p-2 lg:rounded-md" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->image && Storage::exists('thumbnails/' . Auth::user()->image->path) ? Storage::url('thumbnails/' . Auth::user()->image->path) : '/img/user.jpg' }}" alt="">
                            <span class="hidden ml-3 text-gray-700 text-sm font-medium lg:block">
                                <span class="sr-only">Open user menu for </span>
                                {{ Auth::user()->name }}
                            </span>
                            <svg class="hidden flex-shrink-0 ml-1 w-5 h-5 text-gray-400 lg:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>
                    <div x-show="open" style="display: none;" class="origin-top-right absolute top-0 right-0 mt-12 w-48 rounded-md shadow-lg z-50"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95" x-description="Profile dropdown panel, show/hide based on dropdown state.">
                        <div class="p-1 rounded-md bg-white shadow-xs z-50 divide-y divide-gray-100" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                            <div class="">
                                <a href="{{ route('customer.profile') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 rounded-md mb-1 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out" role="menuitem">
                                    <div class="flex justify-start items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                        {{ __('Profile') }}
                                    </div>
                                </a>
                                <a href="{{ route('customer.password') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 rounded-md mb-1 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out" role="menuitem">
                                    <div class="flex justify-start items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" />
                                        </svg>
                                        {{ __('Change Password') }}
                                    </div>
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 rounded-md border border-gray-300 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out" role="menuitem" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div class="flex justify-start items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        {{ __('Log out') }}
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <button type="button" x-on:click="open = !open" class="rounded-md p-2 inline-flex items-center justify-center text-gray-800 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-black" aria-expanded="false">
                    <span class="sr-only">Open menu</span>
                    <!-- Heroicon name: outline/menu -->
                    <svg class="w-5 h-5" xmlns="https://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
            <nav class="hidden lg:flex items-center justify-end space-x-5 xl:space-x-5 lg:flex-1 lg:w-0">
                @if (Auth::check())
                <!-- Notification dropdown -->
                @if (empty(Auth::user()->is_admin) && empty(Auth::user()->role))
                <a href="{{ route('customer.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-semibold tracking-wider leading-5 {{ request()->route()->named('customer.dashboard') ? 'text-white bg-gray-800' : 'text-gray-800 hover:text-white' }} hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-800 transition duration-150 ease-in-out">{{ __('Dashboard') }}</a>
                <a href="{{ route('customer.tickets') }}" class="px-3 py-2 rounded-md text-sm font-semibold tracking-wider leading-5 {{ request()->route()->named('customer.tickets') ? 'text-white bg-gray-800' : 'text-gray-800 hover:text-white' }} hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-800 transition duration-150 ease-in-out">{{ __('Tickets') }}</a>
                <a href="{{ route('customer.bundles') }}" class="px-3 py-2 rounded-md text-sm font-semibold tracking-wider leading-5 {{ request()->route()->named('customer.bundles') ? 'text-white bg-gray-800' : 'text-gray-800 hover:text-white' }} hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-800 transition duration-150 ease-in-out">{{ __('Bundles') }}</a>
                @endif
                <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-semibold tracking-wider leading-5 {{ request()->route()->named('dashboard') ? 'text-white bg-gray-800' : 'text-gray-800 hover:text-white' }} hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-800 transition duration-150 ease-in-out">{{ __('Dashboard') }}</a>

                <!-- Profile dropdown -->
                <div x-on:click.away="open = false" class="ml-3 relative" x-data="{ open: false }">
                    <div>
                        <button x-on:click="open = !open" type="button" class="max-w-xs rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 lg:p-2 lg:rounded-md" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                            <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->image && Storage::exists('thumbnails/' . Auth::user()->image->path) ? Storage::url('thumbnails/' . Auth::user()->image->path) : '/img/user.jpg' }}" alt="">
                            <span class="hidden ml-3 text-gray-700 text-sm font-medium lg:block">
                                <span class="sr-only">Open user menu for </span>
                                {{ Auth::user()->name }}
                            </span>
                            <svg class="hidden flex-shrink-0 ml-1 w-5 h-5 text-gray-400 lg:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </button>
                    </div>

                    <div x-show="open" style="display: none;" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg z-50"
                        x-transition:enter="transition ease-out duration-100"
                        x-transition:enter-start="transform opacity-0 scale-95"
                        x-transition:enter-end="transform opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-75"
                        x-transition:leave-start="transform opacity-100 scale-100"
                        x-transition:leave-end="transform opacity-0 scale-95" x-description="Profile dropdown panel, show/hide based on dropdown state.">
                        <div class="p-1 rounded-md bg-white shadow-xs z-50 divide-y divide-gray-100" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                            <div class="">
                                <a href="{{ route('customer.profile') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 rounded-md mb-1 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out" role="menuitem">
                                    <div class="flex justify-start items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                        {{ __('Profile') }}
                                    </div>
                                </a>
                                <a href="{{ route('customer.password') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 rounded-md mb-1 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out" role="menuitem">
                                    <div class="flex justify-start items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" /></svg>
                                        {{ __('Change Password') }}
                                    </div>
                                </a>
                                <a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 rounded-md border border-gray-300 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out" role="menuitem" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <div class="flex justify-start items-center gap-3">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                        {{ __('Log out') }}
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-semibold tracking-wider leading-5 {{ request()->route()->named('login') ? 'text-white bg-gray-800' : 'text-gray-800 hover:text-white' }} hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-800 transition duration-150 ease-in-out">{{ __('Log in') }}</a>
                @endif
            </nav>
        </div>
    </div>

    <div x-show="open" style="display: none;" class="absolute top-0 z-50 inset-x-0 p-2 bg-white transition transform origin-top-right"
        x-transition:enter="transition ease-out duration-100"
        x-transition:enter-start="transform opacity-0 scale-95"
        x-transition:enter-end="transform opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-75"
        x-transition:leave-start="transform opacity-100 scale-100"
        x-transition:leave-end="transform opacity-0 scale-95">

        <div class="bg-brand rounded-lg shadow-lg ring-1 ring-black ring-opacity-5 divide-y-2 divide-gray-50">
            <div class="pt-5 pb-6 px-5">
                <div class="flex items-center justify-between">
                    <div class="flex justify-center items-center">
                        <img class="w-auto h-12 sm:h-20 px-3" src="{{ asset('img/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}">
                        <span class="sr-only ml-3 mt-2 text-2xl font-bold text-black">{{ config('app.name', 'Laravel') }}</span>
                    </div>
                    <div class="-mr-2">
                        <button type="button" x-on:click="open = !open" class="rounded-md p-2 inline-flex items-center justify-center text-gray-800 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-black">
                            <span class="sr-only">Close menu</span>
                            <!-- Heroicon name: outline/x -->
                            <svg class="w-5 h-5" xmlns="https://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </button>
                    </div>
                </div>
                <div class="mt-6">
                    <nav class="grid gap-y-2">
                        @if (Auth::check())
                        <!-- Notification dropdown -->
                        @if (empty(Auth::user()->is_admin) && empty(Auth::user()->role))
                        <a href="{{ route('customer.dashboard') }}" class="px-3 py-2 rounded-md text-sm font-semibold tracking-wider leading-5 {{ request()->route()->named('customer.dashboard') ? 'text-white bg-gray-800' : 'text-gray-800 hover:text-white' }} hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-800 transition duration-150 ease-in-out">{{ __('Dashboard') }}</a>
                        <a href="{{ route('customer.tickets') }}" class="px-3 py-2 rounded-md text-sm font-semibold tracking-wider leading-5 {{ request()->route()->named('customer.tickets') ? 'text-white bg-gray-800' : 'text-gray-800 hover:text-white' }} hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-800 transition duration-150 ease-in-out">{{ __('Tickets') }}</a>
                        <a href="{{ route('customer.bundles') }}" class="px-3 py-2 rounded-md text-sm font-semibold tracking-wider leading-5 {{ request()->route()->named('customer.bundles') ? 'text-white bg-gray-800' : 'text-gray-800 hover:text-white' }} hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-800 transition duration-150 ease-in-out">{{ __('Bundles') }}</a>
                        @endif
                        <a href="{{ route('login') }}" class="px-3 py-2 rounded-md text-sm font-semibold tracking-wider leading-5 {{ request()->route()->named('login') ? 'text-white bg-gray-900' : 'text-gray-900 hover:text-white' }} hover:bg-gray-100 focus:outline-none focus:text-white focus:bg-gray-900 transition duration-150 ease-in-out">{{ __('Log in') }}</a>
                        @endif
                        <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded-md text-sm font-semibold tracking-wider leading-5 {{ request()->route()->named('customer.dashboard') ? 'text-white bg-gray-800' : 'text-gray-800 hover:text-white' }} hover:bg-gray-800 focus:outline-none focus:text-white focus:bg-gray-800 transition duration-150 ease-in-out">{{ __('Dashboard') }}</a>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
        @csrf
    </form>
</header>
