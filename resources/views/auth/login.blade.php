@extends('layouts.auth')

@section('title')
    {{ __('auth.login.title') }}
@endsection

@section('content')
    <div class="field flex flex-col justify-center items-center gap-2">
        <img src="{{ asset('assets/logo.png') }}" class="h-[75px] md:h-[100px] mb-5 animate-blink"
            alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice">
        <h1 class="subtitle mb-3 font-semibold text-base md:text-xl uppercase">{{ __('navbar.name') }} |
            {{ __('auth.login.title') }}
        </h1>
        <div>
            <p>{{ __('auth.login.text') }}</p>
        </div>
    </div>

    <div class="flex flex-col items-center justify-center w-fit md:w-1/2 xl:w-1/4 mt-6 bg-slate-200 dark:bg-darkMode-background-800 rounded-lg p-6">
        <x-google-button />

        <p class="m-4">{{ __('auth.login.or') }}</p>

        <form action="{{ route('login') }}" method="post" class="w-full flex flex-col gap-6" novalidate>
            @csrf
            <x-form-input name="email" type="email"
                iconPath='<path stroke-linecap="round" stroke-linejoin="round"
            d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />'>{{ __('auth.login.email') }}</x-form-input>
            <x-form-input name="password" type="password"
                iconPath='<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />'>{{ __('auth.login.password') }}</x-form-input>
            <div class="field">
                <input
                    class="button is-login bg-[#305582] hover:bg-[#305582b8] text-white w-full border-transparent rounded-lg cursor-pointer text-center px-4 py-2"
                    type="submit" value="{{ __('auth.login.loginIn') }}"></input>
            </div>
            <div
                class="field flex justify-between text-[#305582] items-end {{ Route::has('register') ? 'flex-row' : 'flex-col' }}">
                @if (Route::has('register'))
                    <div class="register  text-sm md:text-base"><a href="{{ route('register') }}"
                            class="register">Registrácia</a></div>
                @endif
                @if (Route::has('password.request'))
                    <div class="lostPassword  text-sm md:text-base"><a href="{{ route('password.request') }}"
                            class="is-pulled-right lost-password">Zabudnuté heslo</a>
                    </div>
                @endif
            </div>
        </form>
    </div>
@endsection
