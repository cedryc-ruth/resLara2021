@extends('layouts.app')

@section('title', 'Liste des roles')

@section('content')
    <h1>Liste des {{ $resource }}</h1>

    <ul>
     @foreach($roles as $role)
        <li><a href="{{ route('role_show', $role->id) }}">{{ $role->role }}</a></li>
     @endforeach
    </ul>
@endsection