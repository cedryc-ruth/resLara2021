@extends('layouts.app')

@section('title', 'Fiche d\'un lieu de spectacle')

@section('content')
    <article>
        <h1>{{ $location->designation }}</h1>
        <address>
            <p>{{ $location->address }}</p>
            <p>{{ $location->locality->postal_code }} 
               {{ $location->locality->locality }}
            </p>

            @if($location->website)
            <p><a href="{{ $location->website }}" target="_blank">{{ $location->website }}</a></p>
            @else
            <p>Pas de site web</p>
            @endif
            
            @if($location->phone)
            <p><a href="tel:{{ $location->phone }}">{{ $location->phone }}</a></p>
            @else
            <p>Pas de téléphone</p>
            @endif
        </address>
        
        <form action="{{ route('location_note',$location->id)}}" method="post"> 
            @csrf
            <select name="note">
                <option>Votre note</option>
            @for($i=1;$i<=5;$i++)
                <option @if($i==$note) {{ 'selected' }} @endif>{{ $i }}</option>
            @endfor
            </select>
            <button>Noter</button>
        </form>
        @if(Session::has('success'))
        <p class="alert alert-success">{{ Session::get('success') }}</p>
        @elseif(Session::has('error'))
        <p class="alert alert-danger">{{ Session::get('error') }}</p>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <h2>Liste des spectacles</h2>
        <ul>
        @foreach($location->shows as $show)
            <li>{{ $show->title }}</li>
        @endforeach
        </ul>
    </article>
    
    <nav><a href="{{ route('location_index') }}">Retour à l'index</a></nav>
@endsection
