@extends('layouts.main')

    @section('title')
        Rádio ostrov
    @endsection

    @section('content')
        {{-- Welcome --}}
        <section class="hero hero-img max-h-[80vh] lg:min-h-[60vh] flex flex-col justify-center items-center  p-12 gap-2 "
            style="background-image: url('{{ asset('assets/bg/default/bg.png') }}')">
            <div class="hero-body">
                <div class="flex flex-col items-center gap-2 mt-6"> {{--  mt-28 --}}
                    <img src="{{ asset('assets/logo-white.png') }}"
                        alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice"id="logoHero"
                        class="mb-2 lg:mb-5 max-w-20 lg:max-w-32">
                    <h2 class="flex flex-col lg:block text-xl text-center md:text-3xl lg:text-4xl title text-white">Vítame
                        vás na
                        stránke <span class="text-primaryAction">rádia ostrov</span></h2>
                    <h2 class="subtitle text-sm lg:text-3xl capitalize mb-6 lg:mb-12 text-white">{{ auth()->user()->name }}
                    </h2>
                    <div class="inline-grid gap-6 lg:gap-2">
                        <a href="{{ route('vote.active') }}"
                            class="px-3 py-2 lg:mt-5 lg:px-8 lg:py-4 text-black text-center rounded-lg shadow-lg uppercase  @if ($canVote) animate-bounce bg-primaryAction
        @else
        bg-white @endif">Hlasovať</a>
                        <a href="{{ route('vote.index') }}"
                            class="px-3 py-2 mt-2 lg:mt-5 lg:px-8 lg:py-4 text-black text-center rounded-lg shadow-lg uppercase @if (!$canVote) animate-bounce bg-primaryAction
        @else
        bg-white @endif">Výsledky
                            hlasovania</a>
                    </div>
                </div>
            </div>
        </section>


        {{-- HARMONOGRAM --}}

        <section class="flex flex-col items-center gap-3 p-5 lg:p-12">
            <h2 class="title text-center font-bold text-xl lg:text-2xl uppercase">
                Harmonogram hlasovania
            </h2>

            <div class="flex flex-col lg:flex-row gap-4 py-10">
                @foreach ($votingDates as $index => $votingDate)
                    <a
                        class="day{{ $index + 1 }} h-28 flex flex-col w-fit items-center justify-center gap-1 p-4 text-center bg-slate-100 rounded-lg shadow-md">
                        <h4 class="text-xl">{{ $votingDate['name'] }}</h4>
                        <div class="flex gap-10">
                            <div class="flex flex-col gap-2">
                                <p class="flex"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 3v2.25m6.364.386-1.591 1.591M21 12h-2.25m-.386 6.364-1.591-1.591M12 18.75V21m-4.773-4.227-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" />
                                    </svg>
                                    {{ $votingDate['from'] }}</p>
                                <p>14:00</p>
                            </div>
                            <div class="flex flex-col gap-2">
                                <p class="flex gap-2">{{ $votingDate['to'] }} <svg xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M21.752 15.002A9.72 9.72 0 0 1 18 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 0 0 3 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 0 0 9.002-5.998Z" />
                                    </svg>
                                </p>
                                <p>14:00</p>
                            </div>
                        </div>
                    </a>
                @endforeach
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
            if (activeClassName && {{ $canVote }}) {
                document.querySelector(`.${activeClassName}`).classList.add("active-day");
                var odkaz = document.querySelector(".active-day");
                odkaz.setAttribute("href", "{{ route('vote.active') }}");
            }
        </script>
    @endsection
