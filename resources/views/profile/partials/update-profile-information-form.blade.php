<div class="grid grid-cols-1 lg:grid-cols-4 gap-4">

    <!-- Name -->
    <div class="lg:col-span-2">
        <label class="block text-sm font-medium text-black">Meno</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $user->name }}">
    </div>

    <!-- Email -->
    <div class="lg:col-span-2">
        <label class="block text-sm font-medium text-black">Email</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $user->email }}">
    </div>

    <!-- Others -->
    <div>
        <label class="block text-sm font-medium text-black">Pozvaní ľudia</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $invited_people }}">
    </div>

    <div>
        <label class="block text-sm font-medium text-black">Celkový počet hlasov</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $votes }}">
    </div>

    <div>
        <label class="block text-sm font-medium text-black">Maximálny počet hlasov za deň</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $max_votes_per_day }}">
    </div>

    <div>
        <label class="block text-sm font-medium text-black">Váha jednotlivého hlasu</label>
        <input disabled class="mt-1 block w-full rounded-md border-gray-300 bg-gray-100 cursor-not-allowed shadow-sm"
            value="{{ $weight_per_vote }}">
    </div>

</div>
