@extends('layouts.error')

@section('errorCode')
404
@endsection

@section('content')
<div class="flex flex-col items-center">
  <p class="uppercase text-xl text-red-500">404 - {{ __('errors.404.title') }}</p>
  <p>{{ __('errors.404.message') }}</p>
</div>
<p class="text-sm text-slate-400 italic">{{ __('errors.404.suggestion') }}</p>
<a href="{{ route("index") }}" class="mt-2 bg-[#305582] hover:bg-[#305582b8] text-white w-[70%] border-transparent rounded-lg cursor-pointer text-center px-4 py-2">{{ __('errors.return_home') }}</a>
@endsection