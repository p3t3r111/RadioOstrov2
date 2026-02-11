@extends('layouts.main')

@section('title')
{{ __('vote.history.title') }}
@endsection

@section('content')
    {{-- Welcome --}}
    <section class="py-8 flex flex-col items-center min-h-[78vh] ">
        <h2 class="text-center text-base lg:text-3xl font-bold">{{ __('vote.history.title') }}</h2>
        <div class="container h-full">
            <div class="grid grid-cols-2 w-full p-2 gap-3 lg:gap-6 lg:p-6">
                @foreach ($hlasy as $index => $item)
                    <a class=""
                        href="{{ $item['active'] ? route('vote.active') : route('vote.history') . '?date=' . $item['datum'] }}">
                        <div class="card cursor-pointer flex items-center justify-center">
                            <div
                                class="flex h-16 justify-center items-center w-full lg:w-[60%] {{ $item['active'] ? 'bg-primaryAction' : 'bg-white' }} shadow-xl rounded-md border-slate-500 border-[.1px]">
                                <p class="text-sm lg:text-base text-center">
                                    {{ $item['active'] ? $item['datum'] . ' - ' . __('vote.history.active') : $item['datum'] }}
                                </p>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        <div class="w-[90%]">
            {{ $hlasy->links('pagination::simple-tailwind') }}
        </div>
    </section>
@endsection
