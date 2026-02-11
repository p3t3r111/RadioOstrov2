@extends('layouts.main')

@section('title')
{{ __('admin.updates') }}
@endsection

@section('content')
    <section class="">
        <x-admin-section-header>{{ __('admin.updates') }}</x-admin-section-header>
        <div class="flex flex-col items-center my-8">
            <div class="flex flex-col items-center grow gap-4 w-[80%]">
                <div
                    class="w-full p-4 border border-gray-300 rounded-lg shadow-sm bg-white flex flex-col items-center justify-center">
                    <h3 class="text-lg font-semibold mb-2">{{ __('admin.update.add_update') }}</h3>
                    <form method="post" action="{{ route('admin.addUpdate') }}" class="w-full flex gap-4 mt-4">
                        @csrf
                        <div class="flex flex-col flex-1">
                            <label for="text" class="w-full flex items-center">{{ __('admin.update.update_text') }}<span
                                    class="text-red-500">*</span></label>
                            <input class="" type="text" name="text" id="text" maxlength="255"
                                placeholder="{{ __('admin.update.update_text') }}" required>
                            @if ($errors->has('text'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('text') }}</p>
                            @endif
                        </div>
                        <div class="flex flex-col flex-1">
                            <label for="endDate" class="w-full flex items-center">{{ __('admin.update.end_date') }}<span
                                    class="text-red-500"></span></label>
                            <input class="" type="date" name="endDate" id="endDate">
                            @if ($errors->has('endDate'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('endDate') }}</p>
                            @endif

                        </div>
                        <div class="flex flex-col flex-1">
                            <label for="action" class="w-full flex items-center">{{ __('admin.update.action') }}</label>
                            <input class="flex-1" type="text" name="action" id="action"
                                placeholder="{{ __('admin.update.action') }}">
                            @if ($errors->has('action'))
                                <p class="text-red-500 text-sm mt-1">{{ $errors->first('action') }}</p>
                            @endif
                        </div>
                        <input type="submit" value="{{ __('admin.update.add') }}"
                            class="bg-ostrov text-white rounded hover:bg-ostrovHover cursor-pointer h-fit self-end px-4 py-2">
                    </form>
                </div>

                @foreach ($updates as $update)
                    <div
                        class="w-full p-4 border border-gray-300 rounded-lg shadow-sm bg-white grid grid-cols-3 items-center justify-items-center">
                        <p class="text-lg font-semibold mb-2 text-start w-full">{{ $update->text }}</p>
                        <p class="text-gray-600">{{ __('admin.update.to', ['date' => $update->end_date]) }}</p>
                        <form action="{{ route('admin.deleteUpdate') }}" method="post"
                            class="flex items-center justify-center w-full">
                            @csrf
                            <input type="hidden" name="updateId" value="{{ $update->id }}">
                            <button type="submit" title="{{ __('admin.update.remove') }}" class="text-red-400 hover:text-red-500">
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
