<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Moût</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Détails du Moût</h1>

        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Informations sur le Moût</h5>
                <p class="card-text"><strong>ID :</strong> {{ $mout->id }}</p>
                <p class="card-text"><strong>Volume :</strong> {{ $mout->volume }}</p>
                <p class="card-text"><strong>Origine :</strong> {{ $mout->origine }}</p>
                <p class="card-text"><strong>Type :</strong> {{ $mout->type }}</p>
                <p class="card-text"><strong>Cuve associée :</strong> {{ $mout->cuve->nom ?? 'Non associée' }}</p>
                <p class="card-text"><strong>Date de Création :</strong> {{ $mout->created_at }}</p>
            </div>
        </div>

        <a href="{{ route('mouts.index') }}" class="btn btn-secondary mt-4">Retour à la liste</a>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
