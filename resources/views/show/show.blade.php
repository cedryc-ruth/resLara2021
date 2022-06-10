@extends('layouts.app')

@section('title', 'Fiche d\'un spectacle')

@section('content')
    <article>
        <h1>{{ $show->title }}</h1>
            
        @if($show->poster_url)
        <p><img src="{{ asset('images/'.$show->poster_url) }}" alt="{{ $show->title }}" width="200"></p>
        @else
        <canvas width="200" height="100" style="border:1px solid #000000;"></canvas>
        @endif
        
        @if($show->location)
        <p><strong>Lieu de création:</strong> {{ $show->location->designation }}</p>
        @endif

        <p><strong>Prix:</strong> {{ $show->price }} €</p>
        
        @if($show->bookable)
        <p><em>Réservable</em></p>
        @else
        <p><em>Non réservable</em></p>
        @endif

        <h2>Liste des représentations</h2>
        @if($show->representations->count()>=1)
        <ul>
                @foreach ($show->representations as $representation)
                <li>{{ $representation->when }} 
                @if($representation->room)
                &commat; {{ $representation->room->location->designation }} ({{ $representation->room->name }})
                @elseif($representation->show->location)
                ({{ $representation->show->location->designation }})
                @else
                (lieu à déterminer)
                @endif 
                </li>              
            @endforeach
        </ul>
        @else
        <p>Aucune représentation</p>
        @endif

        <h2>Liste des artistes</h2>
        <p><strong>Auteur:</strong>
        @foreach ($collaborateurs['auteur'] as $auteur)
            {{ $auteur->firstname }} 
            {{ $auteur->lastname }}@if($loop->iteration == $loop->count-1) et 
            @elseif(!$loop->last), @endif
        @endforeach
        </p>
        <p><strong>Metteur en scène:</strong>
        @foreach ($collaborateurs['scénographe'] as $scenographe)
            {{ $scenographe->firstname }} 
            {{ $scenographe->lastname }}@if($loop->iteration == $loop->count-1) et 
            @elseif(!$loop->last), @endif
        @endforeach
        </p>
        <p><strong>Distribution:</strong>
        @foreach ($collaborateurs['comédien'] as $comedien)
            {{ $comedien->firstname }} 
            {{ $comedien->lastname }}@if($loop->iteration == $loop->count-1) et 
            @elseif(!$loop->last), @endif
        @endforeach
        </p>

        <h2>Liste des mots-clés</h2>
        @if($show->tags->count()>=1)
        <ul>
            @foreach ($show->tags as $tag)
                <li><a href="{{ route('tag_show', $tag->id) }}">{{ $tag->tag }}</a></li>  
            @endforeach
        </ul>
        @else
        <p>Aucun mot-clé</p>
        @endif

    @if(Auth::check() && Auth::user()->isAdmin())
        <form method="post" action="{{ route('tag_new') }}">
            @csrf
            <div>
                <input type="text" name="tag">
                <span class="helper"></span>
            </div>
            <input type="hidden" name="show_id" value="{{ $show->id }}">
            <button>Ajouter</button>
        </form>

        @if(Session::has('message'))
        <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
        @endif
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
    </article>
    
    <nav><a href="{{ route('show_index') }}">Retour à l'index</a></nav>
@endsection

@section('script')
<script>
const tagField = document.querySelector('form input[name=tag]');

tagField.addEventListener('keyup', function(data) {
    const API_URL = '{{ env('APP_URL') }}' +'/api';

    let newTag = tagField.value;

    const spanHelper = document.querySelector('input[name=tag] + span.helper');

    //Envoyer requête AJAX
    const options = {
        method: 'GET',
        mode: 'cors',
    };

    fetch(API_URL+"/show/"+{{ $show->id }}+"/tag/"+newTag,options)
    .then(function(response) {
        return response.json();
    }).then(function(data) {
        if(data.data.length!=0) {
            //Afficher message
            spanHelper.innerHTML = 'Ce mot-clé est déjà associé à ce spectacle !';
        } else {
            spanHelper.innerHTML = '';
        }
    });
});
</script>
@endsection