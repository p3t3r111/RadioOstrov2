<form action="{{ route('google.redirect') }}">
    <button
        class="flex items-center justify-center gap-2 border border-gray-300 rounded-lg px-4 py-2 hover:bg-gray-100 transition">
        <img src="{{ asset('assets/google.svg') }}" alt="Google logo" class="w-5 h-5">
        <span class="text-gray-700 font-medium">Pokračovať cez Google</span>
    </button>
</form>