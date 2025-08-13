<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- icon -->
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script>
            function dropdown() {
                return {
                    show: false,
                    open() { this.show = true },
                    close() { this.show = false },
                    isOpen() { return this.show === true },
                }
            }
        </script>
        <!-- Custom Styles -->
        @yield('style')
    </head>
    <body class="bg-blue-50">
        <div x-data="dropdown()" class="h-screen flex overflow-hidden bg-gray-100" aria-label="mobile-menu">

            @include('partials.sidebar')

            <div class="flex-1 overflow-auto focus:outline-none">
                <div class="relative z-10 flex-shrink-0 flex h-16 bg-white border-b border-gray-200 lg:border-none">
                    <button x-on:click="open" class="px-4 border-r border-gray-200 text-gray-400 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-cyan-500 lg:hidden">
                        <span class="sr-only">Open sidebar</span>
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" /></svg>
                    </button>
                    <!-- Search bar -->
                    <div class="flex-1 px-4 flex justify-between sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
                        <div class="flex-1 flex">
                            <form class="w-full flex md:ml-0" action="#" method="GET">
                                <label for="search_field" class="sr-only">Search</label>
                                <div class="relative w-full text-gray-400 focus-within:text-gray-600">
                                    {{-- <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none" aria-hidden="true">
                                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" /></svg>
                                    </div>
                                    <input id="search_field" name="search_field" class="block w-full h-full pl-8 pr-3 py-2 border-transparent text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-0 focus:border-transparent sm:text-sm" placeholder="Search" type="search"> --}}
                                </div>
                            </form>
                        </div>
                        <div class="ml-4 flex items-center md:ml-6">
                            {{-- <div x-data="dropdown()" class="ml-3 relative" aria-label="notification">
                                <div>
                                    <button x-on:click="open" class="bg-white p-1 rounded-full text-gray-400 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                        <span class="sr-only">View notifications</span>
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" /></svg>
                                    </button>
                                </div>
                                <div x-show="isOpen()" style="display: none;" x-on:click.away="close" class="bg-gray-100 origin-top-right absolute top-0 right-0 mt-12 w-64 h-64 rounded-md shadow-lg z-50 py-1 ring-1 ring-black ring-opacity-5 focus:outline-none" x-description="Notification dropdown panel, show/hide based on dropdown state."
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95">
                                    @forelse (Auth::user()->notifications as $notification)
                                    <div class="py-1 rounded-md cursor-pointer bg-white shadow-xs z-50" role="menu" aria-orientation="vertical" aria-labelledby="notification">
                                        <div class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out" role="menuitem">
                                            <div class="text-xs text-gray-600">{{ Carbon\Carbon::parse($notification->created_at)->longAbsoluteDiffForHumans() }}</div>
                                            You got {{ $notification->data['status'] }}
                                        </div>
                                    </div>
                                    @empty
                                    <p class="h-full px-6 py-6 text-sm text-gray-600 text-center">{{ __('You don\'t have any notification left') }}</p>
                                    @endforelse
                                </div>
                            </div> --}}

                            <!-- Profile dropdown -->
                            <div x-data="dropdown()" class="ml-3 relative" aria-label="profile">
                                <div>
                                    <button x-on:click="open" type="button" class="max-w-xs bg-white rounded-full flex items-center text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500 lg:p-2 lg:rounded-md lg:hover:bg-gray-50" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                        <img class="h-8 w-8 rounded-full" src="{{ Auth::user()->image && Storage::exists('thumbnails/' . Auth::user()->image->path) ? Storage::url('thumbnails/' . Auth::user()->image->path) : '/img/user.jpg' }}" alt="">
                                        <span class="hidden ml-3 text-gray-700 text-sm font-medium lg:block">
                                            <span class="sr-only">Open user menu for </span>
                                            {{ Auth::user()->name }}
                                        </span>
                                        <svg class="hidden flex-shrink-0 ml-1 w-5 h-5 text-gray-400 lg:block" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                                    </button>
                                </div>

                                <div x-show="isOpen()" style="display: none;" x-on:click.away="close" class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1" x-description="Dropdown menu, show/hide based on menu state."
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="transform opacity-0 scale-95"
                                    x-transition:enter-end="transform opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-75"
                                    x-transition:leave-start="transform opacity-100 scale-100"
                                    x-transition:leave-end="transform opacity-0 scale-95">
                                    <!-- Active: "bg-gray-100", Not Active: "" -->
                                    <div class="p-1 rounded-md bg-white shadow-xs z-50 divide-y divide-gray-100" role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                        <div class="">
                                            <a href="{{ route('profile.index') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 rounded-md mb-1 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out" role="menuitem" tabindex="-1">
                                                <div class="flex justify-start items-center gap-3">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                    {{ __('Profile') }}
                                                </div>
                                            </a>
                                            <a href="{{ route('profile.password') }}" class="block px-4 py-2 text-sm leading-5 text-gray-700 rounded-md mb-1 border border-gray-300 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out" role="menuitem" tabindex="-1">
                                                <div class="flex justify-start items-center gap-3">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z" /></svg>
                                                    {{ __('Change Password') }}
                                                </div>
                                            </a>
                                            <a href="#" class="block px-4 py-2 text-sm leading-5 text-gray-700 rounded-md border border-gray-300 hover:bg-gray-200 focus:outline-none focus:bg-gray-200 transition duration-150 ease-in-out" role="menuitem" tabindex="-1" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                <div class="flex justify-start items-center gap-3">
                                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                                    {{ __('Log out') }}
                                                </div>
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <main class="flex-1 relative pb-4 z-0 overflow-y-auto">
                    <!-- Page header -->
                    <div class="bg-white shadow">
                        @yield('header')
                    </div>

                    <div class="mt-5 px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
                        @include('partials.due-alert')
                    </div>

                    <div class="mt-5">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>

        <script src="{{ mix('js/component.js') }}"></script>
        @yield('script')
    </body>

</html>
