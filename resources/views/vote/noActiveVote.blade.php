@extends('layouts.main')

@section('title')
{{ __('vote.active.title') }}
@endsection

@section('content')
    <section
        class="flex-1 bg-gradient-to-br from-red-500 to-red-600 text-white flex flex-col items-center justify-center gap-4">

        <div class="flex flex-col items-center">
            <img src="{{ asset('assets/logo-white.png') }}"
                alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice"
                class="w-24 h-auto mb-2">

            <h2 class="text-2xl font-bold tracking-wide">
                {{ __('navbar.name') }}
            </h2>

            <p class="text-lg font-semibold">
                {{ __('vote.no_active.text') }}
            </p>
        </div>

        <div class="flex flex-col items-center">
            <p class=" text-white/80">
                {{ __('vote.no_active.suggestion') }}
            </p>

            <a href="{{ route('profile.show') }}"
                class="px-3 py-2 lg:mt-5 lg:px-8 lg:py-4 text-black text-center rounded-lg shadow-lg uppercase bg-white">
                {{ __('navbar.my_profile') }}
            </a>
        </div>
    </section>
@endsection
