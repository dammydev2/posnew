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


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/ItemKit', 'ItemController@ItemKit');

Route::get('/category_edit/{id}', 'ItemController@category_edit');

Route::get('category_delete/{id}', 'ItemController@category_delete');

Route::get('supplier_delete/{id}', 'ItemController@supplier_delete');

Route::get('/add_category', 'ItemController@add_category');

Route::post('/edit_category', 'ItemController@edit_category');

Route::post('/edit_supplier', 'ItemController@edit_supplier');

Route::post('/addItemKit', 'ItemController@addItemKit');

Route::post('/supplier_form', 'ItemController@supplier_form');

Route::get('/supplier_edit/{id}', 'ItemController@supplier_edit');

Route::get('/add_supplier', 'ItemController@add_supplier');

Route::get('/allCategory', 'ItemController@allCategory');

Route::get('allItem', 'ItemController@allItem');

Route::get('/allSupplier', 'ItemController@allSupplier');

Route::get('/item_edit/{id}', 'ItemController@item_edit');

Route::get('/inventory/{id}', 'ItemController@inventory');

Route::get('/addworker', 'WorkerController@addworker');

Route::post('/editItemKit', 'ItemController@editItemKit');

Route::post('/enter_stock', 'ItemController@enter_stock');

Route::get('/add_stock/{id}', 'ItemController@add_stock');

Route::post('/category_form', 'ItemController@category_form');

Route::get('/allworkers', 'WorkerController@allworkers');

Route::get('/worker_edit/{id}', 'WorkerController@worker_edit');

Route::post('/edit_worker', 'WorkerController@edit_worker');

Route::get('/worker_delete/{id}', 'WorkerController@worker_delete');

Route::get('/sale', 'SalesController@sale');

Route::post('/register2', 'WorkerController@register2');












