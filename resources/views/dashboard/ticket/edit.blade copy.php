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
                                <svg class="flex-shrink-0 w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                                </svg>
                                <span class="sr-only">{{ __('Home') }}</span>
                            </a>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                            </svg>
                            <a href="{{ route('ticket.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Tickets') }}</a>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true">
                                <path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" />
                            </svg>
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">{{ __('Edit Page') }}</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            @if(Helpers::isRouteValid('ticket.create'))
            <a href="{{ route('ticket.create') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
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
        <form class="container mx-auto flex flex-wrap" action="{{ route('ticket.update',[$ticket->id]) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="branch_id" value="{{ $branch->id }}" id="branch_id">
            @csrf
            @method('PATCH')
            <div x-data="init()" class="lg:w-2/3 mx-auto">
                <div class="my-6">
                    <h4 class="text-2xl text-center text-gray-700 font-medium"> {{ __('Select visit date and time slot for branch') }} </h4>
                    <h2 class="text-3xl text-center text-yellow-500 font-medium my-2"> {{ $branch->name }} </h2>
                    <p class="flex justify-center items-start leading-relaxed">
                        <svg class="svg-icon" viewBox="0 0 20 20">
                            <path d="M10,1.375c-3.17,0-5.75,2.548-5.75,5.682c0,6.685,5.259,11.276,5.483,11.469c0.152,0.132,0.382,0.132,0.534,0c0.224-0.193,5.481-4.784,5.483-11.469C15.75,3.923,13.171,1.375,10,1.375 M10,17.653c-1.064-1.024-4.929-5.127-4.929-10.596c0-2.68,2.212-4.861,4.929-4.861s4.929,2.181,4.929,4.861C14.927,12.518,11.063,16.627,10,17.653 M10,3.839c-1.815,0-3.286,1.47-3.286,3.286s1.47,3.286,3.286,3.286s3.286-1.47,3.286-3.286S11.815,3.839,10,3.839 M10,9.589c-1.359,0-2.464-1.105-2.464-2.464S8.641,4.661,10,4.661s2.464,1.105,2.464,2.464S11.359,9.589,10,9.589"></path>
                        </svg>
                        {{ $branch->address }}
                    </p>
                </div>

                <hr class="my-4">
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Visit Date') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('date') border-red-400 @enderror" type="date" name="date" id="date" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}" max="{{ Carbon\Carbon::parse($ticket->created_at)->addMonth(1)->format('Y-m-d') }}" x-on:change="data.visit_date = $event.target.value; slots()" autocomplete="off" value="{{ old('date')?? date('Y-m-d', strtotime($ticket->date)) }}" onkeydown="return false">
                        @error('date')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>

                <div x-show="open_slots.length > 0" class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-x-4" x-transition:enter-end="opacity-100 transform translate-x-0" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform translate-x-0" x-transition:leave-end="opacity-0 transform translate-x-4">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Slot') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <div class="flex flex-col flex-wrap mt-2 h-96">
                            <template x-for="slot in open_slots" :key="slot.id">
                                <label class="w-1/3 mb-4 inline-flex items-center" x-bind:class="{ 'text-red-700 line-through': slot.status == 'booked' }">
                                    <input type="radio" class="focus:ring-blue-400 focus:border-blue-400 block sm:text-sm border-gray-400 w-5 h-5 border text-blue-700" x-bind:class="{ 'cursor-pointer': slot.status != 'booked' }" name="slot" :value="slot.slot_id" x-bind:disabled="slot.status == 'booked'" x-on:change="data.slot = slot.slot.name">
                                    <span class="ml-2" x-text="slot.slot.name" x-bind:class="{ 'cursor-pointer': slot.status != 'booked' }"></span>
                                </label>
                            </template>
                        </div>
                        @error('slot')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>

                @if(Auth::user()->is_admin)
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Adult (10+ age)') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('adult_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-on:change="data.no_of_adult = $event.target.value" x-on:keyup="data.no_of_adult = $event.target.value" min="1" max="100" name="adult_number" id="adult_number" autocomplete="off" placeholder="{{ __('Ex. 4') }}" value="{{ old('adult_number') ?? $ticket->regular_ticket_count }}">
                        @error('adult_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <span x-html="data.no_of_adult + ' * ' + cost.adult + ' = ' + cost.adult * data.no_of_adult"></span> <span>৳</span>
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Child (4-10 age)') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('child_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-on:change="data.no_of_child = $event.target.value" x-on:keyup="data.no_of_child = $event.target.value" min="0" max="100" name="child_number" id="child_number" autocomplete="off" placeholder="{{ __('EX. 3') }}" value="{{ old('child_number') ?? $ticket->child_ticket_count }}">
                        @error('child_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <span x-html="data.no_of_child + ' * ' + cost.child + ' = ' + cost.child * data.no_of_child"></span> <span>৳</span>
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
                                    <input type="radio" class="focus:ring-blue-400 focus:border-blue-400 block sm:text-sm border-gray-300 w-5 h-5 border text-blue-700 cursor-pointer" name="facility" data-facility="{{ $facility->title }}" data-cost="{{ $facility->cost }}" x-on:change="cost.facility = $event.target.dataset.cost; data.facility = $event.target.value; data.facility_text = $event.target.dataset.facility" value="{{ $facility->id }}" @if($facility->id == $ticket->facility_id) checked @endif {{ old('facility') == $facility->id ? "checked" : "" }}>
                                    <span class="ml-2"> {{ $facility->title }} @ {{ $facility->cost }} </span>
                                </label>
                                <span x-show="data.facility == {{ $facility->id }}" @click="cost.facility = 0; data.facility = null; data.facility_text = null; facilityUnchecked()" class="ml-4 inline-flex text-sm cursor-pointer">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </span>
                            </div>
                            @endforeach
                        </div>
                        @error('facility')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <span x-html="cost.facility"></span> <span>৳</span>
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Total') }}
                    </dt>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-2 sm:text-left pr-8">
                        <span x-html="cost.adult * data.no_of_adult + cost.child * data.no_of_child + parseInt(cost.facility)"></span> <span>৳</span>
                    </dd>
                </div>

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
                        <div class="flex flex-col mt-2">
                            @php
                            $classes = [
                            'visited' => 'focus:ring-green-400 focus:border-green-400 text-green-700 ',
                            'not-visited' => 'focus:ring-blue-400 focus:border-blue-400 text-blue-700 ',
                            ];
                            @endphp
                            @foreach (config('upsidedown.ticket.statuses') as $status)
                            <label class="mb-4 inline-flex items-center cursor-pointer">
                                <input type="radio" class="block sm:text-sm border-gray-400 w-5 h-5 border cursor-pointer {{ $classes[$status]}}" name="status" value="{{ $status }}" @if($status==$ticket->status) checked @endif {{ old('status') == $status ? "checked" : "" }}>
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
                @endif
                <hr class="my-4">
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-semibold text-gray-500 sm:col-span-1"></dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <button type="button" x-on:click="preview = true" class="inline-flex items-center bg-yellow-500 hover:bg-yellow-400 text-white text-sm font-semibold py-2 pl-3 pr-4 rounded">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            {{ __('Preview') }}
                        </button>
                    </dd>
                </div>

                <div x-show="preview" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true" style="display: none;">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="preview" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-description="Background overlay, show/hide based on modal state." class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-on:click="preview = false" aria-hidden="true"></div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        <div x-show="preview" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100" x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-description="Modal panel, show/hide based on modal state." class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full max-w-lg">
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
                                                                <span x-html="data.visit_date"></span>
                                                            </dd>
                                                        </div>
                                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                Customer
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                                <span class="text-base font-semibold" x-html="user.name"></span>
                                                                <span class="text-sm" x-html="user.mobile"></span>
                                                                <span class="text-sm" x-html="user.email"></span>
                                                                <span class="text-xs" x-html="user.address"></span>
                                                            </dd>
                                                        </div>
                                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                Ticket
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                                <span class="text-sm" x-show="data.no_of_adult > 0">Adult: <span x-html="data.no_of_adult"></span></span>
                                                                <span class="text-sm" x-show="data.no_of_child > 0">Child: <span x-html="data.no_of_child"></span></span>
                                                                <span class="text-sm" x-html="data.facility_text"></span>
                                                            </dd>
                                                        </div>
                                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                Branch
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                                <span class="text-base font-semibold"><span x-html="data.branch"></span></span>
                                                                <span class="text-sm" x-show="data.slot">Slot: <span x-html="data.slot"></span></span>
                                                            </dd>
                                                        </div>
                                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                Total
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                                                <span x-html="'(' + data.no_of_adult + '*' + cost.adult + ') + (' + data.no_of_child + '*' + cost.child + ') + ' + cost.facility + ' = ' + parseInt(data.no_of_adult * cost.adult + data.no_of_child * cost.child + parseInt(cost.facility))"></span> ৳
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
    let ticket = @json($ticket);
    let slots = @json($slots);

    function facilityUnchecked() {
        if (document.querySelector('input[name=facility]:checked')) {
            document.querySelector('input[name=facility]:checked').checked = false;
        }
    }

    function init() {
        return {
            preview: false,
            cost: {
                adult: parseInt(branch.regular_price) || 0,
                child: parseInt(branch.child_price) || 0,
                facility: ticket.facility.cost,
            },
            data: {
                visit_date: ticket.date.split(" ")[0],
                slot: ticket.slot.name,
                no_of_adult: ticket.regular_ticket_count,
                no_of_child: ticket.child_ticket_count,
                facility: ticket.facility.cost,
                facility_text: ticket.facility.title,
                branch: branch.name,
            },
            user: {
                name: ticket.customer.name,
                email: ticket.customer.email,
                mobile: ticket.customer.mobile,
                address: ticket.customer.address,
            },

            open_slots: slots,
            slots() {
                if (this.data.visit_date) {
                    return axios.post('/slot-check', {
                        'branch_id': branch.id,
                        'date': this.data.visit_date,
                    }).then((response) => {
                        this.open_slots = response.data;
                    }).catch((error) => {
                        console.log(error)
                    })
                }
            }

        }
    }
</script>
@endsection
