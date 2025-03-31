<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-black">
            {{ __('Odstrániť účet') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Po vymazaní vášho konta budú všetky jeho zdroje a údaje natrvalo vymazané.') }}
        </p>
    </header>

    <x-danger-button
        x-data=""
        x-on:click.prevent="console.log('Button clicked'); $dispatch('open-modal', 'confirm-user-deletion')"
    >{{ __('Odstrániť účet') }}</x-danger-button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white">
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Určite chcete vymazať svoje konto?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Po vymazaní vášho konta budú všetky jeho zdroje a údaje natrvalo vymazané. Zadajte svoje heslo a potvrďte, že chcete svoje konto natrvalo vymazať.') }}
            </p>

            <div class="mt-6">
                <x-input-label for="password" value="{{ __('Heslo') }}" class="sr-only" />

                <x-text-input
                    id="password"
                    name="password"
                    type="password"
                    class="mt-1 block w-3/4"
                    placeholder="{{ __('Heslo') }}"
                />

                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Zrušiť') }}
                </x-secondary-button>

                <x-danger-button class="ms-3">
                    {{ __('Odstrániť účet') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
