<div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
    <!-- Name -->
    <div class="lg:col-span-2">
        <label class="block text-sm font-medium text-black">{{ __('profile.info.name') }}</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $user->name }}">
    </div>

    <!-- Email -->
    <div class="lg:col-span-2">
        <label class="block text-sm font-medium text-black">{{ __('profile.info.email') }}</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $user->email }}">
    </div>

    <!-- Others -->
    <div>
        <label class="block text-sm font-medium text-black">{{ __('profile.info.invited_people') }}</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $user->invited_people }}">
    </div>

    <div>
        <label class="block text-sm font-medium text-black">{{ __('profile.info.all_time_votes') }}</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $user->votes }}">
    </div>

    <div>
        <label class="block text-sm font-medium text-black">{{ __('profile.info.max_votes_per_day') }}</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $user->max_votes_per_day }}">
    </div>

    <div>
        <label class="block text-sm font-medium text-black">{{ __('profile.info.weight_of_individual_vote') }}</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $user->vote_weight }}">
    </div>

</div>
