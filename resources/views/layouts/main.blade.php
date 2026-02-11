<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('includes.meta')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <title>
        {{ __('navbar.name') }}
        @hasSection('title')
            | @yield('title')
        @endif
    </title>

</head>

<body class="min-h-screen">
    <x-navbar />


    <div class="min-h-[78vh] h-full flex flex-col" id="content">
        @yield('content')
    </div>

    @include('includes.footer')
</body>

</html>
