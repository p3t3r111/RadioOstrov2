@props(['canVote' => false, 'href' => route('vote.index')])

<a href="{{ $href }}"
    class="px-3 py-2 mt-2 lg:mt-5 lg:px-8 lg:py-4 text-black text-center rounded-lg shadow-lg uppercase 
    @if ($canVote) animate-bounce bg-primaryAction @else bg-white @endif">
    {{ $slot }}

</a>
