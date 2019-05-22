<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Genre;

class FrontController extends Controller
{
    protected $paginate = 2;
	public function __construct(){
		view()->composer('partials.menu',function($view){

			$genres = Genre::pluck('name','id')->all();
			$view->with('genres',$genres);
		});
	}

    public function index(){
    	$books = Book::published()->paginate($this->paginate);

    	return view('front.index', ['books' => $books]);
    }

    public function show(int $id){
    	$bookId = Book::find($id);
    	return view('front.show',['book'=> $bookId]);
    }

    public function showBookByAuthor(int $id){
    	$author = Author::find($id);
    	$books =  Author::find($id)->books()->paginate($this->paginate);
    	return view ('front.author',['books'=>$books, 'author'=>$author]);

    }

    public function showBookByGenre(int $id){
        $genre = Genre::find($id);
        $books = $genre->books()->paginate(2);

        return view ('front.genre',['books'=>$books, 'genre'=>$genre]);
    }
}
