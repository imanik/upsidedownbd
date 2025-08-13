@extends('layouts.back')

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
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">{{ __('Show Page') }}</a>
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

    <section class="text-gray-600 body-font">
        <form class="container mx-auto flex flex-wrap" action="{{ route('pay') }}" method="Post">
            <input type="hidden" name="ticket_id" value="{{ $ticket->id }}">
            @csrf
            <div class="lg:w-2/3 mx-auto">
                <div class="my-6">
                    <h4 class="text-2xl text-center text-gray-700 font-medium"> {{ __('Select visit date and time slot for branch') }} </h4>
                    <h2 class="text-3xl text-center text-yellow-500 font-medium my-2"> {{ $branch->name }} </h2>
                    <p class="flex justify-center items-start leading-relaxed">
                        <svg class="svg-icon" viewBox="0 0 20 20"><path d="M10,1.375c-3.17,0-5.75,2.548-5.75,5.682c0,6.685,5.259,11.276,5.483,11.469c0.152,0.132,0.382,0.132,0.534,0c0.224-0.193,5.481-4.784,5.483-11.469C15.75,3.923,13.171,1.375,10,1.375 M10,17.653c-1.064-1.024-4.929-5.127-4.929-10.596c0-2.68,2.212-4.861,4.929-4.861s4.929,2.181,4.929,4.861C14.927,12.518,11.063,16.627,10,17.653 M10,3.839c-1.815,0-3.286,1.47-3.286,3.286s1.47,3.286,3.286,3.286s3.286-1.47,3.286-3.286S11.815,3.839,10,3.839 M10,9.589c-1.359,0-2.464-1.105-2.464-2.464S8.641,4.661,10,4.661s2.464,1.105,2.464,2.464S11.359,9.589,10,9.589"></path></svg>
                        {{ $branch->address }}
                    </p>
                </div>

                <hr class="my-4">

                <div>
                    <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 text-center">
                            {{ __('Ticket Information') }}
                        </h3>
                        <p class="mt-1 mx-auto max-w-2xl text-base text-gray-600 text-center"> {{ __('Reference: ') . $ticket->reference}}</p>
                    </div>
                    <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                        <div class="sm:items-start">
                            <div class="mt-10 sm:mt-0">
                                <div class="md:grid md:grid-cols-3 md:gap-6">
                                    <div class="mt-5 md:mt-0 md:col-span-3">
                                        <!-- This example requires Tailwind CSS v2.0+ -->
                                        <div class="overflow-hidden sm:rounded-lg">
                                            <dl>
                                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        {{ __('Visit Date')}}
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                        <span>{{ date('d/m/Y', strtotime($ticket->date)) }}</span>
                                                    </dd>
                                                </div>
                                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        Branch
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                        <span class="text-base font-semibold"><span>{{ $ticket->branch->name }}</span></span>
                                                        @foreach($ticket->slots as $ticket_slot)
                                                        <span class="text-sm font-semibold">
                                                            Slot: <span class="font-normal">{{ optional($ticket_slot->slot)->name }}</span>
                                                        </span>
                                                        @endforeach
                                                    </dd>
                                                </div>
                                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        Customer
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                        <span class="text-base font-semibold">{{ optional($ticket->customer)->name }}</span>
                                                        <span class="text-sm">{{ optional($ticket->customer)->mobile }}</span>
                                                        <span class="text-sm">{{ optional($ticket->customer)->email }}</span>
                                                        <span class="text-sm">{{ optional($ticket->customer)->address }}</span>
                                                    </dd>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        Ticket
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                        <span class="text-sm font-semibold" x-show="data.no_of_adult > 0">Adult: <span class="font-normal">{{ $ticket->regular_ticket_count }}</span></span>
                                                        <span class="text-sm font-semibold" x-show="data.no_of_child > 0">Child: <span class="font-normal">{{ $ticket->child_ticket_count }}</span></span>
                                                        <span class="text-sm" x-html="data.facility_text">{{ $ticket->facility? $ticket->facility->title : '' }}</span>
                                                    </dd>
                                                </div>
                                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        Total
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                        <span>{{ $ticket->grand_total }}</span> ৳
                                                        <span>{{ $ticket->coupon? '(Coupon: ' . $ticket->coupon->code . ')' : '' }}</span>
                                                        <span class="text-sm">{{ App\Helpers::asText($ticket->payment_status) }}</span>
                                                    </dd>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        {{ __('Created At') }}
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                        <span>{{ $ticket->getCreatedAt() }}</span>
                                                    </dd>
                                                </div>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($ticket->payment_status == "paid")
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse justify-between">
                        {{-- @if($ticket->date > date("Y-m-d"))
                        @if(!$ticket->refund)
                        <a href="{{ route('ticket.refund', $ticket->id) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-yellow-700 bg-yellow-200 hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:text-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Refund Request
                        </a>
                        @else
                        <a class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-yellow-700 bg-yellow-200 hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:text-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            Refund Requested : {{ App\Helpers::asText($ticket->refund->status) }}
                        </a>
                        @endif
                        @endif --}}
                        <a href="{{ route('ticket.print', ['reference' => $ticket->reference]) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-green-700 bg-green-200 hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm" token="if you have any token validation" postdata="your javascript arrays or objects which requires in backend" order="If you already have the transaction generated for current order">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" /></svg>
                            {{ __('Print') }}
                        </a>
                        <a href="{{ route('ticket.mail', ['reference' => $ticket->reference]) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-yellow-700 bg-yellow-200 hover:bg-yellow-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500 sm:text-sm">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                            {{ __('Get Mail') }}
                        </a>
                    </div>
                    @else
                    <a href="{{ route('ticket.detail', $ticket->reference) }}" class="text-indigo-600 hover:text-indigo-900 ml-3" title="show">
                        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        {{ __('Payment') }}
                    </a>
                    @endif
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
