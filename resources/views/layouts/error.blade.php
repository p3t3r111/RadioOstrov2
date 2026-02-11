<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
  @include('includes.meta')
  @vite(['resources/css/app.css','resources/js/app.js'])

  <title>Rádio ostrov | @yield('errorCode')</title>
</head>
<body class="min-h-screen flex flex-col justify-center items-center w-[50%] m-auto">
  <div class="field flex flex-col justify-center items-center gap-2">
    <a href="login"><img src="{{ asset('assets/logo.png') }}"
            class="h-[75px] md:h-[100px] mb-5 animate-blink" alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice"></a>
    <h1 class="subtitle mb-3 font-semibold text-base md:text-xl text-[#4a4a4a]">RÁDIO OSTROV | @yield('errorCode')
    </h1>
  </div>
  <div class="pt-5 flex flex-col justify-center items-center gap-2" id="content">
    @yield('content')
  </div>
</body>
</html>