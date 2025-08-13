<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        @yield('meta')

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap">

        <!-- Styles -->
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <!-- Custom Styles -->
        @yield('style')
    </head>
    <body class="bg-gray-50">
        <div class="flex flex-col h-screen">

            @include('partials.header')

            <div class="py-8 px-4 sm:px-6 lg:px-8 flex-1">
                @yield('content')
            </div>

            {{-- @include('partials.footer') --}}
        </div>

        <script src="{{ mix('js/component.js') }}"></script>
        @yield('script')
    </body>
</html>
