<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Auth routes
Route::post('login', 'API/AuthController@login');
Route::post('register', 'API/AuthController@register');

// Route for admin permissions
Route::prefix('admin')->group(function() {
	Route::post('login', 'API/AuthController@adminLogin');
	Route::post('register', 'API/AuthController@adminRegister');
});

Route::get('products', 'ProductController@index');
Route::get('products/{products}', 'ProductController@show');
Route::post('product', 'ProductController@store')->middleware(['auth:api', 'scope:create']);
Route::put('product/{product}', 'ProductController@update')->middleware(['auth:api', 'scope:edit']);
Route::delete('product/{product}', 'ProductController@destroy')->middleware(['auth:api', 'scope:delete']);