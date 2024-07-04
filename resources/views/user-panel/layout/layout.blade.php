<!doctype html>
<html lang="en">
    @include('user-panel.layout.includes.head')
    <body class="bg-white dark:bg-gray-900 text-black dark:text-white h-lvh grid place-items-center justify-center ">
    <div class="text-center">
        <button onclick="toggleTheme()" class="text-2xl border p-5 mb-4 rounded-2xl">Change Theme</button>
        <h1 class="text-5xl font-bold ">
            Daily Dev Blog
        </h1>
    </div>
    @vite('resources/js/app.js')
    </body>
</html>
