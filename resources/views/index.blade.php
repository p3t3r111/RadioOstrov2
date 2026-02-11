@extends('layouts.main')

@section('title')
@endsection

@section('content')
    {{-- Welcome --}}
    <section class="hero h-[78vh] flex flex-col justify-center items-center gap-2 bg-cover bg-center bg-no-repeat"
        style="background-image: linear-gradient(rgba(0,0,0,0.22), rgba(0,0,0,0.22)), url('{{ asset('assets/bg/default/bg.png') }}')";>
        <div class="hero-body">
            <div class="flex flex-col items-center gap-2 mt-6"> {{--  mt-28 --}}
                <img src="{{ asset('assets/logo-white.png') }}"
                    alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice"id="logoHero"
                    class="mb-2 lg:mb-5 max-w-20 lg:max-w-32">
                <h2 class="flex flex-col lg:block text-xl text-center md:text-3xl lg:text-4xl title text-white">{{ __('home.welcome') }}
                    <span class="text-primaryAction">{{ __('home.welcome_name') }}</span>
                </h2>
                <h2 class="subtitle text-sm lg:text-3xl capitalize mb-6 lg:mb-12 text-white">{{ auth()->user()->name }}
                </h2>
                <div class="inline-grid gap-6 lg:gap-2">
                    <x-home-button :canVote="$canVote" :href="route('vote.active')">{{ __('home.vote') }}</x-home-button>
                    <x-home-button :canVote="!$canVote" :href="route('vote.index')">{{ __('home.results') }}</x-home-button>
                    <x-home-button :href="route('profile.show').'#personal-favorite-songs'">{{ __('home.my_songs') }}</x-home-button>
                </div>
            </div>
        </div>

    </section>


    {{-- HARMONOGRAM --}}

    {{-- <section class="flex flex-col items-center gap-3 p-5 lg:p-12">
            <h2 class="title text-center font-bold text-xl lg:text-2xl uppercase">
                Rozvrh hlasovania
            </h2>

            <div class="flex flex-col lg:flex-row gap-4 py-10 w-[90%] lg:w-[80%]">
                @foreach ($votingDates as $index => $votingDate)
                    <a
                        class="day{{ $index + 1 }} h-28 flex flex-col w-fit items-center justify-center gap-1 p-4 text-center bg-slate-100 rounded-lg shadow-md flex-1">
                        <h4 class="text-2xl">{{ $votingDate['name'] }}</h4>
                        <p class="text-sm">{{ $votingDate['votingDate'] }}</p>
                    </a>
                @endforeach
            </div>
        </section>

        <script>
            const activeVotingDay = {{ $activeVotingDay }};

            const days = {
                "1": "day1",
                "2": "day2",
                "3": "day3",
                "4": "day4",
                "5": "day5"
            };
            const activeClassName = days[activeVotingDay];
            if (activeClassName && {{ $canVote }}) {
                document.querySelector(`.${activeClassName}`).classList.add("active-day");
                var odkaz = document.querySelector(".active-day");
                odkaz.setAttribute("href", "{{ route('vote.active') }}");
            }
        </script> --}}
@endsection
