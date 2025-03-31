@extends('layouts.error')

@section('errorCode')
404
@endsection

@section('content')
<div class="flex flex-col items-center">
  <p class="uppercase text-xl text-red-500">404 - Nenájdené</p>
  <p>Stránka, ktorú hľadáte, neexistuje.</p>
</div>
<p class="text-sm text-slate-400 italic">Skontrolujte adresu URL alebo sa vráťte na hlavnú stránku.</p>
<a href="{{ route("index") }}" class="mt-2 bg-[#305582] hover:bg-[#305582b8] text-white w-[70%] border-transparent rounded-lg cursor-pointer text-center px-4 py-2">Návrat na hlavnú stránku.</a>
@endsection