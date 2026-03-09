<div class="">
    <div class="">
        <h2 class="text-lg font-medium dark:text-darkMode-text mb-4">{{ __('profile.reward_system.title') }}</h2>
        <p class="mb-4 text-sm text-gray-600 dark:text-darkMode-text">
            {{ __('profile.reward_system.text') }}
        </p>
    </div>

    <div class="flex flex-wrap gap-4 justify-center items-center w-full">
        @foreach ($user->rewards as $reward)
            <x-reward-card :reward="$reward" :currentPoints="$user->getUnusedPointsAttribute()" />
        @endforeach
    </div>

</div>
