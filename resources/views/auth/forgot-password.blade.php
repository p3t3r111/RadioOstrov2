@extends('layouts.auth')

@section('title')
Rádio Ostrov | Zabudnuté heslo
@endsection

@section('content')
<div class="field flex flex-col justify-center items-center gap-2">
  <img src="{{ asset('assets/logo.png') }}"
          class="h-[75px] md:h-[100px] mb-5 animate-blink" alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice">
  <h1 class="subtitle mb-3 font-semibold text-base md:text-xl text-[#4a4a4a]">RÁDIO OSTROV | ZABUDNUTÉ HESLO
  </h1>
</div>

<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />

<form method="POST" action="{{ route('password.email') }}" class="w-full flex items-center flex-col gap-6 overflow-hidden" novalidate>
  @csrf

  <!-- Email Address -->
  <x-form-input name="email" type="email" iconPath='<path stroke-linecap="round" stroke-linejoin="round"
    d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />'>Email</x-form-input>

  <div class="flex items-center w-full justify-end">
    <button type="submit" class="bg-[#305582] text-white p-2 rounded-md shadow-sm mt-1 block w-full">
        Odoslať
    </button>
  </div>
  <div class="field text-[#305582] text-sm md:text-base self-end">
    <p class="register"><a href="login" class="register">Späť na prihlásenie</a></p>
  </div>
</form>
@endsection