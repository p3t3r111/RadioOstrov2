@props(['song', 'index' => null, 'datum'])

@php
  if ($index === null){
    $songArray = is_object($song) ? $song->toArray() : (array) $song;
    $song = [
      'title' => $songArray['songName'],
      'author' => $songArray['songauthor'],
      'imgPath' => $songArray['songimgpath'],
      ...array_diff_key($songArray, array_flip(['songName', 'songauthor', 'songimgpath']))
    ];
  }
@endphp

<div
  class="card @if ($index) cursor-pointer @endif w-[90%] lg:w-4/6 h-16 flex justify-between items-center bg-white shadow-xl px-3 rounded-md border-slate-500 border-[.1px] hover:bg-slate-100"
  @if ($index !== null) onclick="document.getElementById('song-{{ $index }}').checked = true"; @endif>
  <div class="flex items-center gap-2 lg:gap-4 justify-between @if (!$index) w-full @endif">
    @if (!$index) <div class="flex items-center gap-2 lg:gap-4"> @endif
      <img class="h-8 w-8" src="{{ $song['imgPath'] }}">
      <div>
        <h3 class="text-sm md:longText lg:text-lg">{{ $song['title'] }}</h3>
        <p class="text-slate-400 text-xs lg:text-sm">{{ $song['author'] }}</p>
      </div>
    @if (!$index) </div> @endif
    @if ($index === null)
      <p class="mr-4">{{ $song['vote_count'] - 1 }}</p>
    @endif
  </div>
  @if ($index !== null)
    <input type="hidden" name="date" value="{{ $datum }}">
    <input type="radio" name="selected_song" id="song-{{ $index }}" value="{{ $index }}">
  @endif
</div>