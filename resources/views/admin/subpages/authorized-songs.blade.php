@extends('layouts.main')

@section('title')
    Rádio ostrov | Schválené pesničky
@endsection

@section('content')
    <section class="space-y-6">
        <x-admin-section-header>Schválené pesničky</x-admin-section-header>
        <div class="flex flex-col items-center gap-10 ">
            <div class="flex flex-col items-center grow gap-4 w-[80%]">
                @if ($songInfo)
                    <div class="flex flex-wrap gap-3 justify-center w-full" id="songUsersHolder">
                        @foreach ($songInfo as $index => $song)
                            <x-admin-song-card :songInfo="$song">
                                <div class="flex gap-3 h-full">
                                    <form action="{{ route('admin.denyUsersSongsPost') }}" method="post"
                                        class="flex items-center justify-center">
                                        @csrf
                                        <input type="hidden" name="songId" value="{{ $song['songId'] }}">
                                        <button type="submit" title="Zamietnuť pesničku"
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
