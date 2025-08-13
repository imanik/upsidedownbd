@extends('layouts.back')

@section('style')
@endsection

@section('header')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
<div class="py-6 md:flex md:items-center md:justify-between lg:border-t lg:border-gray-200">
    <div class="flex-1 min-w-0">
        <!-- Profile -->
        <div class="flex items-center">
            <img class="hidden h-16 w-16 rounded-full sm:block" src="{{ Auth::user()->photo ? Storage::url('thumbnails/'.Auth::user()->photo) : '/img/user.jpg' }}" alt="">
            <div>
                <div class="flex items-center">
                    <img class="h-16 w-16 rounded-full sm:hidden" src="{{ Auth::user()->photo ? Storage::url('thumbnails/'.Auth::user()->photo) : '/img/user.jpg' }}" alt="">
                    <h1 class="ml-3 text-2xl font-bold leading-7 text-gray-900 sm:leading-9 sm:truncate">
                        {{ App\Helpers::greeting() }}, {{ Auth::user()->name }}
                    </h1>
                </div>
                <dl class="mt-6 flex flex-col sm:ml-3 sm:mt-1 sm:flex-row sm:flex-wrap">
                    <dt class="sr-only">Company</dt>
                    <dd class="flex items-center text-sm text-gray-500 font-medium capitalize sm:mr-6">
                        <svg class="flex-shrink-0 mr-1.5 w-5 h-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" /></svg>
                        {{ optional(Auth::user()->branch)->address ?? "Upsidedown" }}, {{ Auth::user()->user_type() }}
                    </dd>
                    {{-- <dt class="sr-only">Account status</dt>
                    <dd class="mt-3 flex items-center text-sm text-gray-500 font-medium sm:mr-6 sm:mt-0 capitalize">
                        <svg class="flex-shrink-0 mr-1.5 w-5 h-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        Verified account
                    </dd> --}}
                </dl>
            </div>
        </div>
    </div>
    {{-- <div class="mt-6 flex space-x-3 md:mt-0 md:ml-4">
        <button type="button" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
            Add money
        </button>
        <button type="button" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-cyan-600 hover:bg-cyan-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
            Send money
        </button>
    </div> --}}
</div>
</div>
@endsection

@section('content')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">
<section class="text-gray-700 body-font">
    <div class="container mx-auto">
        <div class="flex flex-wrap -mx-4">
            @if(Helpers::isRouteValid('income.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('income.index') }}" class="transition duration-200 group block bg-blue-100 border border-blue-300 p-6 rounded-lg hover:bg-blue-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-blue-200 text-blue-600 border border-blue-300 group-hover:bg-blue-100 group-hover:text-blue-500 mb-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" /></svg>
                        
                        </div>
                        <h2 class="text-blue-700 font-semibold text-2xl title-font mb-2">{{ App\Helpers::trans($ticket_sale->total) }}</h2>
                    </div>
                    <h2 class="text-lg text-blue-700 font-semibold title-font mb-2"> {{ __('Todays Ticket Sale') }} </h2>
                </a>
            </div>
            @endif
            @if(Helpers::isRouteValid('transaction.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('transaction.index') }}" class="transition duration-200 group block bg-gray-100 border border-gray-300 p-6 rounded-lg hover:bg-gray-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600 border border-gray-300 group-hover:bg-gray-100 group-hover:text-gray-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6" />
                      </svg>
                       </div>
                        <h2 class="text-gray-700 font-semibold text-2xl title-font mb-2">{{ App\Helpers::trans($total_expense) }}</h2>
                    </div>
                    <h2 class="text-lg text-gray-700 font-semibold title-font mb-2"> {{ __('Todays Expense') }} </h2>
                </a>
            </div>
            @endif

            @if(Helpers::isRouteValid('transaction.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('transaction.index') }}" class="transition duration-200 group block bg-yellow-100 border border-yellow-300 p-6 rounded-lg hover:bg-yellow-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-yellow-200 text-yellow-600 border border-yellow-300 group-hover:bg-yellow-100 group-hover:text-yellow-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                      </svg>
                       </div>
                        <h2 class="text-yellow-700 font-semibold text-2xl title-font mb-2">{{ App\Helpers::trans($total_income) }}</h2>
                    </div>
                    <h2 class="text-lg text-yellow-700 font-semibold title-font mb-2"> {{ __('Todays Income') }} </h2>
                </a>
            </div>
            @endif
            @if(Helpers::isRouteValid('transaction.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('transaction.index') }}" class="transition duration-200 group block bg-gray-100 border border-gray-300 p-6 rounded-lg hover:bg-gray-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600 border border-gray-300 group-hover:bg-gray-100 group-hover:text-gray-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" />
                      </svg>   
                      </div>
                        <h2 class="text-gray-700 font-semibold text-2xl title-font mb-2">{{ __('0') }}</h2>
                    </div>
                    <h2 class="text-lg text-gray-700 font-semibold title-font mb-2"> {{ __('Todays Bank Deposit') }} </h2>
                </a>
            </div>
            @endif

        </div>

        <div class="flex flex-wrap -mx-4">
            @if(Helpers::isRouteValid('income.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('income.index') }}" class="transition duration-200 group block bg-blue-100 border border-blue-300 p-6 rounded-lg hover:bg-blue-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-blue-200 text-blue-600 border border-blue-300 group-hover:bg-blue-100 group-hover:text-blue-500 mb-4">
                      
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                      </svg>
                        </div>
                        <h2 class="text-blue-700 font-semibold text-2xl title-font mb-2">{{ $ticket_sale->adult_ticket_count }}</h2>
                    </div>
                    <h2 class="text-lg text-blue-700 font-semibold title-font mb-2"> {{ __('Todays Adult') }} </h2>
                </a>
            </div>
            @endif
            @if(Helpers::isRouteValid('income.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('income.index') }}" class="transition duration-200 group block bg-gray-100 border border-gray-300 p-6 rounded-lg hover:bg-gray-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600 border border-gray-300 group-hover:bg-gray-100 group-hover:text-gray-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                       </div>
                        <h2 class="text-gray-700 font-semibold text-2xl title-font mb-2">{{ $ticket_sale->child_ticket_count }}</h2>
                    </div>
                    <h2 class="text-lg text-gray-700 font-semibold title-font mb-2"> {{ __('Todays Child') }} </h2>
                </a>
            </div>
            @endif

            @if(Helpers::isRouteValid('income.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('income.index') }}" class="transition duration-200 group block bg-yellow-100 border border-yellow-300 p-6 rounded-lg hover:bg-yellow-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-yellow-200 text-yellow-600 border border-yellow-300 group-hover:bg-yellow-100 group-hover:text-yellow-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7a4 4 0 11-8 0 4 4 0 018 0zM9 14a6 6 0 00-6 6v1h12v-1a6 6 0 00-6-6zM21 12h-6" />
                        </svg>
                    </div>
                        <h2 class="text-yellow-700 font-semibold text-2xl title-font mb-2">{{ $ticket_sale->discount_ticket_count }}</h2>
                    </div>
                    <h2 class="text-lg text-yellow-700 font-semibold title-font mb-2"> {{ __('Todays Discount') }} </h2>
                </a>
            </div>
            @endif
            @if(Helpers::isRouteValid('income.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('income.index') }}" class="transition duration-200 group block bg-gray-100 border border-gray-300 p-6 rounded-lg hover:bg-gray-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600 border border-gray-300 group-hover:bg-gray-100 group-hover:text-gray-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                      </svg>
                         </div>
                        <h2 class="text-gray-700 font-semibold text-2xl title-font mb-2">{{ $ticket_sale->dslr_type1_count + $ticket_sale->dslr_type2_count }}</h2>
                    </div>
                    <h2 class="text-lg text-gray-700 font-semibold title-font mb-2"> {{ __('Todays DSLR') }} </h2>
                </a>
            </div>
            @endif

        </div>

        
        <hr class="my-4">


        <div class="flex flex-wrap -mx-4">
            @if(Helpers::isRouteValid('income.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('income.index') }}" class="transition duration-200 group block bg-blue-100 border border-blue-300 p-6 rounded-lg hover:bg-blue-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-blue-200 text-blue-600 border border-blue-300 group-hover:bg-blue-100 group-hover:text-blue-500 mb-4">
                      
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                      </svg>
                        </div>
                        <h2 class="text-blue-700 font-semibold text-2xl title-font mb-2">{{ $ticket_sale->adult_ticket_count }}</h2>
                    </div>
                    <h2 class="text-lg text-blue-700 font-semibold title-font mb-2"> {{ __('Cash In Hand') }} </h2>
                </a>
            </div>
            @endif
            @if(Helpers::isRouteValid('income.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('income.index') }}" class="transition duration-200 group block bg-gray-100 border border-gray-300 p-6 rounded-lg hover:bg-gray-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600 border border-gray-300 group-hover:bg-gray-100 group-hover:text-gray-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                      </svg>
                       </div>
                        <h2 class="text-gray-700 font-semibold text-2xl title-font mb-2">{{ $ticket_sale->child_ticket_count }}</h2>
                    </div>
                    <h2 class="text-lg text-gray-700 font-semibold title-font mb-2"> {{ __('COGS') }} </h2>
                </a>
            </div>
            @endif

            @if(Helpers::isRouteValid('income.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('income.index') }}" class="transition duration-200 group block bg-yellow-100 border border-yellow-300 p-6 rounded-lg hover:bg-yellow-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-yellow-200 text-yellow-600 border border-yellow-300 group-hover:bg-yellow-100 group-hover:text-yellow-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                      </svg>
                    </div>
                        <h2 class="text-yellow-700 font-semibold text-2xl title-font mb-2">{{ $ticket_sale->discount_ticket_count }}</h2>
                    </div>
                    <h2 class="text-lg text-yellow-700 font-semibold title-font mb-2"> {{ __('Food Sale') }} </h2>
                </a>
            </div>
            @endif
            @if(Helpers::isRouteValid('income.index'))
            <div class="xl:w-1/4 md:w-1/2 p-4 w-full">
                <a href="{{ route('income.index') }}" class="transition duration-200 group block bg-gray-100 border border-gray-300 p-6 rounded-lg hover:bg-gray-200 cursor-pointer">
                    <div class="flex justify-between">
                        <div class="transition duration-200 w-12 h-12 inline-flex items-center justify-center rounded-full bg-gray-200 text-gray-600 border border-gray-300 group-hover:bg-gray-100 group-hover:text-gray-500 mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                      </svg>
                         </div>
                        <h2 class="text-gray-700 font-semibold text-2xl title-font mb-2">{{ $ticket_sale->dslr_type1_count + $ticket_sale->dslr_type2_count }}</h2>
                    </div>
                    <h2 class="text-lg text-gray-700 font-semibold title-font mb-2"> {{ __('Online Ticket Sale') }} </h2>
                </a>
            </div>
            @endif

        </div>

    </div>
    
</section>
</div>


@endsection
