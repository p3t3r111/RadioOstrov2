@extends('layouts.main')

@section('title')
{{ __('admin.backup_songs') }}
@endsection

@section('content')
    <section class="">
        <x-admin-section-header>{{ __('admin.backup_songs') }}</x-admin-section-header>

        <div class="flex flex-col items-center gap-10 my-8">
            <form action="{{ route('admin.addBackSongsPost') }}" method="post" class="flex flex-col items-center gap-10 w-full">
                @csrf
                <div class="flex flex-col grow gap-4 w-[80%]">
                    <div class="flex items-center gap-2">
                        <input
                            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full"
                            id="songAddInput" name="songAddInput" type="text"
                            placeholder="{{ __('admin.add_songs_placeholder') }}">
                        <input type="submit" value="{{ __('admin.add_songs') }}"
                            class="p-2 px-4 bg-primaryAction rounded-md text-black cursor-pointer">
                    </div>
                </div>
            </form>

            @if ($backupSongs)
                <div class="flex flex-wrap gap-3 justify-center" id="songHolder">
                    @foreach ($backupSongs as $song)
                        <div
                            class="card flex-2 w-full lg:w-[45%] h-16 flex justify-between items-center bg-white shadow-xl px-3 rounded-md border-slate-500 border-[.1px]">
                            <div class="flex items-center gap-2 lg:gap-4">
                                <img class="h-8 w-8" src="{{ $song['imgPath'] }}">
                                <div>
                                    <h3 class="text-sm max-w-[200px] overflow-hidden whitespace-nowrap text-ellipsis">
                                        {{ $song['title'] }}</h3>
                                    <p
                                        class="text-slate-400 text-xs lg:text-sm max-w-[100px] overflow-hidden whitespace-nowrap text-ellipsis">
                                        {{ $song['author'] }}</p>
                                </div>
                            </div>

                            <div class="flex gap-3">
                                <div class="flex items-center text-xs text-gray-500">
                                    <p>{{ __('admin.add_by', ['name' => $song['user']]) }}</p>
                                </div>
                                <form action="{{ route('admin.delBackSongsPost') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="song" value="{{ $song['title'] }}">

                                    <button type="submit" title="{{ __('admin.deny_song') }}"><svg xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                            class="size-6 text-red-600 cursor-pointer">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg></button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            {{ $backupSongs->links('pagination::tailwind') }}


            <div class="flex items-center gap-4">
                @if (session('update') === 'updated')
                    <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                        class="text-sm text-gray-400">{{ __('Uložené.') }}</p>
                @endif
                @if (session('update') === 'noninput')
                    <px-data="{ show: true }"
                    x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-red-700">
                    {{ __('Zadajte hodnotu.') }}</p>
                @endif
            </div>
        </div>

    </section>
@endsection
