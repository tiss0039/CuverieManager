<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Parcelles</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Liste des Parcelles</h1>

        <!-- Bouton Ajouter une nouvelle parcelle (Managers uniquement) -->
        @if (auth()->user()->role->nom_role === 'Manager')
            <div class="mb-3">
                <a href="{{ route('parcelles.create') }}" class="btn btn-primary">Ajouter une nouvelle parcelle</a>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($parcelles->isEmpty())
            <p class="text-danger">Aucune parcelle trouvée.</p>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Localisation</th>
                        <th>Propriétaire</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parcelles as $parcelle)
                        <tr>
                            <td>{{ $parcelle->id }}</td>
                            <td>{{ $parcelle->nom_parcelle }}</td>
                            <td>{{ $parcelle->localisation_parcelle }}</td>
                            <td>{{ $parcelle->proprietaire->nom_proprietaire ?? 'Aucun' }}</td>
                            <td>
                                <!-- Actions disponibles selon le rôle -->
                                @if (auth()->user()->role->nom_role === 'Manager' || auth()->user()->role->nom_role === 'Administrateur')
                                    <a href="{{ route('parcelles.edit', $parcelle->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('parcelles.destroy', $parcelle->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cette parcelle ?');">Supprimer</button>
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
