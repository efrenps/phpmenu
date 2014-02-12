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

Route::get('settings', array('uses' => 'ProductsController@get_settings'));

//8888888888888888888888888888888888

Route::get('settings-page', array('uses' => 'ProductsController@show_settingsPage'));


Route::resource('products', 'ProductsController');

Route::get('productList', array('uses' => 'ProductsController@get_ShowProducts'));

Route::get('infoProduct', array('uses' => 'ProductsController@get_infoProduct'));

Route::get('addProduct', array('uses' => 'ProductsController@insert_productInfo'));




