@php
    $siteTitle = "Kaon Ta! Davao – Valdepeñas's Food Guide";
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteTitle }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-orange-50 text-gray-800 min-h-screen flex flex-col">

    <header class="bg-orange-600 text-white">
        <div class="max-w-6xl mx-auto px-4 py-4">
            <a href="{{ route('home') }}" class="text-xl font-bold">{{ $siteTitle }}</a>
        </div>
    </header>

    @include('partials.nav')

    <main class="max-w-6xl mx-auto px-4 py-6 w-full flex-1">
        @include('partials.flash')

        @yield('content')
    </main>

    <footer class="text-center text-sm text-gray-500 py-4">
        Kaon Ta! Davao
    </footer>

</body>
</html>