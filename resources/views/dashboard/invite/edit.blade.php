@extends('layouts.back')

@section('script')
@endsection

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
                            <a href="{{ route('employee.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Employees') }}</a>
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
            @if(Helpers::isRouteValid('employee.create'))
            <a href="{{ route('employee.create') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
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
            <p class="max-w-2xl text-md leading-10 text-gray-700 text-2xl font-semibold">{{ __('Employee Edit') }}</p>
        </div>
        <form action="{{ route('employee.update',[$employee->id]) }}" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="type" value="{{ $employee->type }}" id="type">
            @csrf
            @method('PATCH')
            <dl class="py-6">

                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Branch') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="relative">
                            <select class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('branch') border-red-400 @enderror" name='branch' id='branch'>
                                <option value="">{{ __('Select Branch') }}</option>
                                @foreach ($branches as $branch)
                                <option value="{{ $branch->id }}" @if($employee->branch && $employee->branch->id == $branch->id) selected @endif @if($branch->id == old('branch')) selected @endif>{{ __(App\Helpers::asText($branch->name)) }}</option>
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
                        {{ __('Designation') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <div class="relative">
                            <select class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('designation') border-red-400 @enderror" name='designation' id='designation'>
                                <option value="">{{ __('Select Designation') }}</option>
                                @foreach ($designations as $designation)
                                <option value="{{ $designation->id }}" @if($employee->designation && $employee->designation->id == $designation->id) selected @endif @if($designation->id == old('designation')) selected @endif>{{ __(App\Helpers::asText($designation->title)) }}</option>
                                @endforeach
                            </select>
                            @error('designation')
                            <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </dd>
                </div>
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                        {{ __('Name') }}
                    </dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('name') border-red-400 @enderror" type="text" maxlength="191" name="name" id="name" autocomplete="off" placeholder="{{ __('Employee Name') }}" value="{{ old('name')?? $employee->name }}">
                        @error('name')
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
                            <input class="focus:ring-blue-400 focus:border-blue-400 block w-full pl-12 pr-12 sm:text-sm border-gray-300 rounded @error('mobile') border-red-400 @enderror" type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11" minlength="11" name="mobile" id="mobile" autocomplete="off" placeholder="01XXXXXXXXX" value="{{ old('mobile')?? $employee->mobile }}">
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
                        <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('address') border-red-400 @enderror" type="text" maxlength="400" name="address" id="address" autocomplete="off" placeholder="{{ __('address') }}" value="{{ old('address')?? $employee->address }}">
                        @error('address')
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
