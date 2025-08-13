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
                            <a href="{{ route('customer.tickets') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Tickets') }}</a>
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
            <a href="{{ route('ticket.create') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                {{ __('Buy Ticket') }}
            </a>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
    @include('partials.alert')

    <div class="bg-white shadow sm:rounded-lg">
        <div class="flex items-center justify-between px-4 py-5 border-b border-gray-200 sm:px-6">
            <p class="max-w-2xl text-md leading-10 text-gray-700 text-2xl font-semibold">{{ __('Tickets') }}</p>
        </div>
        <table class="min-w-full w-full align-middle overflow-hidden" id="table">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Branch') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Details') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Reference') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Date') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Create Date') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Payment') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-right text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($tickets as $ticket)
                <tr>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm leading-5 font-semibold text-gray-700">{{ optional($ticket->branch)->name }}</div>
                                <div class="text-sm leading-5 text-gray-600">{{ optional($ticket->slot)->name }}</div>
                                <div class="text-sm leading-5 text-gray-600">{{ optional($ticket->facility)->title }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm leading-5 text-gray-600">Adult: {{ $ticket->regular_ticket_count }}</div>
                                <div class="text-sm leading-5 text-gray-600">Child: {{ $ticket->child_ticket_count }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-600">{{ $ticket->reference }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-700">{{ $ticket->getDate() }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-700">{{ Carbon\Carbon::parse($ticket->created_at)->format('d/m/Y') }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm leading-5 font-semibold text-gray-700">{{ $ticket->grand_total }}</div>
                                <div class="text-sm leading-5 font-semibold text-gray-700">{{ App\Helpers::asText($ticket->payment_status) }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        @php
                        $classes = [
                            'visited' => 'bg-green-100 text-green-600',
                            'not-visited' => 'bg-red-100 text-red-500',
                        ];
                        @endphp
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $classes[$ticket->status]}}">
                            {{ App\Helpers::asText($ticket->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap text-right border-b border-gray-200 text-sm leading-5 font-semibold">
                        @if($ticket->refund && $ticket->refund->status == 'refunded')
                        <div class="flex justify-center">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-600">
                                {{ App\Helpers::asText($ticket->refund->status) }}
                            </span>
                        </div>
                        @else
                        <div class="flex justify-end">
                            @if($ticket->payment_status != "paid")
                            <a href="{{ route('ticket.detail', $ticket->reference) }}" class="text-indigo-600 hover:text-indigo-900 ml-3" title="show">{{ "Pay" }}</a>
                            @endif

                            @if($ticket->facility)
                            <a href="{{ $ticket->photos_link ?? '#' }}" class="text-indigo-600 hover:text-indigo-900 ml-3" title="@if($ticket->photos_link != null) photos not uploaded yet @else photo link @endif">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                            </a>
                            @endif
                            <a href="{{ route('ticket.detail', $ticket->reference) }}" class="text-indigo-600 hover:text-indigo-900 ml-3" title="show">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                            </a>
                        </div>
                        @endif
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
