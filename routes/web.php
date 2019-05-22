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
// Route::group('prefix')
Route::get('/','ProdukCustomerController@index');
Route::resource('/collection','ProdukCustomerController');
Auth::routes(['verify' => true]);

Route::post('/addToCart','CartController@addToCart')->name('addToCart');
Route::get('/viewcart','CartController@index');
Route::get('/cart/deleteItem/{id}','CartController@deleteItem');
Route::get('/cart/update-quantity/{id}/{quantity}','CartController@updateQuantity');

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');
Route::get('/check-out','CheckOutController@index');
    Route::get('/check-shipping','CheckOutController@checkshipping');
    Route::post('/submit-checkout','CheckOutController@submitcheckout');
    Route::resource('/transaction','TransactionController');
    Route::get('/order-review','OrderController@index');
    Route::post('/cod','OrderController@cod');

Route::group(['prefix'=>'admin', 'guard'=>'admin'],function(){
    Route::get('/login','AuthAdmin\LoginController@showLoginForm')->name('admin.login');
    Route::post('/login','AuthAdmin\LoginController@login')->name('admin.login.submit');
    Route::get('/','AdminController@index')->name('admin.home');
    Route::resource('/kategori','KategoriController');
Route::resource('/kurir','KurirController');
Route::resource('/produk','ProdukController');
Route::resource('/transactionAdmin','TransactionAdminController');
});






