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
                            <a href="{{ route('invite.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Invites') }}</a>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 w-5 h-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">{{ __('List Page') }}</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            @if(Helpers::isRouteValid('invite.create'))
            <a href="{{ route('invite.create') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                {{ __('Create') }}
            </a>
            @endif
            @if(Helpers::isRouteValid('invite.csv'))
            <a href="{{ route('invite.csv') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                {{ __('CSV') }}
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
            <p class="max-w-2xl text-md leading-10 text-gray-700 text-2xl font-semibold">{{ __('Invites') }}</p>

            <form class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-3">
                @if(Auth::user()->is_admin)
                <div class="text-sm text-gray-700">
                    <select class="rounded border-gray-400 w-full h-full lg:w-32 xl:w-40 appearance-none text-sm text-gray-700" name="branch" id="branch" onchange="this.form.submit()">
                        <option value="">{{ __('Select Branch') }}</option>
                        @foreach ($branches as $branch)
                        <option value="{{ $branch->id }}" @if($branch->id == $filter['branch']) selected @endif>{{ $branch->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="text-sm text-gray-700">
                    <select class="rounded border-gray-400 w-full h-full lg:w-32 xl:w-40 appearance-none text-sm text-gray-700" name="role" id="role" onchange="this.form.submit()">
                        <option value="">{{ __('Select Type') }}</option>
                        <option value="super-admin" @if ($filter['role'] == 'super-admin') selected @endif>{{ __('Super Admin') }}</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @if ($filter['role'] == $role->id) selected @endif>{{ $role->name }}</option>
                        @endforeach
                        <option value="customer" @if ($filter['role'] == 'customer') selected @endif>{{ __('Customer') }}</option>
                    </select>
                </div>
                @endif
            </form>
        </div>

        <table class="min-w-full w-full align-middle overflow-hidden" id="table">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Name') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Number') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Role') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-right text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($users as $user)
                <tr>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10">
                                <img class="h-10 w-10 rounded-full" src="/img/photo.svg" alt="" />
                            </div>
                            <div class="ml-4">
                                <div class="text-sm leading-5 font-semibold text-gray-700">{{ $user->name }}</div>
                                <div class="text-sm leading-5 text-gray-600">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                        {{ $user->mobile }}
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200 text-sm leading-5 text-gray-600">
                        {{ $user->user_type() }}
                    </td>
                    <td class="px-6 py-4 whitespace-wrap text-right border-b border-gray-200 text-sm leading-5 font-semibold">
                        <div class="flex justify-end">
                            <a href="{{ route('invite.coupon', ['id' => $user->id]) }}" class="text-indigo-600 hover:text-indigo-900 mx-3" name="edit">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </a>
                            <a href="#" class="text-red-600 hover:text-red-900 ml-3" id="data-route-{{ $user->id }}" data-route="{{ route('invite.destroy', [$user->id]) }}" onclick="event.preventDefault();if(confirm('Do you really want to delete this user')){document.getElementById('delete-form').setAttribute('action', document.querySelector('#data-route-'+{{ $user->id }}).dataset.route); document.getElementById('delete-form').submit();}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </a>
                        </div>
                    </td>
                 
                    <!-- <td class="px-6 py-4 whitespace-wrap text-right border-b border-gray-200 text-sm leading-5 font-semibold">
                        <div class="flex justify-end">
                           
                          
                            <a href="{{ route('invite.coupon', ['id' => $user->id]) }}" class="text-indigo-600 hover:text-indigo-900 mx-3" name="edit">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" >
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                
                            </a>
                           
                            <a href="#" class="text-red-600 hover:text-red-900" id="data-route-{{ $user->id }}" name="delete" data-route="{{ route("invite.destroy", [$user->id]) }}" onclick="event.preventDefault();if(confirm('Do you really want to delete this user')){document.getElementById('delete-form').setAttribute('action', document.querySelector('#data-route-'+{{ $user->id }}).dataset.route); document.getElementById('delete-form').submit();}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            </a>
                           
                        </div>
                    </td> -->
                </tr>
                @endforeach
            </tbody>
        </table>
        <form id="delete-form" action="#" method="POST" class="hidden">
            @csrf
            @method("delete")
        </form>
    </div>
</div>
@endsection
