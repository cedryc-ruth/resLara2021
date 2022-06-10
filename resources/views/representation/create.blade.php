@extends('layouts.app')

@section('title', 'Ajouter une représentation')

@section('content')
    <h2>Ajouter une représentation</h2>

    <form action="{{ route('representation_store') }}" method="post">
        @csrf
        <div>
            <label for="firstname">Show</label>
            <select id="show_id" name="show_id" class="@error('show_id') is-invalid @enderror">
                <option></option>
            @foreach($shows as $show)
                <option value="{{ $show->id }}"
                @if(old('show_id'))
                selected="selected"
                @endif    
                >{{ $show->title }}</option>
            @endforeach
            </select>
	    @error('show_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>

        <div>
            <label for="lastname">Date</label>
            <input type="datetime-local" id="when" name="when" 
	       @if(old('when'))
                value="{{ old('when') }}"  
            @endif
	           class="@error('when') is-invalid @enderror">

	    @error('when')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>

        <div>
            <label for="lastname">Salle</label>
            <select id="room_id" name="room_id" class="@error('room_id') is-invalid @enderror">
                <option></option>
            @foreach($rooms as $room)
                <option value="{{ $room->id }}"
                @if(old('room_id'))
                selected="selected"
                @endif    
                >{{ $room->name }}</option>
            @endforeach
            </select>
	    @error('room_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        </div>

        <button>Ajouter</button>
    <a href="{{ route('representation_index') }}">Annuler</a>
    </form>

@if ($errors->any())
    <div class="alert alert-danger">
	   <h2>Liste des erreurs de validation</h2>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

    <nav><a href="{{ route('representation_index') }}">Retour à l'index</a></nav>
@endsection