@extends('layouts.app')

@section('title', 'Liste des localités')

@section('content')
    <h1>Liste des {{ $resource }}</h1>

    <ul>
     @foreach($localities as $locality)
        <li><a href="{{ route('locality_show', $locality->id) }}">{{ $locality->postal_code }} {{ $locality->locality }}</a></li>
     @endforeach
    </ul>
@endsection