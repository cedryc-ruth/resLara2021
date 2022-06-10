@extends('layouts.app')

@section('title', 'Liste des salles')

@section('content')
    <h1>Liste des {{ $resource }}</h1>

    <ul>
     @foreach($rooms as $room)
        <li><a href="{{ route('room_show', $room->id) }}">{{ $room->name }}</a></li>
     @endforeach
    </ul>
@endsection