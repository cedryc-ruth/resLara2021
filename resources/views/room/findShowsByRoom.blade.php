@extends('layouts.app')

@section('title', 'Fiche d\'une salle')

@section('content')
    <h1>{{ ucfirst($room->name) }}</h1>

    <h2>Liste des spectacles</h2>
        @if($shows->count()>=1)
        <ul>
            @foreach ($shows as $show)
                <li>{{ $show->title }}</li>              
            @endforeach
        </ul>
        @else
        <p>Aucun spectacle.</p>
        @endif
    <nav><a href="{{ route('room_index') }}">Retour à l'index</a></nav>
@endsection
