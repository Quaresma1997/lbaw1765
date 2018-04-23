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
    return redirect('homepage');
    else
        return redirect('index');
});

// Cards
Route::get('cards', 'CardController@list');
Route::get('cards/{id}', 'CardController@show');

// API
Route::put('api/cards', 'CardController@create');
Route::delete('api/cards/{card_id}', 'CardController@delete');
Route::put('api/cards/{card_id}/', 'ItemController@create');
Route::post('api/item/{id}', 'ItemController@update');
Route::delete('api/item/{id}', 'ItemController@delete');
Route::post('api/profile/{id}', 'ProfileController@update');
Route::delete('api/profile/{id}', 'ProfileController@delete');
Route::post('api/add_event', 'EventController@add');
Route::delete('api/event/{id}', 'EventController@delete');
Route::post('api/event/{id}', 'EventController@update');

// Authentication

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

//About
Route::get('about', 'AboutController@show')->name('about');

//Index
Route::get('index', 'IndexController@show')->name('index');

//Homepage
Route::get('homepage', 'HomePageController@show')->name('homepage');

//Profile
Route::get('profile/{id}', 'ProfileController@show');

//Events
Route::get('events/{id}', 'EventController@show');

//Cities
Route::get('cities/{country}', 'CityController@list');

//Countries
Route::get('countries', 'CountryController@list');



