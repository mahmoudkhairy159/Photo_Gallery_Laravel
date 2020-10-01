<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Auth;
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


Route::get('/', 'AlbumsController@index');
Route:: resource('albums','AlbumsController');
Route:: resource('photos','photosController');
Route:: get('photos/createForm/{id}','photosController@create')->name('addPhoto');
Route:: get('/trashed-albums','AlbumsController@trashed')->name('trashedAlbums.index');
Route:: get('/trashed-albums/{id}','AlbumsController@restore')->name('trashed.restoreAlbum');
Route:: get('/trashed-photos/{id}','PhotosController@trashed')->name('trashedPhotos.index');
Route:: get('/trashed-photoss/{id}','PhotosController@restore')->name('trashed.restorePhoto');






Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
