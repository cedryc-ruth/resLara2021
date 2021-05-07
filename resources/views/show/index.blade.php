@extends('layouts.app')

@section('title', 'Liste des spectacles')

@section('content')
    <h1>Liste des {{ $resource }}</h1>

    <div id="vueFilter">
        <input type="checkbox" @click="filterShows"><label>Spectacle réservable seulement</label>   

        <ul>
        @foreach($shows as $show)
            <li :class="{ hide: filter && 1!={{ $show->bookable }} }">
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

        <ul>
            <template v-for="show in shows"  :key="show.id">
                <li v-if="!filter || 1==show.bookable" v-html="show.title"></li>
            </template>
        </ul>
 
        <ul>
            <li v-for="item in items">@{{ item.datasetid }}</li>
        </ul>
    </div>
@endsection

@section('style')
<style>
.hide { display: none }
.block { display: block }
</style>
@endsection

@section('script')
<script src="https://unpkg.com/vue@next"></script>
<script>
const API_URL = 'http://localhost:8000';
const vm = Vue.createApp({
    data() {
        return {
            filter: false,
            shows: [
            @foreach($shows as $show)   
                { id: {{ $show->id }}, title: '{{ $show->title }}', bookable: {{ $show->bookable }} },
            @endforeach
            ],
            items: null
        }
    },
    methods: {
        filterShows() {
            this.filter = !this.filter
        }
    }, mounted() {
        console.log('Monté !');

        fetch(API_URL+'/api/shows')
            .then(function(response) {
                return response.json()
            })
            .then((data) => {   console.log(data)
                this.items = data
            })
            .catch(function(error) {
                console.log(error)
            });
    }
});

vm.mount('#vueFilter');
</script>
@endsection