<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }}</title>
    @vite('resources/css/app.css')
</head>
<body>
    <div class="font-sans text-gray-900 antialiased">
        {{-- Colonne centrée et responsive, alignée sur la page de connexion (container my-5 / col-md-6) --}}
        <div class="mx-auto my-12 w-full max-w-xl px-4">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
