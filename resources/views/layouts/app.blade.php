<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title', 'NuxGame')</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Styles / Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-0 items-center lg:justify-center min-h-screen flex-col">
        <header class="bg-blue-500 text-white p-4 text-center text-lg font-semibold w-full">
            <a href="{{ route('registration.index') }}">Nux Game Test App</a>
        </header>
        <main class="flex-grow flex items-center justify-center">
            @yield('content')
        </main>

        <footer class="bg-gray-800 text-white text-center p-4 w-full">
            &copy; {{ date('Y') }} VM Test App
        </footer>
    </body>
</html>
