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
                            <a href="{{ route('bundle.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Bundles') }}</a>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">{{ __('List Page') }}</a>
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

    <div class="mb-5 bg-white shadow sm:rounded-lg">
        <div class="flex items-center justify-between px-4 py-5 border-b border-gray-200 sm:px-6">
            <p class="max-w-2xl text-md leading-10 text-gray-700 text-2xl font-semibold">{{ __('Bundles') }}</p>
        </div>
        <table class="min-w-full w-full align-middle overflow-hidden" id="table">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Title') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Subtitle') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Branch') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Details') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Remaining') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Normal Price / Offer Price') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($bundles as $bundle)
                <tr>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-700">{{ $bundle->bundle->title }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-700">{{ $bundle->bundle->subtitle }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-700">{{ optional($bundle->bundle->branch)->name }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <span class="text-sm leading-5 font-semibold text-gray-700">Adult Ticket: </span>{{ $bundle->regular_ticket_count }}<br>
                                <span class="text-sm leading-5 font-semibold text-gray-700">Child Ticket: </span>{{ $bundle->child_ticket_count }}<br>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <span class="text-sm leading-5 font-semibold text-gray-700">Adult Ticket: </span>{{ $bundle->getRemainingAdult() }}<br>
                                <span class="text-sm leading-5 font-semibold text-gray-700">Child Ticket: </span>{{ $bundle->getRemainingChild() }}<br>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <span class="text-sm leading-5 font-semibold text-gray-600">Regular: </span>{{ $bundle->normal_price }}<br>
                                <span class="text-sm leading-5 font-semibold text-gray-600">Offer: </span>{{ $bundle->offer_price }}
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <form id="delete-form" action="#" method="POST" class="hidden">
            @csrf
            @method("delete")
        </form>
    </div>
</div>
@endsection
