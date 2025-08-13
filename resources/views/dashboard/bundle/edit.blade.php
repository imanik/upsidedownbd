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
                            <a href="{{ route('bundle.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Bundles') }}</a>
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
            @if(Helpers::isRouteValid('bundle.create'))
            <a href="{{ route('bundle.create') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
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

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <p class="max-w-2xl text-md leading-10 text-gray-700 text-2xl font-semibold">{{ __('Bundle Edit') }}</p>
        </div>
        <form action="{{ route('bundle.update',[$bundle->id]) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="{{ $bundle->type }}" id="type">
            @csrf
            @method('PATCH')
            <dl x-data="init()" x-init="getBranch(); getFacilities(); getFacilityCost();" class="py-6">

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Title') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input type="text" class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('title') border-red-400 @enderror" name="title" id="title" placeholder="{{ __('Enter Title') }}" value="{{ old('title')?? $bundle->title }}">
                        @error('title')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Sub Title') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input type="text" class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('subtitle') border-red-400 @enderror" name="subtitle" id="subtitle" placeholder="{{ __('Enter Sub Title') }}" value="{{ old('subtitle')?? $bundle->subtitle }}">
                        @error('subtitle')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>

                <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider text-right pr-8">
                        {{ __('Photo') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1 relative w-64">
                        @php
                            $dummy_photo = 'https://via.placeholder.com/400x500.png/ddd/333';
                            $photo = !empty($bundle->photo) && Storage::disk('public')->exists($bundle->photo) ? Storage::disk('public')->url($bundle->photo) : $dummy_photo;
                        @endphp
                        <div class="flex text-sm text-gray-700 border-2 border-gray-400 border-dashed rounded-md h-80 w-full bg-gray-50 cursor-pointer" onclick="this.querySelector('.form-file').click()">
                            <img class="object-cover w-full" src="{{ $photo }}" id="photo_holder" title="Click to upload photo">
                            <input type="file" class="form-file hidden" name="photo" id="photo" onchange="document.getElementById('photo_holder').src = window.URL.createObjectURL(this.files[0]); document.getElementById('photo_status').value = '';" accept=".png, .jpg, .jpeg">
                        </div>
                        <div class="absolute top-0 right-0">
                            <svg class="w-5 h-5 cursor-pointer text-red-500" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" onclick="if(confirm('Do you want to remove this photo??')){document.getElementById('photo_holder').src = '{{ $dummy_photo }}';document.getElementById('photo_status').value = 'removed';}"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="absolute bottom-0 right-0">
                            <svg class="w-5 h-5 cursor-pointer text-blue-300" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" onclick="if(confirm('Do you want to refresh this photo??')){document.getElementById('photo_holder').src = '{{ $photo }}';document.getElementById('photo').value = null;document.getElementById('photo_status').value = '';}"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" /></svg>
                        </div>
                        <input type="hidden" name="photo_status" id="photo_status" value="">
                        @error('photo')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Branch') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="relative">
                            <select class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('branch') border-red-400 @enderror" name='branch' x-on:change="branch_id = $event.target.value; getBranch(); getFacilities();">
                                <option value="">{{ __('Select Branch') }}</option>
                                @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" @if(old('branch')==$branch->id || $bundle->branch_id == $branch->id) selected @endif>{{ __(App\Helpers::asText($branch->name)) }}</option>
                                @endforeach
                            </select>
                            @error('branch')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Facility') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="relative">
                            <select class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('facility') border-red-400 @enderror" name='facility' x-on:change="facility_id = $event.target.value; getFacilityCost();">
                                <option value="">{{ __('Select Facility') }}</option>
                                <template x-for="(facility, index) in facilities" :key="index">
                                    <option :value="facility.id" x-bind:selected="facility.id == facility_id" x-text="facility.title" x-bind:data-cost="facility.cost"></option>
                                </template>
                            </select>
                            @error('facility')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <span x-html="facility_cost || 0"></span> <span>৳</span>
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Adult (10+ age)') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('adult_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-on:change="no_of_adult = $event.target.value" x-on:keyup="no_of_adult = $event.target.value" min="1" max="100" name="adult_number" id="adult_number" autocomplete="off" placeholder="{{ __('Ex. 4') }}" value="{{ old('adult_number')?? $bundle->regular_ticket_count }}">
                        @error('adult_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <span x-html="no_of_adult + ' * ' + (branch? branch.regular_price : 0) + ' = ' + (branch? branch.regular_price : 0) * no_of_adult"></span> <span>৳</span>
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Child (4-10 age)') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('child_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-on:change="no_of_child = $event.target.value" x-on:keyup="no_of_child = $event.target.value" min="0" max="100" name="child_number" id="child_number" autocomplete="off" placeholder="{{ __('EX. 3') }}" value="{{ old('child_number')?? $bundle->child_ticket_count }}">
                        @error('child_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <span x-html="no_of_child + ' * ' + (branch? branch.child_price : 0) + ' = ' + (branch? branch.child_price : 0) * no_of_child"></span> <span>৳</span>
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Offer Price') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="mt-1 flex rounded shadow-sm">
                            <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 z-10 sm:text-sm border-gray-300 rounded-l @error('offer_price') border-red-400 @enderror" type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="offer_price" id="offer_price" autocomplete="off" x-model="offer_price" placeholder="{{ __('Offer Price') }}" value="{{ old('offer_price')?? $bundle->offer_price }}">
                            <span class="inline-flex items-center justify-center px-4 rounded-r border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-2xl">৳</span>
                        </div>
                        @error('offer_price')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                    <dd class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        <input type="hidden" name="normal_price" :value="parseInt((branch? branch.regular_price : 0) * no_of_adult + (branch? branch.child_price : 0) * no_of_child + parseInt(facility_cost))">
                        <div class="flex-inline">
                            <span>Total</span>
                            <span>&nbsp;</span>
                            <span class="line-through" x-html="parseInt((branch? branch.regular_price : 0) * no_of_adult + (branch? branch.child_price : 0) * no_of_child + parseInt(facility_cost))"></span>
                            <span>৳</span>
                            <svg class="inline w-5 h-5 -mr-2 ml-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                            <svg class="inline w-5 h-5 -ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <span>&nbsp;</span>
                            <span x-html="offer_price || 0"></span>
                            <span>৳</span>
                        </div>
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Description') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <textarea class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('description') border-red-400 @enderror" name="description" rows="4" placeholder="{{ __('Enter Description') }}">{{ old('description')?? $bundle->description }}</textarea>
                        @error('description')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>

                <hr class="my-4">
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-semibold text-gray-500"></dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <div class="mt-6 flex space-x-3 md:mt-0">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                {{ __('Update') }}
                            </button>
                            <button type="reset" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                {{ __('Reset') }}
                            </button>
                        </div>
                    </dd>
                </div>
            </dl>
        </form>
    </div>
</div>
@endsection

@section('script')
<script>
    function init() {
        return {
            no_of_adult: @json($bundle->regular_ticket_count),
            no_of_child: @json($bundle->child_ticket_count),
            offer_price: @json($bundle->offer_price),
            branch_id: @json(old('branch')?? $bundle->branch_id),
            branch: null,
            branch_box: @json($branch_box),
            getBranch(){
                this.branch = this.branch_id? this.branch_box[this.branch_id] : null;
            },
            facility_id: @json(old('facility')?? $bundle->facility_id),
            facility_cost: 0,
            getFacilityCost(){
                this.facility_cost = this.facility_id? this.facility_box[this.facility_id].cost: 0
            },
            facility_box: @json($facility_box),
            facilities_box: @json($facilities_box),
            facilities: [],
            getFacilities(){
                this.facilities = this.branch_id? this.facilities_box[this.branch_id] : [];
            },
        }
    }
</script>
@endsection
