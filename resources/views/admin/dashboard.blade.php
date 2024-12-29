@extends('layouts.app')

@section('title', 'Dashboard Administrateur')

@section('content')
<div class="container my-5">
    <div class="row">
        <div class="col">
            <h1 class="mb-4 text-center">Bienvenue Administrateur</h1>
            <p class="text-center mb-4">Accédez aux fonctionnalités suivantes :</p>
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('roles.index') }}" class="text-decoration-none">Gérer les Rôles</a>
                    <span class="badge bg-primary rounded-pill">Rôles</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('cuves.index') }}" class="text-decoration-none">Gérer les Cuves</a>
                    <span class="badge bg-primary rounded-pill">Cuves</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('proprietaires.index') }}" class="text-decoration-none">Gérer les Propriétaires</a>
                    <span class="badge bg-primary rounded-pill">Propriétaires</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('parcelles.index') }}" class="text-decoration-none">Gérer les Parcelles</a>
                    <span class="badge bg-primary rounded-pill">Parcelles</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('historiques.index') }}" class="text-decoration-none">Gérer l'Historique</a>
                    <span class="badge bg-primary rounded-pill">Historique</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="{{ route('employes.index') }}" class="text-decoration-none">Gérer les Employés</a>
                    <span class="badge bg-primary rounded-pill">Employés</span>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection


