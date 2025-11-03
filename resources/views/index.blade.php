@extends('layouts.main')

@section('title')
Rádio ostrov
@endsection

@section('content')

{{-- Welcome --}}
<section class="pt-12 hero hero-img max-h-[80vh] lg:min-h-[60vh] flex flex-col justify-center items-center  p-12 gap-2 " style="background-image: url('{{ asset('assets/bg/default/bg.png') }}')">
  <div class="hero-body">
    <div class="flex flex-col items-center gap-2 mt-6"> {{--  mt-28 --}}
      <img src="{{ asset('assets/logo-white.png') }}" alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice"id="logoHero" class="mb-2 lg:mb-5 max-w-20 lg:max-w-32">
      <h2 class="text-xl text-center md:text-3xl lg:text-4xl title text-white">Vítame vás na stránke <span class="text-primaryAction">rádia ostrov</span>!</h2>
      <h2 class="subtitle text-sm lg:text-3xl capitalize mb-6 lg:mb-12 text-white">{{ auth()->user()->name }}</h2>
      <div class="inline-grid gap-6 lg:gap-2">
        <a href="{{ route('vote.active') }}" class="px-3 py-2 lg:mt-5 lg:px-8 lg:py-4 text-black text-center rounded-lg shadow-lg uppercase  @if (Auth::user()->voted == 0)
          animate-bounce bg-primaryAction
        @else
        bg-white
        @endif">Hlasovať</a>
        <a href="{{ route('vote.index') }}" class="px-3 py-2 mt-2 lg:mt-5 lg:px-8 lg:py-4 text-black text-center rounded-lg shadow-lg uppercase @if (Auth::user()->voted == 1)
          animate-bounce bg-primaryAction
        @else
        bg-white
        @endif">Výsledky hlasovania</a>
      </div>
    </div>
  </div>
</section>


{{-- HARMONOGRAM --}}

<section class="flex flex-col items-center gap-3 pb-5 lg:gap-10 lg:pb-12">
  <h2 class="title text-center mt-10 font-bold text-xl lg:text-2xl uppercase">
    Harmonogram hlasovania
  </h2>
  <div class="grid-container grid grid-rows-5 grid-cols-3 w-full max-w-7xl gap-3 p-2  rounded-lg text-[#1a1b1f] md:p-5 md:w-[90%] lg:p-6 xl:w-[70%]">
    <div class="grid-item flex justify-center lg:pl-2 lg:justify-start items-center text-center rounded-br-lg border-r border-b border-[#1a1b1f] uppercase">Deň</div>
    <div class="grid-item flex justify-center lg:pl-2 lg:justify-start items-center text-center rounded-br-lg border-r border-b border-[#1a1b1f] uppercase">Od</div>
    <div class="grid-item flex justify-center lg:pl-2 lg:justify-start items-center text-center rounded-br-lg lg:border-r border-b border-[#1a1b1f] uppercase">Do</div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-r border-[#1a1b1f]">
      <a class="day1">Pondelok</a>
    </div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-r border-[#1a1b1f]">Štvrtka {{ $mondayFrom }} {{ config('app.voting_time') }}</div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-[#1a1b1f]">Nedele {{ $mondayTo }} {{  config('app.voting_time') }}</div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-r border-[#1a1b1f]">
      <a class="day2 ">Utorok</a>
    </div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-r border-[#1a1b1f]">Nedele {{ $tuesdayFrom }} {{  config('app.voting_time') }}</div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-[#1a1b1f]">Pondelka {{ $tuesdayTo }} {{  config('app.voting_time') }}</div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-r border-[#1a1b1f]">
      <a class="day3 ">Streda</a>
    </div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-r border-[#1a1b1f]">Pondelka {{ $wednesdayFrom }} {{  config('app.voting_time') }}</div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-[#1a1b1f]">Utorka {{ $wednesdayTo }} {{  config('app.voting_time') }}</div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-r border-[#1a1b1f]">
      <a class="day4 ">Štvrtok</a>
    </div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-r border-[#1a1b1f]">Utorka {{ $thursdayFrom }} {{  config('app.voting_time') }}</div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-[#1a1b1f]">Stredy {{ $thursdayTo }} {{  config('app.voting_time') }}</div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-r border-[#1a1b1f]">
      <a class="day5 ">Piatok</a>
    </div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-r border-[#1a1b1f]">Stredy {{ $fridayFrom }} {{  config('app.voting_time') }}</div>
    <div class="grid-item flex justify-center lg:justify-start items-center border-[#1a1b1f]">Štvrtka {{ $fridayTo }} {{  config('app.voting_time') }}</div>
  </div>
</section>

<script>
  const activeVotingDay = <?php echo $activeVotingDay; ?>;

  const days = {
    "1": "day1",
    "2": "day2",
    "3": "day3",
    "4": "day4",
    "5": "day5"
  };
  const activeClassName = days[activeVotingDay];
  if (activeClassName && {{ Auth::user()->voted != 1 }}) {
    document.querySelector(`.${activeClassName}`).classList.add("active-day");
    var odkaz = document.querySelector(".active-day");
    odkaz.setAttribute("href", "{{ route('vote.active') }}");
  }
</script>
@endsection