<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
	return $request->user();
});

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@authenticate');
Route::get('open', 'DataController@open');

Route::group(['middleware' => ['jwt.verify']], function() {
	Route::get('user', 'UserController@getAuthenticatedUser');
	Route::get('closed', 'DataController@closed');
});

Route::get('/allCategory', 'UserController@allCategory');

Route::get('/category_edit/{id}', 'UserController@category_edit');

Route::post('/edit_category', 'UserController@edit_category');

Route::post('/supplier_form', 'UserController@supplier_form');

Route::get('/add_supplier', 'UserController@add_supplier');

Route::get('category_delete/{id}', 'UserController@category_delete');

Route::post('/edit_supplier', 'UserController@edit_supplier');

Route::get('/add_category', 'UserController@add_category');

Route::post('/category_form', 'UserController@category_form');






