@extends('layouts.master')

@section('content')
<h1>Tous les livres publiés sur notre site</h1>
{{ $books->Links()}}
<ul class="list-group">
@forelse($books as $book)
<li class="list-group-item">
	<h3><a href="{{ url('book', $book->id) }}">{{ $book->title }}</a></h3>

	<div class="row">
		<div class="col-xs-6 col-md-3">
            <a href="#" class="thumbnail">
            <img width="250" src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}">
            </a>
        </div>
        <div class="col-xs-6 col-md-9">
        	<h5 class="font-weight-bold text-primary">Description :</h5>
			{{$book->description}}
			<hr>
			<h5>Auteur(s) : </h5>
			@forelse($book->authors as $author)
			<a href="{{ url('author', $author->id) }}">
			{{ ' - '. $author->name . '  (note : '.$author->pivot->note.')' }}
			</a>
			@empty
			Aucun auteur
			
			@endforelse
		</div>
    </div>
  

</li>		
</ul>

@empty

<li>Désolé, pour le moment aucun livre n'est publié sur notre</li>
@endforelse

@endsection