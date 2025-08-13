@extends('layouts.front')

@section('style')
@endsection

@section('header')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
    <div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
        <div class="flex-1 min-w-0">
            <!-- Profile -->
            <div class="flex items-center">
                <img class="hidden h-16 w-16 rounded-full sm:block" src="{{ Auth::user()->photo ? Storage::url('thumbnails/'.Auth::user()->photo) : '/img/user.jpg' }}" alt="">
                <div>
                    <div class="flex items-center">
                        <img class="h-16 w-16 rounded-full sm:hidden" src="{{ Auth::user()->photo ? Storage::url('thumbnails/'.Auth::user()->photo) : '/img/user.jpg' }}" alt="">
                        <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                            {{ App\Helpers::greeting() }}, {{ Auth::user()->name }}
                        </h1>
                    </div>
                    <dl class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                        <dt class="sr-only">Company</dt>
                        <dd class="flex items-center text-sm text-gray-500 font-medium capitalize sm:mr-6">
                            <svg class="flex-shrink-0 mr-1.5 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" /></svg>
                            {{ optional(Auth::user()->branch)->address ?? "Upsidedown" }}, {{ Auth::user()->user_type() }}
                        </dd>
                        {{-- <dt class="sr-only">Account status</dt>
                        <dd class="mt-3 flex items-center text-sm text-gray-500 font-medium sm:mr-6 sm:mt-0 capitalize">
                            <svg class="flex-shrink-0 mr-1.5 w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                            Verified account
                        </dd> --}}
                    </dl>
                </div>
            </div>
        </div>
        {{-- <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                Add money
            </button>
            <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                Send money
            </button>
        </div> --}}
    </div>
</div>
@endsection

@section('content')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
    <section class="text-gray-700 body-font">
        <div class="container mx-auto">
            <div class="flex flex-wrap -mx-4">

                <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                    <a href="{{ route('customer.tickets') }}" class="transition duration-200 group block bg-yellow-100 border border-yellow-300 p-6 rounded-lg hover:bg-yellow-200 cursor-pointer">
                        <div class="flex justify-between">
                            <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-yellow-200 text-yellow-600 border border-yellow-300 group-hover:bg-yellow-100 group-hover:text-yellow-500 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>
                            </div>
                            <h2 class="text-yellow-700 font-semibold text-4xl title-font mb-2">{{ App\Helpers::trans($tickets ?? 0) }}</h2>
                        </div>
                        <h2 class="text-lg text-yellow-700 font-semibold title-font mb-2"> {{ __('Tickets') }} </h2>
                    </a>
                </div>

                <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                    <a href="{{ route('customer.bundles') }}" class="transition duration-200 group block bg-pink-100 border border-pink-300 p-6 rounded-lg hover:bg-pink-200 cursor-pointer">
                        <div class="flex justify-between">
                            <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-pink-200 text-pink-600 border border-pink-300 group-hover:bg-pink-100 group-hover:text-pink-500 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                            </div>
                            <h2 class="text-pink-700 font-semibold text-4xl title-font mb-2">{{ App\Helpers::trans($bundles ?? 0) }}</h2>
                        </div>
                        <h2 class="text-lg text-pink-700 font-semibold title-font mb-2"> {{ __('Bundles') }} </h2>
                    </a>
                </div>

                <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                    <a href="{{ route('customer.profile') }}" class="transition duration-200 group block bg-gray-100 border border-gray-300 p-6 rounded-lg hover:bg-gray-200 cursor-pointer">
                        <div class="flex justify-between">
                            <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600 border border-gray-300 group-hover:bg-gray-100 group-hover:text-gray-500 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                            </div>
                            <h2 class="text-gray-700 font-semibold text-4xl title-font mb-2"></h2>
                        </div>
                        <h2 class="text-lg text-gray-700 font-semibold title-font mb-2"> {{ __('Profile') }} </h2>
                    </a>
                </div>

                <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                    <a href="{{ route('customer.password') }}" class="transition duration-200 group block bg-blue-100 border border-blue-300 p-6 rounded-lg hover:bg-blue-200 cursor-pointer">
                        <div class="flex justify-between">
                            <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-blue-200 text-blue-600 border border-blue-300 group-hover:bg-blue-100 group-hover:text-blue-500 mb-4">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 11V7a4 4 0 118 0m-4 8v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2z"></path></svg>
                            </div>
                            <h2 class="text-blue-700 font-semibold text-4xl title-font mb-2"></h2>
                        </div>
                        <h2 class="text-lg text-blue-700 font-semibold title-font mb-2"> {{ __('Change Password') }} </h2>
                    </a>
                </div>

            </div>
        </div>

    </section>
</div>
@endsection
