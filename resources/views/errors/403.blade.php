@extends('layouts.error')

@section('errorCode')
403
@endsection

@section('content')
<div class="flex flex-col items-center">
  <p class="uppercase text-xl text-red-500">403 - Zakázaný prístup</p>
  <p>Nemáte oprávnenie na prístup k tejto stránke.</p>
</div>
<div class="flex flex-col justify-center">
  <p class="text-sm text-slate-400 italic">Skúste to prosím neskôr alebo kontaktujte správcu systému.</p>
  <a class="w-full text-center text-sm text-blue-600 hover:underline" href="mailto:radio@ostrovskeho.com">
    radio@ostrovskeho.com
  </a>
</div>
<a href="{{ route("index") }}" class="mt-2 bg-[#305582] hover:bg-[#305582b8] text-white w-[70%] border-transparent rounded-lg cursor-pointer text-center px-4 py-2">Návrat na hlavnú stránku.</a>
@endsection