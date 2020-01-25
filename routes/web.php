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
    return view('app');
});

/**
 * Cart routes.
 *
 * We do not make use of the api.php-routes because normally an API should be stateless.
 * In a more advanced version I would make use of a cart-token which is generated the first time someone
 * puts an item into the cart. Using this token in subsequent requests will make the controller identify the cart.
 */
Route::get('api/cart', 'CartController@index');
Route::post('api/cart/{product}', 'CartController@add');
Route::delete('api/cart/{product}', 'CartController@delete');
Route::delete('api/cart/clear', 'CartController@clear');

/**
 * Product routes
 */
Route::get('api/products', 'ProductController@index');
