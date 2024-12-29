@extends('layouts.app')

@section('title', 'Dashboard Caviste')

@section('content')
<div class="container my-5">
    <h1 class="mb-4">Bienvenue Caviste</h1>
    <p>Accédez aux fonctionnalités suivantes :</p>

    <div class="list-group">
        <a href="{{ route('mouts.index') }}" class="list-group-item list-group-item-action">
            Gérer les Moûts
        </a>
    </div>
</div>
@endsection
