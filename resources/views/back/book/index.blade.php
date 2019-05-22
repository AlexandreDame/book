@extends('layouts.master')

@section('content')
	
{{$books->links()}}	

<a class="btn btn-primary mb-4" href="{{ url('admin/book/create') }}" role="button">Ajouter un livre</a>
@include ('partials.flash')
<table class="table table-bordered table-striped table-dark ">
    <thead class="text-center bg-primary">
        <tr>
            <th scope="col">Titre</th>
            <th scope="col">Auteur(s)</th>
	    	<th scope="col">Genre</th>
            <th scope="col">Date de publication</th>
            <th scope="col">Status</th>
            <th scope="col">Edition</th>
            <th scope="col">Voir</th>
            <th scope="col">Supression</th>
        </tr>
    </thead>
    <tbody>
    @forelse($books as $book)
        <tr class="text-center">
        	
            <td class="align-middle"><a href="{{route('book.edit', ['id' => $book->id])}}">{{$book->title}}</a></td>
            <td class="align-middle">
            @forelse($book->authors as $author)
                {{$author->name}}
            @empty
            aucun auteur
            @endforelse
            </td>
	    	<td class="align-middle">{{$book->genre->name?? 'aucun genre' }}</td>
            <td class="align-middle">{{$book->created_at}}</td>
            <td class="align-middle">
            	@if($book->status == 'published')
                <button type="button" class="btn btn-success">publié</button>
                @else 
                <button type="button" class="btn btn-warning">Non publié</button>
                @endif

			</td>
            <td class="align-middle">
                <a href="{{route('book.edit', ['id' => $book->id])}}">Editer</a>
            </td>
            <td class="align-middle">
                <a href="{{route('book.show', $book->id)}}">Voir</a>
            </td>
            <td class="align-middle">
            	<form class="delete" method="POST" action="{{route('book.destroy', $book->id)}}">
                {{ method_field('DELETE') }}
                {{ csrf_field() }}
                <input class="btn btn-danger" type="submit" value="Supprimer" >
            </form>

			</td>
        
        </tr>
    @empty
        aucun titre ...
    @endforelse
    </tbody>
</table>
{{$books->links()}}
@endsection 
@section('scripts')
	@parent
	<script src="{{asset('js/confirm.js')}}"></script>
@endsection
