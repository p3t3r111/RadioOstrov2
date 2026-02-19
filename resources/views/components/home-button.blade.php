@props(['canVote' => false, 'href' => route('vote.index')])

<a href="{{ $href }}"
    class="px-3 py-2 mt-2 lg:mt-5 lg:px-8 lg:py-4 text-center rounded-lg shadow-lg uppercase 
    @if ($canVote) dark:text-darkMode-background-900 animate-bounce bg-primaryAction @else bg-ostrov text-darkMode-text hover:bg-ostrovHover @endif">
    {{ $slot }}

</a>
