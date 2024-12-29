<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Rôles</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Liste des Rôles</h1>

        <!-- Message de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bouton pour ajouter un nouveau rôle (Administrateurs uniquement) -->
        @if (auth()->user()->role->nom_role === 'Administrateur')
            <a href="{{ route('roles.create') }}" class="btn btn-primary mb-3">Ajouter un nouveau rôle</a>
        @endif

        @if ($roles->isEmpty())
            <p class="text-danger">Aucun rôle trouvé.</p>
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
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{ $role->id }}</td>
                            <td>{{ $role->nom_role }}</td>
                            <td>
                                <!-- Actions disponibles uniquement pour les Administrateurs -->
                                @if (auth()->user()->role->nom_role === 'Administrateur')
                                    <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('roles.destroy', $role->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce rôle ?')">Supprimer</button>
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

        <a href="{{ url('/') }}" class="btn btn-secondary">Retour à l'accueil</a>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
