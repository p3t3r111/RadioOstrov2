@extends('layouts.error')

@section('errorCode')
500
@endsection

@section('content')
<div class="flex flex-col items-center">
  <p class="uppercase text-xl text-red-500">500 - {{ __('errors.500.title') }}</p>
  <p>{{ __('errors.500.message') }}</p>
</div>
<div class="flex flex-col justify-center">
  <p class="text-sm text-slate-400 italic">{{ __('errors.500.suggestion') }}</p>
  <a class="w-full text-center text-sm text-blue-600 hover:underline" href="mailto:radio@ostrovskeho.com">
    radio@ostrovskeho.com
  </a>
</div>
<a href="{{ route("index") }}" class="mt-2 bg-[#305582] hover:bg-[#305582b8] text-white w-[70%] border-transparent rounded-lg cursor-pointer text-center px-4 py-2">{{ __('errors.return_home') }}</a>
@endsection