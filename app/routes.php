<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('uses' => 'ProductsController@get_ShowProductsViews'));

Route::get('settings-page', array('uses' => 'ProductsController@show_settingsPage'));

Route::resource('products', 'ProductsController');

Route::get('productList', array('uses' => 'ProductsController@get_ShowProducts'));

Route::get('infoProduct', array('uses' => 'ProductsController@get_infoProduct'));

Route::get('addProduct', array('uses' => 'ProductsController@insert_productInfo'));

Route::get('getTable', array('uses' => 'ProductsController@get_TableData'));

Route::get('updateProduct', array('uses' => 'ProductsController@update_productInfo'));

Route::get('createCompany', array('uses' => 'ProductsController@createCompany'));

Route::get('populateCompanyList', array('uses' => 'ProductsController@populateCompanyList'));

Route::get('getSortableTable', array('uses' => 'ProductsController@get_SortableTableData'));

Route::get('updateOrderProducts', array('uses' => 'ProductsController@get_UpdateOrderProducts'));

Route::get('deleteProduct', array('uses' => 'ProductsController@get_deleteTable'));

Route::get('insertProduct', array('uses' => 'ProductsController@get_InsertTable'));

Route::get('removeProduct', array('uses' => 'ProductsController@deleteProduct'));