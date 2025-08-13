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
                            <a href="#" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700" aria-current="page">{{ __('Details') }}</a>
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

    <div class="bg-white shadow-md overflow-hidden sm:rounded-lg">
        <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
            <p class="max-w-2xl text-md leading-10 text-gray-700 text-2xl font-semibold">{{ __('Account Detail') }}</p>
        </div>

        <div class="text-sm text-gray-700">
                        <input type="date" class="rounded border-gray-400 w-full h-full lg:w-32 xl:w-40 appearance-none text-sm text-gray-700" name="date" id="date" value="{{ $filter['date']? date('Y-m-d', strtotime($filter['date'])) : null }}" onchange="this.form.submit()">
                    </div>
                    <button type="submit" class="inline-flex items-center bg-yellow-500 hover:bg-yellow-400 text-white text-sm font-semibold py-2 px-3 rounded" onclick="document.getElementById('date').value=null; this.form.submit()">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>

            <dl x-data="{type: ''}" class="py-6">
                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <p class="max-w-2xl text-md leading-6 text-gray-700 text-2xl font-semibold">{{ __('Income') }}</p>
                </div>
                <div class="w-half px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                    <dt class="text-sm leading-5 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">

                      

                        @foreach ($incomes_detail as $income_detail)
                        <p>{{ $income_detail->name }}</p>
                        @endforeach
                        <br>
                        <p class="text-blue-800 font-bold">{{ _('Total Income') }}</p>


                    </dt>
                    <dd class="text-sm leading-5 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">
                     
                        @foreach ($incomes_detail as $income_detail)
                        <p>{{  App\Helpers::getIncomeTotalByCategory($income_detail->id) }}</p>
                        @endforeach
                        <br>
                        <p class="text-blue-800 font-extrabold"></p>
                    </dd>
                </div>

                <div class="px-4 py-5 border-b border-gray-200 sm:px-6">
                    <p class="max-w-2xl text-md leading-6 text-gray-700 text-2xl font-semibold">{{ __('Expense') }}</p>
                </div>
                <div class="w-half px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">

                    <dt class="text-sm leading-5 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">


                        @foreach ($expenses_detail as $expense_detail)
                        <p>{{ $expense_detail->name }}</p>
                        @endforeach
                        <br>
                        <p class="text-red-700 font-extrabold">{{ _('Total Expense') }}</p>


                    </dt>
                    <dd class="text-sm leading-5 font-semibold text-gray-700 tracking-wider sm:col-span-1 sm:text-right pr-8">

                        @foreach ($expenses_detail as $expense_detail)
                        <p>{{   App\Helpers::getExpenseTotalByCategory($expense_detail->id)  }}</p>
                        <!-- <p>{{   $expense_detail->id  }}</p> -->
                        @endforeach
                        <br>
                        <p class="text-red-700 font-extrabold"></p>
                       
                    </dd>
                </div>

            </dl>

    </div>
</div>
@endsection
