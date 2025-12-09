@extends('layouts.main')

@section('title')
Rádio ostrov | Hlasovanie
@endsection

@section('content')

<section class="pt-12 h-[85vh] bg-green-500 text-white flex flex-col items-center justify-center gap-2">
  <img src="{{ asset("assets/logo-white.png") }}" alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice">
  <h2>RÁDIO OSTROV</h2>
  <p>Ďakujeme za hlasovanie.</p>
</section>
@endsection
