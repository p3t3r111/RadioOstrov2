@extends('layouts.main')

@section('title')
{{ __('admin.holidays') }}
@endsection

@section('content')
    <section class="">
        <x-admin-section-header>{{ __('admin.holidays') }}</x-admin-section-header>
        <div class="flex flex-col items-center my-8">
            <div class="flex flex-col items-center grow gap-4 w-[80%]">
                <div
                    class="w-full p-4 border border-gray-300 rounded-lg shadow-sm bg-white dark:bg-darkMode-background-800 dark:border-none flex flex-col items-center justify-center">
                    <h3 class="text-lg font-semibold mb-2">{{ __('admin.holiday.name') }}</h3>
                    <form method="post" action="{{ route('admin.addHoliday') }}" class="w-full flex gap-4 mt-4">
                        @csrf
                        <input class="flex-1 dark:bg-darkMode-background-800 dark:border-slate-700 rounded dark:text-darkMode-text" type="text" name="holidayName" id="holidayName" placeholder="{{ __('admin.holiday.name') }}">
                        <input class="flex-1 dark:bg-darkMode-background-800 dark:border-slate-700 rounded dark:text-darkMode-text" type="date" name="startDate" id="startDate">
                        <input class="flex-1 dark:bg-darkMode-background-800 dark:border-slate-700 rounded dark:text-darkMode-text" type="date" name="endDate" id="endDate">
                        <input type="submit" value="{{ __('admin.holiday.create') }}"
                            class="bg-ostrov text-white px-4 py-2 rounded hover:bg-ostrovHover cursor-pointer">
                    </form>
                </div>

                @foreach ($holidays as $holiday)
                    <div
                        class="w-full p-4 border border-gray-300 rounded-lg shadow-sm bg-white dark:bg-darkMode-background-800 dark:border-none grid grid-cols-3 items-center justify-items-center">
                        <h3 class="text-lg font-semibold mb-2 text-start w-full">{{ $holiday->name }}</h3>
                        <p class="text-gray-600">{{ __('admin.holiday.from') }} {{ $holiday->start_date }} {{ __('admin.holiday.to') }} {{ $holiday->end_date }}</p>
                        <form action="{{ route('admin.deleteHoliday') }}" method="post"
                            class="flex items-center justify-center w-full">
                            @csrf
                            <input type="hidden" name="holidayId" value="{{ $holiday->id }}">
                            <button type="submit" title="{{ __('admin.holiday.remove') }}" class="text-red-400 hover:text-red-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection
