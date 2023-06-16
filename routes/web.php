<?php

use App\Providers\RouteServiceProvider;
use App\Http\Controllers\BuletinNewController;
use App\Http\Controllers\CandidateController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('forget_password', ['as' => 'user.fp', 'uses' => 'UserController@forgetPassword']);
Route::post('forget_password/fp', ['as' => 'user.forgetp', 'uses' => 'UserController@fp']);
Route::get('forget_serial_number', ['as' => 'user.fsn', 'uses' => 'UserController@forgetSecurityNumber']);
Route::post('forget_serial_number/fsn', ['as' => 'user.forgetsn', 'uses' => 'UserController@fsn']);
Route::get('admin', ['as' => 'admin.login', 'uses' => 'UserController@adminLogin']);
// Auth::routes();

// Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');
// Route::get('/home', ['as' => 'home', 'uses' => 'App\Http\Controllers\HomeController@index']);
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('dashboard');
Route::get('home/{id}/detail', ['as'=> 'db.detail', 'uses' => 'HomeController@detail']);

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::patch('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::patch('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	//buletin
	Route::get('buletin_news', ['as' => 'buletin_new.index', 'uses' => 'BuletinNewController@index']);
	Route::get('buletin_news/{buletin_new}/view', ['as'=> 'buletin_new.view', 'uses' => 'BuletinNewController@show']);

	//feedback
	Route::get('feedback', ['as' => 'feedback.index', 'uses' => 'FeedbackController@index']);
	Route::get('feedback/{feedback}/view', ['as'=> 'feedback.view', 'uses' => 'FeedbackController@show']);
	Route::get('feedback/create', ['as' => 'feedback.create', 'uses' => 'FeedbackController@create']);
	Route::post('feedback/create', ['as' => 'feedback.store', 'uses' => 'FeedbackController@store']);

	//candidate
	Route::get('candidates', ['as' => 'candidate.index', 'uses' => 'CandidateController@index']);

	//vote
	Route::get('votes', ['as' => 'vote.index', 'uses' => 'VoteController@index']);
	Route::get('votes/votpages/{id}', ['as' => 'vote.votes', 'uses' => 'VoteController@vote']);
	Route::post('votes/votpages/', ['as' => 'vote.storeVoting', 'uses' => 'VoteController@storeVoting']);
	
	Route::get('results', ['as' => 'result.index', 'uses' => 'VoteController@result']);
});

Route::group(['middleware' => ['auth', 'admin']], function () {
	//buletin
	Route::get('buletin_news/create', ['as' => 'buletin_new.create', 'uses' => 'BuletinNewController@create']);
	Route::post('buletin_news/create', ['as' => 'buletin_new.store', 'uses' => 'BuletinNewController@store']);
	Route::get('buletin_news/{buletin_new}/edit', ['as'=> 'buletin_new.edit', 'uses' => 'BuletinNewController@edit']);
	Route::post('buletin_news/{buletin_new}', ['as'=> 'buletin_new.update', 'uses' => 'BuletinNewController@update']);
	Route::get('buletin_news/{id}/delete', array('as' => 'buletin_new.delete', 'uses' => 'BuletinNewController@destroy'));

	//feedback
	Route::get('feedback/{feedback}/edit', ['as'=> 'feedback.edit', 'uses' => 'FeedbackController@edit']);
	Route::post('feedback/{feedback}', ['as'=> 'feedback.update', 'uses' => 'FeedbackController@update']);
	Route::get('feedback/{id}/delete', array('as' => 'feedback.delete', 'uses' => 'FeedbackController@destroy'));

	//vote
	Route::get('votes/create', ['as' => 'vote.create', 'uses' => 'VoteController@create']);
	Route::post('votes/create', ['as' => 'vote.store', 'uses' => 'VoteController@store']);
	Route::get('votes/{vote}/edit', ['as'=> 'vote.edit', 'uses' => 'VoteController@edit']);
	Route::post('votes/{vote}', ['as'=> 'vote.update', 'uses' => 'VoteController@update']);
	Route::get('votes/{id}/delete', ['as' => 'vote.delete', 'uses' => 'VoteController@destroy']);

	//user
	Route::get('users', ['as' => 'user.index', 'uses' => 'UserController@index']);
	Route::get('users/create', ['as' => 'user.create', 'uses' => 'UserController@create']);
	Route::post('users/create', ['as' => 'user.store', 'uses' => 'UserController@store']);
	Route::get('users/{user}/view', ['as'=> 'user.view', 'uses' => 'UserController@show']);
	Route::get('users/{user}/edit', ['as'=> 'user.edit', 'uses' => 'UserController@edit']);
	Route::post('users/{user}', ['as'=> 'user.update', 'uses' => 'UserController@update']);
	Route::get('users/{id}/delete', array('as' => 'user.delete', 'uses' => 'UserController@destroy'));

	//candidate
	Route::get('candidates/{id}/create', ['as' => 'candidate.create', 'uses' => 'CandidateController@create']);
	Route::post('candidates/create', ['as' => 'candidate.store', 'uses' => 'CandidateController@store']);
	Route::get('candidates/{candidate}/edit', ['as'=> 'candidate.edit', 'uses' => 'CandidateController@edit']);
	Route::post('candidates/{candidate}', ['as'=> 'candidate.update', 'uses' => 'CandidateController@update']);
	Route::get('candidates/{id}/delete', array('as' => 'candidate.delete', 'uses' => 'CandidateController@destroy'));
});

Route::group(['middleware' => ['auth','admin']], function () {
	Route::get('{page}', ['as' => 'page.index', 'uses' => 'PageController@index']);
});


