@extends('layouts.front')

@section('content')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">

    <section class="text-gray-600 body-font">
        <form class="container mx-auto flex flex-wrap" action="{{ route('pay', $bundle->reference) }}" method="Post">
            <input type="hidden" name="payment_id" value="{{ optional($payment)->id }}">
            @csrf
            <div class="lg:w-2/3 mx-auto">
                @include('partials.alert')

                <div>
                    <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200">
                        <h3 class="text-xl font-semibold text-gray-900 text-center">
                            {{ __('Bundle Information') }}
                        </h3>
                        <p class="mt-1 mx-auto max-w-2xl text-base text-gray-600 text-center"> {{ __('Title: ') . $bundle->title}}</p>
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
                                                        {{ __('Visitor\'s Information') }}
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                        <span class="text-base font-semibold">{{ optional($user_bundle->customer)->name }}</span>
                                                        <span class="text-sm">{{ optional($user_bundle->customer)->mobile }}</span>
                                                        <span class="text-sm">{{ optional($user_bundle->customer)->email }}</span>
                                                        <span class="text-sm">{{ optional($user_bundle->customer)->address }}</span>
                                                    </dd>
                                                </div>
                                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        {{ __('Bundle') }}
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                        <span class="text-sm font-semibold">Adult: <span class="font-normal">{{ $user_bundle->regular_ticket_count }}</span></span>
                                                        <span class="text-sm font-semibold">Child: <span class="font-normal">{{ $user_bundle->child_ticket_count }}</span></span>
                                                    </dd>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        {{ __('Price') }}
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                        <span class="text-sm font-semibold">Regular: <span class="font-normal">{{ $user_bundle->normal_price }} ৳</span></span>
                                                        <span class="text-sm font-semibold">Offer: <span class="font-normal">{{ $user_bundle->offer_price }} ৳</span></span>
                                                    </dd>
                                                </div>
                                                <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        {{ __('Payment Status') }}
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                        <span class="text-base font-semibold">{{ __(App\Helpers::asText($user_bundle->payment_status)) }}</span>
                                                    </dd>
                                                </div>
                                                <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                    <dt class="text-sm font-medium text-gray-500">
                                                        {{ __('Created At') }}
                                                    </dt>
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                        <span>{{ $user_bundle->getCreatedAt() }}</span>
                                                    </dd>
                                                </div>
                                                @if ($user_bundle->payment_status != "paid")
                                                <div class="bg-white px-4 py-5 sm:grid sm:gap-4 sm:px-6">
                                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0">
                                                        <div class="flex">
                                                            <label class="flex items-center cursor-pointer">
                                                                <input type="checkbox" class="form-checkbox w-5 h-5 cursor-pointer rounded" required>
                                                                <span class="ml-2 text-sm font-semibold">I read and agree to the
                                                                    <span class="underline hover:bg-blue-200" title="Terms & Conditions page"><a href="{{ route('terms_n_conditions') }}"> Terms & Conditions</a></span>,
                                                                    <span class="underline hover:bg-blue-200" title="Privacy Policy page"><a href="{{ route('privacy_policy') }}"> Privacy Policy</a></span> and
                                                                    <span class="underline hover:bg-blue-200" title="Return Refund Policy page"><a href="{{ route('return_refund_policy') }}"> Return Refund Policy</a></span>.
                                                                </span>
                                                            </label>
                                                        </div>
                                                    </dd>
                                                </div>
                                                @endif
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($user_bundle->payment_status != "paid")
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <button class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-green-700 bg-green-200 hover:bg-green-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:text-sm" token="if you have any token validation" postdata="your javascript arrays or objects which requires in backend" order="If you already have the transaction generated for current order">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ __('Pay Now') }}
                        </button>
                    </div>
                    @else
                    <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                        <a href="{{ route('ticket.create', ['branch' => optional($user_bundle->bundle->branch)->name, 'bundle' => $user_bundle->reference]) }}" class="inline-flex items-center justify-center px-4 py-2 border border-transparent font-medium rounded-md text-blue-700 bg-blue-200 hover:bg-blue-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm" token="if you have any token validation" postdata="your javascript arrays or objects which requires in backend" order="If you already have the transaction generated for current order">
                            <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 11V9a2 2 0 00-2-2m2 4v4a2 2 0 104 0v-1m-4-3H9m2 0h4m6 1a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                            {{ __('Buy Ticket') }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </form>
    </section>
</div>
@endsection
