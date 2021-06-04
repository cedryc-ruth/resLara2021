@extends('layouts.app')

@section('title', 'Liste des artistes')

@section('content')
    <h1>Liste des agents</h1>

    <ul>
    @foreach($agents as $agent)
        <li>{{ $agent->name }}
            <ul>
            @foreach($agent->artists as $artists)
                <li>{{ $artists->firstname }} {{ $artists->lastname }}</li>
            @endforeach
            </ul>
        </li>
    @endforeach
    </ul>
@endsection