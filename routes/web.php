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

use App\Book;
use Illuminate\Http\Request;

Route::get('/books', 'BookController@index')->name('book.list');

Route::get('/book/all/{name}', 'BookController@all')->name('book.all');
Route::delete('/book/all/{id}', 'BookController@destroy')->name('book.destroy');

Route::get('/book/all', function () {
    return redirect('/home');
});


Route::get('/book/edit/{id}', 'BookController@edit')->name('book.edit');
Route::post('/book/update/{id}', 'BookController@update')->name('book.update');
Route::post('/book/{id}', 'BookController@complete')->name('book.complete');
Route::post('/book', 'BookController@store')->name('book.store');

Route::get('/friend', 'BookController@friend')->name('book.friend');
Route::delete('/friend/{id}', 'BookController@remove')->name('book.remove');

Route::post('/search/{name}', 'BookController@follow')->name('book.follow');
Route::get('/search', 'BookController@search')->name('book.search');

Route::get('/map', 'BookController@map')->name('book.map');




Route::get('/', function () {
    return redirect('/books');
});




Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
