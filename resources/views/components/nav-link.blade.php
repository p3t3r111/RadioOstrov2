@props(['active', 'route' => '#', 'class' => ''])

<a class="w-[70%] lg:w-fit flex items-center justify-center gap-2 p-2 hover:text-ostrovHover {{ $active ? 'text-ostrovHover' : '' }} {{ $class }}" href="{{ $route }}">
    {{ $slot }}
</a>