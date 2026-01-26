@extends('layouts.main')

@section('title')
    Rádio ostrov | Pesničky na schválenie
@endsection

@section('content')
    <section class="">
        <x-admin-section-header>Pesničky na schválenie</x-admin-section-header>

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
                                        <button type="submit" title="Schváliť pesničku"
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

{{-- <div class="flex flex-col items-center grow gap-4 w-[80%]">
  @if ($songInfo)
  <div class="flex flex-wrap gap-3 justify-center w-full" id="songUsersHolder">
    @foreach ($songInfo as $index => $song)
    <x-admin-song-card :songInfo="$song">
      <div class="flex gap-3">
        <form action="{{ route('admin.confirmUsersSongsPost') }}" method="post">
          @csrf
          <input type="hidden" name="song" value="{{ $song['title'] }}">
          <button type="submit" title="Schváliť pesničku">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6 text-green-500 cursor-pointer">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
          </button>
        </form>
        <form action="{{ route('admin.denyUsersSongsPost') }}" method="post">
          @csrf
          <input type="hidden" name="songId" value="{{ $song['songId'] }}">
          <button type="submit" title="Zamietnuť pesničku">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
              stroke="currentColor" class="size-6 text-red-500 cursor-pointer">
              <path stroke-linecap="round" stroke-linejoin="round"
                d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
            </svg>
          </button>
        </form>
      </div>
  </div>
  </x-admin-song-card>
  @endforeach
</div>
@endif
{{ $songInfo->links('pagination::simple-tailwind') }}
</div> --}}

{{-- <div class="flex items-center gap-4">
  @if (session('update') === 'updated')
  <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-400
      >{{ __('Uložené.') }}</p>
  @endif
    @if (session('update') === 'noninput')
      <p
      x-data=" { show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
    class="text-sm text-red-700">{{ __('Zadajte hodnotu.') }}</p>
  @endif
</div> --}}
