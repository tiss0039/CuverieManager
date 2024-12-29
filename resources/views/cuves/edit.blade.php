<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier une Cuve</title>
</head>
<body>
    <h1>Modifier la Cuve</h1>
    <form action="{{ route('cuves.update', $cuve->id) }}" method="POST">
        @csrf
        @method('PUT')
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" value="{{ old('nom', $cuve->nom) }}" required>
        <br>
        <label for="volume_maximum">Volume Maximum :</label>
        <input type="number" id="volume_maximum" name="volume_maximum" value="{{ old('volume_maximum', $cuve->volume_maximum) }}" required>
        <br>
        <button type="submit">Modifier</button>
    </form>
    <a href="{{ route('cuves.index') }}">Retour</a>
</body>
</html>
