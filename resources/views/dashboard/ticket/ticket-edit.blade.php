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
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">{{ __('Edit Page') }}</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            @if(Helpers::isRouteValid('ticket.create'))
            <a href="{{ route('ticket.create') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                {{ __('Create') }}
            </a>
            @endif
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">

    @include('partials.alert')

    <section class="text-gray-600 body-font">
        <form class="container mx-auto flex flex-wrap" action="{{ route('ticket.ticket_update',$ticket) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="lg:w-2/3 mx-auto">
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
                                                    {{ __('Branch') }}
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
                                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{ __('Customer') }}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                    <span class="text-base font-semibold">{{ optional($ticket->customer)->name }}</span>
                                                    <span class="text-sm">{{ optional($ticket->customer)->mobile }}</span>
                                                    <span class="text-sm">{{ optional($ticket->customer)->email }}</span>
                                                    <span class="text-sm">{{ optional($ticket->customer)->address }}</span>
                                                </dd>
                                            </div>
                                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{ __('Ticket') }}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                    <span class="text-sm font-semibold" x-show="data.no_of_adult > 0">Adult: <span class="font-normal">{{ $ticket->regular_ticket_count }}</span></span>
                                                    <span class="text-sm font-semibold" x-show="data.no_of_child > 0">Child: <span class="font-normal">{{ $ticket->child_ticket_count }}</span></span>
                                                    <span class="text-sm" x-html="data.facility_text">{{ $ticket->facility? $ticket->facility->title : '' }}</span>
                                                </dd>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                <dt class="text-sm font-medium text-gray-500">
                                                    {{ __('Total') }}
                                                </dt>
                                                <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                    <span>{{ $ticket->grand_total }}</span> ৳
                                                    <span>{{ $ticket->coupon? '(Coupon: ' . $ticket->coupon->code . ')' : '' }}</span>

                                                    <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium @if($ticket->payment_status == "paid") bg-green-100 text-green-800 @else bg-red-100 text-red-800 @endif">
                                                        {{ App\Helpers::asText($ticket->payment_status) }}
                                                    </span>
                                                </dd>
                                            </div>
                                            <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
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
                <hr class="my-4">

                <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider text-right pr-8">
                        {{ __('Volunteer') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                        <div class="relative">
                            <select class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded" name="volunteer">
                                <option value="">{{ __('Select Volunteer') }}</option>
                                @foreach ($volunteers as $volunteer)
                                <option value="{{ $volunteer->id }}" @if($ticket->volunteer_id == $volunteer->id) selected @endif>{{ __(App\Helpers::asText($volunteer->name)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('volunteer')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider text-right pr-8">
                        {{ __('Facility Provider') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                        <div class="relative">
                            <select class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded" name="facility_provider">
                                <option value="">{{ __('Select Facility Provider') }}</option>
                                @foreach ($facility_providers as $facility_provider)
                                <option value="{{ $facility_provider->id }}" @if($ticket->facility_provider_id == $facility_provider->id) selected @endif>{{ __(App\Helpers::asText($facility_provider->name)) }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('facility_provider')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Status') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="flex mt-2 gap-4">
                            @php
                            $classes = [
                                'visited' => 'focus:ring-green-400 focus:border-green-400 text-green-700 ',
                                'not-visited' => 'focus:ring-blue-400 focus:border-blue-400 text-blue-700 ',
                            ];
                            @endphp
                            @foreach (config('upsidedown.ticket.statuses') as $status)
                            <label class="mb-4 inline-flex items-center cursor-pointer">
                                <input type="radio" class="block sm:text-sm border-gray-400 w-5 h-5 border cursor-pointer {{ $classes[$status]}}" name="status" value="{{ $status }}" @if($status == $ticket->status || old('status') == $status) checked @endif>
                                <span class="ml-2"> {{ App\Helpers::asText($status) }} </span>
                            </label>
                            @endforeach
                        </div>
                        @error('status')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Photos Link') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('photos_link') border-red-400 @enderror" type="text" maxlength="191" name="photos_link" id="photos_link" autocomplete="off" placeholder="{{ __('Photos Link') }}" value="{{ old('photos_link')?? $ticket->photos_link }}">
                        @error('photos_link')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                @if($ticket->payment_status == "unpaid" && $ticket->status != "visited")
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        &nbsp;
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="flex mt-2 gap-4">
                            <label class="mb-4 inline-flex items-center cursor-pointer">
                                <input type="checkbox" class="block sm:text-sm border-gray-400 w-5 h-5 border cursor-pointer focus:ring-green-400 focus:border-green-400 text-green-700" name="is_hold" @if($ticket->is_hold) checked @endif>
                                <span class="ml-2"> {{ __('Hold Ticket') }} </span>
                            </label>
                        </div>
                        @error('is_hold')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                @endif
                <hr class="my-4">
                <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-semibold text-gray-500"></dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <div class="mt-6 flex space-x-3 md:mt-0">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                {{ __('Update') }}
                            </button>
                            <button type="reset" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                {{ __('Reset') }}
                            </button>
                        </div>
                    </dd>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
