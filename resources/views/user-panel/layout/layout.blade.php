<!doctype html>
<html lang="en">
    <!-- All meta, links, scripts title or any other tags we need in head will be added in the head component -->
    @include('user-panel.layout.includes.head')
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    <body class="bg-white dark:bg-gray-900 text-black dark:text-white">
    @include('user-panel.layout.includes.header')
    <div class="mx-auto container py-10">
    @yield('content')
    </div>
    @include('user-panel.layout.includes.footer')
    </body>
</html>
