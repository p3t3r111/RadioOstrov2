@props(['reward', 'currentPoints'])

{{-- @dd($reward) --}}
@php
    $reward_points = $reward->points;
    $currentLevelPoints = $reward_points[$reward->pivot->level] ?? $reward_points[0];
    $currentBodText =
        $currentLevelPoints == 1 ? 'bod' : ($currentLevelPoints >= 2 && $currentLevelPoints <= 4 ? 'body' : 'bodov');
    $minPoints = $reward_points[$reward->pivot->level - 1] ?? 0;
    $minBodText = $minPoints == 1 ? 'bod' : ($minPoints >= 2 && $minPoints <= 4 ? 'body' : 'bodov');

    $currentRemainingPoints = $currentLevelPoints - $currentPoints;
    $progressPercent =
        $currentPoints >= $currentLevelPoints
            ? 100
            : (($currentPoints - $minPoints) / ($currentLevelPoints - $minPoints)) * 100;
    
    $reachedMaxLevel = $reward->max_level == $reward->pivot->level;
    // dd($currentPoints);
@endphp

<div class="w-full max-w-sm bg-white p-6 rounded-lg shadow-lg border border-slate-200 flex flex-col items-center">

    <!-- Badge -->
    <div
        class="w-16 h-16 flex items-center justify-center rounded-full bg-ostrov text-white text-2xl font-bold shadow-md">
        {{ $reward->pivot->level }}
    </div>

    <!-- Title -->
    <h3 class="mt-4 text-xl font-semibold text-slate-800 text-center">
        @if ($reachedMaxLevel)
            {{ $reward->name }} ({{ __('profile.reward_system.max_level') }})
        @else
            {{ __('profile.reward_system.card.level', ['level' => $reward->pivot->level]) }}
        @endif
    </h3>
    @if (!$reachedMaxLevel)
        <p class="text-sm text-slate-500 mt-1 text-center">
            {{ __('profile.reward_system.card.text', ['points' => $currentRemainingPoints, 'level' => $reward->pivot->level + 1]) }}
        </p>

        <!-- Progress bar -->
        <div class="w-full mt-4">
            <div class="w-full h-3 bg-slate-200 rounded-full overflow-hidden">
                <div class="h-full bg-gradient-to-r from-slate-50/0 to-ostrov rounded-full"
                    style="width: {{ $progressPercent }}%"></div>
            </div>
            <div class="flex justify-between text-xs text-slate-500 mt-1">
                <span>{{ $minPoints }} {{ trans_choice('profile.reward_system.card.points', $minPoints) }}</span>
                <span>{{ $currentLevelPoints }} {{ trans_choice('profile.reward_system.card.points', $currentLevelPoints) }}</span>
            </div>
        </div>

        <!-- Rewards info -->
        <div class="mt-5 text-sm text-slate-600 text-center">
            {{ __('profile.reward_system.card.reward') }}: <span class=" text-ostrov font-bold">
                @if (count($reward->reward) > 0)
                    + {{ $reward->reward[$reward->pivot->level] . ' ' . $reward->name }}
                @else
                    + {{ $reward->reward[0] . ' ' . $reward->name }}
                @endif
            </span>
        </div>

        <!-- Buttons -->
        <div class="flex gap-3 mt-6 w-full">
            <button @if ($reachedMaxLevel || $progressPercent < 100) disabled @endif
                class="flex-1 px-3 py-2 text-sm font-medium text-white rounded-lg shadow-md bg-ostrov disabled:bg-ostrov/80 disabled:hover:bg-ostrov/80 hover:bg-ostrovHover transition">
                {{ __('profile.reward_system.card.claim') }}
            </button>
        </div>
    @endif

</div>
