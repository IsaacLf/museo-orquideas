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
    return view('welcome');
});
Route::resource('entries', 'EntryController');
Route::resource('media', 'MediaController');
Auth::routes();

Route::get('/index', 'HomeController@index')->name('home');
Route::get('/edit', 'Admincontroller@edit')->name('edit');
Route::get('/upload', 'Admincontroller@upload')->name('upload');
Route::get('/users', 'Admincontroller@users')->name('users')->middleware('admin');

Route::post('/media/upload-new',  'MediaController@uploadImage');