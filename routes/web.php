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

// Homepage route
Route::get('/', function () {
    return redirect()->route('categories.index');
});

//Adminer route
Route::any('adminer', '\Miroc\LaravelAdminer\AdminerController@index');

// Login routes
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Category route
Route::resource('categories', 'CategoryController');

// Subcategory route
Route::resource('categories.subcategories', 'SubcategoryController');

// Photo route
Route::resource('categories.subcategories.photos', 'PhotoController');
