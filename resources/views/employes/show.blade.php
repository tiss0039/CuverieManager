<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails de l'Employé</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4 text-center">Détails de l'Employé</h1>
        <div class="card shadow">
            <div class="card-body">
                <p><strong>ID :</strong> {{ $employe->id }}</p>
                <p><strong>Nom :</strong> {{ $employe->nom }}</p>
                <p><strong>Prénom :</strong> {{ $employe->prenom }}</p>
                <p><strong>Email :</strong> {{ $employe->email }}</p>
                <p><strong>Rôle :</strong> {{ $employe->role->nom_role ?? 'Non défini' }}</p>
                <p><strong>Date de Création :</strong> {{ $employe->created_at }}</p>
            </div>
        </div>
        <div class="mt-4">
            <a href="{{ route('employes.index') }}" class="btn btn-secondary">Retour à la liste</a>
        </div>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

