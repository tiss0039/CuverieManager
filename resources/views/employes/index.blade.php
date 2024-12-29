<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Employés</title>
    <!-- Lien vers Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4">Liste des Employés</h1>

        <!-- Bouton Ajouter un nouvel employé (Administrateur uniquement) -->
        @if (auth()->user()->role->nom_role === 'Administrateur')
            <div class="mb-3">
                <a href="{{ route('employes.create') }}" class="btn btn-primary">Ajouter un nouvel employé</a>
            </div>
        @endif

        @if ($employes->isEmpty())
            <p class="text-danger">Aucun employé trouvé.</p>
        @else
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Rôle</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($employes as $employe)
                        <tr>
                            <td>{{ $employe->id }}</td>
                            <td>{{ $employe->nom }} {{ $employe->prenom }}</td>
                            <td>{{ $employe->role->nom_role ?? 'Aucun' }}</td>
                            <td>
                                <!-- Actions (Administrateur uniquement) -->
                                @if (auth()->user()->role->nom_role === 'Administrateur')
                                    <a href="{{ route('employes.edit', $employe->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                                    <form action="{{ route('employes.destroy', $employe->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet employé ?');">Supprimer</button>
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

