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
                            <a href="{{ route('fmenu.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Menus') }}</a>
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

    <div class="bg-white shadow overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <p class="max-w-2xl text-md leading-10 text-gray-700 text-2xl font-semibold">{{ __('Menu Create') }}</p>
        </div>
        <form action="{{ route('fmenu.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <dl x-data="init()" x-init="getBranch(); getFcategory(); " class="py-6">

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Title') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input type="text" class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('title') border-red-400 @enderror" name="title" id="title" placeholder="{{ __('Enter Title') }}" value="{{ __(old('title')) }}">
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
                        <input type="text" class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('subtitle') border-red-400 @enderror" name="subtitle" id="subtitle" placeholder="{{ __('Enter Sub Title') }}" value="{{ __(old('subtitle')) }}">
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
                            $photo = !empty($user->photo) && Storage::disk('public')->exists($user->photo) ? Storage::disk('public')->url($user->photo) : $dummy_photo;
                        @endphp
                        <input type="hidden" name="photo_status" id="photo_status" value="">
                        <div class="flex text-sm text-gray-700 border-2 border-gray-400 border-dashed rounded-md h-80 w-full bg-gray-50 cursor-pointer" onclick="this.querySelector('.form-file').click()">
                            <img class="object-cover w-full" src="{{ $photo }}" id="photo_holder" title="Click to upload photo">
                            <input type="file" class="form-file hidden" name="photo" id="photo" onchange="document.getElementById('photo_holder').src = window.URL.createObjectURL(this.files[0]); document.getElementById('photo_status').value = null;" accept=".png, .jpg, .jpeg">
                        </div>
                        <div class="absolute bottom-0 right-0">
                            <svg class="h-5 w-5 cursor-pointer text-blue-300" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" onclick="if(confirm('Do you want to refresh this photo??')){document.getElementById('photo_holder').src = '{{ $photo }}';document.getElementById('photo').value = null;document.getElementById('photo_status').value = '';}"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" /></svg>
                        </div>
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
                                <option value="{{ $branch->id }}" @if(old('branch')==$branch->id) selected @endif>{{ __(App\Helpers::asText($branch->name)) }}</option>
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
                        {{ __('Type Of Item') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="relative">
                            <select class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('fcategory') border-red-400 @enderror" name='fcategory' x-on:change="fcategory_id = $event.target.value; getFcategory(); ">
                                <option value="">{{ __('Select Category') }}</option>
                                @foreach ($fcategories as $fcategory)
                                <option value="{{ $fcategory->id }}" @if(old('fcategory')==$fcategory->id) selected @endif>{{ __(App\Helpers::asText($fcategory->name)) }}</option>
                                @endforeach
                            </select>
                            @error('fcategory')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </dd>
                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Number of Item') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('item_number') border-red-400 @enderror" type="number" oninput="this.value = this.value.replace(/[^0-9]/g, '');" x-on:change="no_of_item = $event.target.value" x-on:keyup="no_of_item = $event.target.value" min="1" max="100" name="item_number" id="item_number" autocomplete="off" placeholder="{{ __('Ex. 4') }}" value="{{ old('item_number') ?? 2 }}">
                        @error('item_number')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>

                </div>

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Normal Price') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="mt-1 flex rounded shadow-sm">
                            <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('normal_price') border-red-400 @enderror" type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="normal_price" x-model="normal_price" id="normal_price" autocomplete="off" placeholder="{{ __('Normal Price') }}" value="{{ old('normal_price') }}">
                            <span class="inline-flex items-center px-6 rounded-r border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">&#2547;</span>
                        </div>
                        @error('normal_price')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>

                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Offer Price') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="mt-1 flex rounded shadow-sm">
                            <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 z-10 sm:text-sm border-gray-300 rounded-l @error('offer_price') border-red-400 @enderror" type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '');" name="offer_price" x-model="offer_price" id="offer_price" autocomplete="off" placeholder="{{ __('Offer Price') }}" value="{{ old('offer_price') }}">
                            <span class="inline-flex items-center justify-center px-4 rounded-r border border-l-0 border-gray-300 bg-gray-50 text-gray-500 sm:text-sm">৳</span>
                        </div>
                        @error('offer_price')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Description') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <textarea class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('description') border-red-400 @enderror" name="description" rows="4" placeholder="{{ __('Enter Description') }}">{{ old('description') }}</textarea>
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
                                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                {{ __('Create') }}
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
            no_of_item: 2,
    //        no_of_child: 1,
            offer_price: @json(old('offer_price')?? null),
            branch_id: @json(old('branch')?? null),
            branch: null,
            branch_box: @json($branch_box),
            getBranch(){
                this.branch = this.branch_id? this.branch_box[this.branch_id] : null;
            },

            fcategory_id: @json(old('fcategory')?? null),
            fcategory: null,
            fcategory_box: @json($fcategory_box),
            getFcategory(){
                this.fcategory = this.fcategory_id? this.fcategory_box[this.fcategory_id] : null;
            },

        }
    }
</script>
@endsection
