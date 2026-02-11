<nav class="navbar fixed flex flex-col items-center justify-between bg-white w-full z-40 shadow-lg"
    id="mainNav" role="navigation" aria-label="main navigation">
    @if ($updates->isNotEmpty())
        <div
            class="update h-10 w-full flex justify-center items-center p-2 text-white text-sm font-semibold bg-gradient-to-r from-slate-800 via-slate-700 to-ostrov">

            <a href={{ $updates[0]->action_url }} id="update-text"
                class="text-center flex gap-2 items-center justify-center w-full transition-opacity duration-300 hover:underline"
                data-updates='@json(
                    $updates->map(fn($u) => [
                            'text' => $u->text,
                            'url' => $u->action,
                        ]))'>
                {{ $updates[0]->text }}

                @if ($updates[0]->action)
                    <span id="update-arrow">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                        </svg>
                    </span>
                @endif
            </a>
        </div>
    @endif

    <div class="flex justify-between items-center w-full p-3">
        <div class="navbar-brand flex justify-between px-2 lg:pl-6 w-full items-center " id="mainNavBrand">
            <a class="navbar-item flex items-center" href="{{ route('index') }}">
                <img src="{{ asset('assets/logo.png') }}" id="logoFly" class="h-8 w-8 mr-2"
                    alt="Logo školy : Stredná odborná škola informačných technológií, Ostrovského 1, Košice">
                <h1 class="title pageTitle uppercase text-sm lg:text-lg font-bold">{{ __('navbar.name') }}</h1>
            </a>

            <div class="flex items-center gap-4 z-50">
                <a role="button" class="navbar-burger block lg:hidden" aria-label="menu" aria-expanded="false"
                    data-target="mainNavBar" id="hamburger">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path id="hamburger-open" class="block" stroke-linecap="round" stroke-linejoin="round"
                            d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                        <path id="hamburger-close" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12" />
                    </svg>
                </a>


                <x-lang-dropdown id="lang-dropdown-mobile" :actualLocale="$actualLocale" :availableLocales="$availableLocales"
                    class="inline-block lg:hidden" />
            </div>
        </div>

        <div class="hidden lg:block">
            <div id="mainNavBar" class="navbar-menu hidden lg:block">
                <div class="navbar-end flex items-center gap-6 uppercase">

                    <a class="navbar-item" href="{{ route('index') }}">{{ __('navbar.home') }}</a>

                    <a class="navbar-item text-nowrap animate-customPulse"
                        href="{{ route('profile.show') }}#personal-favorite-songs">{{ __('navbar.my_songs') }}</a>

                    <a class="navbar-item" href="{{ route('vote.index') }}">{{ __('navbar.votes') }}</a>

                    @if ($user->usertype == 'admin')
                        <a class="navbar-item" href="{{ route('admin.index') }}">
                            {{ __('navbar.admin') }}
                        </a>
                    @endif
                    @if ($canVote)
                        <a class="navbar-item" href="{{ route('vote.active') }}">
                            <span
                                class="p-2 text-black text-center bg-primaryAction rounded-lg">{{ __('navbar.vote') }}</span>
                        </a>
                    @endif

                    <a class="flex items-center gap-1 capitalize w-fit mr-2" onmouseover="showDropdown('dropdown')"
                        href="{{ route('profile.show') }}">
                        <div class="w-7 h-7 rounded-full bg-slate-300 flex justify-center items-center">
                            {{ $initials }}
                        </div>
                        <div class="is-user-name whitespace-nowrap">
                            {{ $user->name }}
                        </div>
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-3 h-3">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5" />
                            </svg>
                        </span>
                    </a>

                    <x-lang-dropdown id="lang-dropdown-desktop" :actualLocale="$actualLocale" :availableLocales="$availableLocales"
                        class="hidden lg:inline-block" />



                </div>
            </div>
            <div class="flex flex-col absolute right-16 min-w-40" onmouseleave="hideDropdown('dropdown')">
                <div class="navbar-dropdown flex flex-col gap-2 bg-white rounded-b-lg hidden item" id="dropdown">
                    <a class="navbar-item" href="{{ route('profile.show') }}">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </span>
                        <span>{{ __('navbar.my_profile') }}</span>
                    </a>


                    <hr class="navbar-divider">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="navbar-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
            this.closest('form').submit();">
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                            </span>
                            <span>{{ __('navbar.logout') }}</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>

        <div id="mainNavBar2" class="navbar-menu bg-white hidden border-l-2">
            <div class="navbar-end h-full flex flex-col gap-3 uppercase justify-between w-full">
                <div class="flex flex-col gap-5 pt-5 w-full items-center">
                    <a class="flex items-center gap-1 capitalize" href="{{ route('profile.show') }}">
                        <div class="w-7 h-7 rounded-full bg-slate-300 flex justify-center items-center">
                            {{ $initials }}
                        </div>
                        <div class="is-user-name">
                            {{ $user->name }}
                        </div>
                    </a>
                    <hr class="navbar-divider w-full">
                    <a class="navbar-item" href="{{ route('index') }}">Domov</a>

                    <a class="navbar-item text-nowrap animate-customPulse"
                        href="{{ route('profile.show') }}#personal-favorite-songs">Moje pesničky</a>

                    <a class="navbar-item" href="{{ route('vote.index') }}">Hlasovania</a>

                    @if ($user->usertype == 'admin')
                        <a class="navbar-item" href="{{ route('admin.index') }}">
                            <span>Admin</span>
                        </a>
                    @endif
                    @if ($canVote)
                        <a class="navbar-item" href="{{ route('vote.active') }}">
                            <span class="p-2 text-black text-center bg-primaryAction rounded-lg">Hlasovať</span>
                        </a>
                    @endif
                </div>

                <div class="flex flex-col navbar-item has-dropdown relative w-full gap-3">
                    <a class="navbar-item flex items-center justify-center" href="{{ route('profile.show') }}">
                        <span class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                            </svg>
                        </span>
                        <span>Môj profil</span>
                    </a>


                    <hr class="navbar-divider">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="navbar-item flex items-center justify-center mb-4" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
            this.closest('form').submit();">
                            <span class="icon">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                            </span>
                            <span>Odhlásiť sa</span>
                        </a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const el = document.getElementById('update-text');
        if (!el) return;

        const updates = JSON.parse(el.dataset.updates);
        if (updates.length <= 1) return;

        let index = 0;

        setInterval(() => {
            index = (index + 1) % updates.length;

            el.classList.add('opacity-0');

            setTimeout(() => {
                // Vyčistiť obsah
                el.innerHTML = '';

                // Pridať text
                const textNode = document.createTextNode(updates[index].text);
                el.appendChild(textNode);

                // Pridať/odstrániť href a arrow
                if (updates[index].url) {
                    el.href = updates[index].url;

                    // Pridať arrow SVG
                    const arrow = document.createElement('span');
                    arrow.id = 'update-arrow';
                    arrow.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
                    </svg>`;
                    el.appendChild(arrow);

                    el.classList.add('hover:underline');
                } else {
                    el.removeAttribute('href');
                    el.classList.remove('hover:underline');
                }

                el.classList.remove('opacity-0');
            }, 300);

        }, 10000);
    });
</script>
