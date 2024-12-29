<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Propriétaire</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Modifier un Propriétaire</h1>

        <!-- Formulaire -->
        <form action="{{ route('proprietaires.update', $proprietaire->id) }}" method="POST" class="border p-4 rounded shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom_proprietaire" class="form-label">Nom :</label>
                <input 
                    type="text" 
                    id="nom_proprietaire" 
                    name="nom_proprietaire" 
                    class="form-control"
                    value="{{ old('nom_proprietaire', $proprietaire->nom_proprietaire) }}" 
                    required
                >
                @error('nom_proprietaire')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div>
                <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                <a href="{{ route('proprietaires.index') }}" class="btn btn-secondary">Retour à la liste</a>
            </div>
        </form>

        <!-- Affichage des erreurs -->
        @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

