@extends('layouts.master')

@section('content')
<div class="container">
	<h1 class="mt-2 text-primary">Modifier un livre :  </h1><hr>
	<div class="row">
		<div class="col-md-6 mt-4">
			
			<form action="{{ route('book.update' , $book->id )}}" method="post" enctype="multipart/form-data">
				@csrf
				@method('PUT')
				<div>
					<label for="title"><strong>Titre</strong></label>
					<input class="form-control " id="title" value="{{$book->title}}" name="title" type="text">
					@if($errors->has('title')) 
					<span class="alert text-danger">{{$errors->first('title')}}</span>
					@endif
				</div>
				<div class ="mt-4">
					<label for="description"><strong>Description</strong></label>
					<textarea class="form-control " value="{{$book->description}}" name="description" id="description" rows="10">{{$book->description}}</textarea>
					@if($errors->has('description')) 
					<span class="error text-danger">{{$errors->first('description')}}</span>
					@endif
				</div>
				<div class ="mt-4" >
					<label for="SelectGenre"><strong>Genre : </strong></label>
				    <select id="SelectGenre" name="genre_id" value="">
				      <option value="0" {{is_null($book->genre)? 'selected' : ''}} >Pas de genre</option>
				      @foreach ($genres as $id => $name)
				      <option {{ (!is_null($book->genre) and $book->genre->id == $id)? 'selected' : '' }}   value="{{ $id }}"  >{{ $name }}</option>
				      @endforeach
				    </select>
				</div>
		</div>
		<div class="col-md-6 mt-4">

			<h6 class="mb-4"><strong>Choisir un/des auteurs :</strong></h6>
			<div>
				@forelse($authors as $id => $name)
				<label class="control-label" for="author{{$id}}">{{ $name }}</label>
				<input name="authors[]" value="{{ $id }}" @if( is_null($book->authors) == false and  in_array($id, $book->authors()->pluck('id')->all())) checked @endif
 				type="checkbox" class="mr-1" id="author{{$id}}">
				@empty
				@endforelse
			</div>

			<h6 class=" mt-4 mb-2"><strong>Status :</strong></h6>
			<div class="form-check">
			  	<input class="form-check-input" type="radio" @if ($book->status =='published') checked @endif  name="status" value=" published" checked >
			  	<label class="form-check-label" for="publier">Publier</label>
			</div>

			<div class="form-check">
				<input class="form-check-input" type="radio" @if($book->status =='unpublished') checked @endif  name="status" value=" unpublished" checked>
				<label class="form-check-label" for="defaultCheck2">Dépublier</label>
			</div>

			<div class="mt-4">
				<label for="file"><strong>File</strong></label>
	    		<input type="file" name="picture" class="form-control-file" id="file">
	    		@if($errors->has('picture')) <span class="error bg-warning text-warning">{{$errors->first('picture')}}</span> @endif
	    			@if(!empty($book->picture))
        			<div class="mt-3">
        				<h6><strong>Image associée : </strong></h6>
			            <a href="#" class="thumbnail">
			            <img src="{{asset('images/'.$book->picture->link)}}" alt="{{$book->picture->title}}">
			            </a>
        			</div>
    				@endif
    		</div>

    		<div class="mt-5">
    			<input type="submit" class="btn btn-primary" value="Modifier" >
    		</div>

		</div>
			</form>
	</div>
</div>

@endsection