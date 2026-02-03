@extends('layouts.main')

@section('title')
    Rádio ostrov | Hlasovanie
@endsection

@section('content')
    <section class="py-8 flex flex-col items-center gap-6">
        <h2 class="text-center text-base lg:text-3xl font-bold">Hlasovanie | {{ $den }} {{ $datum }}</h2>
        <div class="container">
            <form action="{{ route('vote.vote') }}" method="post"
                class="w-full flex flex-col items-center justify-center gap-5">
                @csrf
                <input type="hidden" name="date" value="{{ $datum }}">

                <a href="{{ route('profile.show') }}#personal-favorite-songs"
                    class="text-center text-sm px-2 lg:text-base hover:underline">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="yellow" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 inline-block">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 18v-5.25m0 0a6.01 6.01 0 0 0 1.5-.189m-1.5.189a6.01 6.01 0 0 1-1.5-.189m3.75 7.478a12.06 12.06 0 0 1-4.5 0m3.75 2.383a14.406 14.406 0 0 1-3 0M14.25 18v-.192c0-.983.658-1.823 1.508-2.316a7.5 7.5 0 1 0-7.517 0c.85.493 1.509 1.333 1.509 2.316V18" />
                    </svg>
                    Tieto piesničky sa vyberajú z obľúbených skladieb používateľov. Chceš ovplyvniť výber? Pridaj si
                    svoje obľúbené piesničky vo svojom profile alebo klikni sem.
                </a>
                <p>Zostavajúci počet hlasov: <span id="remainingVotes">{{ $maxVotes - $voteCounterUserTotal }}</span> | Váha hlasu: {{ $voteWeight }}</p>
                <div class="flex flex-wrap items-center justify-center gap-3">
                    @foreach ($songs as $index => $song)
                        <x-voteCard :index="$index" :song="$song" />
                    @endforeach
                </div>
                <button type="submit" id="confirmButton"
                    class="mt-3 p-2 text-black text-center bg-primaryAction text-base rounded-lg lg:text-xl">Potvrdiť
                    hlasovanie</button>
            </form>
        </div>
    </section>

    <script>
        addEventListener("DOMContentLoaded", () => {
            const maxVotes = {{ $maxVotes }};
            const remainingVotesEl = document.getElementById("remainingVotes");
            let remainingVotes = parseInt(remainingVotesEl.textContent);
            const voteCounters = document.querySelectorAll("[id^='voteCounter']");
            const incrementButtons = document.querySelectorAll("[id^='voteIncrement']");
            let voteCounterUserTotal = {{ $voteCounterUserTotal }};

            const updateIncrementButtons = () => {
                incrementButtons.forEach(btn => {
                    btn.disabled = voteCounterUserTotal >= maxVotes;
                });
            };

            voteCounters.forEach(counter => {
                if (counter.getAttribute("data-count") <= 0) {
                    document.getElementById(`voteDecrement${counter.getAttribute("data-index")}`).disabled = true;
                }
            });


            voteCounters.forEach((counter) => {
                const parent = counter.parentElement
                const index = counter.getAttribute("data-index");
                const songId = counter.getAttribute("data-songId");
                let count = counter.getAttribute("data-count");
                let input = document.createElement("input")
                input.type = "hidden"

                document
                    .getElementById(`voteIncrement${index}`)
                    .addEventListener("click", (e) => {
                        e.preventDefault();
                        if (voteCounterUserTotal < maxVotes) {
                            count++;
                            document.getElementById(`voteDecrement${index}`).disabled = count == 0;
                            counter.textContent = count;
                            voteCounterUserTotal++;
                            remainingVotes--;
                            remainingVotesEl.textContent = remainingVotes;
                            let songCounter = document.getElementById(`userVoteSelectionCount${index}`);
                            if (!songCounter) {
                                songCounter = input.cloneNode(true)
                                songCounter.name = `votes[${songId}]`;
                                songCounter.id = `userVoteSelectionCount${index}`;
                                songCounter.value = 1;
                                parent.appendChild(songCounter);
                            }
                            songCounter.value = count;
                        }
                        updateIncrementButtons()

                    });

                document
                    .getElementById(`voteDecrement${index}`)
                    .addEventListener("click", (e) => {
                        e.preventDefault();
                        if (count > 0 && voteCounterUserTotal > 0) {
                            count--;
                            e.currentTarget.disabled = count == 0;
                            counter.textContent = count;
                            voteCounterUserTotal--;
                            remainingVotes++    ;
                            remainingVotesEl.textContent = remainingVotes;
                            let songCounter = document.getElementById(`userVoteSelectionCount${index}`);
                            if (songCounter) {
                                songCounter.value = count;

                            }
                        }
                        updateIncrementButtons()

                    });
            });
        })
    </script>
@endsection
