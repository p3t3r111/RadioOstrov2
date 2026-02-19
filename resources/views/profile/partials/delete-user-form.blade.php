<section class="space-y-6">
    <div class="">
        <h2 class="text-lg font-medium text-gray-900 dark:text-white">
            {{ __('profile.delete_account.title') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-darkMode-text w-full">
            {{ __('profile.delete_account.text') }}
        </p>
    </div>

    <x-danger-button
        x-data=""
        x-on:click.prevent="console.log('Button clicked'); $dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('profile.delete_account.delete') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white dark:bg-darkMode-background-900">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-darkMode-text">
                {{ __('profile.delete_account.confirm_delete.title') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('profile.delete_account.confirm_delete.text') }}
            </p>

            {{-- <div class="mt-6">
                <x-input-label for="password" value="{{ __('Heslo') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Heslo') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div> --}}

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('profile.delete_account.confirm_delete.cancel') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('profile.delete_account.confirm_delete.delete') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
