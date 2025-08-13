@extends('layouts.back')

@section('script')
<script>
    function checkModify(e) {
        let item = e.target;
        let checkBoxes = document.querySelectorAll(".form-checkbox");
        checkBoxes.forEach(checkbox => {
            checkbox.checked = item.checked;
        });
    }

    function groupCheckModify(e) {
        let item = e.target;
        let group = item.closest(".group");
        let checkBoxes = group.querySelectorAll(".form-checkbox");
        checkBoxes.forEach(checkbox => {
            checkbox.checked = item.checked;
        });
    }
</script>

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
                            <a href="{{ route('role.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Roles') }}</a>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">{{ __('Permission Page') }}</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            @if(Helpers::isRouteValid('role.create'))
            <a href="{{ route('role.create') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
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
        <div class="flex items-center justify-between px-4 py-5 border-b border-gray-200 sm:px-6">
            <p class="max-w-2xl text-md leading-10 text-gray-700 text-2xl font-semibold">{{ __($role->name . ' Role Permission') }}</p>

            <div class="flex px-0 my-3 gap-2">
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500" onclick="document.getElementById('form').submit()">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    {{ __('Update') }}
                </button>

                <div class="inline-flex items-center px-4 py-2 text-sm font-medium rounded-md text-gray-700 bg-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                    <input type="checkbox" id="permission_all" class="group-checkbox form-checkbox w-5 h-5 text-indigo-600 transition duration-150 ease-in-out rounded cursor-pointer" onchange="checkModify(event)">
                    <label for="permission_all" class="ml-3 block leading-5 select-none cursor-pointer">All</label>
                </div>
            </div>
        </div>

        <form class="" action="{{ route('role.permission.update', $role->id) }}" id="form" method="POST">
            @csrf
            @method('patch')
            <dl class="py-6 px-6">
                <div class="grid grid-cols-3 gap-4 mb-6">
                    @foreach (config('permission') as $name => $items)
                    <div class="group px-4 py-4">
                        <dt class="px-4 my-3 text-lg leading-10 font-medium text-gray-700 border-b border-indigo-500">
                            <div class="flex items-center">
                                <input type="checkbox" id="permissions_{{$name}}" class="group-checkbox form-checkbox w-5 h-5 text-indigo-600 transition duration-150 ease-in-out rounded cursor-pointer" onchange="groupCheckModify(event)">
                                <label for="permissions_{{$name}}" class="ml-2 block select-none cursor-pointer">
                                    {{ Str::of($name)->ucfirst()->replace('-', ' ')->replace('_', ' ') }}
                                </label>
                            </div>
                        </dt>
                        @foreach ($items as $item => $route)
                        <dd class="px-4 mt-2 text-sm text-gray-700">
                            <div class="flex items-center">
                                <input id="permissions_{{$name}}_{{$item}}" name="permissions[{{$name}}][{{$item}}]" type="checkbox" class="form-checkbox w-5 h-5 text-indigo-600 transition duration-150 ease-in-out rounded cursor-pointer" @if( isset($permissions[$name]) && isset($permissions[$name][$item]) && $permissions[$name][$item]=="on" ) checked @endif>
                                <label for="permissions_{{$name}}_{{$item}}" class="ml-3 block leading-5 select-none cursor-pointer">
                                    {{ Str::of($item)->ucfirst()->replace('-', ' ')->replace('_', ' ') }}
                                </label>
                            </div>
                        </dd>
                        @endforeach
                    </div>
                    @endforeach
                </div>
                
                <hr class="my-4">
                <div class="px-4 py-3 sm:px-6">
                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                        <div class="mt-6 flex space-x-3 md:mt-0">
                            <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                {{ __('Update') }}
                            </button>
                            <button type="reset" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
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
