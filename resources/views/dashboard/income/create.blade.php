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
                                <svg class="flex-shrink-0 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" /></svg>
                                <span class="sr-only">{{ __('Home') }}</span>
                            </a>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                            <a href="{{ route('income.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('incomes') }}</a>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">{{ __('Create Page') }}</a>
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
        <form class="container mx-auto flex flex-wrap" action="{{ route('income.store') }}" method="POST" enctype="multipart/form-data">
            {{-- Preventing submit from enter press --}}
            <button type="submit" disabled style="display: none" aria-hidden="true"></button>
            <input type="hidden" name="branch" value="uttara">
            @csrf
            <div x-data="init()" class="lg:w-2/3 mx-auto">

                <div class="my-6">
                    <h4 class="text-2xl text-center text-gray-700 font-medium"> {{ __('Income ') }} </h4>

                </div>

                <hr class="my-4">
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Date') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('date') border-red-400 @enderror" type="date" name="date" id="date" min="{{ Carbon\Carbon::now()->addMonth(-6)->format('Y-m-d') }}" max="{{ Carbon\Carbon::now()->addDay(1)->format('Y-m-d') }}" x-on:change="data.visit_date = $event.target.value; slots(); checkCoupon();" autocomplete="off" value="{{ old('date') }}" onkeydown="return false">
                        @error('date')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>


                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Adult') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('adult_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-on:change="data.no_of_adult = $event.target.value" x-on:keyup="data.no_of_adult = $event.target.value" min="1" max="100" name="adult_number" id="adult_number" autocomplete="off" placeholder="{{ __('Ex. 4') }}" value="{{ old('adult_number') ?? 2 }}">
                        @error('adult_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <span x-html="data.no_of_adult + ' * ' + cost.adult + ' = ' + cost.adult * data.no_of_adult"></span> <span>&#2547;</span>
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Child') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('child_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-on:change="data.no_of_child = $event.target.value" x-on:keyup="data.no_of_child = $event.target.value" min="0" max="100" name="child_number" id="child_number" autocomplete="off" placeholder="{{ __('EX. 3') }}" value="{{ old('child_number') ?? 1 }}">
                        @error('child_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <span x-html="data.no_of_child + ' * ' + cost.child + ' = ' + cost.child * data.no_of_child"></span> <span>&#2547;</span>
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Discount') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('discount_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-on:change="data.no_of_discount = $event.target.value" x-on:keyup="data.no_of_discount = $event.target.value" min="0" max="100" name="discount_number" id="discount_number" autocomplete="off" placeholder="{{ __('EX. 3') }}" value="{{ old('child_number') ?? 1 }}">
                        @error('discount_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>

                </div>


                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Discount Amount') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('discount_amount') border-red-400 @enderror" type="text" name="discount_amount" id="discount_amount" x-on:keyup="cost.discount= $event.target.value;" autocomplete="off" placeholder="{{ __('Total Discount') }}" value="{{ old('discount_amount')?? null }}">
                        @error('discount_amount')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <span x-html="data.no_of_discount + ' * ' + cost.discount + ' = ' + cost.discount * data.no_of_discount"></span> <span>&#2547;</span>
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Dslr Type 1') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('dslr_type1_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-on:change="data.no_of_dslr_type1 = $event.target.value" x-on:keyup="data.no_of_dslr_type1 = $event.target.value" min="0" max="100" name="dslr_type1_number" id="dslr_type1_number" autocomplete="off" placeholder="{{ __('EX. 0') }}" value="{{ old('dslr_type1_number') ?? 0 }}">
                        @error('dslr_type1_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <span x-html="data.no_of_dslr_type1 + ' * ' + cost.dslr_type1 + ' = ' + cost.dslr_type1 * data.no_of_dslr_type1"></span> <span>&#2547;</span>
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Dslr Type 2') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('dslr_type1_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-on:change="data.no_of_dslr_type2 = $event.target.value" x-on:keyup="data.no_of_dslr_type2 = $event.target.value" min="0" max="100" name="dslr_type2_number" id="dslr_type2_number" autocomplete="off" placeholder="{{ __('EX. 0') }}" value="{{ old('dslr_type2_number') ?? 0 }}">
                        @error('dslr_type2_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <span x-html="data.no_of_dslr_type2 + ' * ' + cost.dslr_type2 + ' = ' + cost.dslr_type2 * data.no_of_dslr_type2"></span> <span>&#2547;</span>
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Total') }}
                    </dt>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-2 sm:text-left pr-8">
                        <span x-show="cost.coupon != 0" class="text-red-500 line-through" x-html="cost.adult * data.no_of_adult + cost.child * data.no_of_child  + cost.dslr_type1 * data.no_of_dslr_type1 + cost.dslr_type2 * data.no_of_dslr_type2"></span>
                        <span x-html="cost.adult * data.no_of_adult + cost.child * data.no_of_child + cost.dslr_type1 * data.no_of_dslr_type1 + cost.dslr_type2 * data.no_of_dslr_type2 - cost.dslr_type2 * data.no_of_dslr_type2 +  cost.discount * data.no_of_discount"></span> <span>&#2547;</span>
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Card Income') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('cc_sale') border-red-400 @enderror" type="text" name="cc_sale" id="cc_sale" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-on:change="data.cc_amount = $event.target.value" x-on:keyup="data.cc_amount = $event.target.value" min="0" max="100"  autocomplete="off" placeholder="{{ __('Card Payment') }}" value="{{ old('cc_sale')?? null }}">
                        @error('cc_sale')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>

                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Cash Income') }}
                    </dt>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-2 sm:text-left pr-8">
                            <span x-html="cost.adult * data.no_of_adult + cost.child * data.no_of_child + cost.dslr_type1 * data.no_of_dslr_type1 + cost.dslr_type2 * data.no_of_dslr_type2 -  cost.discount * data.no_of_discount -data.cc_amount"></span> <span>&#2547;</span>
                    </dd>
                </div>

                <hr class="my-4">


                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Notes') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <textarea class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('notes') border-red-400 @enderror" type="text" name="notes" id="notes"  rows="3" placeholder="{{ __('Notes') }}">{{ old('notes')?? null }}</textarea>
                        @error('notes')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>

                <hr class="my-4">
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-semibold text-gray-500 sm:col-span-1"></dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('Submit') }}
                        </button>
                    </dd>
                </div>

            </div>
        </form>
    </section>
</div>
@endsection

@section('script')
<script>
    let branch = [];



    function init() {
        return {
            preview: false,
            cost: {
                adult:400,
                child: 250,
                facility: 0,
                discount: 0,
                discount: 0,
                dslr_type1: 300,
                dslr_type2: 500,
                // coupon: 0,
            },
            data: {
                visit_date: null,
                no_of_adult: 2,
                no_of_child: 1,
                no_of_discount: 0,
                no_of_dslr_type1: 0,
                no_of_dslr_type2: 0,
                cc_amount: 0,

            },
            user: {
                name: null,
                email: null,
                mobile: null,
                address: null,
            },

        }
    }
</script>
@endsection
