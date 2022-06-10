@extends('layouts.app')

@section('title', 'Fiche d\'une salle')

@section('content')
    <h1>{{ ucfirst($room->name) }}</h1>
    <p><a href="{{ route('room_findShowsByRoom',[$room->id]) }}">Afficher les spectacles</a></p>

    <nav><a href="{{ route('room_index') }}">Retour à l'index</a></nav>
@endsection
