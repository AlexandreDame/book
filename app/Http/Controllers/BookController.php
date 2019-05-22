<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use App\Author;
use App\Genre;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){

        $books = Book::paginate(4);

        return view('back.book.index', ['books' => $books]);
        
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::pluck('name','id')->all();
        $genres = Genre::pluck('name','id')->all();

        return view('back.book.create', ['authors'=>$authors, 'genres'=>$genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title' => 'required',
            'description' => 'required|string',
            'genre_id' => 'integer',
            'authors.*' =>'integer',
            'status' => 'in:published,unpublished',
            'title_image' => 'string|nullable', 
            'picture' => 'image|max:3000',

        ]);
        
        //dump($request->all());
        $book = Book::create($request->all());
        $book->authors()->attach($request->authors);

        $im = $request->file('picture');
        
        // si on associe une image Ã  un book 
        if (!empty($im)) {
            
            $link = $request->file('picture')->store('images');

            // mettre Ã  jour la table picture pour le lien vers l'image dans la base de donnÃ©es
            $book->picture()->create([
                'link' => $link,
                'title' => $request->title_image?? $request->title
            ]);
        }

        return redirect()->route('book.index')->with('message','La nouvelle référence est bien enregistrée !');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $book = Book::find($id);
        return view('back.book.show',['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {       $book = Book::find($id);

            $authors = Author::pluck('name', 'id')->all();
            $genres = Genre::pluck('name', 'id')->all();

            return view('back.book.edit', compact('book', 'authors', 'genres'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required|string',
            'genre_id' => 'integer',
            'authors.*' => 'integer', 
            'status' => 'in:published,unpublished'
        ]);

        $book = Book::find($id); 

        $book->update($request->all());
        
        $book->authors()->sync($request->authors);

        $im = $request->file('picture');
        
        
        if (!empty($im)) {

            $link = $request->file('picture')->store('images');

            // suppression de l'image si elle existe 
            if(count($book->picture)>0){
                Storage::disk('local')->delete($book->picture->link); 
                $book->picture()->delete(); 
            }

            
            $book->picture()->create([
                'link' => $link,
                'title' => $request->title_image?? $request->title
            ]);
            
        }


        return redirect()->route('book.index')->with('message', 'La référence a bien été mise à jour !');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Book::find($id);

        $book->delete();

        return redirect()->route('book.index')->with('message', 'L\'élément a bien été supprimé !');
    }

    
}
