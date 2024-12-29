<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Moût</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4 text-center">Modifier un Moût</h1>

        <!-- Formulaire -->
        <form action="{{ route('mouts.update', $mout->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="volume" class="form-label">Volume :</label>
                <input type="number" id="volume" name="volume" value="{{ old('volume', $mout->volume) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="type" class="form-label">Type :</label>
                <input type="text" id="type" name="type" value="{{ old('type', $mout->type) }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="proprietaire_id" class="form-label">Propriétaire :</label>
                <select id="proprietaire_id" name="proprietaire_id" class="form-select" required>
                    <option value="">-- Sélectionnez un propriétaire --</option>
                    @foreach ($proprietaires as $proprietaire)
                        <option value="{{ $proprietaire->id }}" {{ old('proprietaire_id', $mout->proprietaire_id) == $proprietaire->id ? 'selected' : '' }}>
                            {{ $proprietaire->nom_proprietaire }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="cuve_id" class="form-label">Cuve associée :</label>
                <select id="cuve_id" name="cuve_id" class="form-select">
                    <option value="">Aucune</option>
                    @foreach ($cuves as $cuve)
                        <option value="{{ $cuve->id }}" {{ old('cuve_id', $mout->cuve_id) == $cuve->id ? 'selected' : '' }}>
                            {{ $cuve->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                <a href="{{ route('mouts.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </form>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>



