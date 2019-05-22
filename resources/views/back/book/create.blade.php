@extends('layouts.master')

@section('content')
<div class="container">
	<h1 class="mt-2 text-primary">Créer un livre :  </h1><hr>
	<div class="row">
		<div class="col-md-6 mt-4">
			
			<form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
				{{ csrf_field() }}
				<div>
					<label for="title"><strong>Titre</strong></label>
					<input class="form-control " id="title" value="{{old('title')}}" name="title" type="text">
					@if($errors->has('title')) 
					<span class="alert text-danger">{{$errors->first('title')}}</span>
					@endif
				</div>
				<div>
					<label for="description"><strong>Description</strong></label>
					<textarea class="form-control " value="description" name="description" id="description" rows="3">{{old('description')}}</textarea>
					@if($errors->has('description')) 
					<span class="error text-danger">{{$errors->first('description')}}</span>
					@endif
				</div>
				<div>
					<label for="SelectGenre"><strong>Genre : </strong></label>
				    <select id="SelectGenre" name="genre_id" value="">
				      <option value="0">Pas de genre</option>
				      @foreach ($genres as $id => $name)
				      <option {{ old('genre_id')==$id? 'selected' : '' }} value="{{ $id }}"  >{{ $name }}</option>
				      @endforeach
				    </select>
				</div>
		</div>
		<div class="col-md-6 mt-4">

			<h6 class="mb-4"><strong>Choisir un/des auteurs :</strong></h6>
			<div>
				@forelse($authors as $id => $name)
				<label class="control-label" for="author{{$id}}">{{ $name }}</label>
				<input name="authors[]" value="{{ $id }}" {{ ( !empty(old('authors')) and in_array($id, old('authors')) )? 'checked' : ''  }} type="checkbox" class="mr-1" id="author{{$id}}">
				@empty
				@endforelse
			</div>

			<h6 class=" mt-4 mb-2"><strong>Status :</strong></h6>
			<div class="form-check">
			  	<input class="form-check-input" type="radio" @if(old('status')=='published') checked @endif name="status" value=" published" checked >
			  	<label class="form-check-label" for="publier">Publier</label>
			</div>

			<div class="form-check">
				<input class="form-check-input" type="radio" @if(old('status')=='unpublished') checked @endif  name="status" value=" unpublished" checked>
				<label class="form-check-label" for="defaultCheck2">Dépublier</label>
			</div>

			<div class="mt-4">
				<label for="file"><strong>File</strong></label>
	    		<input type="file" name="picture" class="form-control-file" id="file">
	    		@if($errors->has('picture')) <span class="error bg-warning text-warning">{{$errors->first('picture')}}</span> @endif
								
			</div>

    		<div class="mt-5">
    			<input type="submit" class="btn btn-primary" value="Enregistrer" >
    		</div>

		</div>
			</form>
	</div>
</div>

@endsection