<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('includes.meta')
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>
    <section class="hero min-h-screen flex flex-col">
        <div class="flex-grow flex items-center">
            <div class="container flex flex-col justify-center flex-grow flex-shrink relative w-auto mx-auto max-w-screen-[1344px]">
                <div class="columns flex justify-center">
                    <div class="column max-w-sm flex flex-col items-center">
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>
    @yield("script")
</body>

</html>