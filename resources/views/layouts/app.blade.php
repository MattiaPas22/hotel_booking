<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts + Bootstrap -->
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- App Styles (vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Figtree', sans-serif;
            background-color: #f8f9fa;
        }
        header {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body>
    <div class="min-vh-100 d-flex flex-column">
        {{-- Navigazione --}}
        @include('layouts.navigation')

        {{-- Header pagina (opzionale) --}}
        @isset($header)
            <header class="py-4 border-bottom">
                <div class="container">
                    <h1 class="h3 text-primary fw-bold">{{ $header }}</h1>
                </div>
            </header>
        @endisset

        {{-- Contenuto principale --}}
        <main class="flex-grow-1 py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>

        {{-- Footer opzionale --}}
        <footer class="text-center py-3 border-top text-muted small">
            © {{ date('Y') }} {{ config('app.name') }}. Tutti i diritti riservati.
        </footer>
    </div>

    <!-- Bootstrap JS (necessario per dropdowns, modali, ecc.) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
