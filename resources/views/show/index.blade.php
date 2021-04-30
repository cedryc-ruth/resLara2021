@extends('layouts.app')

@section('title', 'Liste des spectacles')

@section('content')
    <h1>Liste des {{ $resource }}</h1>

    <div id="vueFilter">
        <input type="checkbox" @click="filterShows"><label>Spectacle réservable seulement</label>   

        <ul>
        @foreach($shows as $show)
            <li v-if="seen" href="{{ $show->bookable }}">
                <a href="{{ route('show_show', $show->id) }}">{{ $show->title }}</a>
                @if($show->bookable)
                <span>{{ $show->price }} €</span>
                @endif

                @if($show->representations->count()==1)
                - <span>1 représentation</span>
                @elseif($show->representations->count()>1)
                - <span>{{ $show->representations->count() }} représentations</span>
                @else
                - <em>aucune représentation</em>
                @endif
            </li>
        @endforeach
        </ul>
    </div>
@endsection

@section('script')
<script src="https://unpkg.com/vue@next"></script>
<script>
const vm = Vue.createApp({
    data() {
        return {
            seen: true,
        }
    },
    methods: {
        filterShows() {
            this.seen = !this.seen
        }
    }
}).mount('#vueFilter');
</script>
@endsection