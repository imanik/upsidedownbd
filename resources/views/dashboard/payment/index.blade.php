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
                            <a href="{{ route('payment.index') }}" class="ml-4 text-sm font-medium text-gray-500 hover:text-gray-700">{{ __('Payments') }}</a>
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
    </div>
</div>
@endsection

@section('content')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
    @include('partials.alert')

    <div class="mb-5 bg-white shadow sm:rounded-lg">
        <div class="flex items-center justify-between px-4 py-5 border-b border-gray-200 sm:px-6">
            <p class="max-w-2xl text-md leading-10 text-gray-700 text-2xl font-semibold">{{ __('Payments') }}</p>

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
                @endif
                <div class="text-sm text-gray-700">
                    <input type="date" class="rounded border-gray-400 w-full h-full lg:w-32 xl:w-40 appearance-none text-sm text-gray-700" name="date" value="{{ $filter['date']? date('Y-m-d', strtotime($filter['date'])) : null }}" onchange="this.form.submit()">
                </div>
            </form>
        </div>
        <table class="min-w-full w-full align-middle overflow-hidden" id="table">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Transaction ID') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Date') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Type') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Customer') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-left text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Status') }}</th>
                    <th class="px-6 py-3 border-b border-gray-200 bg-gray-100 text-right text-xs leading-4 font-semibold text-gray-500 uppercase tracking-wider">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($payments as $payment)
                <tr>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-600">{{ $payment->tran_id }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-600">{{ date('d/m/Y', strtotime($payment->created_at)) }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="text-sm leading-5 text-gray-600 capitalize">{{ $payment->type }}</div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        <div class="flex items-center">
                            <div class="ml-4">
                                <div class="text-sm leading-5 font-semibold text-gray-700">{{ optional($payment->customer)->name . ' [' . optional($payment->customer)->mobile . ']' }}</div>
                                <div class="text-sm leading-5 text-gray-600">{{ optional($payment->customer)->address }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap border-b border-gray-200">
                        @php
                        $classes = [
                            'Pending' => 'bg-yellow-100 text-yellow-600',
                            'Processing' => 'bg-green-100 text-green-500',
                            'Complete' => 'bg-green-100 text-green-500',
                            'Failed' => 'bg-red-100 text-red-500',
                        ];
                        @endphp
                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $classes[$payment->status]}}">
                            {{ App\Helpers::asText($payment->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-wrap text-right border-b border-gray-200 text-sm leading-5 font-semibold">
                        <div class="flex justify-end">
                            <a href="#" class="text-red-600 hover:text-red-900 ml-3" title="delete" id="data-route-{{ $payment->id }}" data-route="{{ route("payment.destroy", [$payment->id]) }}" onclick="event.preventDefault();if(confirm('Do you really want to delete this payment')){document.getElementById('delete-form').setAttribute('action', document.querySelector('#data-route-'+{{ $payment->id }}).dataset.route); document.getElementById('delete-form').submit();}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
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
