@extends('layouts.app')

@section('title', 'Dashboard Manager')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Bienvenue Manager</h1>
    <p>Accédez aux fonctionnalités suivantes :</p>

    <div class="list-group">
        <a href="{{ route('proprietaires.index') }}" class="list-group-item list-group-item-action">
            Gérer les Propriétaires
        </a>
        <a href="{{ route('parcelles.index') }}" class="list-group-item list-group-item-action">
            Gérer les Parcelles
        </a>
        <a href="{{ route('historiques.index') }}" class="list-group-item list-group-item-action">
            Voir l'Historique
        </a>
    </div>
</div>
@endsection
