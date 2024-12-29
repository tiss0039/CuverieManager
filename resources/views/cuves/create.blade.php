<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Cuve</title>
</head>
<body>
    <h1>Ajouter une Cuve</h1>
    <form action="{{ route('cuves.store') }}" method="POST">
        @csrf
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>
        <br>
        <label for="volume_maximum">Volume Maximum :</label>
        <input type="number" id="volume_maximum" name="volume_maximum" required>
        <br>
        <button type="submit">Ajouter</button>
    </form>
    <a href="{{ route('cuves.index') }}">Retour</a>
</body>
</html>
