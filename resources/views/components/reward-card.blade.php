@props(['reward', 'currentPoints'])

{{-- @dd($reward) --}}
@php
    $progressPercent = 0;
    $currentLevelPoints = $reward->points_for_level;
    $minPoints = $reward->minimum_points_for_level;

    $reachedMaxLevel = $reward->max_level == $reward->pivot->level;
    if (!$reachedMaxLevel) {
        $currentRemainingPoints = $currentLevelPoints - $currentPoints;
        $range = $currentLevelPoints - $minPoints;

        if ($range <= 0) {
            $progressPercent = $currentPoints >= $currentLevelPoints ? 100 : 0;
        } else {
            $progressPercent = min(100, (($currentPoints - $minPoints) / $range) * 100);
        }
    }
@endphp

<form action="{{ route('rewards.claim', ['reward' => $reward->id]) }}" method="post"
    class="w-full max-w-sm bg-white p-6 rounded-lg shadow-lg border border-slate-200 flex flex-col items-center dark:bg-darkMode-background-900 dark:border-gray-700 dark:text-darkMode-text">
    @csrf

    <!-- Badge -->
    <div
        class="w-16 h-16 flex items-center justify-center rounded-full bg-ostrov text-white text-2xl font-bold shadow-md">
        {{ $reward->pivot->level }}
    </div>

    <!-- Title -->
    <h3 class="mt-4 text-xl font-semibold text-center">
        @if ($reachedMaxLevel)
            {{ $reward->name }} ({{ __('profile.reward_system.max_level') }})
        @else
            {{ __('profile.reward_system.card.level', ['level' => $reward->pivot->level]) }}
        @endif
    </h3>
    @if (!$reachedMaxLevel)
        <p class="text-sm mt-1 text-center">
            @if ($currentRemainingPoints <= 0)
                {{ __('profile.reward_system.card.ready_to_claim') }}
            @else
                {{ __('profile.reward_system.card.text', ['points' => $currentRemainingPoints, 'level' => $reward->pivot->level + 1]) }}
            @endif
        </p>

        <!-- Progress bar -->
        <div class="w-full mt-4">
            <div class="w-full h-3 bg-slate-200 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-ostrov to-ostrovHover rounded-full"
                    style="width: {{ $progressPercent }}%"></div>
            </div>
            <div class="flex justify-between text-xs text-slate-500 mt-1">
                <span>{{ $minPoints }} {{ trans_choice('profile.reward_system.card.points', $minPoints) }}</span>
                <span>{{ $currentLevelPoints }}
                    {{ trans_choice('profile.reward_system.card.points', $currentLevelPoints) }}</span>
            </div>
        </div>

        <!-- Rewards info -->
        <div class="mt-5 text-sm  text-center">
            {{ __('profile.reward_system.card.reward') }}: <span class=" text-ostrov font-bold">
                @if (count($reward->reward) > 1)
                    + {{ $reward->reward[$reward->pivot->level] . ' ' . $reward->name }}
                @else
                    + {{ $reward->reward[0] . ' ' . $reward->name }}
                @endif
            </span>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 mt-6 w-full">
            <button @if ($reachedMaxLevel || $progressPercent < 100) disabled @endif
                class="flex-1 px-3 py-2 text-sm font-medium text-white rounded-lg shadow-md bg-ostrov disabled:bg-ostrov/50 hover:bg-ostrovHover transition">
                @if ($reachedMaxLevel)
                    {{ __('profile.reward_system.card.max_level') }}
                @elseif ($reachedMaxLevel || $progressPercent < 100)
                    {{ __('profile.reward_system.card.earn_more_points') }}
                @else
                    {{ __('profile.reward_system.card.claim') }}
                @endif
            </button>
        </div>
    @endif

</form>
