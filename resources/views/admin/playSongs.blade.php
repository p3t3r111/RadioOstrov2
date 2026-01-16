@extends('layouts.main')

@section('title')
Rádio ostrov
@endsection

@section('content')
    <div class="w-full h-full flex justify-center">
        <iframe 
            id="frame" 
            src="https://open.spotify.com/embed/playlist/2YgC0FpYjIED8J7e9AfTEC" 
            style="border-radius:12px; width:80%; height:80vh;" 
            frameborder="0" 
            allowfullscreen 
            allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
            loading="lazy">
        </iframe>
    </div>
@endsection