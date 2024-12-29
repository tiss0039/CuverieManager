<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Rôle</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Modifier un Rôle</h1>

        <form action="{{ route('roles.update', $role->id) }}" method="POST" class="bg-light p-4 rounded shadow-sm">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom_role" class="form-label">Nom :</label>
                <input type="text" id="nom_role" name="nom_role" class="form-control" 
                       value="{{ old('nom_role', $role->nom_role) }}" required>
            </div>

            <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
            <a href="{{ route('roles.index') }}" class="btn btn-secondary">Retour</a>
        </form>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
