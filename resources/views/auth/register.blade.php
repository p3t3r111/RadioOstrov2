@extends('layouts.auth')

@section('title')
    Registrácia
@endsection

@section('content')
    <div class="field flex flex-col justify-center items-center gap-2 pt-4 lg:pt-0">
        <img src="{{ asset('assets/logo.png') }}"
            alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice"
            class="w-[50px] h-[50px] md:w-[100px] md:h-[100px] mb-5 animate-blink">
        <h1 class="subtitle mb-3 font-semibold text-base md:text-xl text-[#4a4a4a]">RÁDIO OSTROV | REGISTRÁCIA
        </h1>
    </div>

    <x-google-button />

    <div class="w-full flex flex-col gap-4 pt-4">
        {{-- <form action="{{ route('register') }}" method="post" class="w-full flex flex-col gap-4" novalidate>

            @csrf --}}
        {{-- @method("PATCH") --}}
        {{-- First Name --}}
        {{-- <x-form-input name="first_name"
                iconPath='<path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />'>Meno</x-form-input> --}}

        {{-- Second Name --}}
        {{-- <x-form-input name="second_name"
                iconPath='<path stroke-linecap="round" stroke-linejoin="round" d="M17.982 18.725A7.488 7.488 0 0 0 12 15.75a7.488 7.488 0 0 0-5.982 2.975m11.963 0a9 9 0 1 0-11.963 0m11.963 0A8.966 8.966 0 0 1 12 21a8.966 8.966 0 0 1-5.982-2.275M15 9.75a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />'>Priezvisko</x-form-input> --}}

        {{-- School Email --}}
        {{-- <x-form-input name="email" type="email"
                iconPath='<path stroke-linecap="round" stroke-linejoin="round"
                    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />'>Email</x-form-input>
            --}}

        {{-- Password --}}
        {{-- <x-form-input name="password" type="password"
                iconPath='<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />'>Heslo</x-form-input>
            --}}


        {{-- Confirm Password --}}
        {{-- <x-form-input name="password_confirmation" id="password_confirmation" type="password"
                iconPath='<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />'>Potvrdenie
                hesla</x-form-input> --}}

        {{-- GDPR --}}
        {{-- <label class="flex items-center space-x-2 text-sm">
                <input type="checkbox" name="ochrana-osobnych-udajov" value="1" id="ochrana-osobnych-udajov"
                    class="focus:ring-0">
                <span>
                    Súhlasím so
                    <a href="{{ route('ochranaUdajov')}}" title="Ochrana osobných údajov" target="_blank"
                        class="text-black underline">
                        spracovaním osobných údajov
                    </a>
                </span>
            </label>
            <x-input-error :messages="$errors->get('ochrana-osobnych-udajov')" class=" max-w-full" />
            {{-- Submit Button --}}
        {{-- <div class="field">
                <input
                    class="button is-login bg-[#305582] hover:bg-[#305582b8] text-white w-full border-transparent rounded-lg cursor-pointer text-center px-4 py-2"
                    type="submit" value="Registrovať sa"></input>
            </div>
        </form> --}}
        {{-- Back to login --}}
        <div class="field text-[#305582] text-sm md:text-base self-center">
            <p class="register"><a href="login" class="register">Späť na prihlásenie</a></p>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('js/auth/inputs.js') }}"></script>
@endsection
