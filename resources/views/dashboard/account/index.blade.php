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
                            <a href="{{ route('account.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Accounts') }}</a>
                        </div>
                    </li>

                    <li>
                        <div class="flex items-center">
                            <svg class="flex-shrink-0 h-5 w-5 text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20" aria-hidden="true"><path d="M5.555 17.776l8-16 .894.448-8 16-.894-.448z" /></svg>
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">{{ __('List Page') }}</a>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            @if(Helpers::isRouteValid('account.detail'))
            <a href="{{ route('account.detail') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
          </svg> {{ __('Details') }}
            </a>
            @endif
        </div>
        <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
            @if(Helpers::isRouteValid('account.summary'))
            <a href="{{ route('account.summary') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
          </svg> {{ __('Summary') }}
            </a>
            @endif
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
    @include('partials.alert')

    <div class="mb-5 bg-white shadow sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <p class="max-w-2xl text-md leading-10 text-gray-700 text-2xl font-semibold">{{ __('Daily Accounts') }}</p>
        </div>
        <table class="min-w-full w-full align-middle overflow-hidden" id="table">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Date') }}</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Branch') }}</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Cash Sale') }}</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Card Sale') }}</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Ticket') }}</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Income') }}</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Expense') }}</th>
                <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-right text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody class="bg-white">
            @foreach ($incomes as $income)
            <tr>

                <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-700">{{ $income->getDate() }}</div>
                </td>
                <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-700">{{ optional($income->branch)->name}}</div>
                </td>

                <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-700">{{ $income->total - $income->cc_sale}}</div>
                </td>
                <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-700">{{  $income->cc_sale}}</div>
                </td>

                <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-700">{{ $income->total }}</div>
                </td>
                <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-700">{{  App\Helpers::getIncomeSumByDate($income->date) }}</div>
                </td>
                <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                    <div class="text-sm leading-5 text-gray-700">{{  App\Helpers::getExpenseSumByDate($income->date) }}</div>
                </td>
                <td class="px-6 py-4 whitespace-wrap text-right border-b border-gray-200 text-sm leading-5 font-semibold">
                    <div class="flex justify-end">

                        <a href="{{ route('account.show',$income->id) }}" class="text-indigo-600 hover:text-indigo-900 ml-3" title="show">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                        </a>
                    </div>
                </td>
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
