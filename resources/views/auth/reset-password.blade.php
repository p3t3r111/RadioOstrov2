@extends('layouts.auth')

@section('title')
Rádio Ostrov | Zabudnuté heslo
@endsection

@section('content')
<div class="field flex flex-col justify-center items-center gap-2">
    <img src="{{ asset('assets/logo.png') }}" class="h-[75px] md:h-[100px] mb-5 animate-blink">
    <h1 class="subtitle mb-3 font-semibold text-base md:text-xl text-[#4a4a4a]" alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice">RÁDIO OSTROV | OBNOVENIE HESLA
    </h1>
</div>

<form method="POST" action="{{ route('password.store') }}" class="max-w-[90%] lg:w-full flex items-center flex-col gap-3 overflow-hidden" novalidate>
  @csrf

    <!-- Password Reset Token -->

    <input type="hidden" name="token" value="{{ $request->route('token') }}">

    <!-- Email Address -->
    <x-form-input mt_2='true' value="{{ $request->query('email') }}" :readonly="true" name="email" iconPath='<path stroke-linecap="round" stroke-linejoin="round" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L3.32 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" />'>Email</x-form-input>

    <x-form-input name="password" type="password" iconPath='<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />'>Heslo</x-form-input>

    <x-form-input name="password_confirmation" type="password" iconPath='<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />'>Potvrdenie hesla</x-form-input>

    <div class="flex items-center w-full justify-end mt-4">
        <button type="submit" class="bg-[#305582] text-white p-2 rounded-md shadow-sm mt-1 block w-full">
            Resetovať
        </button>
    </div>
</form>
@endsection
@section("script")
<script src="{{ asset('js/auth/inputs.js') }}"></script>
@endsection