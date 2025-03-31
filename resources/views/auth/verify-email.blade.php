@extends('layouts.auth')

@section('title')
Rádio Ostrov | Overenie emailu
@endsection

@section('content')
<div class="field flex flex-col justify-center items-center gap-2">
    <img src="{{ asset('assets/logo.png') }}"
            class="w-[50px] h-[50px] md:w-[100px] md:h-[100px] mb-5 animate-blink" alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice">
    <h1 class="subtitle mb-3 font-semibold text-base md:text-xl text-[#4a4a4a]">RÁDIO OSTROV | OVERENIE EMAILU
    </h1>
    <div class="mb-4 text-sm text-gray-600 w-[90%]">
        Ďakujeme za registráciu! Predtým, ako začnete, mohli by ste overiť svoju e-mailovú adresu kliknutím na odkaz, ktorý sme vám práve poslali e-mailom? Ak ste e-mail nedostali, radi vám pošleme ďalší.
    </div>
</div>

@if (session('status') == 'verification-link-sent')
    <div class="mb-4 font-medium text-sm text-green-600">
        {{ __('Na e-mailovú adresu, ktorú ste uviedli pri registrácii, bolo odoslané nové overovacie prepojenie.') }}
    </div>
@endif

<div class="mt-4 flex items-center justify-between w-full">
    <form method="POST" action="{{ route('verification.send') }}">
        @csrf

        <div>
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#0c344c] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#0c334cbe]  active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Opätovné zaslať e-mail
            </button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            {{ __('Odhlásiť sa') }}
        </button>
    </form>
</div>
@endsection