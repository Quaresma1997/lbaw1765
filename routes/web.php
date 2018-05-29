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
    if(Auth::check())
        if(Auth::user()->is_admin)
        return redirect('admin');
        else
        return redirect('homepage');
    else
        return redirect('index');
});



// API
Route::post('profile/{id}', 'ProfileController@update');
Route::delete('api/profile/{id}', 'ProfileController@delete');
Route::post('api/add_event', 'EventController@add');
Route::delete('api/event/{id}', 'EventController@delete');
Route::post('events/{id}', 'EventController@update');

//Route::post('api/add_post/', 'EventController@addPost');
Route::post('addPost/{id}', 'PostController@add')->name('posta');
Route::delete('deletePost/{id}', 'PostController@delete')->name('postd');
Route::post('updatePost/{id}', 'PostController@update')->name('postupdate');

Route::post('addPoll/{id}', 'PollController@add')->name('polla');
Route::post('addPoll_vote/{id}', 'Poll_votesController@add')->name('votea');


Route::put('api/shortcut', 'ShortcutController@add');
Route::delete('api/shortcut/{id}', 'ShortcutController@delete');




Route::delete('api/participant/', 'ParticipantController@delete');
Route::post('api/participant/', 'ParticipantController@create');
Route::delete('api/friendship/', 'FriendshipController@delete');
Route::put('api/invite/', 'EventInviteController@create');
Route::delete('api/invite/', 'EventInviteController@delete');
Route::post('api/invite/', 'EventInviteController@update');
Route::put('api/friend_request/', 'FriendRequestController@create');
Route::post('api/friend_request/', 'FriendRequestController@update');

Route::put('api/rating/', 'RatingController@create');
Route::post('api/rating/', 'RatingController@update');

Route::delete('api/admin/{username}', 'AdminController@delete');

Route::delete('api/event_update_warning/{id}', 'EventUpdateWarningController@delete');
Route::delete('api/event_delete_warning/{id}', 'EventDeleteWarningController@delete');

// Authentication

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//About
Route::get('about', 'AboutController@show')->name('about');

//Search
Route::get('search', ['uses'=> 'SearchController@index', 'as' => 'search']);

//Index
Route::get('index', 'IndexController@show')->name('index');

//Homepage
Route::get('homepage', 'HomePageController@show')->name('homepage');

//Admin
Route::get('admin', 'AdminController@show')->name('admin');

//Profile
Route::get('profile/{id}', 'ProfileController@show');

//Events
Route::get('events/{id}', 'EventController@show');

//Cities
Route::get('cities/{country}', 'CityController@list');

//Countries
Route::get('countries', 'CountryController@list');

//400
Route::get('400', 'IndexController@show400error');

//401
Route::get('401', 'IndexController@show401error');

//403
Route::get('403', 'IndexController@show403error');

//404
Route::get('404', 'IndexController@show404error');

//500
Route::get('500', 'IndexController@show500error');

// OAuth Routes
Route::get('auth/{provider}', 'Auth\SocialController@redirectToProvider');
Route::get('auth/{provider}/callback', 'Auth\SocialController@handleProviderCallback');