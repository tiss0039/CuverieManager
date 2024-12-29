<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Propriétaires</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Liste des Propriétaires</h1>

        <!-- Bouton Ajouter un nouveau propriétaire (Managers et Administrateurs uniquement) -->
        @if (auth()->user()->role->nom_role === 'Manager' || auth()->user()->role->nom_role === 'Administrateur')
            <div class="mb-3">
                <a href="{{ route('proprietaires.create') }}" class="btn btn-primary">Ajouter un nouveau propriétaire</a>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($proprietaires->isEmpty())
            <p class="text-danger">Aucun propriétaire trouvé.</p>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($proprietaires as $proprietaire)
                        <tr>
                            <td>{{ $proprietaire->id }}</td>
                            <td>{{ $proprietaire->nom_proprietaire }}</td>
                            <td>
                                <!-- Actions disponibles selon le rôle -->
                                @if (auth()->user()->role->nom_role === 'Manager' || auth()->user()->role->nom_role === 'Administrateur')
                                    <a href="{{ route('proprietaires.edit', $proprietaire->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('proprietaires.destroy', $proprietaire->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce propriétaire ?');">Supprimer</button>
                                    </form>
                                @else
                                    <span class="text-muted">Aucune action autorisée</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

