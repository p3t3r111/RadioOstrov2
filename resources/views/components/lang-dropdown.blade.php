@props(['id', 'actualLocale', 'availableLocales', 'class' => ''])

<div {{ $attributes->merge([
    'class' => "relative items-end group w-max $class",
]) }}>

    <img src="{{ asset('assets/flags/' . $actualLocale . '.svg') }}" class="size-8 cursor-pointer" alt="Flag"
        onclick="toggleDropdown('{{ $id }}')">

    <div id="{{ $id }}"
        class="absolute right-0 w-max top-full mt-2 p-3 hidden flex-col gap-2 bg-white rounded-lg shadow-lg z-50 dark:bg-darkMode-background-900">

        @foreach ($availableLocales as $locale)
            <a class="w-full flex items-center gap-2" href="{{ route('lang.switch', $locale['code']) }}">

                <img src="{{ asset('assets/flags/' . $locale['flag'] . '.svg') }}" class="size-8" alt="Flag"
                    title="{{ Str::upper($locale['code']) }}">
            </a>
        @endforeach

    </div>
</div>
