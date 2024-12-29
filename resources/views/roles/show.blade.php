<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Rôle</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Détails du Rôle</h1>
        
        <div class="card">
            <div class="card-header bg-primary text-white">
                Informations sur le rôle
            </div>
            <div class="card-body">
                <p><strong>ID :</strong> {{ $role->id }}</p>
                <p><strong>Nom :</strong> {{ $role->nom }}</p>
                <p><strong>Date de Création :</strong> {{ $role->created_at }}</p>
            </div>
        </div>

        <a href="{{ route('roles.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
