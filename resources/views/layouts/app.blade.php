@php
    $siteTitle = "Kaon Ta! Davao – Valdepeñas's Food Guide";
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $siteTitle }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Fraunces:opsz,wght@9..144,500..700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-cream text-forest antialiased min-h-screen flex flex-col selection:bg-lime selection:text-forest">

    <header class="sticky top-0 z-10 border-b border-forest/10 bg-cream/90 backdrop-blur">
        <div class="max-w-6xl mx-auto px-4 py-3 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between sm:h-16 sm:py-0">
            <a href="{{ route('home') }}" class="font-serif text-lg font-semibold tracking-tight">{{ $siteTitle }}</a>

            @include('partials.nav')
        </div>
    </header>

    <main class="max-w-6xl mx-auto px-4 py-10 w-full flex-1">
        @include('partials.flash')

        @yield('content')
    </main>

    <footer class="border-t border-forest/10">
        <div class="max-w-6xl mx-auto px-4 py-6 text-sm text-forest/60">
            Kaon Ta! Davao
        </div>
    </footer>

</body>
</html>