<div class="grid grid-cols-1 lg:grid-cols-4 gap-4">
    <!-- Name -->
    <div class="lg:col-span-2">
        <x-input-label for="name" value="{{ __('profile.info.name') }}" />
        <x-text-input disabled class="mt-1" value="{{ $user->name }}" name="name" />
    </div>

    <!-- Email -->
    <div class="lg:col-span-2">
        <x-input-label for="email" value="{{ __('profile.info.email') }}" />
        <x-text-input disabled class="mt-1" value="{{ $user->email }}" name="email" />
    </div>

    <!-- Others -->
    <div>
        <x-input-label for="invited_people" value="{{ __('profile.info.invited_people') }}" />
        <x-text-input disabled class="mt-1" value="{{ $user->invited_people }}" name="invited_people" />
    </div>

    <div>
        <x-input-label for="all_time_votes" value="{{ __('profile.info.all_time_votes') }}" />
        <x-text-input disabled class="mt-1" value="{{ $user->votes }}" name="all_time_votes" />
    </div>

    <div>
        <x-input-label for="max_votes_per_day" value="{{ __('profile.info.max_votes_per_day') }}" />
        <x-text-input disabled class="mt-1" value="{{ $user->max_votes_per_day }}" name="max_votes_per_day" />
    </div>

    <div>
        <x-input-label for="weight_of_individual_vote" value="{{ __('profile.info.weight_of_individual_vote') }}" />
        <x-text-input disabled class="mt-1" value="{{ $user->vote_weight }}" name="weight_of_individual_vote" />
    </div>

</div>
