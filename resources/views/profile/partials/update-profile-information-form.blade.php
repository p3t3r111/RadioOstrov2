<section>
    <div class="flex flex-col gap-4">
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-black">
                {{ __('Informácie o profile') }}
            </h2>
        </header>
        <div class="grid grid-cols-4 gap-4">
            <div class="flex-1 col-span-2">
                <label class="block font-medium text-sm text-black" for="name">
                    Meno
                </label>
                <input disabled=""
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed"
                    id="name" name="name" type="text" value="{{ $user->name }}" required="required"
                    autofocus="autofocus" autocomplete="name">
                {{-- <x-input-error class="mt-2" :messages="$errors->get('name')" /> --}}
            </div>

            <div class="flex-1 col-span-2">
                <label class="block font-medium text-sm text-black" for="email">
                    Email
                </label>
                <input disabled=""
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed"
                    id="email" name="email" type="email" value="{{ $user->email }}" required="required"
                    autocomplete="username">
                {{-- <x-input-error class="mt-2" :messages="$errors->get('email')" /> --}}

                {{-- @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                    <div>
                        <p class="text-sm mt-2 text-gray-800 dark:text-gray-200">
                            {{ __('Your email address is unverified.') }}
        
                            <button form="send-verification" class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                                {{ __('Click here to re-send the verification email.') }}
                            </button>
                        </p>
        
                        @if (session('status') === 'verification-link-sent')
                            <p class="mt-2 font-medium text-sm text-green-600 dark:text-green-400">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </p>
                        @endif
                    </div>
                @endif --}}
            </div>

            <div class="flex-1">
                <label class="block font-medium text-sm text-black" for="invited_people">
                    Pozvaní ľudia
                </label>
                <input disabled=""
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed"
                    id="invited_people" name="invited_people" type="text" value="{{ $invited_people }}"
                    required="required" autocomplete="invited_people">
            </div>
            <div class="flex-1">
                <label class="block font-medium text-sm text-black" for="total_votes">
                    Celkový počet hlasov
                </label>
                <input disabled=""
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed"
                    id="total_votes" name="total_votes" type="text" value="{{ $votes }}"
                    required="required" autocomplete="total_votes">
            </div>

            <div class="flex-1">
                <label class="block font-medium text-sm text-black" for="max_votes_per_day">
                    Maximálny počet hlasov za deň
                </label>
                <input disabled=""
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed"
                    id="max_votes_per_day" name="max_votes_per_day" type="text" value="{{ $max_votes_per_day }}"
                    required="required" autocomplete="max_votes_per_day">
            </div>

            <div class="flex-1">
                <label class="block font-medium text-sm text-black" for="weight_per_vote">
                    Vaha jednotlivého hlasu
                </label>
                <input disabled=""
                    class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm mt-1 block w-full cursor-not-allowed"
                    id="weight_per_vote" name="weight_per_vote" type="text" value="{{ $weight_per_vote }}"
                    required="required" autocomplete="weight_per_vote">
            </div>
        </div>
</section>
