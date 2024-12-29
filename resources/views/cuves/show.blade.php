<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de la Cuve</title>
</head>
<body>
    <h1>Détails de la Cuve</h1>
    <p><strong>ID :</strong> {{ $cuve->id }}</p>
    <p><strong>Nom :</strong> {{ $cuve->nom }}</p>
    <p><strong>Volume Maximum :</strong> {{ $cuve->volume_maximum }}</p>
    <p><strong>Date de Création :</strong> {{ $cuve->created_at }}</p>
    <a href="{{ route('cuves.index') }}">Retour</a>
</body>
</html>
