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
                            <a href="{{ route('user.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Users') }}</a>
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
            @if(Helpers::isRouteValid('user.create'))
            <a href="{{ route('user.create') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
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

    <div class="bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <p class="max-w-2xl text-md leading-10 text-gray-700 text-2xl font-semibold">{{ __('User Edit') }}</p>
        </div>
        <form class="" action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('patch')
            <dl x-data="{ role: {{!$user->is_admin && $user->role? 'true' : 'false'}} }" class="py-6 max-w-5xl mx-auto">

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider text-right pr-8">
                        {{ __('Role') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <div class="mt-2">
                            <label class="w-32 mr-4 inline-flex items-center cursor-pointer">
                                <input type="radio" class="form-radio w-5 h-5 border-yellow-500 text-yellow-500 cursor-pointer focus:ring-yellow-500" name="role" x-on:change="role = false" value="super-admin" @if($user->is_admin || old('role') == 'super-admin') checked @endif>
                                <span class="ml-2 tracking-wide"> Super Admin </span>
                            </label>
                            @foreach($roles as $role)
                            <label class="w-32 mr-4 inline-flex items-center cursor-pointer">
                                <input type="radio" class="form-radio w-5 h-5 border-green-500 text-green-500 cursor-pointer focus:ring-green-500" name="role" x-on:change="role = true" value="{{ $role->id }}" @if($user->role_id == $role->id || old('role') == $role->id) checked @endif>
                                <span class="ml-2 tracking-wide"> {{ __($role->name) }} </span>
                            </label>
                            @endforeach
                            <label class="w-32 mr-4 inline-flex items-center cursor-pointer">
                                <input type="radio" class="form-radio w-5 h-5 border-blue-500 text-blue-500 cursor-pointer focus:ring-blue-500" name="role" x-on:change="role = false" value="customer" @if(!$user->is_admin && !$user->role) checked @endif>
                                <span class="ml-2 tracking-wide"> Customer </span>
                            </label>
                        </div>
                        @error('role')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>

                <div x-show="role" class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 transform translate-x-4"
                    x-transition:enter-end="opacity-100 transform translate-x-0"
                    x-transition:leave="transition ease-in duration-300"
                    x-transition:leave-start="opacity-100 transform translate-x-0"
                    x-transition:leave-end="opacity-0 transform translate-x-4">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider text-right pr-8">
                        {{ __('Branch') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <div class="mt-2">
                            @foreach($branches as $branch)
                            <label class="w-32 mr-4 inline-flex items-center cursor-pointer">
                                <input type="radio" class="form-radio w-5 h-5 border-green-500 text-green-500 cursor-pointer focus:ring-green-500" name="branch" value="{{ $branch->id }}" @if($user->branch_id == $branch->id || old('branch') == $branch->id) checked @endif>
                                <span class="ml-2 tracking-wide"> {{ __($branch->name) }} </span>
                            </label>
                            @endforeach
                        </div>
                        @error('branch')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>

                <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider text-right pr-8">
                        {{ __('Photo') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1 relative w-32">
                        @php
                            $dummy_photo = '/img/user.jpg';
                            $photo = !empty($user->photo) && Storage::disk('public')->exists($user->photo) ? Storage::disk('public')->url($user->photo) : $dummy_photo;
                        @endphp
                        <input type="hidden" name="photo_status" id="photo_status" value="">
                        <div class="flex text-sm text-gray-700 border-2 border-gray-400 border-dashed rounded-md h-32 w-full bg-gray-50 cursor-pointer" onclick="this.querySelector('.form-file').click()">
                            <img class="object-cover w-full" src="{{ $photo }}" id="photo_holder" title="Click to upload photo">
                            <input type="file" class="form-file hidden" name="photo" id="photo" onchange="document.getElementById('photo_holder').src = window.URL.createObjectURL(this.files[0]); document.getElementById('photo_status').value = null;" accept=".png, .jpg, .jpeg">
                        </div>
                        <div class="absolute top-0 right-0">
                            <svg class="w-5 h-5 cursor-pointer text-red-500" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" onclick="if(confirm('Do you want to remove this photo??')){document.getElementById('photo_holder').src = '{{ $dummy_photo }}';document.getElementById('photo').value = null;document.getElementById('photo_status').value = 'removed';}"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" /></svg>
                        </div>
                        <div class="absolute bottom-0 right-0">
                            <svg class="w-5 h-5 cursor-pointer text-blue-300" viewBox="0 0 20 20" fill="currentColor" xmlns="http://www.w3.org/2000/svg" onclick="if(confirm('Do you want to refresh this photo??')){document.getElementById('photo_holder').src = '{{ $photo }}';document.getElementById('photo').value = null;document.getElementById('photo_status').value = '';}"><path fill-rule="evenodd" d="M4 2a1 1 0 011 1v2.101a7.002 7.002 0 0111.601 2.566 1 1 0 11-1.885.666A5.002 5.002 0 005.999 7H9a1 1 0 010 2H4a1 1 0 01-1-1V3a1 1 0 011-1zm.008 9.057a1 1 0 011.276.61A5.002 5.002 0 0014.001 13H11a1 1 0 110-2h5a1 1 0 011 1v5a1 1 0 11-2 0v-2.101a7.002 7.002 0 01-11.601-2.566 1 1 0 01.61-1.276z" clip-rule="evenodd" /></svg>
                        </div>
                        @error('photo')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider text-right pr-8">
                        {{ __('Full name') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('name') border-red-400 @enderror" type="text" name="name" placeholder="Full Name" value="{{ old('name') ?? $user->name }}">
                        @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Mobile') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('mobile') border-red-400 @enderror" type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="13" minlength="11" name="mobile" id="mobile" autocomplete="off" placeholder="{{ __('Mobile') }}" value="{{ old('mobile') ?? $user->mobile }}">
                        @error('mobile')
                        <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider text-right pr-8">
                        {{ __('E-mail Address') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('email') border-red-400 @enderror" type="email" name="email" autocomplete="off" placeholder="name@example.com" value="{{ old('email') ?? $user->email }}">
                        @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider text-right pr-8">
                        {{ __('Password') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('password') border-red-400 @enderror" type="password" name="password" autocomplete="new-password" placeholder="********" value="">
                        @error('password')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider text-right pr-8">
                        {{ __('Status') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <div class="mt-2">
                            @if ($user->status == "pending")
                            <label class="w-32 mr-4 inline-flex items-center cursor-pointer">
                                <input type="radio" class="form-radio w-5 h-5 border-yellow-500 text-yellow-500 cursor-pointer focus:ring-yellow-500" name="status" value="pending" {{ $user->status == "pending" ? 'checked' : '' }}>
                                <span class="ml-2 tracking-wide"> Pending </span>
                            </label>
                            @endif
                            <label class="w-32 mr-4 inline-flex items-center cursor-pointer">
                                <input type="radio" class="form-radio w-5 h-5 border-green-500 text-green-500 cursor-pointer focus:ring-green-500" name="status" value="active" {{ $user->status == "active" ? 'checked' : '' }}>
                                <span class="ml-2 tracking-wide"> Active </span>
                            </label>
                            <label class="w-32 mr-4 inline-flex items-center cursor-pointer">
                                <input type="radio" class="form-radio w-5 h-5 border-indigo-500 text-indigo-500 cursor-pointer focus:ring-indigo-500" name="status" value="suspended" {{ $user->status == "suspended" ? 'checked' : '' }}>
                                <span class="ml-2 tracking-wide"> Suspended </span>
                            </label>
                            <label class="w-32 mr-4 inline-flex items-center cursor-pointer">
                                <input type="radio" class="form-radio w-5 h-5 border-black text-black cursor-pointer focus:ring-black" name="status" value="blocked" {{ $user->status == "blocked" ? 'checked' : '' }}>
                                <span class="ml-2 tracking-wide"> Blocked </span>
                            </label>
                        </div>
                        @error('status')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                        @enderror
                    </dd>
                </div>

                <hr class="my-4">
                <div class="px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
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
