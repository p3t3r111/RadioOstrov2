<div id="mainNavBar2" class="navbar-menu bg-white hidden border-l-2">
    <div class="navbar-end h-full flex flex-col gap-3 uppercase justify-between w-full">
        <div class="flex flex-col gap-5 pt-5 w-full items-center">
            <a class="flex items-center gap-1 capitalize" href="{{ route('profile.show') }}">
                <div class="w-7 h-7 rounded-full bg-slate-300 flex justify-center items-center">
                    @php
                        $names = explode(' ', Auth::user()->name);
                        $initials = '';

                        foreach ($names as $name) {
                            if (!empty($name)) {
                                $initials .= strtoupper($name[0]);
                            }
                        }

                        print $initials;
                    @endphp
                </div>
                <div class="is-user-name">
                    {{ auth()->user()->name }}
                </div>
            </a>
            <hr class="navbar-divider w-full">
            <a class="navbar-item" href="{{ route('index') }}">Domov</a>

            <a class="navbar-item text-nowrap animate-customPulse"
                href="{{ route('profile.show') }}#personal-favorite-songs">Moje pesničky</a>

            <a class="navbar-item" href="{{ route('vote.index') }}">Hlasovania</a>

            @if (Auth::user()->usertype == 'admin')
                <a class="navbar-item" href="{{ route('admin.index') }}">
                    <span>Admin</span>
                </a>
            @endif
            @if (Auth::user()->voted == 0)
                <a class="navbar-item" href="{{ route('vote.active') }}">
                    <span class="p-2 text-black text-center bg-primaryAction rounded-lg">Hlasovať</span>
                </a>
            @endif
        </div>

        <div class="flex flex-col navbar-item has-dropdown relative w-full gap-3" onmouseleave="hideDropdown()">
            <a class="navbar-item flex items-center justify-center" href="{{ route('profile.show') }}">
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-4 h-4">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </span>
                <span>Môj profil</span>
            </a>


            <hr class="navbar-divider">

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a class="navbar-item flex items-center justify-center mb-4" href="route('logout')"
                    onclick="event.preventDefault();
            this.closest('form').submit();">
                    <span class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="w-4 h-4">
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
