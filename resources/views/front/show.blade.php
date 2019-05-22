@extends('layouts.master')

@section('content')
<article class="row">
    <div class="col-md-12">
    @if(count($book)>0)
    <h3>{{ $book->title }}</h3>

    @if(count($book->picture) > 0)
    
    <div class="row">
        <div class="col-xs-12 col-md-4 mt-4">
            <a href="#" class="thumbnail">
            <img src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}">
            </a>
        </div>
    
    @endif
        <div class="col-xs-12 col-md-8 mt-4">
            <h4>Description :</h4>
                {{ $book->description }}

            <h4>Auteur(s) :</h4>
            <ul>
                @forelse($book->authors as $author)
                <li ><a href="{{ url('author', $author->id) }}">{{ $author->name . ' (note : '.$author->pivot->note.')' }}</a></li>
                @empty
                <li>Aucun auteur</li>
                @endforelse
            </ul>
        </div>
    </div>
    @else 
    <h1>Désolé aucun article</h1>
    @endif 
 
    </div>
</article>

@endsection 
