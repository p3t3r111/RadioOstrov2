@props(['song', 'index' => null, 'datum'])


@php
  if ($index === null){
    $songArray = is_object($song) ? $song->toArray() : (array) $song;
    $song = [
      'title' => $songArray['songName'],
      'author' => $songArray['songAuthor'],
      'imgPath' => $songArray['songImgPath'],
      ...array_diff_key($songArray, array_flip(['songName', 'songAuthor', 'songImgPath']))
    ];
  }
@endphp

<div
  class="card @if ($index) cursor-pointer @endif w-fit gap-5 lg:gap-10 flex justify-between items-center bg-white shadow-xl pr-3 rounded-md rounded-l-2xl border-slate-500 border-[.1px] hover:bg-slate-100"
  @if ($index !== null) onclick="document.getElementById('song-{{ $index }}').checked = true"; @endif>
  <div class="flex items-center gap-5 lg:gap-4 justify-between @if (!$index) w-full @endif">
      <iframe style="border-radius:12px" src="https://open.spotify.com/embed/track/{{ $song['songId'] }}?utm_source=generator" height="152" frameBorder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
    @if ($index === null)
      <p class="mr-4">Počet hlasov: {{ $song['voteCount'] - 1 }}</p>
    @endif
  </div>
  @if ($index !== null)
    <input type="hidden" name="date" value="{{ $datum }}">
    <input type="radio" name="selected_song" id="song-{{ $index }}" value="{{ $index }}">
  @endif
</div>