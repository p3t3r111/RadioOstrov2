@extends('layouts.main')

@section('title')
    Rádio ostrov
@endsection

@section('content')
    <div class="w-full h-full flex justify-center">
        <iframe id="frame" src="https://open.spotify.com/embed/playlist/{{ config('spotify.playlist_id') }}"
            style="border-radius:12px; width: 85%; height:72vh;" frameborder="0" allowfullscreen
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy">
        </iframe>
    </div>
@endsection
