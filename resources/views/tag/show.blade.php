@extends('layouts.app')

@section('title', 'Fiche d\'un mot-clé')

@section('content')
    <h1>{{ ucfirst($tag->tag) }}</h1>

    <h2>Liste des spectacles</h2>
    <ul>
    @foreach($tag->shows as $show)    
        <li>{{ $show->title }}</li>
    @endforeach
    </ul>
@endsection
