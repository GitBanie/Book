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

// Route::get('/', function () {
//     return view('welcome');
// });

//Route

//Page index, affichage de tous les livres
Route::get('/', "FrontController@index"); // On peut renomer l'url avec comme méthode name

//Detail d'une page
Route::get('book/{id}','FrontController@show')->where(['id' => '[0-9]+']);

//Detail d'un auteur
Route::get('author/{id}','FrontController@showBookByAuthor')->where(['id' => '[0-9]+']);

Route::get('genre/{id}','FrontController@showBookByGenre')->where(['id' => '[0-9]+']);

Route::post('vote/','FrontController@create')->name('vote');
