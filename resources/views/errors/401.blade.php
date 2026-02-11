@extends('layouts.error')

@section('errorCode')
401
@endsection

@section('content')
<div class="flex flex-col items-center">
  <p class="uppercase text-xl text-red-500">401 - {{ __('errors.401.title') }}</p>
  <p>{{ __('errors.401.message') }}</p>
</div>
<p class="text-sm text-slate-400 italic">{{ __('errors.401.suggestion') }}</p>
<a href="{{ route('login') }}" class="mt-2 bg-[#305582] hover:bg-[#305582b8] text-white w-[70%] border-transparent rounded-lg cursor-pointer text-center px-4 py-2">{{ __('error.401.login') }}</a>
@endsection
