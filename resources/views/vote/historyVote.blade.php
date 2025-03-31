@extends('layouts.main')

@section('title')
Rádio ostrov | Výsledky
@endsection

@section('content')


<section class="py-8 flex flex-col items-center gap-6">
  <h2 class="text-center text-base lg:text-3xl font-bold">Výsledky hlasovania | {{ $den }} {{ $datum }}</h2>
  <div class="history-voted-card container flex flex-col items-center gap-3">
    @foreach ($result as $song)
      <x-voteCard :datum="$datum" :song="$song" />
    @endforeach
  </div>
</section>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  // ALL SPACE ON CARD IS CLICABLE
  $(document).ready(function(){
    $(".card").click(function(){
      $(this).find('input[type="radio"]').prop("checked", true);
    });
  });
</script>

@endsection
