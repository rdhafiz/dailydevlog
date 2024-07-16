<!doctype html>
<html lang="en">
    <!-- All meta, links, scripts title or any other tags we need in head will be added in the head component -->
    @include('user-panel.layout.includes.head')
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    <body class="bg-white dark:bg-gray-900 text-black dark:text-white h-lvh grid place-items-center justify-center ">
{{--    <div class="text-center">--}}
{{--        <button onclick="toggleTheme()" class="text-2xl border p-5 mb-4 rounded-2xl">Change Theme</button>--}}
{{--        <h1 class="text-5xl font-bold ">--}}
{{--            Daily Dev Blog--}}
{{--        </h1>--}}
{{--    </div>--}}
    @include('user-panel.layout.includes.header')
    @yield('content')
    @include('user-panel.layout.includes.footer')
    </body>
</html>
