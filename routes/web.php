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

Route::get('/', function () {
    redirect('/films');
});

Auth::routes();

Route::get('/films', 'FilmsController@index')->name('films');
Route::get('/films/{film}', 'FilmsController@show')->name('film');
