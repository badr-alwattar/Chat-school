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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/getUsers', 'UsersController@getUsers');
Route::get('/getCurrentUser', 'UsersController@getCurrentUser');
Route::get('/getMessages', 'MessagesController@getMessages');


Route::resource('homework', 'HomeworkController');
Route::resource('homeworksol', 'HomeworkSolutionController');
Route::post('homeworksol/myupdate', 'HomeworkSolutionController@myupdate');
Route::get('/settings/{id}', 'HomeController@AccountSettings');
Route::get('/profile/{id}', 'HomeController@Profile');
Route::post('/updateAdmin', 'HomeController@updateAdmin');

