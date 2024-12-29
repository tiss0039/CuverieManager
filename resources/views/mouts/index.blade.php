<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Moûts</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Liste des Moûts</h1>

        <!-- Message de succès -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Bouton Ajouter un nouveau moût (Cavistes uniquement) -->
        @if (auth()->user()->role->nom_role === 'Caviste')
            <div class="mb-3">
                <a href="{{ route('mouts.create') }}" class="btn btn-primary">Ajouter un nouveau moût</a>
            </div>
        @endif

        @if ($mouts->isEmpty())
            <p class="text-danger">Aucun moût trouvé.</p>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Volume</th>
                        <th>Type</th>
                        <th>Propriétaire</th>
                        <th>Cuve associée</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($mouts as $mout)
                        <tr>
                            <td>{{ $mout->id }}</td>
                            <td>{{ $mout->volume }}</td>
                            <td>{{ $mout->type }}</td>
                            <td>{{ $mout->proprietaire->nom_proprietaire ?? 'Aucun' }}</td>
                            <td>{{ $mout->cuve->nom ?? 'Aucune' }}</td>
                            <td>
                                <!-- Actions disponibles selon le rôle -->
                                @if (auth()->user()->role->nom_role === 'Caviste')
                                    <a href="{{ route('mouts.edit', $mout->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('mouts.destroy', $mout->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer ce moût ?');">Supprimer</button>
                                    </form>
                                @elseif (auth()->user()->role->nom_role === 'Administrateur')
                                    <span class="text-muted">Lecture uniquement</span>
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
