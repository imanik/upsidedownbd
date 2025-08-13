<x-guest-layout>
    <div>
        <h2 class="mt-6 text-center text-3xl leading-9 font-extrabold text-gray-900">
            {{ __('Franchise Form') }}
        </h2>
    </div>

    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('franchise_store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

             <!-- Email -->
             <div  class="mt-4">
                <x-label for="email" :value="__('Email Address')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

             <!-- Phone -->
             <div class="mt-4">
                <x-label for="contact" :value="__('Mobile No')" />

                <x-input id="contact" class="block mt-1 w-full" type="text" name="contact" :value="old('contact')" required autofocus />
            </div>

               <!-- address -->
               <div  class="mt-4">
                <x-label for="address" :value="__('Address')" />

                <x-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required autofocus />
            </div>

            <div  class="mt-4">
                <x-label for="academic" :value="__('Last Academic Qualification')" />

                <x-input id="academic" class="block mt-1 w-full" type="text" name="academic" :value="old('academic')" required autofocus />
            </div>

            <div  class="mt-4">
                <x-label for="profession" :value="__('Profession')" />

                <x-input id="profession" class="block mt-1 w-full" type="text" name="profession" :value="old('profession')" required autofocus />
            </div>

            <div  class="mt-4">
                <x-label for="location" :value="__('Gallery Setup Location (District)')" />

                <x-input id="location" class="block mt-1 w-full" type="text" name="location" :value="old('location')" required autofocus />
            </div>

       

            <!-- Remember Me -->
                <div class="w-full px-4 py-3 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                    <dt class="text-sm leading-5 font-semibold text-gray-500 sm:col-span-1"></dt>
                    <dd class="mt-1 text-sm text-gray-700 sm:mt-0 sm:col-span-2">
                        <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
                            {{ __('Submit') }}
                        </button>
                    </dd>
                </div>
        </form>
    </x-auth-card>
</x-guest-layout>
