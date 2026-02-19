@props(['songInfo', 'actions'])

<div
  class="card flex-3 flex justify-between items-center bg-white shadow-xl rounded-2xl border-[1px] border-slate-500 dark:border-none dark:bg-darkMode-background-800">
  <div class="flex items-center">
    <div class="flex-1">
      <iframe style="border-radius:12px"
        src="https://open.spotify.com/embed/track/{{ $songInfo['songId'] }}?utm_source=generator" width="100%"
        height="152" frameBorder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture"
        loading="lazy">
      </iframe>
    </div>
    <div class="flex-3">
      {{ $slot }}
    </div>
  </div>

</div>