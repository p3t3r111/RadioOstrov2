<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('includes.meta')

    <title>
        {{ __('navbar.name') }}
        @hasSection('title')
            | @yield('title')
        @endif
    </title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <section class="hero min-h-screen flex flex-col dark:bg-darkMode-background-950 dark:text-darkMode-text">
        <div class="flex-grow flex items-center">
            <div
                class="container flex flex-col justify-center flex-grow flex-shrink relative w-auto mx-auto max-w-screen-[1344px]">
                <div class="columns flex justify-center">
                    <div class="flex flex-col items-center w-full">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

</html>
