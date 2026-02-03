@props(['song', 'index' => null])

<div class="card w-fit flex flex-col justify-between items-center bg-white shadow-xl rounded-md border-slate-500 border-[.1px] @if ($index === null) rounded-l-2xl hover:bg-slate-100 @else rounded-t-2xl @endif">
    <div class="flex items-center gap-5 lg:gap-4 justify-between @if (!$index) w-full @endif">
        <iframe style="border-radius:12px"
            src="https://open.spotify.com/embed/track/{{ $song['songId'] }}?utm_source=generator" height="152"
            frameBorder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
            loading="lazy"></iframe>
        @if ($index === null)
            <p class="pr-2"><span class="hidden md:inline-block">Počet hlasov:</span> {{ $song['voteCount'] - 1 }}</p>
        @endif
    </div>
    @if ($index !== null)
        <div class="flex items-center gap-2 w-full justify-around">
            <button id="voteDecrement{{ $index }}" class="h-full py-3 flex-1 flex justify-center items-center hover:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14" />
                </svg>
            </button>
            <p id="voteCounter{{ $index }}" data-index="{{ $index }}" data-songId="{{ $song['id']}}" data-count="{{ $song['user_votes'] }}">{{ $song['user_votes'] ?? 0 }}</p>
            <button id="voteIncrement{{ $index }}" class="h-full py-3 flex-1 flex justify-center items-center hover:bg-slate-100 disabled:opacity-50 disabled:cursor-not-allowed">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                </svg>
            </button>
            @if ($song['user_votes'] !== null)
                <input type="hidden" name="votes[{{ $song['id'] }}]" id="userVoteSelectionCount{{ $index }}" value="{{ $song['user_votes'] }}">
            @endif
        </div>
    @endif
</div>
