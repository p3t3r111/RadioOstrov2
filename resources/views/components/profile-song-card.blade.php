@props(['index' => 0, 'song' => null])

<div class="song flex flex-col flex-1 relative w-full gap-2 dark:text-darkMode-text">
    <div class="flex-1 w-full">
        <label class="flex justify-between px-2 font-medium text-sm" for="name">
            {{ $index }}. {{ __('profile.favorite_songs.song') }}
            @if ($song && $song['id'])
                @if ($song['confirmed'] == 1)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 text-green-500">
                        <title>{{ __('profile.favorite_songs.text.approved') }}</title>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                @elseif ($song['confirmed'] == -1)
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5 text-red-500">
                        <title>
                            @if ($song && $song['confirmed'] == -1)
                                {{ $song['moderation_reason'] }}
                            @endif
                        </title>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-5">
                        <title>{{ __('profile.favorite_songs.text.waiting') }}</title>
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                @endif
            @endif
        </label>
        <input type="hidden" name="song{{ $index }}Id" class="songId"
            @if ($song && $song['id']) value="{{ $song['id'] }}" @endif>
        <input
            class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full dark:bg-darkMode-background-900 dark:border-slate-700 dark:text-darkMode-text"
            autocomplete="off" id="song{{ $index }}" name="song{{ $index }}" type="text"
            @if ($song && $song['title']) value="{{ $song['title'] }}" @endif>
    </div>

    @if ($song && $song['songId'])
        <div class="flex flex-col">
            <iframe style="border-radius:12px"
                src="https://open.spotify.com/embed/track/{{ $song['songId'] }}?utm_source=generator" height="152"
                frameBorder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
                loading="lazy"></iframe>
        </div>
    @endif
</div>
