<section class="space-y-6">
    <div class="flex flex-col gap-2">
        <h2 class="text-lg font-medium text-gray-900 dark:text-white">
            {{ __('profile.favorite_songs.title') }}
        </h2>
        <div class="flex flex-col mt-1 text-sm text-gray-600 dark:text-darkMode-text gap-2">
            <span class="font-bold">{{ __('profile.favorite_songs.text.main') }}</span>

            <div class="flex gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-sm">{{ __('profile.favorite_songs.text.waiting') }}</p>
            </div>
            <div class="flex gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5 text-green-500 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-sm">{{ __('profile.favorite_songs.text.approved') }}</p>
            </div>
            <div class="flex gap-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-5 text-red-500 shrink-0">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <p class="text-sm">{{ __('profile.favorite_songs.text.rejected') }}</p>
            </div>
        </div>
    </div>
    <form action="{{ route('profile.songs') }}" method="post" class="flex flex-col items-center gap-10">
        @csrf
        @method('PATCH')
        <div class="w-full grid grid-cols-1 lg:grid-cols-5 gap-6 justify-center">
            @for ($i = 1; $i <= $user->max_favorite_songs; $i++)
                @php
                    $song = $songs[$i - 1];
                @endphp
                <x-profile-song-card :index="$i" :song="$song" />
            @endfor
        </div>
        <div class="flex items-center gap-4">
            <input type="submit" value="{{ __('profile.favorite_songs.save_changes') }}"
                class="p-2 bg-ostrov hover:bg-ostrovHover text-white rounded-md cursor-pointer">
            @if (session('status') === 'songs-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Uložené.') }}</p>
            @endif
        </div>
    </form>

    <script>
        showDropdownSongList = (songDiv, tracks) => {
            const dropdown = songDiv.querySelector('.dropdown-wrapper');
            if (dropdown) dropdown.remove();

            const inputDiv = songDiv.children[0];
            const input = inputDiv.querySelector('input[type="text"]');
            const songIdInput = inputDiv.querySelector('.songId');

            if (input.value == "") return;

            const dropdownDiv = document.createElement('div');
            dropdownDiv.classList.add('dropdown-wrapper');
            dropdownDiv.style.top = '70px';
            songDiv.appendChild(dropdownDiv);

            tracks.forEach(track => {
                const dropdownItem = document.createElement('div');
                dropdownItem.classList.add('dropdown-item');

                const text = document.createElement('p');
                text.textContent = track.name;

                const img = document.createElement('img');
                img.src = track.album.images[0].url;

                dropdownItem.appendChild(img);
                dropdownItem.appendChild(text);
                dropdownItem.addEventListener('click', () => {
                    input.value = track.name;
                    songIdInput.value = track.id;
                    dropdownDiv.remove();
                });

                dropdownDiv.appendChild(dropdownItem);
            });

        }


        document.addEventListener('DOMContentLoaded', () => {
            const songsDiv = document.querySelectorAll('.song');

            let debounceTimer;

            songsDiv.forEach(songDiv => {
                const songInput = songDiv.querySelector('input[type="text"]')

                songInput.addEventListener('input', () => {
                    clearTimeout(debounceTimer);
                    debounceTimer = setTimeout(async () => {
                        const query = songInput.value.trim();
                        if (query.length === 0) return;

                        const response = await fetch(
                            `/spotify/search?q=${encodeURIComponent(query)}&limit=10`
                        );
                        const data = await response.json();
                        showDropdownSongList(songDiv, data.items);
                    }, 300);
                });

                document.addEventListener('mousedown', (event) => {
                    const dropdown = songDiv.querySelector('.dropdown-wrapper');

                    // Ak klikol mimo input a dropdown, odstráni dropdown po krátkom oneskorení
                    if (dropdown && !songDiv.contains(event.target)) {
                        window.setTimeout(() => {
                            // Naistalovať podmienky, kedy má byť dropdown odstránený
                            dropdown.remove();
                        }, 100); // oneskorenie pred odstránením
                    }
                });

                // Ak input stráca focus, zavrie dropdown
                songInput.addEventListener('focusout', () => {
                    window.setTimeout(() => {
                        const dropdown = songDiv.querySelector('.dropdown-wrapper');
                        if (dropdown) {
                            dropdown.remove();
                        }
                    }, 200); // Krátke oneskorenie na spracovanie kliknutia
                });

            });

            document.querySelectorAll(".songId").forEach(input => {
                parentElement = input.parentElement;
                textInput = parentElement.querySelector('input[type="text"]');
                textInput.addEventListener("input", function() {
                    if (input) {
                        input.value = "";
                    }
                });
            });
        });
    </script>
</section>
