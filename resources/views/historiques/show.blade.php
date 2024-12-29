<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Historique</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4 text-center">Détails de l'Historique</h1>
        <div class="card">
            <div class="card-body">
                <p><strong>ID :</strong> {{ $historique->id }}</p>
                <p><strong>Action :</strong> {{ $historique->action }}</p>
                <p><strong>Employé :</strong> {{ $historique->employe->nom ?? 'Inconnu' }}</p>
                <p><strong>Date :</strong> {{ $historique->created_at }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('historiques.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
