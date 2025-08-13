@extends('layouts.front')

@section('content')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">

    @include('partials.alert')

    <section class="text-gray-600 body-font">
        <form class="container mx-auto flex flex-wrap" action="{{ route('ticket.create') }}" method="POST" enctype="multipart/form-data">
            {{-- Preventing submit from enter press --}}
            <button type="submit" disabled style="display: none" aria-hidden="true"></button>
            <input type="hidden" name="branch" value="{{ $branch->name }}">
            @csrf
            <div x-data="init()" x-init='slots(); checkCoupon(); changeBundle();' class="lg:w-2/3 mx-auto">

                <div class="my-6">
                    <h4 class="text-2xl text-center text-gray-700 font-medium"> {{ __('Select visit date and time slot for branch') }} </h4>
                    <h2 class="text-3xl text-center text-yellow-500 font-medium my-2"> {{ $branch->name }} </h2>
                    <p class="flex justify-center items-start leading-relaxed">
                        <svg class="svg-icon" viewBox="0 0 20 20"><path d="M10,1.375c-3.17,0-5.75,2.548-5.75,5.682c0,6.685,5.259,11.276,5.483,11.469c0.152,0.132,0.382,0.132,0.534,0c0.224-0.193,5.481-4.784,5.483-11.469C15.75,3.923,13.171,1.375,10,1.375 M10,17.653c-1.064-1.024-4.929-5.127-4.929-10.596c0-2.68,2.212-4.861,4.929-4.861s4.929,2.181,4.929,4.861C14.927,12.518,11.063,16.627,10,17.653 M10,3.839c-1.815,0-3.286,1.47-3.286,3.286s1.47,3.286,3.286,3.286s3.286-1.47,3.286-3.286S11.815,3.839,10,3.839 M10,9.589c-1.359,0-2.464-1.105-2.464-2.464S8.641,4.661,10,4.661s2.464,1.105,2.464,2.464S11.359,9.589,10,9.589"></path></svg>
                        {{ $branch->address }}
                    </p>
                </div>

                <hr class="my-4">
                @if(request()->bundle)
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Bundle') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <select class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('bundle') border-red-400 @enderror" x-model="bundle_id" x-on:change="changeBundle()" name="bundle">
                            <option value="">{{ __('Custom Ticket') }}</option>
                            @foreach ($bundles as $item)
                            <option value="{{ $item->id }}" @if(old('bundle') == $item->id) selected @endif>{{ $item->title }}</option>
                            @endforeach
                        </select>
                        @error('bundle')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                @endif
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Visit Date') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">

                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('date') border-red-400 @enderror" type="date" name="date" id="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" max="{{ Carbon\Carbon::now()->addMonth(1)->format('Y-m-d') }}" x-on:change="data.visit_date = $event.target.value; slots(); checkCoupon();" autocomplete="off" value="{{ old('date') }}" onkeydown="return false">
                        @error('date')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dt>
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                    </dt>
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                    </dt>
                    <dd class="mt-1 text-sm font-medium text-gray-700 sm:mt-0 sm:col-span-2">
                        <span class="text-green-400">You can reschedule your visiting time anytime. Every visitors group can enter the gallery after 15mins of previous visitor group.</span>
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Select Slot') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-2 sm:col-span-2">
                        <span x-show="data.open_slots.length == 0" x-text="data.loading_slot_text"></span>
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-4"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform translate-x-4">
                    <dd x-show="data.open_slots.length > 0" style="display: none;" class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-3">
                        <div class="flex flex-col flex-wrap mt-2 h-96">
                            <template x-for="slot in data.open_slots" :key="slot.id">
                                <label class="w-40 mb-4 inline-flex items-center">
                                    <input type="radio" class="focus:ring-blue-400 focus:border-blue-400 block sm:text-sm border-gray-400 w-5 h-5 border text-blue-700" name="slot" :value="slot.slot_id" x-bind:checked="slot.slot_id == data.slot" x-bind:disabled="slot.status == 'booked' || checkSlot(slot.date + ' ' + slot.slot.time)" x-on:change="data.slot = slot.slot.name;">
                                    <span class="ml-2" x-text="slot.slot.name" x-bind:class="{ 'text-red-700 line-through': slot.status == 'booked' || checkSlot(slot.date + ' ' + slot.slot.time), 'cursor-pointer': !(slot.status == 'booked' || checkSlot(slot.date + ' ' + slot.slot.time)) }" :title="slot.slot.name"></span>
                                </label>
                            </template>
                        </div>
                        @error('slot')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd x-show="data.loading_slot" style="display: none;" class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-3">
                        <div class="w-full mx-auto">
                            <div class="animate-pulse flex">
                                <div class="flex flex-col flex-wrap mt-2 h-96">
                                    <template x-for="(n, index) in 50" :key="n">
                                        <div class="w-40 mb-4 inline-flex items-center gap-2">
                                            <div class="rounded-full bg-blue-100 w-5 h-5"></div>
                                            <div class="h-4 bg-blue-100 rounded w-28"></div>
                                        </div>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Adult (10+ age)') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('adult_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-bind:readonly="bundle" x-model="data.no_of_adult" min="1" max="100" name="adult_number" id="adult_number" autocomplete="off" placeholder="{{ __('Ex. 4') }}" value="{{ old('adult_number') }}">
                        @error('adult_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="leading-10 font-normal text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8 text-xl">
                        <span><span x-html="(data.no_of_adult || 0) + ' * ' + cost.adult + ' = ' + cost.adult * data.no_of_adult"></span> ৳</span>
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Child (4-10 age)') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('child_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-bind:readonly="bundle" x-model="data.no_of_child" min="0" max="100" name="child_number" id="child_number" autocomplete="off" placeholder="{{ __('EX. 3') }}" value="{{ old('child_number') }}">
                        @error('child_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="leading-10 font-normal text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8 text-xl">
                        <span><span x-html="(data.no_of_child || 0) + ' * ' + cost.child + ' = ' + cost.child * data.no_of_child"></span> ৳</span>
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Facility') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="flex flex-col mt-2">
                            @foreach ($facilities as $facility)
                            <div>
                                <label class="w-auto mb-4 inline-flex items-center cursor-pointer">
                                    <input type="radio" class="focus:ring-blue-400 focus:border-blue-400 block sm:text-sm border-gray-300 w-5 h-5 border text-blue-700 cursor-pointer" x-bind:disabled="bundle" name="facility" data-facility="{{ $facility->title }}" data-cost="{{ $facility->cost }}" x-on:change="cost.facility = $event.target.dataset.cost; data.facility = $event.target.value; data.facility_text = $event.target.dataset.facility" value="{{ $facility->id }}" x-bind:checked="data.facility == {{$facility->id}}">
                                    <span class="ml-2"> {{ $facility->title }} @ {{ $facility->cost }} </span>
                                </label>
                                <span x-show="!bundle_id && data.facility == {{ $facility->id }}" style="display: none;" x-on:click="cost.facility = 0; data.facility = null; data.facility_text = null; facilityUnchecked()" class="ml-4 inline-flex text-sm cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @error('facility')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="leading-10 font-normal text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8 text-xl">
                        <span><span x-html="cost.facility"></span> ৳</span>
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Coupon') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('coupon') border-red-400 @enderror" type="text" x-bind:readonly="bundle" name="coupon" id="coupon" x-model="data.coupon" x-on:keyup="checkCoupon();" autocomplete="off" placeholder="{{ __('Your coupon') }}" value="{{ old('coupon') ?? null }}">
                        @error('coupon')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }} 20 BDT Vat & Online service charge applied on per ticket  </p>
                        @enderror
                    </dd>
                    <dt class="leading-10 font-normal text-red-400 tracking-wider sm:col-span-1 pr-8 text-2xl flex justify-between items-center">
                        <span class="inline-flex">
                            <svg x-show="!data.loading_coupon && !data.invalid_coupon && data.coupon" style="display: none;" class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            <svg x-show="data.loading_coupon" style="display: none;" class="animate-spin ml-2 mr-3 w-6 h-6 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                            <span x-show="!data.loading_coupon && data.invalid_coupon" style="display: none;" class="text-sm text-red-500" x-text="data.invalid_coupon_text"></span>
                        </span>
                        <span x-show="getDiscount()" style="display: none;"> −<span x-text="getDiscount()"></span> ৳</span>
                    </dt>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Total') }}
                    </dt>
                    <dd class="leading-10 font-normal text-gray-700 tracking-wider sm:col-span-2 sm:text-left pr-8 text-2xl">
                        <span x-show="cost.coupon != 0 || bundle_id" style="display: none;" class="text-red-500">
                            <span><span class="line-through" x-html="bundle_id? bundle.normal_price : getCost()"></span> ৳ </span>
                            <span class="mt-1 text-xs text-gray-900 xs:mt-0 xs:col-span-2">(BDT 3% of Total Cost Included For Online Service Charge & Vat)</span> 
                        </span>
                        <span><span x-html="bundle_id? bundle.offer_price : getCost() - getDiscount()"></span> ৳  </span>
                    </dd>
                    
                </div>

                @if (!Auth::check() || Auth::user()->is_admin || Auth::user()->role)
                <hr class="my-4">
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Name') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('name') border-red-400 @enderror" type="text" maxlength="191" name="name" x-model="visitor.name" id="name" autocomplete="off" placeholder="{{ __('Your name') }}" value="{{ old('name') ?? null }}">
                        @error('name')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Email') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('email') border-red-400 @enderror" type="text" maxlength="191" name="email" x-model="visitor.email" id="email" autocomplete="off" placeholder="{{ __('example@email.com') }}" value="{{ old('email') ?? null }}">
                        @error('email')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Mobile') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">+88</span>
                            </div>
                            <input class="focus:ring-blue-400 focus:border-blue-400 block w-full pl-12 pr-12 sm:text-sm border-gray-300 rounded @error('mobile') border-red-400 @enderror" type="text" x-model="visitor.mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11" minlength="11" name="mobile" id="mobile" autocomplete="off" placeholder="01XXXXXXXXX" value="{{ old('mobile') ?? null }}">
                        </div>
                        @error('mobile')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Address') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <textarea class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('address') border-red-400 @enderror" type="text" name="address" id="address" x-model="visitor.address" rows="3" placeholder="{{ __('Address') }}">{{ old('address') ?? null }}</textarea>
                        @error('address')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                @endif

                <hr class="my-4">
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-semibold text-gray-500 sm:col-span-1"></dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <button type="button" x-on:click="preview = true" class="inline-flex items-center bg-yellow-500 hover:bg-yellow-400 text-white text-sm font-semibold py-2 pl-3 pr-4 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                            {{ __('Preview') }}
                        </button>
                    </dd>
                </div>

                <div x-show="preview" style="display: none;" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="preview"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" x-description="Background overlay, show/hide based on modal state." class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-on:click="preview = false" aria-hidden="true"></div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        <div x-show="preview"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-description="Modal panel, show/hide based on modal state." class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full max-w-lg">
                            <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-900 text-center">
                                    {{ __('Ticket Information') }}
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500" id="ticket_details"></p>
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
                                                                <span x-html="(new Date(data.visit_date)).toLocaleDateString('en-US', {year: 'numeric', month: 'long', day: 'numeric'})"></span>
                                                            </dt>
                                                        </div>
                                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                {{ __('Visitor\'s Information') }}
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                                <span class="text-base font-semibold" x-html="visitor.name"></span>
                                                                <span class="text-sm" x-html="visitor.mobile"></span>
                                                                <span class="text-sm" x-html="visitor.email"></span>
                                                                <span class="text-sm" x-html="visitor.address"></span>
                                                            </dd>
                                                        </div>
                                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                Ticket
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                                <span class="text-sm font-semibold" x-show="data.no_of_adult > 0">Adult: <span class="font-normal" x-html="data.no_of_adult"></span></span>
                                                                <span class="text-sm font-semibold" x-show="data.no_of_child > 0">Child: <span class="font-normal" x-html="data.no_of_child"></span></span>
                                                                <span class="text-sm" x-html="data.facility_text"></span>
                                                            </dd>
                                                        </div>
                                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                Branch
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                                <span class="text-base font-semibold"><span x-html="data.branch"></span></span>
                                                                <span class="text-sm font-semibold" x-show="data.slot">Slot: <span class="font-normal" x-html="data.slot"></span></span>
                                                            </dd>
                                                        </div>
                                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                Total
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                                <span x-show="bundle_id">
                                                                    <span class="text-red-500"><span class="line-through" x-html="bundle_id? bundle.normal_price : getCost()"></span> ৳</span>
                                                                    <span x-html="bundle_id? bundle.offer_price : getCost() - getDiscount()"></span> ৳ </span>
                                                                </span>
                                                                <span x-show="!bundle_id" x-html="'(' + (data.no_of_adult || 0) + '*' + cost.adult + ') + (' + (data.no_of_child || 0) + '*' + cost.child + ') + ' + cost.facility + ' - ' + getDiscount() + ' = ' + parseInt(data.no_of_adult * cost.adult + data.no_of_child * cost.child + parseInt(cost.facility) - getDiscount())"></span> ৳ (BDT 3% of Total Cost Included For Online Service Charge & Vat)
                                                            </dd>
                                                        </div>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    {{ __('Submit') }}
                                </button>
                                <button x-on:click="preview = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    {{ __('Cancel') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </section>
</div>
@endsection

@section('script')
<script>
    let branch = @json($branch);
    let visitor = @json(Auth::user());

    function facilityUnchecked() {
        if (document.querySelector('input[name=facility]:checked')) {
            document.querySelector('input[name=facility]:checked').checked = false;
        }
    }

    function init() {
        return {
            preview: false,
            bundle_id: @json($bundle? $bundle->id : ''),
            bundles_box: @json($bundles_box),
            bundle: false,

            cost: {
                adult: parseInt(branch.regular_price) || 0,
                child: parseInt(branch.child_price) || 0,
                facility: 0,
                coupon: 0,
                discount: 0,
            },
            data: {
                visit_date: @json(old('date') ?? null),
                slot: @json(old('slot') ?? null),
                no_of_adult: @json(old('adult_number') ?? null),
                no_of_child: @json(old('child_number') ?? null),
                facility:  @json(old('facility') ?? null),
                facility_text: null,
                branch: branch.name,
                coupon: @json(old('coupon') ?? null),
                open_slots: [],

                loading_slot: false,
                loading_slot_text: 'Yet to load',
                loading_coupon: false,
                invalid_coupon: false,
                invalid_coupon_text: '',
            },
            visitor: {
                name: visitor ? visitor.name : null,
                email: visitor ? visitor.email : null,
                mobile: visitor ? visitor.mobile : null,
                address: visitor ? visitor.address : null,
            },

            slots() {
                if(!this.data.visit_date) {
                    return;
                }
                this.data.loading_slot = true;
                this.data.loading_slot_text = 'Loading ...';
                this.data.open_slots = [];

                return axios.post('/slot-check', {
                    'date': this.data.visit_date,
                    'branch_id': branch.id,
                }).then((response) => {
                    this.data.open_slots = response.data;
                }).catch((error) => {
                    console.log(error);
                }).then(() => {
                    this.data.loading_slot = false;
                });
            },
            checkSlot(slot){
                return new Date() > Date.parse(slot);
            },

            getCost(){
                return parseInt(this.cost.adult * this.data.no_of_adult) + parseInt(this.cost.child * this.data.no_of_child) + parseInt(this.cost.facility);
            },

            getDiscount(){
                return (this.getCost() * this.cost.coupon / 100);
            },

            checkCoupon() {

                this.data.invalid_coupon_text = '';
                if(!this.data.coupon){
                    this.data.invalid_coupon = true;
                    return;
                }

                if(!this.data.visit_date) {
                    this.data.invalid_coupon = true;
                    this.data.invalid_coupon_text = 'Please select visit date!';
                    return;
                }

                this.data.loading_coupon = true;
                this.data.invalid_coupon = false;
                this.data.invalid_coupon_text = '';

                return axios.post('/coupon-check', {
                    'date': this.data.visit_date,
                    'branch': branch.id,
                    'coupon': this.data.coupon,
                }).then((response) => {
                    if (response.data.status) {
                        this.cost.coupon = response.data.coupon.discount;
                        this.data.invalid_coupon = false;
                    } else {
                        this.cost.coupon = 0;
                        this.data.invalid_coupon = true;
                        this.data.invalid_coupon_text = 'Invalid';
                    }
                }).catch((error) => {
                    console.log(error);
                }).then(() => {
                    this.data.loading_coupon = false;
                });
            },

            changeBundle(){
                facilityUnchecked();
                if(this.bundle_id){
                    this.bundle = this.bundles_box[this.bundle_id];
                    this.data.no_of_adult = this.bundle.regular_ticket_count;
                    this.data.no_of_child = this.bundle.child_ticket_count;
                    this.data.facility = this.bundle.facility_id;
                    this.data.facility_text = this.bundle.facility? this.bundle.facility.title : null;
                    this.cost.facility = this.bundle.facility? this.bundle.facility.cost : 0;
                    this.data.coupon = null;
                    this.cost.coupon = 0;
                }else{
                    this.bundle = false;
                    this.data.no_of_adult = null;
                    this.data.no_of_child = null;
                    this.data.facility = null;
                    this.data.facility_text = null;
                    this.cost.facility = 0;
                }
            }
        }
    }
</script>
@endsection
