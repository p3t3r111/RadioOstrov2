@extends('layouts.main')

@section('title')
  Rádio ostrov | Hlasovanie
@endsection

@section('content')


  <section class="py-8 flex flex-col items-center gap-6">
    <h2 class="text-center text-base lg:text-3xl font-bold">Hlasovanie | {{ $den }} {{ $datum }}</h2>
    <div class="container">
    <form action="{{ route('vote.vote') }}" method="post" class="w-full flex flex-col items-center justify-center gap-5">
      @csrf
      <div class="flex flex-wrap items-center justify-center gap-3">
        @foreach ($songs as $index => $song)
          <x-voteCard :datum="$datum" :index="$index" :song="$song" />
        @endforeach
      </div>
      <button type="submit" id="confirmButton"
      class="mt-3 p-2 text-black text-center bg-primaryAction text-base rounded-lg lg:text-xl">Potvrdiť
      hlasovanie</button>
    </form>
    </div>
  </section>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    // ALL SPACE ON CARD IS CLICABLE
    $(document).ready(function () {
    $(".card").click(function () {
      $(this).find('input[type="radio"]').prop("checked", true);
    });
    });
  </script>

@endsection