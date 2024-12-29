<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un Historique</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <h1 class="mb-4 text-center">Modifier un Historique</h1>
        <div class="card shadow">
            <div class="card-body">
                <form action="{{ route('historiques.update', $historique->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="type_action" class="form-label">Type d'Action :</label>
                        <input type="text" id="type_action" name="type_action" value="{{ old('type_action', $historique->type_action) }}" class="form-control" required>
                        @error('type_action')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="date_action" class="form-label">Date de l'Action :</label>
                        <input type="date" id="date_action" name="date_action" value="{{ old('date_action', $historique->date_action) }}" class="form-control" required>
                        @error('date_action')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="employe_id" class="form-label">Employé :</label>
                        <select id="employe_id" name="employe_id" class="form-select" required>
                            <option value="">Sélectionnez un employé</option>
                            @foreach ($employes as $employe)
                                <option value="{{ $employe->id }}" {{ old('employe_id', $historique->employe_id) == $employe->id ? 'selected' : '' }}>
                                    {{ $employe->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('employe_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-success">Enregistrer les modifications</button>
                        <a href="{{ route('historiques.index') }}" class="btn btn-secondary">Retour</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
