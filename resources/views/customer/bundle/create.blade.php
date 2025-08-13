@extends('layouts.front')

@section('content')
<div class="px-4 sm:px-6 lg:max-w-7xl lg:mx-auto lg:px-8">

    @include('partials.alert')

    <section class="text-gray-600 body-font">
        <form class="container mx-auto flex flex-wrap" action="{{ route('bundle.get') }}" method="POST" enctype="multipart/form-data">
            {{-- Preventing submit from enter press --}}
            <button type="submit" disabled style="display: none" aria-hidden="true"></button>
            <input type="hidden" name="bundle" value="{{ $bundle->id }}">
            <input type="hidden" name="branch" value="{{ $branch->id }}">
            @csrf

            <div x-data="init()" class="lg:w-full mx-auto">
                <div class="my-6">
                    <h4 class="text-2xl text-center text-gray-700 font-medium"> {{ __('Choose your prefered bundle') }} </h4>
                    <h2 class="text-3xl text-center text-yellow-500 font-medium my-2"> {{ $branch->name }} </h2>
                    <p class="flex justify-center items-start leading-relaxed">
                        <svg class="svg-icon" viewBox="0 0 20 20"><path d="M10,1.375c-3.17,0-5.75,2.548-5.75,5.682c0,6.685,5.259,11.276,5.483,11.469c0.152,0.132,0.382,0.132,0.534,0c0.224-0.193,5.481-4.784,5.483-11.469C15.75,3.923,13.171,1.375,10,1.375 M10,17.653c-1.064-1.024-4.929-5.127-4.929-10.596c0-2.68,2.212-4.861,4.929-4.861s4.929,2.181,4.929,4.861C14.927,12.518,11.063,16.627,10,17.653 M10,3.839c-1.815,0-3.286,1.47-3.286,3.286s1.47,3.286,3.286,3.286s3.286-1.47,3.286-3.286S11.815,3.839,10,3.839 M10,9.589c-1.359,0-2.464-1.105-2.464-2.464S8.641,4.661,10,4.661s2.464,1.105,2.464,2.464S11.359,9.589,10,9.589"></path></svg>
                        {{ $branch->address }}
                    </p>
                </div>
                <hr class="my-4">

                <!-- This example requires Tailwind CSS v2.0+ -->
                @php
                    $photo = !empty($bundle->photo) && Storage::disk('public')->exists($bundle->photo) ? Storage::disk('public')->url($bundle->photo) : "https://via.placeholder.com/400x500.png/ddd/333";
                @endphp

                <div class="flex justify-center sm:px-8 sm:py-12 sm:gap-x-8 md:py-16">
                    <div class="w-1/3 relative z-10 px-4 pt-10 pb-3 bg-gradient-to-t from-black sm:bg-none"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                        <p class="text-sm font-medium text-white sm:mb-1 sm:text-gray-500">{{ optional($bundle->branch)->name }}</p>
                        <h2 class="text-xl font-semibold text-white sm:text-2xl sm:leading-7 sm:text-black md:text-3xl">{{ $bundle->title }}</h2>
                        <h3 class="text-lg leading-6 text-gray-600">{{ $bundle->subtitle }}</h3>
                        <div class="flex items-center text-sm font-medium my-5 sm:mt-2 sm:mb-4">
                            <svg width="20" height="20" class="text-cyan-600" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <div class="ml-1">
                                <span class="text-black"> {{ $bundle->regular_ticket_count }} </span>
                                <span>({{ __('Adult') }})</span>
                            </div>
                            <div class="text-base font-normal mx-2">·</div>
                            <div class="ml-1">
                                <span class="text-black"> {{ $bundle->child_ticket_count }} </span>
                                <span>({{ __('Child') }})</span>
                            </div>
                        </div>

                        {{-- <div class="flex items-center text-sm font-medium my-5 sm:mt-2 sm:mb-4">
                            <svg width="20" height="20" class="text-cyan-600" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <div class="ml-1">
                                <span class="text-black"> {{ optional($bundle->facility)->title }} </span>
                            </div>
                        </div> --}}

                        <div class="flex items-center text-sm font-medium my-5 sm:mt-2 sm:mb-4">
                            <svg width="20" height="20" class="text-cyan-600" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <div class="ml-1">
                                <span class="text-red-500 line-through">{{ $bundle->normal_price }} <span class="text-base">৳</span></span>
                            </div>
                            <svg class="inline w-5 h-5 -mr-2 ml-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                            <svg class="inline w-5 h-5 -ml-1 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            <div class="ml-1">
                                <span class="text-black"> {{ $bundle->offer_price }} <span class="text-base">৳</span></span>
                            </div>
                        </div>

                        <hr class="w-16 border-gray-300 hidden sm:block">

                        <p class="flex items-center text-black text-sm font-medium h-20">
                            {{ $bundle->description }}
                        </p>

                        <div class="flex">
                            @if (!Auth::check() || Auth::user()->is_admin || Auth::user()->role)
                            <button x-show="!preview_box" x-on:click="preview_box = !preview_box" type="button" class="bg-cyan-100 text-cyan-700 text-base font-semibold px-6 py-2 rounded-lg">{{ __('Get') }}</button>
                            @else
                            <button x-on:click="preview = true" type="button" class="bg-cyan-100 text-cyan-700 text-base font-semibold px-6 py-2 rounded-lg">{{ __('Get') }}</button>
                            @endif
                        </div>

                    </div>
                    <div x-show="preview_box" class="w-1/3 space-y-1 px-4"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                        @if (!Auth::check() || Auth::user()->is_admin || Auth::user()->role)
                        <div class="w-full">
                            <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider pr-8">
                                {{ __('Name') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                                <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('name') border-red-400 @enderror" type="text" maxlength="191" name="name" x-model="visitor.name" id="name" autocomplete="off" placeholder="{{ __('Your name') }}" value="{{ old('name') ?? null }}">
                                @error('name')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </dd>
                        </div>
                        <div class="w-full">
                            <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider pr-8">
                                {{ __('Email') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                                <input class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('email') border-red-400 @enderror" type="text" maxlength="191" name="email" x-model="visitor.email" id="email" autocomplete="off" placeholder="{{ __('example@email.com') }}" value="{{ old('email') ?? null }}">
                                @error('email')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </dd>
                        </div>
                        <div class="w-full">
                            <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider pr-8">
                                {{ __('Mobile') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-1">
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <span class="text-gray-500 sm:text-sm">+88</span>
                                    </div>
                                    <input class="focus:ring-blue-400 focus:border-blue-400 block w-full pl-12 pr-12 sm:text-sm border-gray-300 rounded @error('mobile') border-red-400 @enderror" type="text" x-model="visitor.mobile" oninput="this.value = this.value.replace(/[^0-9]/g, '');" maxlength="11" minlength="11" name="mobile" id="mobile" autocomplete="off" placeholder="01XXXXXXXXX" value="{{ old('mobile') ?? null }}">
                                </div>
                                @error('mobile')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </dd>
                        </div>
                        <div class="w-full">
                            <dt class="text-sm leading-10 font-semibold text-gray-700 tracking-wider pr-8">
                                {{ __('Address') }}
                            </dt>
                            <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                                <textarea class="focus:ring-blue-400 focus:border-blue-400 block w-full px-4 sm:text-sm border-gray-300 rounded @error('address') border-red-400 @enderror" type="text" name="address" id="address" x-model="visitor.address" rows="3" placeholder="{{ __('Address') }}">{{ old('address') ?? null }}</textarea>
                                @error('address')
                                <p class="text-red-500 text-xs italic mt-1">{{ $message }}</p>
                                @enderror
                            </dd>
                        </div>
                        <div class="w-full py-2 flex gap-3">
                            <button type="button" x-on:click="preview = true" class="inline-flex items-center bg-yellow-200 hover:bg-yellow-300 text-yellow-700 text-base font-semibold px-6 py-2 rounded-lg">
                                <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                {{ __('Preview') }}
                            </button>
                            <button x-show="preview_box" x-on:click="preview_box = !preview_box" type="button" class="inline-flex items-center bg-gray-200 hover:bg-gray-300 text-gray-700 text-base font-semibold px-6 py-2 rounded-lg">{{ __('Cancel') }}</button>
                        </div>
                        @endif
                    </div>

                    <div class="w-1/3"
                        x-transition:enter="ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0">
                        <div class="relative">
                            <img src="{{ $photo }}" alt="" class="absolute inset-0 w-full object-cover bg-gray-100 sm:rounded-lg" />
                        </div>
                    </div>
                </div>

                <div x-show="preview" style="display: none;" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
                    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                        <div x-show="preview"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0"
                            x-transition:enter-end="opacity-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" x-description="Background overlay, show/hide based on modal state." class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" x-on:click="preview = false" aria-hidden="true"></div>

                        <!-- This element is to trick the browser into centering the modal contents. -->
                        <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                        <div x-show="preview"
                            x-transition:enter="ease-out duration-300"
                            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave="ease-in duration-200"
                            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95" x-description="Modal panel, show/hide based on modal state." class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-5xl sm:w-full max-w-lg">
                            <div class="bg-white px-4 py-5 sm:px-6 border-b border-gray-200">
                                <h3 class="text-xl font-semibold text-gray-900 text-center">
                                    {{ __('Bundle Information') }}
                                </h3>
                                <p class="mt-1 max-w-2xl text-sm text-gray-500" id="ticket_details"></p>
                            </div>
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                                <div class="sm:items-start">
                                    <div class="mt-10 sm:mt-0">
                                        <div class="md:grid md:grid-cols-3 md:gap-6">
                                            <div class="mt-5 md:mt-0 md:col-span-3">
                                                <!-- This example requires Tailwind CSS v2.0+ -->
                                                <div class="overflow-hidden sm:rounded-lg">
                                                    <dl>
                                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                {{ __('Visitor\'s Information') }}
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                                <span class="text-base font-semibold" x-html="visitor.name"></span>
                                                                <span class="text-sm" x-html="visitor.mobile"></span>
                                                                <span class="text-sm" x-html="visitor.email"></span>
                                                                <span class="text-sm" x-html="visitor.address"></span>
                                                            </dd>
                                                        </div>
                                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                Bundle
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                                <span class="text-sm font-semibold">Adult: <span class="font-normal">{{ $bundle->regular_ticket_count }}</span></span>
                                                                <span class="text-sm font-semibold">Child: <span class="font-normal">{{ $bundle->child_ticket_count }}</span></span>
                                                            </dd>
                                                        </div>
                                                        <div class="bg-white px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                Branch
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                                <span class="text-base font-semibold">{{ $branch->name }}</span>
                                                            </dd>
                                                        </div>
                                                        <div class="bg-gray-50 px-4 py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                                            <dt class="text-sm font-medium text-gray-500">
                                                                Price
                                                            </dt>
                                                            <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2 flex flex-col">
                                                                <span class="flex text-gray-600 text-sm font-semibold">
                                                                    <span>Regular: </span>
                                                                    <span class="font-normal mx-1 line-through">{{ $bundle->normal_price }}<span>৳</span></span>
                                                                </span>
                                                                <span class="flex text-green-500 text-sm font-semibold">
                                                                    <span>Offer: </span>
                                                                    <span class="font-normal mx-1">{{ $bundle->offer_price }}<span>৳</span></span>
                                                                </span>
                                                            </dd>
                                                        </div>
                                                    </dl>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                                    {{ __('Submit') }}
                                </button>
                                <button x-on:click="preview = false" type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    {{ __('Cancel') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($branch->bundles as $bundle)
                <!-- <div class="xl:w-1/3 p-4 w-full bg-gray-200 rounded-md">
                    <div class="px-4 py-5 sm:px-6">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">{{ $bundle->title }} - {{ $bundle->subtitle }}</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">{{ $bundle->description }}</p>
                    </div>
                    <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                        <dl class="sm:divide-y sm:divide-gray-800">
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Ticket</dt>
                                <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <div class="">{{ __('Adult') . ': ' . $bundle->regular_ticket_count }}</div>
                                    <div class="">{{ __('Child') . ': ' . $bundle->child_ticket_count }}</div>
                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Facilities</dt>
                                <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    {{ optional($bundle->facility)->title }}

                                </dd>
                            </div>
                            <div class="py-4 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                <dt class="text-sm font-medium text-gray-500">Price</dt>
                                <dd class="text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                    <span class="text-red-500 line-through">{{ $bundle->normal_price }}</span>
                                        <svg class="inline w-5 h-5 -mr-2 ml-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path></svg>
                                        <svg class="inline w-5 h-5 -ml-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                    <span>&nbsp;</span>
                                    <span class="">{{ $bundle->offer_price }}</span>
                                    <span>৳</span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div> -->
                @endforeach
            </div>
        </form>
    </section>
</div>
@endsection

@section('script')
<script>
    let bundle = @json($bundle);
    let branch = @json($branch);
    let visitor = @json(Auth::user());

    function init() {
        return {
            preview: false,
            preview_box: @json(old('name') || old('email') || old('mobile') || old('address')),
            bundle: bundle,

            visitor: {
                name: visitor ? visitor.name : @json(old('name')),
                email: visitor ? visitor.email : @json(old('email')),
                mobile: visitor ? visitor.mobile : @json(old('mobile')),
                address: visitor ? visitor.address : @json(old('address')),
            },
        }
    }
</script>
@endsection
