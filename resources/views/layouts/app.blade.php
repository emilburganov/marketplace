<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description"
          content="Marketplace ia a wide range of products and services on reliable and user-friendly marketplace. From electronics to fashion, find everything you need in one place.">
    <title>@yield('title', env('APP_NAME'))</title>
    @vite(['resources/assets/scss/style.scss', 'resources/assets/js/app.js'])
</head>
<body>
@include('includes.notification')
@include('includes.header')

@yield('content')

@include('includes.footer')

{{-- Scroll button--}}
<button
    onclick="window.scrollTo({ top: 0, behavior: 'smooth' })"
    class="button arrow-button scroll-button"
    aria-label="scroll page top">
    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M12 20V4M5 11L12 4L19 11" stroke="white" stroke-width="2" stroke-linecap="round"
              stroke-linejoin="round"/>
    </svg>
</button>

@auth
    <script>localStorage.setItem('isAuthenticated', 'true');</script>
@endauth

@guest
    <script>localStorage.setItem('isAuthenticated', 'false');</script>
@endguest
</body>
</html>
