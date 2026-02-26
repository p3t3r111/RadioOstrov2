<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-darkMode-text">
            @if (Auth::user()->password == null)
                {{ __('profile.password.title2') }}
            @else
                {{ __('profile.password.title') }}
            @endif
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-darkMode-text">
            {{ __('profile.password.text') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6 text-black dark:text-darkMode-text">
        @csrf
        @method('put')

        {{-- @if (Auth::user()->password)
            <x-form-input name="current_password" type="password"
                iconPath='<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />'>{{ __('profile.password.current_password') }}</x-form-input>
        @endif --}}

        <div>
            <x-form-input name="password" type="password"
                iconPath='<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />'
                mt_2='true'>{{ __('profile.password.new_password') }}</x-form-input>
        </div>

        <div>
            <x-form-input name="password_confirmation" type="password"
                iconPath='<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />'
                mt_2='true'>{{ __('profile.password.confirm_new_password') }}</x-form-input>
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="inline-flex items-center px-4 py-2 bg-ostrov border border-transparent rounded-md text-white tracking-widest hover:bg-ostrovHover focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('profile.password.save_changes') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('profile.password.saved') }}</p>
            @endif
        </div>
    </form>
</section>
