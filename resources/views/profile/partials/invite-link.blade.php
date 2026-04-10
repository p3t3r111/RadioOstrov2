<div class="flex flex-col lg:flex-row gap-8 items-stretch">
    <div class="flex flex-col gap-4 flex-1">
        <div class="">
            <h2 class="text-lg font-medium dark:text-white">{{ __('profile.invite_link.title') }}</h2>
            <p class="text-sm text-gray-600 dark:text-darkMode-text">
                {{ __('profile.invite_link.text') }}
            </p>
        </div>
        <div class="relative w-full flex-2">
            <input disabled
                class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm dark:border-gray-700 dark:bg-darkMode-background-900 dark:text-darkMode-text sm:text-sm"
                type="text" value="{{ url('/invite/' . $user->referral_code) }}">
            <button
                class="copy-btn absolute right-2 top-1/2 -translate-y-1/2 rounded bg-ostrov hover:bg-ostrovHover text-white px-2 py-1 text-sm font-semibold"
                data-copy="{{ url('/invite/' . $user->referral_code) }}">
                <p class="hidden md:block">{{ __('profile.invite_link.copy_link') }}</p>
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6 block md:hidden">
                    <path id="svgCopy" stroke-linecap="round" stroke-linejoin="round"
                        d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                    <path id="svgCopied" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                        d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />


                </svg>
            </button>
        </div>
    </div>
    @if ($user->hasCustomReferralLink())
        <div class="flex flex-col w-full flex-1 gap-4 lg:gap-0 lg:justify-between">
            <div class="">
                <h2 class="text-lg font-medium dark:text-white">{{ __('profile.invite_link.custom_link') }}</h2>
                <p class="text-sm text-gray-600 dark:text-darkMode-text">
                    {{ __('profile.invite_link.custom_link_text') }}
                </p>
            </div>
            <form method="post" action="{{ route('profile.update.referallink') }}"
                class="relative w-full flex-1 max-h-fit">
                @csrf
                <input
                    class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 shadow-sm dark:border-gray-700 dark:bg-darkMode-background-900 dark:text-darkMode-text sm:text-sm"
                    type="text" value="{{ $user->referral_code }}" maxlength="255" min="4"
                    name="referral_code" required>
                <button
                    class="absolute right-2 top-1/2 -translate-y-1/2 rounded bg-ostrov hover:bg-ostrovHover text-white px-2 py-1 text-sm font-semibold"
                    type="submit">
                    <p class="hidden md:block">{{ __('profile.invite_link.update_link') }}</p>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 block md:hidden">
                        <path id="svgCopy" stroke-linecap="round" stroke-linejoin="round"
                            d="M7.5 7.5h-.75A2.25 2.25 0 0 0 4.5 9.75v7.5a2.25 2.25 0 0 0 2.25 2.25h7.5a2.25 2.25 0 0 0 2.25-2.25v-7.5a2.25 2.25 0 0 0-2.25-2.25h-.75m0-3-3-3m0 0-3 3m3-3v11.25m6-2.25h.75a2.25 2.25 0 0 1 2.25 2.25v7.5a2.25 2.25 0 0 1-2.25 2.25h-7.5a2.25 2.25 0 0 1-2.25-2.25v-.75" />
                    </svg>
                </button>
            </form>
        </div>
    @endif
</div>

<script>
    document.querySelectorAll('.copy-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            navigator.clipboard.writeText(btn.dataset.copy);
            btn.children[0].textContent = 'Odkaz skopírovaný!';
            setTimeout(() => {
                btn.children[0].textContent = 'Kopírovať odkaz';
            }, 2000);
            document.getElementById('svgCopy').classList.toggle('hidden');
            document.getElementById('svgCopied').classList.toggle('hidden');
            setTimeout(() => {
                document.getElementById('svgCopy').classList.toggle('hidden');
                document.getElementById('svgCopied').classList.toggle('hidden');
            }, 2000);
        });
    });
</script>
