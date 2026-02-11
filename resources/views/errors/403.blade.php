@extends('layouts.error')

@section('errorCode')
{{ $exception->getStatusCode() }}
@endsection

@section('content')
<div class="flex flex-col items-center">
  <p class="uppercase text-xl text-red-500">403 | {{ __('errors.403.title') }}</p>
  <p>{{ __('errors.403.message') }}</p>
</div>
<div class="flex flex-col justify-center">
  <p class="text-sm text-slate-400 italic">{{ __('errors.403.suggestion') }}</p>
  <a class="w-full text-center text-sm text-blue-600 hover:underline" href="mailto:radio@ostrovskeho.com">
    radio@ostrovskeho.com
  </a>
</div>
<a href="{{ route("index") }}" class="mt-2 bg-[#305582] hover:bg-[#305582b8] text-white w-[70%] border-transparent rounded-lg cursor-pointer text-center px-4 py-2">{{ __('errors.return_home') }}</a>
@endsection