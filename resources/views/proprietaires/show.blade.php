<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Propriétaire</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Détails du Propriétaire</h1>
        
        <div class="card">
            <div class="card-body">
                <p><strong>ID :</strong> {{ $proprietaire->id }}</p>
                <p><strong>Nom :</strong> {{ $proprietaire->nom_proprietaire }}</p>
            </div>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('proprietaires.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
