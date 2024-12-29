<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Cuves</title>
</head>
<body>
    <h1>Liste des Cuves</h1>

    <!-- Afficher le bouton Ajouter une nouvelle cuve uniquement si l'utilisateur est Administrateur -->
    @if (auth()->user()->role->nom_role === 'Administrateur')
        <a href="{{ route('cuves.create') }}">Ajouter une nouvelle cuve</a>
    @endif

    @if ($cuves->isEmpty())
        <p>Aucune cuve trouvée.</p>
    @else
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Volume Maximum</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cuves as $cuve)
                    <tr>
                        <td>{{ $cuve->id }}</td>
                        <td>{{ $cuve->nom }}</td>
                        <td>{{ $cuve->volume_maximum }}</td>
                        <td>
                            <!-- Afficher les boutons Modifier et Supprimer uniquement pour l'Administrateur -->
                            @if (auth()->user()->role->nom_role === 'Administrateur')
                                <a href="{{ route('cuves.edit', $cuve->id) }}">Modifier</a>
                                <form action="{{ route('cuves.destroy', $cuve->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Voulez-vous vraiment supprimer cette cuve ?');">Supprimer</button>
                                </form>
                            @else
                                <span>Aucune action autorisée</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>



