@extends('layouts.main')

@section('title')
    Rádio ostrov | Hlasovanie
@endsection

@section('content')
    <section
        class="flex-1 bg-gradient-to-br from-green-500 to-green-600 text-white flex flex-col items-center justify-center gap-4">

        <div class="flex flex-col items-center">
            <img src="{{ asset('assets/logo-white.png') }}"
                alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice"
                class="w-24 h-auto mb-2">

            <h2 class="text-2xl font-bold tracking-wide">
                Rádio Ostrov
            </h2>

            <p class="text-lg font-semibold">
                Ďakujeme za hlasovanie!
            </p>
        </div>

        <div class="flex flex-col items-center">
            <p class=" text-white/80 text-center">
                Povedz svojim kamošom, aby hlasovali tiež za tvoju obľúbenú pesničku, aby si si zvýšil šancu, že ju zahráme!
            </p>

            <a href="{{ route('vote.active') }}"
                class="px-3 py-2 lg:mt-5 lg:px-8 lg:py-4 text-black text-center rounded-lg shadow-lg uppercase bg-white">
                Späť na hlasovanie
            </a>
        </div>
    </section>
@endsection
