<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                Home
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('contacts.store') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="company_name" :value="__('Company Name:')" />

                <x-input id="company_name" class="block mt-1 w-full" type="text" name="company_name" :value="old('company_name')" required autofocus />
            </div>

           
            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="contact_person_name" :value="__('Contact Name:')" />

                <x-input id="contact_person_name" class="block mt-1 w-full" type="text" name="contact_person_name" :value="old('contact_person_name')" required />
            </div>

            <!-- Mobile -->
            <div class="mt-4">
                <x-label for="person_mobile" :value="__('Mobile:')" />

                <x-input id="person_mobile" class="block mt-1 w-full" type="text" name="person_mobile" :value="old('person_mobile')" required />
            </div>

            <!-- Email -->
            <div class="mt-4">
                <x-label for="person_email" :value="__('Email:')" />

                <x-input id="person_email" class="block mt-1 w-full"
                                type="email"
                                name="person_email" :value="old('person_email')" />
            </div>

            <div class="mt-4">
                <x-label for="office_addr" :value="__('Address:')" />

                <x-input id="office_addr" class="block mt-1 w-full" type="text" name="office_addr" :value="old('office_addr')" required />
            </div>
            <div class="mt-4">
                <x-label for="company_balance" :value="__('Current Balance:')" />

                <x-input id="company_balance" class="block mt-1 w-full" type="text" name="company_balance" :value="old('company_balance')" required />
            </div>
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ '/contacts' }}">
                    {{ __('Show') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Add Contact') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
