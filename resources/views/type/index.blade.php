@extends('layouts.app')

@section('title', 'Liste des types d\'artistes')

@section('content')
    <h1>Liste des {{ $resource }}</h1>

    <ul>
     @foreach($types as $type)
        <li><a href="{{ route('type_show', $type->id) }}">{{ $type->type }}</a></li>
     @endforeach
    </ul>
@endsection