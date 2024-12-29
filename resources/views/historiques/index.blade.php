<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Historiques</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4 text-center">Liste des Historiques</h1>

        <!-- Bouton Ajouter un nouvel historique (Administrateur ou Manager uniquement) -->
        @if (auth()->user()->role->nom_role === 'Administrateur' || auth()->user()->role->nom_role === 'Manager')
            <div class="mb-3">
                <a href="{{ route('historiques.create') }}" class="btn btn-primary">Ajouter un nouvel historique</a>
            </div>
        @endif

        @if ($historiques->isEmpty())
            <p class="text-danger text-center">Aucun historique trouvé.</p>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Type d'Action</th>
                        <th>Date</th>
                        <th>Employé</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($historiques as $historique)
                        <tr>
                            <td>{{ $historique->id }}</td>
                            <td>{{ $historique->type_action }}</td>
                            <td>{{ $historique->date_action }}</td>
                            <td>{{ $historique->employe->nom ?? 'Aucun' }}</td>
                            <td>
                                <!-- Actions disponibles selon le rôle -->
                                @if (auth()->user()->role->nom_role === 'Administrateur')
                                    <a href="{{ route('historiques.edit', $historique->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('historiques.destroy', $historique->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet historique ?');">Supprimer</button>
                                    </form>
                                @elseif(auth()->user()->role->nom_role === 'Manager')
                                    <span class="text-muted">Lecture uniquement</span>
                                @else
                                    <span class="text-danger">Aucune action autorisée</span>
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

