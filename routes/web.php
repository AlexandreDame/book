<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
	    return view('welcome');
});

Route::get('books',function(){

		return App\Book::All();
});
*/


//Page d'accueil :
Route::get('/','FrontController@index');
//Page d'un livre :
Route::get('book/{id}','FrontController@show')->where(['id'=>'[0-9]+']);
//Page d'un auteur :	
Route::get('author/{id}','FrontController@showBookByAuthor')->where(['id'=>'[0-9]+']);
//Page d'un genre :
Route::get('genre/{id}','FrontController@showBookByGenre')->where(['id'=>'[0-9]+']);

Route::resource('admin/book','BookController')->middleware('auth');

Auth::routes();


