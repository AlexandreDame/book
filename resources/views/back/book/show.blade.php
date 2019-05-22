@extends('layouts.master')

@section('content')
<div class="card mb-3" style="max-width: 100%;">
  <div class="row no-gutters">
	@if(!empty($book->picture))
    <div class="col-md-5">
      <img src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}" class="card-img" >
    </div>
	@endif
    <div class="col-md-7">
      <div class="card-body">
        <h3 class="card-title"><strong>Titre : </strong>{{$book->title}}</h3>
        <p class="card-text"><strong>Genre : </strong>{{$book->genre->name?? 'aucun'}}</p>
        <p class="card-text"><strong>Date de création : </strong>{{$book->created_at}}  |  <strong>Date de mise à  jour : </strong>{{$book->updated_at}}</p>
        <p class="card-text"><strong>Status : </strong>{{$book->status}}</p>
        <p class="card-text"><strong>Description : </strong>{{$book->description}}</p>
        
        <h3>Les auteurs :</h3>
        <ul>
            <li><strong>Nombre d'auteur(s) </strong>: {{count($book->authors)}}</li>
        @forelse($book->authors as $author)
            <li>{{$author->name}}</li>
        @empty
        aucun auteur
        @endforelse
        </ul>
      </div>
    </div>
  </div>
</div>

@endsection 
