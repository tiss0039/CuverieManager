<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Employé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4 text-center">Modifier un Employé</h1>
        <form action="{{ route('employes.update', $employe->id) }}" method="POST" class="shadow p-4 rounded bg-light">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nom" class="form-label">Nom :</label>
                <input type="text" id="nom" name="nom" value="{{ old('nom', $employe->nom) }}" class="form-control" required>
                @error('nom')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="prenom" class="form-label">Prénom :</label>
                <input type="text" id="prenom" name="prenom" value="{{ old('prenom', $employe->prenom) }}" class="form-control" required>
                @error('prenom')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email :</label>
                <input type="email" id="email" name="email" value="{{ old('email', $employe->email) }}" class="form-control" required>
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Rôle :</label>
                <select id="role_id" name="role_id" class="form-select" required>
                    <option value="">Sélectionnez un rôle</option>
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id', $employe->role_id) == $role->id ? 'selected' : '' }}>
                            {{ $role->nom_role }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                <a href="{{ route('employes.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

