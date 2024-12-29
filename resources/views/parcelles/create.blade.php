<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter une Parcelle</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Ajouter une Parcelle</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('parcelles.store') }}" method="POST" class="card p-4">
            @csrf
            <div class="mb-3">
                <label for="nom_parcelle" class="form-label">Nom :</label>
                <input type="text" id="nom_parcelle" name="nom_parcelle" class="form-control" value="{{ old('nom_parcelle') }}" required>
            </div>
            <div class="mb-3">
                <label for="localisation_parcelle" class="form-label">Localisation :</label>
                <input type="text" id="localisation_parcelle" name="localisation_parcelle" class="form-control" value="{{ old('localisation_parcelle') }}" required>
            </div>
            <div class="mb-3">
                <label for="proprietaire_id" class="form-label">Propriétaire :</label>
                <select id="proprietaire_id" name="proprietaire_id" class="form-select" required>
                    <option value="" selected>-- Sélectionnez un propriétaire --</option>
                    @foreach ($proprietaires as $proprietaire)
                        <option value="{{ $proprietaire->id }}" {{ old('proprietaire_id') == $proprietaire->id ? 'selected' : '' }}>
                            {{ $proprietaire->nom_proprietaire }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Ajouter</button>
                <a href="{{ route('parcelles.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </form>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

