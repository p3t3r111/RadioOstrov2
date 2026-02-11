@extends('layouts.main')

@section('title')
{{ __('admin.confirming_songs') }}
@endsection

@section('content')
    <section class="">
        <x-admin-section-header>{{ __('admin.confirming_songs') }}</x-admin-section-header>

        <div class="flex flex-col items-center gap-10 my-8">
            <div class="flex flex-col items-center grow gap-4 w-[80%]">
                @if ($songInfo)
                    <div class="flex flex-wrap gap-3 justify-center w-full" id="songUsersHolder">
                        @foreach ($songInfo as $index => $song)
                            <x-admin-song-card :songInfo="$song">
                                <div class="flex h-full">
                                    <form action="{{ route('admin.confirmUsersSongsPost') }}" method="post"
                                        class="flex items-center justify-center">
                                        @csrf
                                        <input type="hidden" name="song" value="{{ $song['title'] }}">
                                        <button type="submit" title="{{ __('admin.confirm_song') }}"
                                            class="flex-3 min-h-[9.5rem] bg-green-400 hover:bg-green-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.denyUsersSongsPost') }}" method="post"
                                        class="flex items-center justify-center">
                                        @csrf
                                        <input type="hidden" name="songId" value="{{ $song['songId'] }}">
                                        <button type="submit" title="{{ __('admin.deny_song') }}"
                                            class="flex-3 min-h-[9.5rem] bg-red-400 rounded-r-2xl hover:bg-red-500">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </x-admin-song-card>
                        @endforeach
                    </div>
                @endif
                {{ $songInfo->links('pagination::tailwind') }}
            </div>

    </section>
@endsection
