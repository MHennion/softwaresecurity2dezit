<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'PCController@index');
Route::post('/predict', 'PCController@predict')->name("predict");
Route::post('/suggestion', 'PCController@suggestion')->name("suggestion");

// Route::get('/', function() {
//     return Redirect::to('https://thedarksidesoftwaresecurity.ga/');
// });